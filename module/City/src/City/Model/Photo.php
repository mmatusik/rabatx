<?php
namespace City\Model;

class Photo
{
    public $id;
    public $id_offer;
    public $src;
    protected $inputFilter;    

    public function exchangeArray($data)
    {
        $this->id     = (isset($data['id'])) ? $data['id'] : null;
        $this->id_offer     = (isset($data['id_offer'])) ? $data['id_offer'] : null;
        $this->src = (isset($data['src'])) ? $data['src'] : null;
    }
    

}

