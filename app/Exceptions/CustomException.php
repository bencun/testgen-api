<?php

namespace App\Exceptions;

class CustomException extends \Exception{

    public $message = "";

    public function __construct($message){
        $this->message = $message;
    }
    
}