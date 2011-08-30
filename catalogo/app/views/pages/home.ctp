<script src="https://www.google.com/jsapi?key=ABQIAAAAB9-4gZ-EdgJfDxJFt0gpERTMa6vFho1POZQcegfZ_L_wbfYheBQjEPuUk3RRDdCPUjVvstGMAxLpRQ" type="text/javascript"><!--mce:0--></script>
<?php 
echo $html->css('catalogo.home', false);
$this->pageTitle = "Inicio";
?>
<div class="clear separador"></div> 

<div class="grid_12 alpha omega" id="fechaRedesSociales">
    <p class="fecha"> <?php echo actual_date();?></p>
</div>
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

            <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut 
                labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris 
                nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit 
                esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in 
                culpa qui officia deserunt mollit anim id est laborum
            </p>

            <div class="clear"></div>

            <ul class="ul-horizontal centrado">
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
            <li><?php echo $html->link('Ver más', array('controller' => 'pages', 'action' => 'buscadores')); ?></li>
        </ul>
    </div>
</div>

<div class="clear separador"></div>
<!--                
            Politicas
-->
<div class="grid_6 alpha">
    <div class="boxblanca politicas">
            <h2>Las Políticas en Argentina para la Educación Técnico Profesional</h2>
            <div class="boxcontent">
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut 
                    labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris 
                    nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                </p>
                <ul class="ul-horizontal">
                    <li><?php echo $html->link('Grafo de la ley', array('controller' => 'pages', 'action' => 'grafo_ley')); ?></li>
                </ul>
            </div>
    </div>
</div>

<!--                
            Graficos
-->
<div class="grid_6 omega">
    <div class="boxblanca cifras">
            <h2>La Educación Técnico Profesional en Cifras</h2>
            <div class="boxcontent">
                <?php echo $html->image('mapaFP.jpg', array('style' => 'float: left; height: 90px; margin: 0px 10px 0px 0px;')); ?>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut 
                    labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris 
                    nisi ut aliquip ex ea commodo consequat. 
                </p>
                <div class="clear"></div>
                <ul class="ul-horizontal centrado">
                    <li><?php echo $html->link('Ver más', array('controller' => 'pages', 'action' => 'mapas_y_graficos')); ?></li>
                </ul>
            </div>
    </div>
</div>
<div class="grid_12 alpha omega" id="fechaRedesSociales">
    <p class="fecha"> <?php echo actual_date();?></p>
</div>
