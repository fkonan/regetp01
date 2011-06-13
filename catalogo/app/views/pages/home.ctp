<?php 
echo $html->css('catalogo.home', false);

$this->pageTitle = "Inicio";
?>


<div class="grid_6">
    <h1>La Educación Técnico Profesional en Argentina</h1>
    La Educación Técnico Profesional es la modalidad de la Educación Secundaria y la Educación Superior responsable de la formación de técnicos medios y técnicos superiores en áreas ocupacionales específicas, y de la formación profesional (formación profesional inicial, capacitación continua y capacitación laboral). Se rige por la Ley Nº 26.058 y promueve la formación de profesionales, especialidades, ocupaciones o carreras, relacionadas con el desempeño laboral.
</div>
<?php echo $html->image('escuela_tecnica.jpg', array( 'class' => 'grid_5 photo', 'style' => 'margin-top: 15px;')) ?>


<h1 class="grid_12">Catálogo Nacional de Títulos y Certificaciones de Educación Técnico Profesional</h1>
<?php echo $html->image('escuela-tecnica2.jpg', array('class' => 'grid_6 photo'))?>
<div class="grid_5">
    
    <div>
        <p>
            El Catálogo Nacional de Títulos y Certificaciones es uno de los instrumentos previstos por la Ley Nº 26.058 para la mejora continua de la Educación Técnico Profesional. Como instrumento operativo y de consulta el Catálogo constituye un servicio permanente de información actualizada sobre títulos y certificaciones de la educación técnico profesional en el ámbito nacional que permite:
        </p>

        <ul>
            <li>
                Consultar toda la información y normativa relacionada con su funcionamiento y características (familias profesionales, marcos de referencia, procesos de homologación, foros sectoriales, etc.) en el apartado de [Documentación].
            </li>

            <li>
                Realizar búsquedas de títulos y certificaciones utilizando las distintas estrategias de acceso que se ofrecen a continuación.
            </li>

            <!-- <li>
                 Propiciar la articulación entre los distintos ámbitos y niveles de la educación técnico-profesional.
             </li>

             <li>
                 Orientar la definición y el desarrollo de programas federales para el fortalecimiento y mejora de las
     instituciones de educación técnico profesional.
             </li>-->
        </ul>
    </div>
</div>





<h2 class="separador grid_12">Búsquedas por perfiles</h2>
<div class="clear"></div>

<div class="grid_4">
    <div class="boxblanca">
        <h3>Estudiantes</h3>
        <h4><?php echo $html->link('Guía del Estudiante',array('controller'=>'titulos', 'action'=>'guiaDelEstudiante'));?></h4>

        <?php echo $html->link('más información',
        array('controller'=>'titulos', 'action'=>'guiaDelEstudiante'),
        array('class'=>'mas_info_azul'));?>
        <p>
            La Guía del Estudiante ayudará a que puedas encontrarar donde estudiar y obtener un título o certificación según tus gustos e intereses.
        </p>
    </div>
</div>

<div class="grid_8">
    <div class="boxblanca boxdocs">
        <h3>Empresas, profesionales, funcionarios, etc.</h3>
        <div class="box_home_buscadores">
            <div class="box_pad_wrapper">
                <h4><?php echo $html->link('Búsqueda de títulos y certificaciones',array('controller'=>'titulos', 'action'=>'search'));?></h4>
                <?php echo $html->link('más información',
                array('controller'=>'titulos', 'action'=>'search'),
                array('class'=>'mas_info_azul'));?>
                <p>
                    Obtenga un listado de títulos y certificaciones filtrando por sector de actividad socio productiva y/o localización de la oferta (jurisdicción, departamento, localidad).
                </p>
            </div>
        </div>

        <div class="box_home_buscadores_separador">&nbsp;</div>

        <div class="box_home_buscadores">
            <div class="box_pad_wrapper" style="margin-left: 10px; padding-right: 0px;">
                <h4><?php echo $html->link('Búsqueda por instituciones',array('controller'=>'instits', 'action'=>'search_form'))?></h4>
                <?php echo $html->link('más información',
                array('controller'=>'instits', 'action'=>'search_form'),
                array('class'=>'mas_info_azul'));?>
                <p>
                    Obtenga el detalle de los títulos y certificaciones que ofrece una institución educativa.
                </p>
            </div>
        </div>

        <div class="clear"></div>
    </div>
</div>


<h2 class="grid_12">Búsquedas por oferta formativa</h2>

<div class="clear"></div>

<div class="grid_4">
    <div class="boxgris">
        <h4><?php echo $html->link('Secundario Técnico',array('controller'=>'titulos', 'action'=>'search', SEC_TEC_ID));?></h4>

        <?php echo $html->link('más información',
        array('controller'=>'titulos', 'action'=>'search', SEC_TEC_ID),
        array('class'=>'mas_info_azul'));?>
        <p>
            Esta opción sirve para obtener información sobre títulos de tecnicaturas de nivel medio.
        </p>
    </div>

</div>

<div class="grid_4">
    <div class="boxgris">
        <h4><?php echo $html->link('Superior Técnico', array('controller'=>'titulos', 'action'=>'search', SUP_TEC_ID));?></h4>

        <?php echo $html->link('más información',
        array('controller'=>'titulos', 'action'=>'search', SUP_TEC_ID),
        array('class'=>'mas_info_azul'));?>
        <p>
            Esta opción sirve para obtener información sobre títulos de tecnicaturas de nivel superior.
        </p>
    </div>
</div>


<div class="grid_4">
    <div class="boxgris">
        <h4><?php echo $html->link('Formación Profesional', array('controller'=>'titulos', 'action'=>'search', FP_ID));?></h4>

        <?php echo $html->link('más información',
        array('controller'=>'titulos', 'action'=>'search', FP_ID),
        array('class'=>'mas_info_azul'));?>

        <p>
            Esta opción sirve para obtener información sobre certificaciones de formación profesional y educación continua.        </p>
    </div>
</div>


