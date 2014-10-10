<?php
namespace City;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Dashboard\Model\Offer;
use Dashboard\Model\OfferTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use City\Model\Photo;
use City\Model\PhotoTable;

class Module
{
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',               
            ),
            'Zend\Loader\StandardAutoloader' => array(
                __DIR__ . '/autoload_login.php',
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    
    public function bootstrapSession($e)
    {
        $session = $e->getApplication()
                     ->getServiceManager()
                     ->get('Zend\Session\SessionManager');
        $session->start();

        $container = new Container('initialized');
        if (!isset($container->init)) {
             $session->regenerateId(true);
             $container->init = 1;
        }
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
    
    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'Dashboard\Model\OfferTable' =>  function($sm) {
                    $tableGateway = $sm->get('OfferTableGateway');
                    $table = new OfferTable($tableGateway);
                    return $table;
                },
                'OfferTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Offer());
                    return new TableGateway('offers', $dbAdapter, null, $resultSetPrototype);
                },
                'City\Model\PhotoTable' =>  function($sm) {
                    $tableGateway = $sm->get('PhotoTableGateway');
                    $table = new PhotoTable($tableGateway);
                    return $table;
                },
                'PhotoTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Photo());
                    return new TableGateway('photos', $dbAdapter, null, $resultSetPrototype);
                },          
                'Zend\Session\SessionManager' => function ($sm){
                    $config = $sm->get('config');
                    if (isset($config['session'])){
                        $session_config = $config['session'];

                        $sessionConfig = null;
                        if (isset($session_config['config'])){
                            $class = isset($session_config['config']['class'])
                                ? $session_config['config']['class']
                                : 'Zend\Session\Config\SessionConfig';
                            $options = isset($session_config['config']['options'])
                                ? $session_config['config']['options']
                                : array();
                            $sessionConfig = new $class();
                            $sessionConfig->setOptions($options);
                        }

                        $sessionStorage = null;
                        if (isset($session_config['storage'])){
                            $class = $session_config['storage'];
                            $sessionStorage = new $class();
                        }

                        $sessionSaveHandler = null;
                        if (isset($session_config['save_handler'])){
                            // class should be fetched from service manager
                            // since it will require constructor arguments
                            $sessionSaveHandler = $sm->get($session_config['save_handler']);
                        }

                        $sessionManager = new SessionManager(
                            $sessionConfig,
                            $sessionStorage,
                            $sessionSaveHandler
                        );

                        if (isset($session_config['validator'])){
                            $chain = $sessionManager->getValidatorChain();
                            foreach ($session_config['validator'] as $validator){
                                $validator = new $validator();
                                $chain->attach('session.validate', array(
                                    $validator,
                                    'isValid'
                                ));
                            }
                        }
                    } else {
                        $sessionManager = new SessionManager();
                    }
                    Container::setDefaultManager($sessionManager);
                    return $sessionManager;
                },                 
            ),
        );
    }

}