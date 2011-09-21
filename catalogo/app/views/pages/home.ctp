<!--<script src="https://www.google.com/jsapi?key=ABQIAAAAB9-4gZ-EdgJfDxJFt0gpERTMa6vFho1POZQcegfZ_L_wbfYheBQjEPuUk3RRDdCPUjVvstGMAxLpRQ" type="text/javascript">mce:0</script>-->
<?php 
echo $html->css('catalogo.home', false);
$this->pageTitle = "Inicio";
?>
<div class="clear separador"></div> 

<!--                
            INET
-->
<div class="grid_9 alpha">
    <div class="boxblanca inet">
        <h2>El Instituto Nacional de Educación Tecnológica</h2>
        <div class="boxcontent">
            <div class="picround" style="margin-right: 10px;">
            <?php echo $html->image('material/soldadura.jpg', array('style' => "float: left; height: 120px;" )) ?> 
            </div>

            <p style="margin-top:0px">
               Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut 
                    labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris 
                    nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut 
                    labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris 
                    nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
            </p>

            <div class="clear"></div>

            <ul class="ul-horizontal" style="text-align: right">
                <li><?php echo $html->link('Ver más', array('controller' => 'pages', 'action' => 'el_inet')); ?></li>
            </ul>
        </div>
    </div>
    
</div>

<!--                
            Buscador
-->
<div class="grid_3 omega">
    <div class="boxgris box_home_buscadores">
        <h2>Buscadores</h2>
        <p>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut 
        </p>
        
        <?= $html->image('search.png', array('style'=>'float: right; position: absolute; right: 10px; width: 36px;'))?>
        <ul>
            <li><?php echo $html->link('Realizar búsquedas', array('controller' => 'pages', 'action' => 'buscadores')); ?></li>
        </ul>
    </div>
</div>

<div class="clear separador"></div>
<!--                
            Politicas
-->
<div class="grid_6 alpha">
    <div class="boxblanca politicas">
            <h2>Las políticas para la Educación Técnico Profesional en Argentina</h2>
            <div class="boxcontent">
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut 
                    labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris 
                    nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                </p>
                <ul class="ul-horizontal" style="text-align: right">
                    <li><?php echo $html->link('Ver grafo de la ley', array('controller' => 'pages', 'action' => 'grafo_ley')); ?></li>
                </ul>
            </div>
    </div>
</div>

<!--                
            Graficos
-->
<div class="grid_6 omega">
    <div class="boxblanca cifras">
            <h2>La Educación Técnico Profesional en cifras</h2>
            <div class="boxcontent">
                <?php echo $html->image('mapaFP.jpg', array('style' => 'float: left; height: 90px; margin: 0px 10px 0px 0px;')); ?>
                <p>
                    Información estadística de la Educación Técnico Profesional. Las fuentes de información son: 1) el Relevamiento Anual llevado
a cabo por la Dirección Nacional de Información y Evaluación de la Calidad
Educativa (DINIECE) del Ministerio de Educación de la Nación, y 2) la información
presentada por las instituciones educativas a la base de datos del Registro Federal de
Instituciones de Educación Técnica Profesional (RFIETP).
                </p>
                <div class="clear"></div>
                <ul class="ul-horizontal" style="text-align: right">
                    <li><?php echo $html->link('Ver más', array('controller' => 'pages', 'action' => 'mapas_y_graficos')); ?></li>
                </ul>
            </div>
    </div>
</div>
