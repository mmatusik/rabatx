<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Select\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Http\Cookies;
use Zend\Http\Header\SetCookie;
use Zend\Session\SessionManager;
use Zend\Session\Config\SessionConfig;
use Zend\Session\Container;
use Zend\Http\Request;

class IndexController extends AbstractActionController
{ 
    public function indexAction()
    {
        $link = $this->params('link');     
        $cityTable = $this->getCityTable();
        $g = $cityTable->fetchAll();
           
        $viewmodel = new ViewModel(array(
            'citys' => $g,
        ));
        return $viewmodel;       
    }  
    
    public function setAction()
    {   
        $link = $this->params('link');
        if($link) {        
            setcookie('city',$link,time() + 2*7*24*60*60,'/','', false);
            return $this->redirect()->toRoute('city',array('action' => 'index'));
        }
                      
        $viewmodel = new ViewModel();
        return $viewmodel;
    }
    
    public function zmianaAction()
    {   
        setcookie('city','',time() - 2*7*24*60*60,'/','', false);
        return $this->redirect()->toRoute('select',array('action' => 'index'));
    }
    
    public function getOfferTable()
    {
        if (!$this->offerTable) {
            $sm = $this->getServiceLocator();
            $this->offerTable = $sm->get('Dashboard\Model\OfferTable');
        }
        return $this->offerTable;
    }
    
    public function getOfferCityTable()
    {
        if (!$this->offercityTable) {
            $sm = $this->getServiceLocator();
            $this->offercityTable = $sm->get('Offer\Model\OfferCityTable');
        }
        return $this->offercityTable;
    }
    
        public function getCityTable()
    {
        if (!$this->cityTable) {
            $sm = $this->getServiceLocator();
            $this->cityTable = $sm->get('Offer\Model\CityTable');
        }
        return $this->cityTable;
    }
    
    public function getPhotoTable()
    {
        if (!$this->photoTable) {
            $sm = $this->getServiceLocator();
            $this->photoTable = $sm->get('City\Model\PhotoTable');
        }
        return $this->photoTable;
    }
}
