<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Podglad\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        $link = $this->params('link');
        $offerTable = $this->getOfferTable(); //Pobieranie tabeli
        $photoTable = $this->getPhotoTable();
        $offer = $offerTable->fetchOffer($link); //Wyświetlanie wyniku
        
        $pr = $offer->new_price / $offer->old_price * 100;
	$percent = round(100-$pr); // Obliczanie rabatu
        $photos = $photoTable->fetchall($offer->id);       
        
        $viewmodel = new ViewModel(array(
            'name' => $offer->name,
            'old_price' => $offer->old_price,
            'new_price' => $offer->new_price,
            'disc' => $offer->disc,
            'worth' => $offer->worth,
            'how' => $offer->how,
            'percent' => $percent,
            'photos' => $photos,
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
    
    public function getPhotoTable()
    {
        if (!$this->photoTable) {
            $sm = $this->getServiceLocator();
            $this->photoTable = $sm->get('City\Model\PhotoTable');
        }
        return $this->photoTable;
    }
    
}
