<br />

<?php echo $this->element('menu_docs')?>

<div class="grid_9">
    <div class="boxblanca boxdocs">
        <h1>Foros sectoriales</h1>
        <p>Descripci&oacute;n, Mecanismos de funcionamiento [Pablo]</p>
        
        <p><?echo $html->link('Ver metodología','/pages/foros_metodologia');?></p>
        
        <h4>Foros</h4>
        
        <?php 
        $vops = array(
            'foroName' => 'Fsd',
            'participantes' => array('pepe', 'lola'),
            'docInfoSectorial' => '/files/pdfs/'
        );
        
        $this->element('foro') ?>
        <p>Informes [Asignar al foro correspondiente]</p>
        <ul type="disc">
            <li>Hort&iacute;cola (Link a PDF)</li>
            <li>Est&eacute;tica Profesional (Link a PDF)</li>
            <li>Textil / Indumentaria (Link a PDF)</li>
            <li>Producci&oacute;n Lechera (Link a PDF)</li>
            <li>Automotriz (Link a PDF)</li>
            <li>Construcciones (Link a PDF)</li>
            <li>Energ&iacute;a El&eacute;ctrica (Link a PDF)</li>
            <li>Hoteler&iacute;a y Gastronom&iacute;a (Link a PDF)</li>
            <li>Inform&aacute;tica (Link a PDF)</li>
            <li>Madera y Mueble (Link a PDF)</li>
            <li>Metalmec&aacute;nica (Link a PDF)</li>
        </ul>
        <p>&nbsp;</p>
    </div>
</div>