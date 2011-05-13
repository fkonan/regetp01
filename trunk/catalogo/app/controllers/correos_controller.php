<?php


class CorreosController extends AppController{
    
    // sin tablas asociadas a este controlador
    var $uses = null;
    
    var $components = array('Email');
    
    function contacto(){
        /* @var $email EmailComponent */
        $email =& $this->Email;
        $email->to('pepito@gmail.com');
    }
}