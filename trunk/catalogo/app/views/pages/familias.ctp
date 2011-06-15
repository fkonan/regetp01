<?php
    //debug($this);
    $this->pageTitle = 'Familias Profesionales';
?>

<?php echo $this->element('menu_docs')?>

<div class="grid_9">
    <div class="boxblanca boxdocs">
        <h2>Familias profesionales</h2>
        <p style="color: red">Presentaci&oacute;n [Pablo]</p>
        
        <h3>Listado de familias  </h3>
        <p class="warning">Haciendo click en el nombre de la familia podr� ver un cuadro con informaci�n ampliada.</p>
        <ul>
            <li><?php echo $html->link('Energ�a El�ctrica', '/pages/flias/energia_electrica'); ?></li>
            <li><?php echo $html->link('Est�tica Profesional', '/pages/flias/estetica_profesional'); ?></li>
            <li><?php echo $html->link('Inform�tica', '/pages/flias/informatica'); ?></li>
            <li><?php echo $html->link('Madera y Mueble', '/pages/flias/madera_y_mueble'); ?></li>
            <li><?php echo $html->link('Mec�nica Automotriz', '/pages/flias/mecanica_automotriz'); ?></li>
            <li><?php echo $html->link('Metalmec�nica', '/pages/flias/metalmecanica'); ?></li>
            <li><?php echo $html->link('Textil', '/pages/flias/textil'); ?></li>
            <hr />
            <p style="color:red">De las siguientes, faltan los cuadros</p>
            <li>Construcciones</li>
            <li>Hort�cola</li>
            <li>Hoteler�a y Gastronom�a</li>
            <li>Producci�n Lechera</li>
        </ul>
        
        <h3>M&aacute;s informaci&oacute;n</h3>
        <p style="color:red">Normativa que aprueba familias profesionales [Pablo, a aprobar en breve]</p>
        <p>&nbsp;</p>
    </div>
</div>
