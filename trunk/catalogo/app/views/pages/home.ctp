<?php 
//echo $html->css('catalogo.home.css');
echo $javascript->link(array('jquery.animate-colors-min'));
?>

<div class="buscadores grid_12">
    <h2 class="grid_12 centrado">Búsqueda por Perfil</h2>
    <div class="grid_6 alpha">
        <h3>Estudiantes</h3>
        <a href="<?php echo $html->url(array('controller'=>'titulos', 'action'=>'guiaDelEstudiante'))?>">
            <h2>
                Guía del Estudiante
                <?php echo $html->image('home/estudio.png', array('style'=>'float:right; margin-top:-15px;'));?>                
            </h2>
            <p class="description">
               Utilizá este buscador si lo que estas buscando son Títulos o Certificados
            </p>
        </a>
    </div>
    
    <div class="grid_6 omega">
        <h3>Otros</h3>
        <a href="<?php echo $html->url(array('controller'=>'instits', 'action'=>'search_form'))?>">
            <h2>
                Buscador de Instituciones
                <?php echo $html->image('home/school.png', array('style'=>'float:right;margin-top:-16px;'));?>
            </h2>
            <p class="description">
                Utilizá este buscador si lo que estas buscando son Títulos o Certificados
            </p>
        </a>
        
        <a href="<?php echo $html->url(array('controller'=>'titulos', 'action'=>'guiaDelEstudiante'))?>">
            <h2>
                Buscador de Títulos
                <?php echo $html->image('home/diploma.png', array('style'=>'float:right; margin-top:-18px;'));?>                
            </h2>
            <p class="description">
                Utilizá este buscador si lo que estas buscando son Títulos o Certificados
            </p>

        </a>
    </div>
</div>


<ul class="buscadores grid_12">
    <div class="grid_12">
            <h2>Busquedas por Oferta</h2>
    </div>
    <li class="grid_4 alpha">
            <h2>
                <?php
                    echo $html->link('Formación Profesional', array('controller'=>'titulos', 'action'=>'search', FP_ID));
                ?>
            </h2>
            <div class="description">
                <p>¿Estas buscando que estudiar y no sabes que? Este buscador te guiará en tu busqueda</p>
            </div>
    </li>
    <li class="grid_4">
        <h2>
            <?php
                echo $html->link('Secundario Técnico', array('controller'=>'titulos', 'action'=>'search', SEC_TEC_ID));
            ?>
        </h2>
        <div class="description">
            <p>Utilizá este buscador si lo que estas buscando son Títulos o Certificados</p>
        </div>
    </li>
    <li class="grid_4 omega">
            <h2>
                <?php
                    echo $html->link('Superior Técnico', array('controller'=>'titulos', 'action'=>'search', SUP_TEC_ID), array('escape'=>false));
                ?>
            </h2>
            <div class="description">
                <p>Utilizá este buscador para encontrar una institución en particular</p>
            </div>
    </li>
</ul>
<div class="grid_12">
        <h2>More Info</h2>
        <p>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas fermentum arcu in tellus commodo vestibulum. Aliquam erat volutpat. Cras elementum justo vitae metus consequat in condimentum nunc ultrices. Nam mollis bibendum volutpat. Donec velit ante, varius euismod pulvinar eu, hendrerit eget tellus. Aenean sed euismod augue. Aenean sollicitudin ligula et lorem feugiat vel accumsan sapien porta. Integer mollis ultricies felis non porttitor. Donec fermentum blandit ante vel tempus. Donec pulvinar, magna non aliquet egestas, nulla urna facilisis tortor, vel volutpat leo lorem ultrices odio. Cras lacinia aliquet placerat. Integer luctus massa quis massa blandit ac scelerisque neque dignissim. In iaculis vulputate ligula, sit amet mattis felis cursus eu. Proin iaculis nisi sit amet neque rhoncus vitae tempus lectus ornare. Aliquam in neque mauris.
        <br/>
</div>


<div class="clear"></div>
