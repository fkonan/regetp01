<?php
    echo $html->css('documentacion');
    
?>
<h1 class="grid_12">Documentaci&oacute;n</h1>

<div id="menu1" class="grid_3">
    <div class="boxblanca">
        
    <ul>
            
        <li><?php echo $html->link('Introducción', 'introduccion');?></li>
        
        <li>
            <h2>Informaci&oacute;n sectorial</h2>
            <ul>
                <li><?php echo $html->link('Familias profesionales', 'familias');?></li>
                <li>
                    <?php echo $html->link('Foros sectoriales', 'foros');?>

                </li>
                <li><?php echo $html->link('Entidades participantes', 'entidades');?></li>
            </ul>
        </li>

        <li>
            <?php echo $html->link('Procesos de homologación', 'homologacion');?>
        <li>
            <?php echo $html->link('Marcos de referencia', 'marcos');?>
        
        <li>
            <h2>Niveles y Modalidades</h2>
            <ul>
                <li>
                   <?php echo $html->link('Educación Técnica de Nivel Medio y Superior', 'mediaysuperior');?>
                </li>
                <li>
                   <?php echo $html->link('Formación Profesional', 'fp');?>
                </li>
            </ul>
        </li>
        
        <li>
            <?php echo $html->link('Normativa de referencia', 'normativa');?>
        </li>
        
    </ul>
    </div>
</div>

