<?php
namespace Offer;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Offer\Model\Adressess;
use Offer\Model\AdressessTable;
use Offer\Model\aOffer;
use Offer\Model\aOfferTable;
use Offer\Model\OfferCity;
use Offer\Model\OfferCityTable;
use Offer\Model\City;
use Offer\Model\CityTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Validator\AbstractValidator;
use Offer\Model\Region;
use Offer\Model\RegionTable;

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
                'Offer\Model\AdressessTable' =>  function($sm) {
                    $tableGateway = $sm->get('AdressessTableGateway');
                    $table = new AdressessTable($tableGateway);
                    return $table;
                },
                'AdressessTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Adressess());
                    return new TableGateway('addresses', $dbAdapter, null, $resultSetPrototype);
                },
                'Offer\Model\aOfferTable' =>  function($sm) {
                    $tableGateway = $sm->get('aOfferTableGateway');
                    $table = new aOfferTable($tableGateway);
                    return $table;
                },
                'aOfferTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new aOffer());
                    return new TableGateway('adresses_offers', $dbAdapter, null, $resultSetPrototype);
                },
                'Offer\Model\OfferCityTable' =>  function($sm) {
                    $tableGateway = $sm->get('OfferCityTableGateway');
                    $table = new OfferCityTable($tableGateway);
                    return $table;
                },
                'OfferCityTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new OfferCity());
                    return new TableGateway('offers_city', $dbAdapter, null, $resultSetPrototype);
                },
                'Offer\Model\CityTable' =>  function($sm) {
                    $tableGateway = $sm->get('CityTableGateway');
                    $table = new CityTable($tableGateway);
                    return $table;
                },
                'CityTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new City());
                    return new TableGateway('city', $dbAdapter, null, $resultSetPrototype);
                },        
                'Offer\Model\RegionTable' =>  function($sm) {
                    $tableGateway = $sm->get('RegionTableGateway');
                    $table = new RegionTable($tableGateway);
                    return $table;
                },
                'RegionTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Region());
                    return new TableGateway('region', $dbAdapter, null, $resultSetPrototype);
                },                                  
            ),
        );
    }

}