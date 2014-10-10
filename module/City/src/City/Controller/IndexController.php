<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace City\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Http\Cookies;
use Zend\Http\Header\SetCookie;
use Zend\Session\Config\StandardConfig;

class IndexController extends AbstractActionController
{ 
    public function indexAction()
    {
        $link = $this->params('link');

        $cookie_city = $_COOKIE['city'];

        if(strlen($cookie_city) <= 0) {
            return $this->redirect()->toRoute('select',array('action' => 'index'));
        }        
        
        
        $offerTable = $this->getOfferTable();
        $cityoffer = $this->getOfferCityTable();
        $cityTable = $this->getCityTable();
        $getlink = $cityTable->getCityIdLink($cookie_city);
        $photoTable = $this->getPhotoTable();
        $links = $getlink->id;
        
        //OFERTY
        $get_offers = $cityoffer->fetchOffers($links); // Oferty o id miasta, np. 4
        foreach($get_offers as $offer) {
            $offers = $offerTable->fetchOffers($offer->id_offer);
            $photo = $photoTable->fetchmain($offer->id_offer);
            $photo_src[] = $photo->src;
            $offer_name[] = $offers->name; //Wyświetlanie ofert
            $offer_rec[] = $offers->recommended; //Wyświetlanie ofert polecanych
            if($offer->recommended == 1) {
                $offer_reco[] = $offers->recommended;
            }
            $offer_link[] = $offers->link; //Wyświetlanie ofert
            $offer_old_price[] = $offers->old_price; //Wyświetlanie ofert
            $offer_new_price[] = $offers->new_price; //Wyświetlanie ofert
            $offer_rec_count[] = $offerTable->fetchOffersRec($offer->id_offer); 
            
        }
        
        $viewmodel = new ViewModel(array(
            'offer_name' => $offer_name,
            'offer_rec' => $offer_rec,
            'offer_old_price' => $offer_old_price,
            'offer_new_price' => $offer_new_price,
            'offer_link' => $offer_link,
            'recommended' => $offer_rec_count[0],
            'offer_reco' =>  count($offer_reco),
            'photo_src' => $photo_src,
        ));
        return $viewmodel;        
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
