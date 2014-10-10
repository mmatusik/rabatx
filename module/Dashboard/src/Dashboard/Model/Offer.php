<?php
namespace Dashboard\Model;

class Offer
{
    public $id;
    public $name;
    public $disc;
    public $how;
    public $end_time;
    public $new_price;
    public $old_price;
    public $worth;
    public $recommended;
    public $link;
    protected $inputFilter;    

    public function exchangeArray($data)
    {
        $this->id     = (isset($data['id'])) ? $data['id'] : null;
        $this->name     = (isset($data['name'])) ? $data['name'] : null;
        $this->disc = (isset($data['disc'])) ? $data['disc'] : null;
        $this->how  = (isset($data['how'])) ? $data['how'] : null;
        $this->end_time  = (isset($data['end_time'])) ? $data['end_time'] : null;
        $this->recommended  = (isset($data['recommended'])) ? $data['recommended'] : null;
        $this->worth  = (isset($data['worth'])) ? $data['worth'] : null;
        $this->new_price     = (isset($data['new_price'])) ? $data['new_price'] : null;
        $this->old_price    = (isset($data['old_price'])) ? $data['old_price'] : null;
        $this->link     = (isset($data['link'])) ? $data['link'] : null;
    }
    

}

