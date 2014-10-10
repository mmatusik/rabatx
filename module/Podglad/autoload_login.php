<?php

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;

class Login 
{
    public function chcekLogin() 
    {
        if($this->getSessionTable()->checkSession() == FALSE) {
            $this->redirect()->toRoute('home'); 
        }
    }
    
    public function getSessionTable()
    {
        if (!$this->sessionTable) {
            $sm = $this->getServiceLocator();
            $this->sessionTable = $sm->get('Application\Model\SessionTable');
        }
        return $this->sessionTable;
    }
}
