<?php
namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Application\Model\Uzytkownicy;
use Application\Model\UzytkownicyTable;
use Application\Model\Session;
use Application\Model\SessionTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Validator\AbstractValidator;
use Zend\Session\SessionManager;
use Zend\Session\Container;

class Module
{
    
    
    public function onBootstrap(MvcEvent $e)
    {
        $translator=$e->getApplication()->getServiceManager()->get('translator');
        $translator->addTranslationFile(
            'phpArray',
            './vendor/zendframework/zendframework/resources/languages/pl/Zend_Validate.php'

        );
        AbstractValidator::setDefaultTranslator($translator);
       // \Zend\Debug\Debug::dump($application);
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
    
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
    
    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'Application\Model\UzytkownicyTable' =>  function($sm) {
                    $tableGateway = $sm->get('UzytkownicyTableGateway');
                    $table = new UzytkownicyTable($tableGateway);
                    return $table;
                },
                'UzytkownicyTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Uzytkownicy());
                    return new TableGateway('users', $dbAdapter, null, $resultSetPrototype);
                },
                'Application\Model\SessionTable' =>  function($sm) {
                    $tableGateway = $sm->get('SessionTableGateway');
                    $table = new SessionTable($tableGateway);
                    return $table;
                },
                'SessionTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Session());
                    return new TableGateway('sessions', $dbAdapter, null, $resultSetPrototype);
                },        
            ),
        );
    }


}