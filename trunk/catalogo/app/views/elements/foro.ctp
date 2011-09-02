<h2><?php echo "Sector $foroName"; ?></h2>
<div style="padding-bottom: 10px;">
    <div id="<?php echo $foroName; ?>" class=""></div>

    <h3>Foro del Sector</h3>
    <?php
    $i = 0;
    if (!empty($participantes) && count($participantes) > 0) {?>
        Participantes:<br />
        <ul class="grid_4">
            <?php foreach ($participantes as $p) { ?>
                <?php $i++; if($i == ceil(count($participantes)/2)+1):?>
                    </ul><ul class="grid_3">
                <?php endif ?>
                <li><?php echo $p?></li>
            <?php } ?>
        </ul>
    <?php } ?>
   
    <p>
        <!-- Informe Sectorial -->    
        <?php if (!empty($docInfoSectorial) ):?>
            <div class="clear"></div>
            <?php echo $html->link('Informe sectorial', $docInfoSectorial, array('target'=>'_blank')) ?>
        <?php else: ?>
            <p style="color:red">Falta Informe Sectorial</p>
        <?php endif ?>
        <br />
        <!-- Familia Profesional -->    
        <?php if (!empty($fliaProfesional) ):?>        
            <?php echo $html->link('Familia profesional del sector '.$fliaProfesional["nombre"], $fliaProfesional["link"], array('target'=>'_blank')) ?>
        <?php else: ?>
            <p style="color:red">Falta familia profesional</p>
        <?php endif ?>
    </p>
</div>    

<?php 
//
// En la carpeta /webroot/files/pdfs/nombre_del_sector si hay archivos, los ennumero

$carpetaDeEsteSector = 'files/pdfs/'.basename($this->here);
debug( $fileStructureWritter->tieneArchivos( $carpetaDeEsteSector ) );
if ($fileStructureWritter->tieneArchivos( $carpetaDeEsteSector )) {
?>
    <h3>Marcos de Referencia</h3>
    <?php
    $fileStructureWritter->write($carpetaDeEsteSector );
}
?>
