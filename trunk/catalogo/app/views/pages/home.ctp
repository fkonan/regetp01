<?php 
echo $html->css('catalogo.home', false);

$this->pageTitle = "Inicio";
?>

<div class="grid_12 home_info" style="margin-top: 10px">
    <div class="boxblanca">
        <div style="float:left">
            <div>
                
                <?php echo $html->image('material/inicio2010.jpg', array('style'=>'float: right; height: 110px; margin: 0px 0px 0px 20px;')) ?> 
                
                
                <h2>La Educaci�n T�cnico Profesional en Argentina</h2>
                <p>La Educaci�n T�cnico Profesional es la modalidad de la 
                    Educaci�n Secundaria y la Educaci�n Superior responsable 
                    de la formaci�n de t�cnicos medios y t�cnicos superiores 
                    en �reas ocupacionales espec�ficas, y de la formaci�n 
                    profesional (formaci�n profesional inicial, capacitaci�n 
                    continua y capacitaci�n laboral). Se rige por la Ley N� 
                    26.058 y promueve la formaci�n de profesionales, 
                    especialidades, ocupaciones o carreras, relacionadas con 
                    el desempe�o laboral. 
                <?php echo $html->link('M�s informaci�n...', '/pages/educ_tec_prof'); ?>
                </p>
                
                  
                <?php echo $html->image('material/taller carpinteria.gif', array('style'=>'float: right; height: 205px; margin: 0px 0px 0px 20px;')) ?> 
                <h2>Cat�logo Nacional de T�tulos y Certificaciones</h2>
                <p>
                    El Cat�logo Nacional de T�tulos y Certificaciones es uno de los instrumentos previstos por la Ley N� 26.058 para la mejora continua de la Educaci�n T�cnico Profesional. Como instrumento operativo y de consulta el Cat�logo constituye un servicio permanente de informaci�n actualizada sobre t�tulos y certificaciones de la educaci�n t�cnico profesional en el �mbito nacional que permite:
                </p>

                <ul>
                    <li>
                        Consultar toda la informaci�n y normativa relacionada con su funcionamiento y caracter�sticas (familias profesionales, marcos de referencia, procesos de homologaci�n, foros sectoriales, etc.) en el apartado de <?php echo $html->link('Documentaci�n', '/pages/introduccion')?>.
                    </li>

                    <li>
                        Realizar b�squedas de t�tulos y certificaciones utilizando las distintas estrategias de acceso que se ofrecen a continuaci�n.
                    </li>

                    <!-- <li>
                         Propiciar la articulaci�n entre los distintos �mbitos y niveles de la educaci�n t�cnico-profesional.
                     </li>

                     <li>
                         Orientar la definici�n y el desarrollo de programas federales para el fortalecimiento y mejora de las
             instituciones de educaci�n t�cnico profesional.
                     </li>-->
                </ul>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>

<h2 class="grid_12">B�squedas por perfiles</h2>
<div class="clear"></div>

<div class="grid_4">
    <div class="boxblanca">
        <h3>Estudiantes</h3>
        <h4><?php echo $html->link('Gu�a del Estudiante',array('controller'=>'titulos', 'action'=>'guiaDelEstudiante'));?></h4>
        
        <?php echo $html->link('m�s informaci�n',
                array('controller'=>'titulos', 'action'=>'guiaDelEstudiante'),
                array('class'=>'mas_info_azul'));?>
        <p>
            La Gu�a del Estudiante ayudar� a que puedas encontrarar donde estudiar y obtener un t�tulo o certificaci�n seg�n tus gustos e intereses.
        </p>
    </div>
</div>

<div class="grid_8">
    <div class="boxblanca boxdocs">
        <h3>Empresas, profesionales, funcionarios, etc.</h3>
        <div class="box_home_buscadores">
            <div class="box_pad_wrapper" style="margin-right: 15px">
                <h4><?php echo $html->link('B�squeda de t�tulos y certificaciones',array('controller'=>'titulos', 'action'=>'search'));?></h4>
               
                <?php 
                     echo $html->link('m�s informaci�n',
                        array('controller'=>'titulos', 'action'=>'search'),
                        array('class'=>'mas_info_azul'));
                     ?>
                <p style="text-align: justify">
                     
                    Obtenga un listado de t�tulos y certificaciones filtrando por sector de actividad socio productiva y/o localizaci�n de la oferta (jurisdicci�n, departamento, localidad).
                </p>
            </div>
        </div>

        <div class="box_home_buscadores_separador">&nbsp;</div>

        <div class="box_home_buscadores">
            <div class="box_pad_wrapper" style="margin-left: 20px; padding-right: 0px;">
                <h4><?php echo $html->link('B�squeda por instituciones',array('controller'=>'instits', 'action'=>'search_form'))?></h4>
               
                <?php echo $html->link('m�s informaci�n',
                        array('controller'=>'instits', 'action'=>'search_form'),
                        array('class'=>'mas_info_azul', 'style'=> 'margin-right: 5px'));?>
                <p style="text-align: justify">
                     
                    Obtenga el detalle de los t�tulos y certificaciones que ofrece una instituci�n educativa.
                </p>
            </div>
        </div>

        <div class="clear"></div>
    </div>
</div>


<h2 class="grid_12">B�squedas por oferta formativa</h2>

<div class="clear"></div>

<div class="grid_4">
    <div class="boxgris">
        <h4><?php echo $html->link('Secundario T�cnico',array('controller'=>'titulos', 'action'=>'search', SEC_TEC_ID));?></h4>

         <?php echo $html->link('m�s informaci�n',
                array('controller'=>'titulos', 'action'=>'search', SEC_TEC_ID),
                array('class'=>'mas_info_azul'));?>
        <p style="text-align: justify">
            Esta opci�n sirve para obtener informaci�n sobre t�tulos de tecnicaturas de nivel medio.
            <br /><br />
        </p>
    </div>

</div>

<div class="grid_4">
    <div class="boxgris">
        <h4><?php echo $html->link('Superior T�cnico', array('controller'=>'titulos', 'action'=>'search', SUP_TEC_ID));?></h4>

        <?php echo $html->link('m�s informaci�n',
        array('controller'=>'titulos', 'action'=>'search', SUP_TEC_ID),
        array('class'=>'mas_info_azul'));?>
        <p style="text-align: justify">
            
            Esta opci�n sirve para obtener informaci�n sobre t�tulos de tecnicaturas de nivel superior.
            <br /><br />
        </p>
    </div>
</div>


<div class="grid_4">
    <div class="boxgris">
        <h4><?php echo $html->link('Formaci�n Profesional', array('controller'=>'titulos', 'action'=>'search', FP_ID));?></h4>
         <?php echo $html->link('m�s informaci�n',
                array('controller'=>'titulos', 'action'=>'search', FP_ID),
                array('class'=>'mas_info_azul'));?>
        <p style="text-align: justify">
            Esta opci�n sirve para obtener informaci�n sobre certificaciones de formaci�n profesional y educaci�n continua.        </p>
    </div>
</div>


