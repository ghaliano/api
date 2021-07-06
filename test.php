<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2021-07-06
 * Time: 09:28
 */

class Logger{
    public function log($message){

    }
}

class Mailer{
    public function __construct(Logger $logger)
    {
    }

    public function send(){

        $this->logger->log("Email envoyé");
    }
}

class UserManager{
    private $mailer;
    public function __construct(Mailer $mailer){
        $this->mailer = $mailer;
    }
    public function subscribe(){
        $this->mailer->send("message");
    }
}
