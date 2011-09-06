<?php 
//
// En la carpeta /webroot/files/pdfs/nombre_del_sector si hay archivos, los ennumero

$carpetaDeEsteSector = 'files/pdfs/'.basename($this->here);
//debug(basename($this->here));
//debug($carpetaDeEsteSector);
//debug( $fileStructureWritter->tieneArchivos( $carpetaDeEsteSector ) );
if ($fileStructureWritter->tieneArchivos( $carpetaDeEsteSector )) {
?>
    <h3>Marcos de Referencia</h3>
    <?php
    $fileStructureWritter->write($carpetaDeEsteSector );
}
?>
