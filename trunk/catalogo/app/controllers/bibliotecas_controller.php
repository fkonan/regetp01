<?php


class BibliotecasController extends AppController{
    
    // sin tablas asociadas
    var $uses = array();
    
    var $helpers = array('ArrayWritter');
    
    var $components = array('FileReader');
    
    function index(){
        
        $this->cacheAction = true;
        
        $pdfs_path = WWW_ROOT . 'files' . DS. 'pdfs' . DS;       
        
        $this->set('archivos', $this->FileReader->getFiles($pdfs_path));
        
        $this->set('archivos2', $this->FileReader->getFiles($pdfs_path.DS.'resoluciones'));
    }
}
