<?php
namespace Offer\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;

class aOfferTable
{
    protected $tableGateway;
    
    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function addAdressOffer($offer)
    {
        $this->tableGateway->insert($offer);    
    }
}
