<?php
namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;

class UzytkownicyTable
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
    
    public function countUsers($username, $pass)
    {
        $passmd5 = md5($pass);
        $resultSet = $this->tableGateway->select(array('username' => $username, 'pass' => $passmd5));
        return $resultSet->count();
    }  
}