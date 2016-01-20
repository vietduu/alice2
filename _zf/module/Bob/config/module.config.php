<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Bob\Controller\Index' => 
            'Bob\Controller\IndexController',
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'bobadmin/layout' => __DIR__ . '/../view/layout/layout.phtml',
            'bob/index/index' => __DIR__ . '/../view/bob/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
            'cms/bob/header' => __DIR__ . '/../view/cms/header.phtml',
            'cms/bob/footer' => __DIR__ . '/../view/cms/footer.phtml',
        ),
        'template_path_stack' => array(
            'bobadmin' => __DIR__ . '/../view',
        ),
    ),
);
