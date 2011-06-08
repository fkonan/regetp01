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
        <p class="warning">Haciendo click en el nombre de la familia se podrá descargar un cuadro con información ampliada.</p>
        <ul>
            <li><?php echo $html->link('Energía Eléctrica', '/files/pdfs/info_sectorial/ee.doc'); ?></li>
            <li><?php echo $html->link('Estética Profesional', '/files/pdfs/info_sectorial/estetica_prof.doc'); ?></li>
            <li><?php echo $html->link('Informática', '/files/pdfs/Marcos de Referencia/Secundario Técnico/15-07-anexo16 Informática.pdf'); ?></li>
            <li><?php echo $html->link('Madera y Mueble', '/files/pdfs/info_sectorial/madera_y_mueble.doc'); ?></li>
            <li><?php echo $html->link('Mecánica Automotriz', '/files/pdfs/info_sectorial/mecanica_aut.doc'); ?></li>
            <li><?php echo $html->link('Metalmecánica', '/files/pdfs/info_sectorial/metalmecanica.doc'); ?></li>
            <li><?php echo $html->link('Textil', '/files/pdfs/info_sectorial/textil.doc'); ?></li>
        </ul>
        
        <h3>M&aacute;s informaci&oacute;n</h3>
        <p style="color:red">Normativa que aprueba familias profesionales [Pablo, a aprobar en breve]</p>
        <p>&nbsp;</p>
    </div>
</div>

