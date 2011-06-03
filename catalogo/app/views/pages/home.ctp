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

<?php echo $html->image('/css/img/me_trans.png', array('class' => 'grid_3', 'style' => 'padding-top:35px;'))?>


    
<h2 class="separador grid_4">Búsqueda por Perfiles</h2>
<div class="clear"></div>

<div class="grid_4">
    <div class="boxblanca">
        <div class="box_pad_wrapper">
        <h3>Estudiantes</h3>
        <h4><?php echo $html->link('Guía del Estudiante',array('controller'=>'titulos', 'action'=>'guiaDelEstudiante'));?></h4>

        <?php echo $html->link('más información',
                array('controller'=>'titulos', 'action'=>'guiaDelEstudiante'),
                array('class'=>'mas_info_gris'));?>
        <p>
           La Guía del Estudiante ayudará a que puedas encontrarar donde estudiar y obtener un título o certificación según tus gustos e intereses.
        </p>
        </div>
    </div>
</div>
    
<div class="grid_8">
    <div class="boxblanca">
        <h3 style="margin-left: 10px; margin-bottom: 0px;">Empresas, profesionales, funcionarios y otros</h3>
        <div class="box_home_buscadores">
            <div class="box_pad_wrapper">
                <h4><?php echo $html->link('Buscador de Títulos',array('controller'=>'titulos', 'action'=>'search'));?></h4>
                <?php echo $html->link('más información',
                        array('controller'=>'titulos', 'action'=>'search'),
                        array('class'=>'mas_info_gris'));?>
                <p>
                   Desde aquí obtendrás un listado de títulos o certificaciones de la Educación Técnico Profesional según los criterios de búsqueda ingresados.
                </p>
            </div>
        </div>

        <div class="box_home_buscadores_separador">&nbsp;</div>

        <div class="box_home_buscadores">
            <div class="box_pad_wrapper" style="margin-left: 10px; padding-right: 0px;">
                <h4><?php echo $html->link('Buscador de Instituciones',array('controller'=>'instits', 'action'=>'search_form'))?></h4>
            <?php echo $html->link('más información',
                    array('controller'=>'instits', 'action'=>'search_form'),
                    array('class'=>'mas_info_gris'));?>
            <p>
               Desde aquí obtendrás un listado de instituciones del Registro Nacional Educación Técnico Profesional según los criterios de búsqueda ingresados.
            </p>
            </div>
        </div>

        <div class="clear"></div>
    </div>
</div>


<h2 class="grid_12">Búsqueda por Oferta</h2>
    
<div class="clear"></div>
    
<div class="grid_4 boxgris">
     <div class="box_pad_wrapper">
    <h4><?php echo $html->link('Secundario Técnico',array('controller'=>'titulos', 'action'=>'search', SEC_TEC_ID));?></h4>

    <?php echo $html->link('más información', 
        array('controller'=>'titulos', 'action'=>'search', SEC_TEC_ID),
        array('class'=>'mas_info_azul'));?>
    <p>
       Esta opción sirve para obtener información sobre títulos de tecnicaturas de nivel medio.
    </p>
     </div>

</div>
    
<div class="grid_4 boxgris">
    <div class="box_pad_wrapper">
    <h4><?php echo $html->link('Superior Técnico', array('controller'=>'titulos', 'action'=>'search', SUP_TEC_ID));?></h4>

    <?php echo $html->link('más información', 
        array('controller'=>'titulos', 'action'=>'search', SUP_TEC_ID),
        array('class'=>'mas_info_azul'));?>
    <p>
        Esta opción sirve para obtener información sobre títulos de tecnicaturas de nivel superior.
    </p>
     </div>
</div>


<div class="grid_4 boxgris">
    <div class="box_pad_wrapper">
        <h4><?php echo $html->link('Formación Profesional', array('controller'=>'titulos', 'action'=>'search', FP_ID));?></h4>

        <?php echo $html->link('más información', 
            array('controller'=>'titulos', 'action'=>'search', FP_ID),
            array('class'=>'mas_info_azul'));?>

        <p>
        Esta opción sirve para obtener información sobre certificaciones de formación profesional y educación continua.        </p>
    </div>
</div>
    

