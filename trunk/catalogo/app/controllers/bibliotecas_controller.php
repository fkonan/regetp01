<?php


class BibliotecasController extends AppController{
    
    // sin tablas asociadas
    var $uses = array();
    
    function index(){
        $path =  APP_DIR . DS . WEBROOT_DIR . DS .'files/pdfs/marcos_referencia';
        $fol = new Folder($path);
        $marcos_referencia = $fol->read();
        debug($fol->pwd());
        debug($marcos_referencia);
        $this->set(compact('marcos_referencia'));
    }
}
