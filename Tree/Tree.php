<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Tree;

class Tree {
    public $tree;
    public $config;
    public $template = 'main';
    /**
     * Register Slim's PSR-0 autoloader
     */
    public static function autoload($className)
    {
        $thisClass = str_replace(__NAMESPACE__.'\\', '', __CLASS__);

        $baseDir = __DIR__;

        if (substr($baseDir, -strlen($thisClass)) === $thisClass) {
            $baseDir = substr($baseDir, 0, -strlen($thisClass));
        }

        $className = ltrim($className, '\\');
        $fileName  = $baseDir;
        $namespace = '';
        if ($lastNsPos = strripos($className, '\\')) {
            $namespace = substr($className, 0, $lastNsPos);
            $className = substr($className, $lastNsPos + 1);
            $fileName  .= str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
        }
        $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';

        if (file_exists($fileName)) {
            require $fileName;
        }
    }

    /**
     * Register Slim's PSR-0 autoloader
     */
    public static function registerAutoloader()
    {
        spl_autoload_register(__NAMESPACE__ . "\\Tree::autoload");
    }


    /**
     * Constructor
     * @param  array $ArrayToMenu Associative array of application settings
     */
    public function __construct(array $ArrayToMenu = array())
    {
        if (!empty($ArrayToMenu) && is_array($ArrayToMenu)) {
            $this->tree = $ArrayToMenu;
        }
        $this->config();
    }

    public function config(){
        if (!defined('VENDOR_DIR')){
            $this->definedIt();
        }
        $this->config = include VENDOR_DIR.DIRECTORY_SEPARATOR.'mader12/treemenu/config/config.treemenu.sample.php';
    }

    public function defineIt(){
        define('VENDOR_DIR', realpath(dirname(__DIR__)).DIRECTORY_SEPARATOR.'vendor');
    }

    public function render(){
        include VENDOR_DIR.DIRECTORY_SEPARATOR.'mader12'.
            DIRECTORY_SEPARATOR.'treemenu'.
            DIRECTORY_SEPARATOR.'template'.
            DIRECTORY_SEPARATOR.$this->template.'.php';
    }
    

}
