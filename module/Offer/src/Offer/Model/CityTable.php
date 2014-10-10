<?php
namespace Offer\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;

class CityTable
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
    
    public function getCityIdLink($city)
    {
        $resultSet = $this->tableGateway->select(function(Select $select) use ($city){
        $select->where(array(
                'link' => $city
            )
        );});
        $row = $resultSet->current();
        return $row;
    }
    
    public function getCityWhere($city)
    {
        $resultSet = $this->tableGateway->select(function(Select $select) use ($city){
        $select->where(array(
                'id' => $city
            )
        );});
        $row = $resultSet->current();
        return $row;
    }
    
}
