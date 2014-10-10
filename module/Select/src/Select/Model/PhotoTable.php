<?php
namespace City\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;

class PhotoTable
{
    protected $tableGateway;
    private $limit;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchall($id_offer)
    {
         $resultSet = $this->tableGateway->select(function(Select $select) use ($id_offer){
            $select->where(array(
                    'id_offer' => $id_offer
                )
            );});
        $resultSet->buffer();
        return $resultSet;
    }
    
    public function fetchmain($id_offer)
    {
        $resultSet = $this->tableGateway->select(function(Select $select) use ($id_offer){
            $select->where(array(
                    'id_offer' => $id_offer,
                    'main' => 1,
                )
            );});
        $row = $resultSet->current();
        return $row;
    }
}
