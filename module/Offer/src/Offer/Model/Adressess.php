<?php
namespace Offer\Model;

class Adressess
{
    public $id;
    public $company;
    protected $inputFilter;    

    public function exchangeArray($data)
    {
        $this->id     = (isset($data['id'])) ? $data['id'] : null;
        $this->company     = (isset($data['company'])) ? $data['company'] : null;
    }
    

}

