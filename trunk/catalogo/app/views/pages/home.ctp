<?php 
echo $html->css('catalogo.home', false);
$this->pageTitle = "Inicio";
?>




<div class="clear separador"></div>



<!--                
            INET
-->
<div class="grid_9">
    <div class="boxblanca">
        <h2 class="centrado">El Instituto Nacional de Educación Técnica</h2>
          
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
            <li><?php echo $html->link('Propósitos', '#'); ?></li>
            <li><?php echo $html->link('Ideas Eje', '#'); ?></li>
            <li><?php echo $html->link('Entidades Relacionadas', '#'); ?></li>
        </ul>
    </div>
    
</div>



<!--                
            Buscador
-->
<div class="grid_3">
    <div class="boxgris">
        
        
        <h2 class="centrado">Buscadores</h2>
        <p>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut 
        </p>
        
        <?= $html->image('search.png', array('style'=>'float: right; position: absolute; right: 10px; width: 36px;'))?>
        <ul>
            <li><?php echo $html->link('Ver más', '/pages/buscadores'); ?></li>
        </ul>
    </div>
</div>


<div class="clear separador"></div>



<!--                
            Politicas
-->
<div class="grid_6">
    <div class="boxblanca">
            <h2 class="centrado">Las políticas en Argentina <br />para la educación técnico profesional</h2>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut 
                labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris 
                nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
            </p>
            <ul class="ul-horizontal">
                <li><?php echo $html->link('Grafo de la ley', '/pages/grafo_ley'); ?></li>
            </ul>
    </div>
</div>



<!--                
            Graficos
-->
<div class="grid_6">
    <div class="boxblanca">
            <h2 class="centrado">La educación técnico profesional en cifras</h2>
            <?php echo $html->image('mapaFP.jpg', array('style' => 'float: left; height: 90px; margin: 0px 10px 0px 0px;')); ?>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut 
                labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris 
                nisi ut aliquip ex ea commodo consequat. 
            </p>
            <div class="clear"></div>
            <ul class="ul-horizontal centrado">
                <li><?php echo $html->link('Ver más', '/pages/mapas_y_graficos'); ?></li>
            </ul>
    </div>
</div>

