<?php
/**
 * Escribe recursivamente un array dado
 * lo anida mediante titulos h1 h2 h3
 * 
 * funciona con arrays del tipo arbol
 * o sea que el perimer nodo debe contener un root
 * 
 * por ejemplo el array debera ser asi:
 * 
 * array['/'][0][subfolder][0][otrosubfolder]
 *                         [1][files del subfolder]
 * array['/'][0][files]
 * 
 * 
 */
class ArrayWritterHelper extends AppHelper {
    
    /**
     * Son los indices a leer del array
     */
    var $folders = 'folders';
    var $files = 'files';
    
    
    function write($array, $level = 1) {
               
        $title = key($array);
        $this->__printTitle($title, $level);
        
        $cantI = count($array[$title][$this->files]);
        $cantJ = count($array[$title][$this->folders]);

        if ($cantI || $cantJ) {
            echo "<ul>";            
            if ($cantI) {
                $this->__readFiles($array[$title][$this->files]);
            }
            if ($cantJ){
                $this->__readSubfolders(&$array[$title][$this->folders], $level+1);
            }
            echo "</ul>";
        }  
    }
    
    function __readFiles($array){
        foreach ($array as $val){
            $val = utf8_decode($val);
            echo "<li>$val</li>";
        }
    }
    
    function __readSubfolders(&$array, $level){
        foreach($array as $k=>$a){
            $vaux[$k] = $array[$k];
            $this->write($vaux, $level);
        }
    }
    
    
    function __printTitle($title, $level){
        $title = utf8_decode($title);
        echo "<h$level>$title</h$level>";        
    }
    
}
