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
class FileStructureWritterHelper extends AppHelper {
    
    /**
     * Son los indices a leer del array
     */
    var $helpers = array('Html');
    
    var $folders = 'folders';
    var $files = 'files';

    // paths de cada file para poder generar su link de descarga
    var $paths = '';
    var $level = 1;
    
    function getFileStructure($array) {

        $mainkey = key($array);

        // inicializa path para el level si no existe
        if (empty($this->paths[$this->level])) {
                $this->paths[$this->level] = '';
        }
        $this->paths[$this->level] = $mainkey."/";
        
        if (!empty($array[$mainkey][$this->files])) {
            $cantFiles = count($array[$mainkey][$this->files]);
        } 
        if (!empty($array[$mainkey][$this->folders])) {
            $cantFolders = count($array[$mainkey][$this->folders]);
        }

        if (!@$cantFiles && !@$cantFolders) {
            $this->paths[$this->level] = '';
            $this->level--;
        }
        else {
            echo "<ul>";
            if (@$cantFolders){
                foreach ($array[$mainkey][$this->folders] as $k=>$folder) {
                    if (!empty($folder)) {
                        $this->level++;
                        $arraux = array();
                        $arraux[$k] = $folder;

                        echo "<li>".$k;

                        $this->getFileStructure($arraux);
                    }
                }
                echo "</li>";
            }

            if (@$cantFiles) {
                $this->_readFiles($array[$mainkey][$this->files], $this->paths);
                echo "</ul>";

                $this->level--;
            }
            elseif (!@$cantFiles) {
                $this->paths[$this->level] = '';
                $this->level--;
            }
        }
    }
    
    function _readFiles($array){
        if (!empty($array)) {
            foreach ($array as $val){
                $val = utf8_decode($val);
                echo "<li><a href='".$this->_getFileFullPath($val)."'>".$val."</a></li>";
            }
        }
    }

    function _getFileFullPath($file) {
        $path = '';
        for ($i=1; $i <= $this->level; $i++) {
            $path .= $this->paths[$i];
        }

        return $this->Html->url('/files/pdfs/' . $path . $file);
    }
}
