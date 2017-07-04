<?php
return [
    'ajax' => true,
    'ajaxdata' => [
        //Name for ajax give
        'getObjectToIndex' => [
            'header' => 'Тематические области',
            'get' => true,
            'post' => false,
            'firstdata' => '',
            'url' => '/home/get-tree-class',
            'uniqFirstId' => 'id-tree_0',
            'uniqFirstIdUl' => 'class-ul_0',
            'css' => 'height: 300px;
                    overflow: auto;
                    overflow-y: overlay;
                    font-size: 15px;
                    margin-top: 5px;
                    text-align:left;'
        ]
    ]
];

