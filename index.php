<?php
/**
 * Require the Tree
 *
 * If you are not using Composer, you need to require the
 * Tree and register its PSR-0 autoloader.
 *
 * If you are using Composer, you can skip this step.
 */
require 'Tree/Tree.php';

\Tree\Tree::registerAutoloader();

$tree = new \Tree\Tree();

