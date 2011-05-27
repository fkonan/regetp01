<?php echo $html->css('catalogo.home', false);?>

<h1 class="grid_12">El Catálogo Nacional de Títulos y Certificaciones</h1>

<div class="grid_9">
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

<?php echo $html->image('/css/img/me_trans.png', array('class' => 'grid_3'))?>


    
<h2 class="separador grid_4">Búsquedas por Perfiles</h2>
<div class="clear"></div>

<div class="boxblanca grid_4">
    <div class="box_pad_wrapper">
    <h3>Estudiantes</h3>        
    <h4>Guía del Estudiante</h4>

    <?php echo $html->link('más información', 
            array('controller'=>'titulos', 'action'=>'guiaDelEstudiante'),
            array('class'=>'mas_info_gris'));?>
    <p>
       Aquí podrás encontrarar lugares donde estudiar y obtener un título o certificación.
    </p>
    </div>
</div>
    
<div class="boxblanca grid_8">
    <h3 style="margin-left: 10px; margin-bottom: 0px;">Empresas, Profesionales, Funcionarios, Otros</h3>
    <div class="grid_4 alpha" style="">                   
        <div class="box_pad_wrapper">
            <h4>Buscador de Títulos</h4>
            <?php echo $html->link('más información', 
                    array('controller'=>'titulos', 'action'=>'search'),
                    array('class'=>'mas_info_gris'));?>
            <p>
               Mediante este buscador se puede obtener un listado de títulos o certificaciones de Educación Técnico Profesonal
            </p>
        </div>
    </div>


    <div class="grid_4 alpha omega" style="margin-left: -1px; border-left: solid #dcddde 1px;">
        <div class="box_pad_wrapper" style="margin-left: 10px; padding-right: 0px;">
            <h4>Buscador de Instituciones</h4>
        <?php echo $html->link('más información', 
                array('controller'=>'instits', 'action'=>'search_form'),
                array('class'=>'mas_info_gris'));?>
        <p>
           Mediante este buscador se obtiene un listado de instituciones del Registro Federal de Instituciones de Educación Técnico Profesonal
        </p>
        </div>
    </div>

</div>


<h2 class="grid_12">Búsquedas por Oferta</h2>
    
<div class="clear"></div>

<div class="grid_4 boxgris">
    <div class="box_pad_wrapper">
        <h4>Formación Profesional</h4>

        <?php echo $html->link('más información', 
            array('controller'=>'titulos', 'action'=>'search', FP_ID),
            array('class'=>'mas_info_azul'));?>

        <p>
            ¿Estas buscando que estudiar y no sabes que? Este buscador te guiará en tu busqueda
        </p>
    </div>
</div>
    
    
<div class="grid_4 boxgris">
     <div class="box_pad_wrapper">
    <h4>Secundario Técnico</h4>

    <?php echo $html->link('más información', 
        array('controller'=>'titulos', 'action'=>'search', SEC_TEC_ID),
        array('class'=>'mas_info_azul'));?>
    <p>
       ¿Estas buscando que estudiar y no sabes que? Este buscador te guiará en tu busqueda
    </p>
     </div>

</div>
    
<div class="grid_4 boxgris">
    <div class="box_pad_wrapper">
    <h4>Superior Técnico</h4>

    <?php echo $html->link('más información', 
        array('controller'=>'titulos', 'action'=>'search', SUP_TEC_ID),
        array('class'=>'mas_info_azul'));?>
    <p>
        ¿Estas buscando que estudiar y no sabes que? Este buscador te guiará en tu busqueda
    </p>
     </div>
</div>
    

