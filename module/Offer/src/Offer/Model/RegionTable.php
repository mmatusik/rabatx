<?php
namespace Offer\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;

class RegionTable
{
    protected $tableGateway;
    
    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }
    public function fetchAll()
    {
        $select = $this->tableGateway->getSql()->select(); 
        $resultSet = $this->tableGateway->selectWith($select);
        $resultSet->buffer();
        $resultSet->next();

        return $resultSet;
    }
    public function getCityId($city)
    {
        $resultSet = $this->tableGateway->select(function(Select $select) use ($city){
        $select->where(array(
                'name' => $city
            )
        );});
        $row = $resultSet->current();
        return $row;
    }
}
