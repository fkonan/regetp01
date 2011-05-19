<h1>Bienvenidos</h1>
<div class="grid_9 alpha">
    <cite class="bigquote">
        necesitamos que todos los argentinos tengan una educación de calidad y en particular los técnicos porque sabemos que las tecnologías van cambiando día a día, así que, hay que contextualizar las escuelas técnicas y también que los chicos nuestros tengan una alta calificación que les permita complementar la formación académica con la transformación tecnológica y estar mejor preparados para el mundo laboral
    </cite>
</div>
<div class="grid_3 omega"><?php echo $html->image('/css/img/me_trans.png')?></div>




<div class="buscadores grid_12 alpha">
    <h2 class="separador uppercase grid_4 alpha">Búsquedas por Perfiles</h2>
    <div class="clear" ></div>
    
    <div class="boxblanca grid_4 alpha">
        <h3 class="grid_4">Estudiantes</h3>        
        <h2 class="grid_4" style="margin-top: 0px;">Guía del Estudiante</h2>
        <div class="description grid_3">
           Utilizá este buscador si lo que estas buscando son Títulos o Certificados
        </div>

        <?php echo $html->link('más información', 
                array('controller'=>'titulos', 'action'=>'guiaDelEstudiante'),
                array('class'=>'mas_info_gris'));?>

    </div>
    
    <div class="grid_8 omega">
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
            <h2>Búsquedas por Oferta</h2>
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


<div class="clear"></div>



<div class="grid_8 alpha">
    <h2>El Rol del Catálogo Nacional de Títulos y Certificados</h2>
    
    <p>
        En función de la mejora continua de la calidad de la educación técnico profesional créase, 
en el ámbito del Instituto Nacional de Educación Tecnológica, el Registro Federal de Instituciones de 
Educación Técnico Profesional y el Catálogo Nacional de Títulos y Certificaciones y establécese el proceso de 
la Homologación de Títulos y Certificaciones. Dichos instrumentos, en forma combinada, permitirán: 
    </p>
    
    <ul>
        <li>
            Garantizar el derecho de los estudiantes y de los egresados a la formación y al reconocimiento, en todo el 
territorio nacional, de estudios, certificaciones y títulos de calidad equivalente. 
        </li>
        
        <li>
            Definir los diferentes ámbitos institucionales y los distintos niveles de certificación y titulación de la 
educación técnico profesional. 
        </li>
        
        <li>
            Propiciar la articulación entre los distintos ámbitos y niveles de la educación técnico-profesional. 
        </li>
        
        <li>
            Orientar la definición y el desarrollo de programas federales para el fortalecimiento y mejora de las 
instituciones de educación técnico profesional. 
        </li>
    </ul>
</div>
