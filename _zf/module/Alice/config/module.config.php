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
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'Alice\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'product' => array(
                    /*    'type' => 'Segment',
                        'options' => array(
                            'route' => '[:action[?id=:id]]',
                            'constraints' => array(
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id' => '[0-9]+',
                            ),
                            'defaults' => array(
                                '__NAMESPACE__' => 'Alice\Controller',
                                'controller'    => 'Index',
                                'action'    => 'product',
                            ),
                        ),*/
                        'type' => 'Zend\Mvc\Router\Http\Regex',
                        'options' => array(
                            'regex' => '(?<productname>([[a-zA-Z0-9_-]+]*))-(?<id>[a-zA-Z0-9_-]+)\.html',
                            'defaults' => array(
                                '__NAMESPACE__' => 'Alice\Controller',
                                'controller' => 'Index',
                                'action' => 'product',
                            ),
                            'spec' => '%productname%-%id%.html',
                        ),
                    ),
                ),
            ),
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /application/:controller/:action
            'alice' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Alice\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                ),
            ),

        //    'url' => array(
        //        'type' => UrlRoute::class,
        //    ),
        ),
    ),
//    'route_manager' => array(
//        'factories' => array(
//            UrlRoute::class => UrlRoute::class,
//        ),
//    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'factories' => array(
            'translator' => 'Zend\Mvc\Service\TranslatorServiceFactory',
        ),
    //    'invokables' => array(
    //        UrlReferenceMapper::class => UrlReferenceMapper::class,
    //    ),
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
    //        'Alice\Controller\Url' => Controller\UrlController::class,
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout' => __DIR__ . '/../view/layout/layout.phtml',
            'dictionary' => __DIR__ . '/../view/layout/dictionary.php',
            'alice/index/index' => __DIR__ . '/../view/alice/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
            'cms/header' => __DIR__ . '/../view/cms/header.phtml',
            'cms/footer' => __DIR__ . '/../view/cms/footer.phtml',
            'cms/ups' => __DIR__ . '/../view/cms/ups.phtml',
            'cms/contact' => __DIR__ . '/../view/cms/contact.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
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
