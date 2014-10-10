<?php
namespace Offer\Model;

class OfferCity
{
    public $id;
    public $company;
    protected $inputFilter;    

    public function exchangeArray($data)
    {
        $this->id_city     = (isset($data['id_city'])) ? $data['id_city'] : null;
        $this->id_offer     = (isset($data['id_offer'])) ? $data['id_offer'] : null;
    }
    

}

