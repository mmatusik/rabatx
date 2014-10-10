<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Dashboard\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    const ROUTE_LOGIN        = 'zfcuser/login';
    protected $offerTable;
    public function indexAction()
    {
        //if($this->getSessionTable()->checkSession() == FALSE) {
        //    $this->redirect()->toRoute('home'); 
        //}
        
        $viewmodel = new ViewModel(array(
            'offers' => $this->getOfferTable()->fetchLimit(),
        ));
        $this->layout()->setVariables(array(
            'user_session_login' => $user_session_login,
            'user_session_session'  => $user_session_session,
        ));
        //$viewmodel->setVariable('user_session_login', $user_session_login);
        //$viewmodel->setVariable('user_session_session', $user_session_session);
        return $viewmodel;
    
    }
    
    public function recAction()
    {
        return new ViewModel();
    }
    
    public function getOfferTable()
    {
        if (!$this->offerTable) {
            $sm = $this->getServiceLocator();
            $this->offerTable = $sm->get('Dashboard\Model\OfferTable');
        }
        return $this->offerTable;
    }
    
}
