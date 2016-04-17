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

//require_once(__DIR__ . '/view/layout/dictionary.php');

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $eventManager->attach('dispatch', array($this, 'loadConfiguration'), 100);
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }

    public function init(ModuleManager $mm)
    {
        $mm->getEventManager()->getSharedManager()->attach(__NAMESPACE__,
        'dispatch', function($e) {
            $config = $e->getApplication()->getServiceManager()->get('config');
            $routeMatch = $e->getRouteMatch();
            $namespace = array_shift(explode('\\', $routeMatch->getParam('controller')));
            $controller = $e->getTarget();
            $controllerName = array_pop(explode('\\', $routeMatch->getParam('controller')));
            $actionName = strtolower($routeMatch->getParam('action'));

            // Use the layout assigned to the action
            if(isset($config['layouts'][$namespace]['controllers'][$controllerName]['actions'][$actionName]))
            {
                $controller->layout($config['layouts'][$namespace]['controllers'][$controllerName]['actions'][$actionName]);
            }
            // Use the controller default layout
            elseif(isset($config['layouts'][$namespace]['controllers'][$controllerName]['default']))
            {
                $controller->layout($config['layouts'][$namespace]['controllers'][$controllerName]['default']);
            }
            // Use the module default layout
            elseif(isset($config['layouts'][$namespace]['default']))
            {
                $controller->layout($config['layouts'][$namespace]['default']);
            }

        }, 10);
    }

    public function getConfig()
    {
        $config = include __DIR__ . '/config/module.config.php';
        require_once(__DIR__ . '/view/alice/index/dictionary.php');
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
                    'product-url' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '[:producturl/]',
                            'constraints' => array(
                                'producturl' => '[[a-zA-Z0-9_-]+]*',
                            ),
                            'defaults' => array(
                                'controller' => 'Alice\Controller\Index',
                                'action' => 'productUrl',
                            ),
                        ),
                    ),

                    'cms-template' => array(
                        'type'    => 'Regex',
                        'options' => array(
                            'regex' => '(?<key>([[a-zA-Z0-9_-]+]*))\.html',
                            'defaults' => array(
                                'controller' => 'Alice\Controller\Cms',
                                'action' => 'index',
                            ),
                            'spec' => '%key%.html',
                        ),
                    ),
                    'block-template' => array(
                        'type'    => 'Regex',
                        'options' => array(
                            'regex' => '(?<key>([[a-zA-Z0-9_-]+]*))',
                            'defaults' => array(
                                'controller' => 'Alice\Controller\Cms',
                                'action' => 'staticBlock',
                            ),
                            'spec' => '%key%',
                        ),
                    ),

                    'product' => array(
                        'type' => 'Zend\Mvc\Router\Http\Regex',
                        'options' => array(
                            'regex' => '(?<productname>([[a-zA-Z0-9_-]+]*))-(?<id>[0-9_-]+)\.html',
                            'defaults' => array(
                                '__NAMESPACE__' => 'Alice\Controller',
                                'controller' => 'Index',
                                'action' => 'product',
                            ),
                            'spec' => $dictionary::formatUrl('%productname%') . '-%id%.html',
                        ),
                    ),

                    'news' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => 'tin-tuc/',
                            'defaults' => array(
                                'controller' => 'Alice\Controller\Index',
                                'action' => 'news',
                            ),
                        ),
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

    public function loadConfiguration(MvcEvent $e)
    {
        $sm  = $e->getApplication()->getServiceManager();
     
        $controller = $e->getRouteMatch()->getParam('controller');
        if (0 !== strpos($controller, __NAMESPACE__, 0)) {
            //if not this module
            return;
        }
     
        //if this module 
        $exceptionstrategy = $sm->get('ViewManager')->getExceptionStrategy();
        $exceptionstrategy->setExceptionTemplate('error/error-variation');
    }
}
