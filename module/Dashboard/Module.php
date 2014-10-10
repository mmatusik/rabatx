<?php
namespace Dashboard;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Dashboard\Model\Offer;
use Dashboard\Model\OfferTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

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
                      
            ),
        );
    }

}