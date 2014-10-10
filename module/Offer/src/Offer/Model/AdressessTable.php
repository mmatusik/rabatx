<?php
namespace Offer\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;

class AdressessTable
{
    protected $tableGateway;
    private $limit;
    private $a = array( 'Ę', 'Ó', 'Ą', 'Ś', 'Ł', 'Ż', 'Ź', 'Ć', 'Ń', 'ę', 'ó', 'ą', 'ś', 'ł', 'ż', 'ź', 'ć', 'ń' );
    private $b = array( 'e', 'o', 'a', 's', 'l', 'z', 'z', 'c', 'n', 'e', 'o', 'a', 's', 'l', 'z', 'z', 'c', 'n' );
        
    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        $resultSet = $this->tableGateway->select();
        
        return $resultSet;
    }
    
    public function getAdressId($li)
    {
        $resultSet = $this->tableGateway->select(function(Select $select) use ($li){
        $select->where(array(
                'company' => $li
            )
        );});
        $row = $resultSet->current();
        return $row;
    }
}
