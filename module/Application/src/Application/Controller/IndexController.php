<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Model\Users;  
use Application\Model\Session; //Model
use Zend\Session\Container;
use Zend\Mvc\Controller\Plugin\FlashMessenger;

class IndexController extends AbstractActionController
{
    protected $uzytkownicyTable;
    protected $sessionTable;
    protected $session_id;
    protected $user_ip; 
    
    public function indexAction()
    {
        $form = $this->getServiceLocator()->get('FormElementManager')->get('LoginForm');
        $title = 'LOGOWANIE';
        $undertitle = 'wypełnij formularz';
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $userTable = $this->getUzytkownicyTable();
                $sessionTable = $this->getSessionTable();
                $username_post = $request->getPost('username');
                $pass_post = $request->getPost('pass');
                $session_id = $this->genSessionId();
                $user_ip = $_SERVER['REMOTE_ADDR'];
                
                $userCount = $userTable->countUsers($username_post, $pass_post); //Zliczenie użykowników o danym loginie+haśle

                if($userCount == 1) { // Jezeli dane są prawidłowe(hasło i login jest poprawny) następuje przekierowanie.                  
                    if($sessionTable->countSession($username_post, $user_ip) == 0) { // Jeżeli sesja użytkownika nie istnieje lub wygasła, tworzy nową sesje
                        $sessionTable->setSession($username_post, $session_id, $user_ip);                                               
                    } else { // Jeżeli ktoś jest zalogowany bądź chcemy się zalogować z innego ip
                        $sessionTable->deleteSession($username_post, NULL, $user_ip ); // usuwamy sesję                      
                        
                       // if($sessionTable->countSession($username_post, $user_ip) == 0) { //po usunięciu sesji
                            $sessionTable->setSession($username_post, $session_id, $user_ip); // nadajemy ją od nowa
                        //}    
                    }
                    
                    $message = '<div class="confirmation-box round">Logowanie zakończone sukcesem! Zostaniesz przeniesiony.</div>'
                               .'<META HTTP-EQUIV="refresh" CONTENT="2; URL=dashboard">';
                } else { // Logowanie nieudane
                    $message = '<div class="error-box round">Logowanie zakończone nie powodzeniem! Sprawdź pisownie loginu i hasła.</div>';                                              
                }                
            }
        }
        $layout = $this->layout();
        $layout->setTemplate('layout/custom');
        $viewmodel = new ViewModel();
        $viewmodel->setVariable('form', $form);
        $viewmodel->setVariable('message', $message);
       
        $this->layout()->setVariables(array(
            'title' => $title,
            'undertitle'  => $undertitle,
        ));
        
        return $viewmodel;
    }
    
    public function getUzytkownicyTable()
    {
        if (!$this->uzytkownicyTable) {
            $sm = $this->getServiceLocator();
            $this->uzytkownicyTable = $sm->get('Application\Model\UzytkownicyTable');
        }
        return $this->uzytkownicyTable;
    }
    
    public function getSessionTable()
    {
        if (!$this->sessionTable) {
            $sm = $this->getServiceLocator();
            $this->sessionTable = $sm->get('Application\Model\SessionTable');
        }
        return $this->sessionTable;
    }
    
    public function genSessionId() {
        $this->session_id = md5(uniqid().'sóls5ratatat2atata3tat4a');
        return $this->session_id;
    }
}
