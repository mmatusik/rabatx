<?php
namespace Offer\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;

class OfferCityTable
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
    public function addOfferCity($offer)
    {
        $this->tableGateway->insert($offer);    
    }
    public function fetchOffers($id)
    {
        $resultSet = $this->tableGateway->select(function(Select $select) use ($id){
        $select->where(array(
                'id_city' => $id,
                'active' => 1,
            )
        );});
        return $resultSet;
    }
}
