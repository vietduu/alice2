<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Alice;

use Bob\Model\DataMapper\UrlReferenceMapper;
use Bob\Helper\UrlRouteFactory;
use Bob\Helper\UrlRoute;

return array(
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'factories' => array(
            'translator' => 'Zend\Mvc\Service\TranslatorServiceFactory',
        ),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Alice\Controller\Index' => Controller\IndexController::class,
            'Alice\Controller\Cms' => Controller\CmsController::class,
        ),
    ),
/*    'view_helpers' => array(
        'invokables' => array(
            'requestHandler' => 'Alice\View\Helper\RequestHandler',
        ),
    ),*/

    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'admin/layout' => __DIR__ . '/../view/layout/layout.phtml',
            'dictionary' => __DIR__ . '/../view/layout/dictionary.php',
            'alice/index/index' => __DIR__ . '/../view/alice/index/index.phtml',
            'alice/cms/index' => __DIR__ . '/../view/alice/index/cms-template.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
            'cms/alice/header' => __DIR__ . '/../view/cms/header.phtml',
            'cms/alice/footer' => __DIR__ . '/../view/cms/footer.phtml',
            'cms/ups' => __DIR__ . '/../view/cms/ups.phtml',
            'cms/contact' => __DIR__ . '/../view/cms/contact.phtml',
        ),
        'template_path_stack' => array(
            'admin' => __DIR__ . '/../view',
        ),
    ),
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),
    'navigation' => [
        'default' => [
            'home' => [
                'label' => 'Home',
                'route' => 'home'
            ],
        ],
    ],
);
