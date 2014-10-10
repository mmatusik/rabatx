<?php
namespace Dashboard\Model;

class Offer
{
    public $id;
    public $name;
    public $disc;
    public $how;
    public $end_time;
    public $recommended;
    protected $inputFilter;    

    public function exchangeArray($data)
    {
        $this->id     = (isset($data['id'])) ? $data['id'] : null;
        $this->name     = (isset($data['name'])) ? $data['name'] : null;
        $this->disc = (isset($data['disc'])) ? $data['disc'] : null;
        $this->how  = (isset($data['how'])) ? $data['how'] : null;
        $this->end_time  = (isset($data['end_time'])) ? $data['end_time'] : null;
        $this->recommended  = (isset($data['recommended'])) ? $data['recommended'] : null;
    }
    

}

