<?php 
echo $html->css('catalogo.estaticas', false);
?>

<h2 class="grid_12">B�squedas seg�n caracter�sticas del usuario</h2>
<div class="clear"></div>

<div class="grid_8">
    <div class="boxblanca boxestudiantes">
        <h3>Empresas, profesionales, funcionarios, sindicatos, etc.</h3>
        <div class="box_home_buscadores">
            <div class="box_pad_wrapper" style="margin-right: 15px">
                <h4><?php echo $html->link('B�squeda de t�tulos y certificaciones',array('controller'=>'titulos', 'action'=>'search'));?></h4>
               
                <?php 
                     echo $html->link('m�s informaci�n',
                        array('controller'=>'titulos', 'action'=>'search'),
                        array('class'=>'mas_info_azul'));
                     ?>
                <p>
                    Para obtener un listado de t�tulos y certificaciones filtrando por sector de actividad socio productiva y/o localizaci�n de la oferta (jurisdicci�n, departamento, localidad).
                </p>
            </div>
        </div>

        <div class="box_home_buscadores_separador">&nbsp;</div>

        <div class="box_home_buscadores">
            <div class="box_pad_wrapper" style="margin-left: 20px; padding-right: 0px;">
                <h4><?php echo $html->link('B�squeda por instituciones',array('controller'=>'instits', 'action'=>'search'))?></h4>
               
                <?php echo $html->link('m�s informaci�n',
                        array('controller'=>'instits', 'action'=>'search'),
                        array('class'=>'mas_info_azul', 'style'=> 'margin-right: 5px'));?>
                <p>
                    Para obtener el detalle de los t�tulos y certificaciones que ofrece una instituci�n educativa.
                </p>
            </div>
        </div>

        <div class="clear"></div>
    </div>
</div>

<div class="grid_4">
    <div class="boxblanca boxestudiantes">
        <h3>Estudiantes</h3>
        <h4><?php echo $html->link('Gu�a del Estudiante',array('controller'=>'titulos', 'action'=>'guiaDelEstudiante'));?></h4>
        
        <?php echo $html->link('m�s informaci�n',
                array('controller'=>'titulos', 'action'=>'guiaDelEstudiante'),
                array('class'=>'mas_info_azul'));?>
        <p>
            Us� este buscador para encontrar <strong>qu�</strong> y <strong>d�nde</strong> estudiar mediante tres sencillos pasos.
            <br /><br /><br />
        </p>
    </div>
</div>

<h2 class="grid_12">B�squeda por nivel de la oferta</h2>

<div class="clear"></div>

<div class="grid_4">
    <div class="boxgris boxoferta">
        <h4><?php echo $html->link('Nivel Secundario T�cnico',array('controller'=>'titulos', 'action'=>'search', SEC_TEC_ID));?></h4>

         <?php echo $html->link('m�s informaci�n',
                array('controller'=>'titulos', 'action'=>'search', SEC_TEC_ID),
                array('class'=>'mas_info_azul'));?>
        <ul style="margin-left: 0px; padding-left: 17px;">
            <li>Requisitos de ingreso: Primaria completa</li>
            <li>Duraci�n: 6 o 7 a�os</li>
            <li>T�tulo otorgado: T�cnico (en distintas especialidades).</li>
        </ul>
        <br />
    </div>

</div>

<div class="grid_4">
    <div class="boxgris boxoferta">
        <h4><?php echo $html->link('Nivel Superior T�cnico', array('controller'=>'titulos', 'action'=>'search', SUP_TEC_ID));?></h4>

        <?php echo $html->link('m�s informaci�n',
        array('controller'=>'titulos', 'action'=>'search', SUP_TEC_ID),
        array('class'=>'mas_info_azul'));?>
        <ul style="margin-left: 0px; padding-left: 17px;">
            <li>Requisitos de ingreso: Secundaria completa</li>
            <li>Duraci�n: 3 o 4 a�os</li>
            <li>T�tulo otorgado: T�cnico Superior (en distintas especialidades).</li>
        </ul>
        <br />
    </div>
</div>


<div class="grid_4">
    <div class="boxgris boxoferta">
        <h4><?php echo $html->link('Formaci�n Profesional', array('controller'=>'titulos', 'action'=>'search', FP_ID));?></h4>
         <?php echo $html->link('m�s informaci�n',
                array('controller'=>'titulos', 'action'=>'search', FP_ID),
                array('class'=>'mas_info_azul'));?>
        
        <ul style="margin-left: 0px; padding-left: 17px;">
            <li>Requisitos de ingreso y duraci�n variables</li>
            <li>Certificaciones: <br />Certificados de Formaci�n Profesional, Certificados de Formaci�n Continua, Certificados de Capacitaci�n Laboral.</li>
        </ul>
    </div>
</div>