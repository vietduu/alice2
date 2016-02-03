<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Alice;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\ModuleManager\ModuleManager;

//require_once(dirname(dirname(dirname(__FILE__))).'\layout\dictionary.php');
require_once(__DIR__ . '\view\layout\dictionary.php');

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }

    public function init(ModuleManager $mm)
    {
        $mm->getEventManager()->getSharedManager()->attach(__NAMESPACE__,
        'dispatch', function($e) {
            $e->getTarget()->layout('admin/layout');
        });
    }

    public function getConfig()
    {
        $config = include __DIR__ . '/config/module.config.php';
        $dictionary = 'Dictionary';
        $config['router'] = array(
            'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'Alice\Controller\Index',
                        'action'     => 'index',
                        'cache'      => true
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'product' => array(
                        'type' => 'Zend\Mvc\Router\Http\Regex',
                        'options' => array(
                            'regex' => '(?<productname>([[a-zA-Z0-9_-]+]*))-(?<id>[a-zA-Z0-9_-]+)\.html',
                            'defaults' => array(
                                '__NAMESPACE__' => 'Alice\Controller',
                                'controller' => 'Index',
                                'action' => 'product',
                            ),
                            'spec' => $dictionary::formatUrl('%productname%') . '-%id%.html',
                        ),
                    ),
                ),
            ),
           
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
        ));
        return $config;
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
}
