<?php
namespace Offer\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Offer\Form\CityForm;
use Offer\Form\PhotoForm;
use Zend\Mvc\Controller;
use Zend\File\Transfer\Adapter\Http;
use Zend\Validator\File;

class IndexController extends AbstractActionController
{
    protected $offerTable;
    protected $adressesTable;
    protected $adressesofferTable;
    
    public function indexAction()
    {
        $viewmodel = new ViewModel(array(
            'offers' => $this->getOfferTable()->fetchAll(),
        ));
        return $viewmodel;
    
    }
    
    public function addAction()
    {
        $form = $this->getServiceLocator()->get('FormElementManager')->get('AddForm');
        $request = $this->getRequest();
        if ($request->isPost()) {  
            $form->setData($request->getPost());
            if ($form->isValid()) {               
                $offerTable = $this->getOfferTable();
                $link = $offerTable->genOfferLink($request->getPost('name'));
                $time = time();
                $godzina = date('H:i:s');
                $end_time_1 = $request->getPost('end_time').' '.$godzina.''; 
                $end_time = strtotime($end_time_1);
                $offer = array(
                    'name' => $request->getPost('name'),
                    'disc' => $request->getPost('disc'),
                    'how' => $request->getPost('how'),
                    'worth' => $request->getPost('worth'),
                    'old_price' => $request->getPost('oldprice'),
                    'new_price' => $request->getPost('newprice'),
                    'add_time' => $time,
                    'end_time' => $end_time,
                    'active' => 0,
                    'id_category' => 1,
                    'link' => $link,
                    'code_per_person' => $request->getPost('code_per_person'),
                );
                $offerTable->addOffer($offer); //DODANIE OFERTY
                return $this->redirect()->toRoute('offer', array('action' => 'company', 'link' => $link, ));
            }
        }
        
        $viewmodel = new ViewModel();
        $viewmodel->setVariable('form', $form);
        $viewmodel->setTemplate('offer/index/add_1'); // path to phtml file under view folder
        return $viewmodel;
    }
    
    public function companyAction()
    {
        $form = $this->getServiceLocator()->get('FormElementManager')->get('CompanyForm');
        $request = $this->getRequest();
        $offerTable = $this->getOfferTable();
        $adressTable = $this->getAdressessTable();
        $link = $this->params('link');
        $name = $request->getPost('company');
        $offer_id = $offerTable->getOfferId($link);
        $adress_id = $adressTable->getAdressId($name);
        
        if ($request->isPost()) {  
            $form->setData($request->getPost());
            if ($form->isValid()) {               
                $adress = array(
                    'id_offer' => $offer_id->id,
                    'id_adress' => $adress_id->id,
                );
                $this->getaOfferTable()->addAdressOffer($adress); //DODANIE ADRESU OFERTY
                return $this->redirect()->toRoute('offer', array('action' => 'photo', 'link' => $link, ));               
            }
        }
        
        $viewmodel = new ViewModel();
        //$viewmodel->setVariable('form', $form);
        $viewmodel->setVariable('form', $form);
        $viewmodel->setVariable('addresses', $this->getAdressessTable()->fetchAll());
        $viewmodel->setTemplate('offer/index/add_2'); // path to phtml file under view folder
        return $viewmodel;
    }
    
    public function photoAction()
    {
        $form = new PhotoForm('upload-form');
        $request = $this->getRequest();
        if ($request->isPost()) {  
            
            $form->setData($request->getPost());
         
            echo 'post</br>';
            
            if ($form->isValid()) {
                echo 'valid';
                $files = $form->getData();
    // $upload = new Http();
     var_dump($files);
     $upload->setDestination(realpath(APPLICATION_PATH . '\..\data\upload'));
 
     try { //be sure to call receive() before getValues()
      $upload->receive();
     } catch (Zend_File_Transfer_Exception $e) {
       $e->getMessage();
     }
 
     $filename = $files['image']['name']; //optional info about uploaded file
     $filesize = $upload->getFileSize('image');
     $filemimeType = $upload->getMimeType('image');
 
     $dstFilePath = '/images/'.$filename;
     
     echo "<img src=''.$filename.'' />";
     
   }
 }

                    /*    if ( isset($_FILES['image']) ) {
                                if (! $_FILES['image']['error'] && $_FILES['image']['size'] < $max_file_size) {
                                        $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
                                        if (in_array($ext, $valid_exts)) {
                                                        $path = 'uploads/' . uniqid() . '.' . $ext;
                                                        $size = getimagesize($_FILES['image']['tmp_name']);

                                                        $x = (int) $request->getPost('x');
                                                        $y = (int) $request->getPost('y');
                                                        $w = (int) $request->getPost('w') ? $request->getPost('w') : $size[0];
                                                        $h = (int) $request->getPost('h') ? $request->getPost('h') : $size[1];

                                                        $data = file_get_contents($_FILES['image']['tmp_name']);
                                                        $vImg = imagecreatefromstring($data);
                                                        $dstImg = imagecreatetruecolor($nw, $nh);
                                                        imagecopyresampled($dstImg, $vImg, 0, 0, $x, $y, $nw, $nh, $w, $h);
                                                        imagejpeg($dstImg, $path);
                                                        imagedestroy($dstImg);
                                                        echo "<img src='$path' />";

                                                } else {
                                                        echo 'unknown problem!';
                                                } 
                                } else {
                                        echo 'file is too small or large';
                                }
                        } else {
                                echo 'file not set';
                        }
                } else {
                        echo 'bad request!';
                }
                //return $this->redirect()->toRoute('offer', array('action' => 'city', 'link' => $link, ));               
            }*/
        
        $viewmodel = new ViewModel();
        $viewmodel->setVariable('form', $form);
        
        return $viewmodel;
    
    }

public function cityAction()
    {
        $dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $form = new CityForm ($dbAdapter);
        $request = $this->getRequest();
        $cityoffer = $this->getOfferCityTable();
        $offerTable = $this->getOfferTable();
        $city = $this->getCityTable();
        $link = $this->params('link');
        if ($request->isPost()) {  
            $tabs = $request->getPost('city');
            $t = count($tabs)-1;
            $offer = $offerTable->getOfferId($link);
                for ($x=0; $x<=$t; $x++) {
                    $ct = $city->getCityId($tabs[$x]);
                    
                    $cityofferadd = array(
                            'id_city' => $tabs[$x],
                            'id_offer' => $offer->id,
                    );
                    
                    //$cityoffer->addOfferCity($cityofferadd);
            }  
            return $this->redirect()->toRoute('offer', array('action' => 'success', 'link' => $link, ));
        }
        $viewmodel = new ViewModel();
        //$viewmodel->setVariable('form', $form);
        $viewmodel->setVariable('form', $form);
        $viewmodel->setTemplate('offer/index/add_4'); // path to phtml file under view folder
        return $viewmodel;
    }
    
    public function successAction() 
    {
        $viewmodel = new ViewModel();
        $viewmodel->setTemplate('offer/index/add_5'); // path to phtml file under view folder
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
    
    public function getAdressessTable()
    {
        if (!$this->adressessTable) {
            $sm = $this->getServiceLocator();
            $this->adressessTable = $sm->get('Offer\Model\AdressessTable');
        }
        return $this->adressessTable;
    }
    
    public function getaOfferTable()
    {
        if (!$this->aofferTable) {
            $sm = $this->getServiceLocator();
            $this->aofferTable = $sm->get('Offer\Model\aOfferTable');
        }
        return $this->aofferTable;
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
}
