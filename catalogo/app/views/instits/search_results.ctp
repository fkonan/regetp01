<?php  $paginator->options(array('update' => 'consoleResult', 'url' => $this->passedArgs,'indicator'=> 'ajax_paginator_indicator')); ?>

<?php echo $html->css(array('catalogo.advanced_search', 'catalogo.instits'), $inline=false); ?>
<div class="boxblanca" id="search_results">
<h3>Listado de resultados</h3>
<? if (sizeof($conditions)>0): ?>
	Criterios de búsqueda seleccionados:
	<dl class="criterios_busq">
	<?

	 foreach($conditions as $key => $value){
		?><dt><?
			echo '- '.$key.': ';
		?></dt><?
		?><dd><?
			echo $value."&nbsp";
		?></dd><?
	}

	?>
	</dl>
<? endif; ?>
    <div class="list-header">
        <div class="sorter">
        <?php
        $sort = 'cue';
        if(isset($this->passedArgs['sort'])){
        $sort = $this->passedArgs['sort'];
        }
        ?>
            Ordenar por:
            <? $class = ($sort == 'cue')?'marcada':'';?>
            <span class="<?= $class?>"><?php echo $paginator->sort('CUE', 'cue');?></span>,

            <? $class = ($sort == 'Jurisdiccion.name')?'marcada':'';?>
            <span class="<?= $class?>"><?php echo $paginator->sort('Jurisdicción','Jurisdiccion.name');?></span>,

            <? $class = ($sort == 'Departamento.name')?'marcada':'';?>
            <span class="<?= $class?>"><?php echo $paginator->sort('Departamento','Departamento.name');?></span>,

            <? $class = ($sort == 'Localidad.name')?'marcada':'';?>
            <span class="<?= $class?>"><?php echo $paginator->sort('Localidad','Localidad.name');?></span>

        </div>
        <div class="paging">
            <?php echo $paginator->counter(array(
                'format' => __('Instituciones %start%-%end% de <strong>%count%</strong>', true))); ?>
        </div>
        <div class="clear"></div>
    </div>
    <? if (sizeof($instits) > 0) { ?>
        <ol id="items" class="items">
        <?php foreach($instits as $instit) : ?>
            <?  $año_actual = date("Y");
                $fecha_hasta = "$año_actual-07-21"; //hasta julio
                $fecha_desde = "$año_actual-01-01"; //desde enero
                $clase = '';
                if($instit['Instit']['activo']) {
                    $clase .= ' escuela_activa';
                }else {
                    $clase .= ' escuela_inactiva';
                }
            ?>
            <li>
                <a href="<?php echo $html->url(array(
                                    'controller' => 'instits',
                                    'action' => 'view',
                                    'id' => $instit['Instit']['id'],
                                    'slug' => slug($instit['Instit']['nombre_completo'])))
                    ?>" style="display:block; cursor:pointer;">
                <div class="items-nombre">
                    <?= "".($instit['Instit']['cue']*100)+$instit['Instit']['anexo']." - ". $instit['Instit']['nombre_completo']; ?>
                </div>
                <div class="items-domicilio">
                    Domicilio: 
                    <?php
                        echo joinNotNull(", ", array($instit['Instit']['direccion'],$instit['Instit']['lugar'],
                                             $instit['Localidad']['name'],
                                             $instit['Departamento']['name'] == $instit['Localidad']['name']?null:$instit['Departamento']['name'],
                                             $instit['Jurisdiccion']['name']));
                    ?>
                </div>
                <div class="items-gestion"><?= $instit['Gestion']['name'] ?></div>
                <div class="items-actions">
                    <span class="mas_info_azul_small"></span>
                </div>
                <div class="clear"></div>
                </a>
            </li>

        <? endforeach?>
    </ol>
    <?php
    }
    else {
        ?>
    <div id="no_results">No hay resultados</div>
    <?php
    }
    
    if ($paginator->numbers()) { ?>
        <div style="text-align:center; display:block;margin-bottom: 10px">
            <?php
            echo $paginator->prev('« Anterior ',null, null, array('class' => 'disabled', 'tag' => 'span'));
            echo " | ".$paginator->numbers(array('modulus'=>'9'))." | ";
            echo $paginator->next(' Siguiente »', null, null, array('class' => 'disabled'));
            ?>
            <span class="ajax_update" id="ajax_paginator_indicator" style="display:none; padding-left:10px;"><?php echo $html->image('ajax-loader.gif')?></span>
        </div>
    <?php } ?>
</div>