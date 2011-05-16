<?php


class CorreosController extends AppController{
    
    // sin tablas asociadas a este controlador
    var $uses = null;
    
    var $components = array('Email');
    
    function contacto(){
        /* @var $email EmailComponent */
        
    }
    
    function desactualizada(){
        if (!empty($this->data)) {
            if ($this->RequestHandler->isAjax()) {                
                $this->autoRender = false;
                return "Gracias por informarnos sobre una desactualización";
            }
        }
    }
}