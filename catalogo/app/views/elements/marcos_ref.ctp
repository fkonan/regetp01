<?php 
//
// En la carpeta /webroot/files/pdfs/nombre_del_sector si hay archivos, los ennumero

$carpetaDeEsteSector = 'files/pdfs/'.basename($this->here);
//debug(WWW_ROOT.$carpetaDeEsteSector);
//debug(is_dir(WWW_ROOT.$carpetaDeEsteSector));
if (is_dir(WWW_ROOT.$carpetaDeEsteSector) && $fileStructureWritter->tieneArchivos( $carpetaDeEsteSector )) {
?>
    <h3>Marcos de Referencia</h3>
    <?php
    $fileStructureWritter->write($carpetaDeEsteSector );
}
?>
