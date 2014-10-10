<?php
namespace Application\Model;

class Session
{
    public $id;
    public $artist;
    public $username;

    public function exchangeArray($data)
    {
        $this->id     = (isset($data['id'])) ? $data['id'] : null;
        $this->username = (isset($data['username'])) ? $data['username'] : null;
        $this->title  = (isset($data['title'])) ? $data['title'] : null;
    }
}