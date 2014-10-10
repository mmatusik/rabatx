<?php
namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Session\Container;

class SessionTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }
    
    public function countSession($username, $ip)
    {
        $resultSet = $this->tableGateway->select(array('username' => $username, 'ip' => $ip));
        return $resultSet->count();
    }

    public function setSession($username, $session, $ip)
    {
        $data = array(
            'username' => $username,
            'session'  => $session,
            'ip' => $ip,
        );
        $user_session = new Container('user'); 
        $user_session->username = $username; // Nadawnie sesji Username
        $user_session->session = $session; // Nadawanie sesji Session - to jest id sesji
        $this->tableGateway->insert($data); // Wrzucenie do bazy rekordu z ip sesja i nazwą użytkownika - później będzie to sprawdzane
        
    }

    public function deleteSession($username, $session, $ip)
    { 
        if($session == NULL) {
            $this->tableGateway->delete(array('username' => $username));
        } else {
            $this->tableGateway->delete(array('username' => $username, 'session'  => $session, 'ip' => $ip));
        }
        $user_session = new Container('user'); 
        $user_session->getManager()->getStorage()->clear('user');  
    }
    
    public function checkSession() { //Czy użytkownik jest zalogowany
        $user_session = new Container('user'); 
        $ip = $_SERVER['REMOTE_ADDR'];
        $username = $user_session->username;
        $session = $user_session->session;
        $resultSet = $this->tableGateway->select(array('username' => $username, 'session'  => $session, 'ip' => $ip));
        $session_count = $resultSet->count();
        
        if($session_count != 1) {
            return FALSE; 
        } else {
            return TRUE;
        }
    }
}