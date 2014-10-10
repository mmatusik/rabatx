<?php
namespace Offer\Model;

class aOffer
{
    public $id_offer;
    public $id_adress;
    protected $inputFilter;    

    public function exchangeArray($data)
    {
        $this->id_offer     = (isset($data['id_offer'])) ? $data['id_offer'] : null;
        $this->id_adress     = (isset($data['id_adress'])) ? $data['id_adress'] : null;
    }
    

}

