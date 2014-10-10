<?php
namespace Dashboard\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;

class OfferTable
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
    
    public function fetchLimit()
    {
        $resultSet = $this->tableGateway->select(function(Select $select){
        $select->limit(5);});
        return $resultSet;
    }

    public function fetchOffers($id) {
            $resultSet = $this->tableGateway->select(function(Select $select) use ($id){
            $select->where(array(
                    'id' => $id
                )
            );});
        $row = $resultSet->current();
        return $row;
    }
    
    public function fetchOffer($link) {
            $resultSet = $this->tableGateway->select(function(Select $select) use ($link){
            $select->where(array(
                    'link' => $link
                )
            );});
        $row = $resultSet->current();
        return $row;
    }
    
    public function fetchOffersRec($id) {
            $resultSet = $this->tableGateway->select(function(Select $select) use ($id){
            $select->where(array(
                    'id' => $id,
                    'recommended' => 1,
                )
            );});
        $row = $resultSet->current();
        if($row == false) {
            return false;
        } else {
            return $row;
        }
    }
    
    public function getOfferId($link)
    {
        $resultSet = $this->tableGateway->select(function(Select $select) use ($link){
        $select->where(array(
                'link' => $link,
            )
        );});
        $row = $resultSet->current();
        return $row;
    }

    public function addOffer($offer)
    {
        $this->tableGateway->insert($offer);    
    }

    public function genOfferLink ($string) {
        $resultSet = $this->tableGateway->select(array('name' => $string));
        $string = str_replace( $this -> a, $this -> b, $string );
        $string = preg_replace( '#[^a-z0-9]#is', ' ', $string );
        $string = trim( $string );
        $string = preg_replace( '#\s{2,}#', ' ', $string );
        $string = str_replace( ' ', '-', $string );
        $strings = strtolower($string);
        
        if($resultSet->count() != 0) {
            return $strings.uniqid();
        } else {
            return $strings;
        }
    }
}
