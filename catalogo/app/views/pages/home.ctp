<?php 
echo $html->css('catalogo.home', false);
echo $javascript->link('jquery.cross-slide.min', false);
$this->pageTitle = "Inicio";
?>

<script type="text/javascript">
$(function() {
    $('#placeholder').crossSlide({
      sleep: 2,
      fade: 1
    }, [
      { src: '<?php echo $html->url("/img/material/home_1.jpg");?>'},
      { src: '<?php echo $html->url("/img/material/home_2.jpg");?>'},
      { src: '<?php echo $html->url("/img/material/home_3.jpg");?>'}
    ]);

});
</script>

<div class="grid_12 home_info" style="margin-top: 10px">
    <div class="boxblanca">
        <div style="float:left">
            <div>
                
                
                <div id="placeholder" style="float: right; width:300px; height:300px; margin: 0px 0px 0px 20px;"></div>
                
                <h2>La Educación Técnico Profesional en Argentina</h2>
                <p>La Educación Técnico Profesional es la modalidad de la 
                    Educación Secundaria y la Educación Superior responsable 
                    de la formación de técnicos medios y técnicos superiores 
                    en áreas ocupacionales específicas, y de la formación 
                    profesional (formación profesional inicial, capacitación 
                    continua y capacitación laboral). Se rige por la Ley Nº 
                    26.058 y promueve la formación de profesionales, 
                    especialidades, ocupaciones o carreras, relacionadas con 
                    el desempeño laboral. 
                <?php echo $html->link('Más información...', '/pages/educ_tec_prof'); ?>
                </p>
                
                <h2>Catálogo Nacional de Títulos y Certificaciones</h2>
                <p>
                    El Catálogo Nacional de Títulos y Certificaciones es uno de los instrumentos previstos por la Ley Nº 26.058 para la mejora continua de la Educación Técnico Profesional. Como instrumento operativo y de consulta el Catálogo constituye un servicio permanente de información actualizada sobre títulos y certificaciones de la educación técnico profesional en el ámbito nacional que permite:
                </p>

                <ul>
                    <li>
                        Consultar toda la información y normativa relacionada con su funcionamiento y características (familias profesionales, marcos de referencia, procesos de homologación, foros sectoriales, etc.) en el apartado de <?php echo $html->link('Documentación', '/pages/introduccion')?>.
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
        <div class="clear"></div>
    </div>
</div>

<h2 class="grid_12">Búsquedas según perfil del usuario</h2>
<div class="clear"></div>

<div class="grid_4">
    <div class="boxblanca boxestudiantes">
        <h3>Estudiantes</h3>
        <h4><?php echo $html->link('Guía del Estudiante',array('controller'=>'titulos', 'action'=>'guiaDelEstudiante'));?></h4>
        
        <?php echo $html->link('más información',
                array('controller'=>'titulos', 'action'=>'guiaDelEstudiante'),
                array('class'=>'mas_info_azul'));?>
        <p>
            Usá este buscador para encontrar <strong>qué</strong> y <strong>dónde</strong> estudiar mediante tres sencillos pasos.
            <br /><br /><br />
        </p>
    </div>
</div>

<div class="grid_8">
    <div class="boxblanca boxestudiantes">
        <h3>Empresas, profesionales, funcionarios, sindicatos, etc.</h3>
        <div class="box_home_buscadores">
            <div class="box_pad_wrapper" style="margin-right: 15px">
                <h4><?php echo $html->link('Búsqueda de títulos y certificaciones',array('controller'=>'titulos', 'action'=>'search'));?></h4>
               
                <?php 
                     echo $html->link('más información',
                        array('controller'=>'titulos', 'action'=>'search'),
                        array('class'=>'mas_info_azul'));
                     ?>
                <p>
                    Para obtener un listado de títulos y certificaciones filtrando por sector de actividad socio productiva y/o localización de la oferta (jurisdicción, departamento, localidad).
                </p>
            </div>
        </div>

        <div class="box_home_buscadores_separador">&nbsp;</div>

        <div class="box_home_buscadores">
            <div class="box_pad_wrapper" style="margin-left: 20px; padding-right: 0px;">
                <h4><?php echo $html->link('Búsqueda por instituciones',array('controller'=>'instits', 'action'=>'search_form'))?></h4>
               
                <?php echo $html->link('más información',
                        array('controller'=>'instits', 'action'=>'search_form'),
                        array('class'=>'mas_info_azul', 'style'=> 'margin-right: 5px'));?>
                <p>
                    Para obtener el detalle de los títulos y certificaciones que ofrece una institución educativa.
                </p>
            </div>
        </div>

        <div class="clear"></div>
    </div>
</div>


<h2 class="grid_12">Búsquedas por oferta formativa</h2>

<div class="clear"></div>

<div class="grid_4">
    <div class="boxgris boxoferta">
        <h4><?php echo $html->link('Nivel Secundario Técnico',array('controller'=>'titulos', 'action'=>'search', SEC_TEC_ID));?></h4>

         <?php echo $html->link('más información',
                array('controller'=>'titulos', 'action'=>'search', SEC_TEC_ID),
                array('class'=>'mas_info_azul'));?>
        <ul style="margin-left: 0px; padding-left: 17px;">
            <li>Requisitos de ingreso: Primaria completa</li>
            <li>Duración: 6 o 7 años</li>
            <li>Título otorgado: Técnico (en distintas especialidades).</li>
        </ul>
        <br />
    </div>

</div>

<div class="grid_4">
    <div class="boxgris boxoferta">
        <h4><?php echo $html->link('Nivel Superior Técnico', array('controller'=>'titulos', 'action'=>'search', SUP_TEC_ID));?></h4>

        <?php echo $html->link('más información',
        array('controller'=>'titulos', 'action'=>'search', SUP_TEC_ID),
        array('class'=>'mas_info_azul'));?>
        <ul style="margin-left: 0px; padding-left: 17px;">
            <li>Requisitos de ingreso: Secundaria completa</li>
            <li>Duración: 3 o 4 años</li>
            <li>Título otorgado: Técnico Superior (en distintas especialidades).</li>
        </ul>
        <br />
    </div>
</div>


<div class="grid_4">
    <div class="boxgris boxoferta">
        <h4><?php echo $html->link('Formación Profesional', array('controller'=>'titulos', 'action'=>'search', FP_ID));?></h4>
         <?php echo $html->link('más información',
                array('controller'=>'titulos', 'action'=>'search', FP_ID),
                array('class'=>'mas_info_azul'));?>
        
        <ul style="margin-left: 0px; padding-left: 17px;">
            <li>Requisitos de ingreso y duración variables</li>
            <li>Certificaciones: <br />Certificados de Formación Profesional, Certificados de Formación Continua, Certificados de Capacitación Laboral.</li>
        </ul>
    </div>
</div>


