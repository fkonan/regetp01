<?php  $paginator->options(array('update' => 'consoleResult', 'url' => $this->passedArgs,'indicator'=> 'ajax_indicator')); ?>

<?php echo $html->css(array('catalogo.advanced_search', 'catalogo.instits'), $inline=false); ?>
<div class="grid_10 alpha omega prefix_1 suffix_1 boxblanca" id="search_results">
<div class="clear"></div>
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
    <div class="grid_6 suffix_2">
    <?php
    $sort = 'cue';
    if(isset($this->passedArgs['sort'])){
    $sort = $this->passedArgs['sort'];
    }
    ?>
        Ordenar por:
        <? $class = ($sort == 'cue')?'marcada':'';?>
        <span class="<?= $class?>"><?php echo $paginator->sort('cue');?></span>,

        <? $class = ($sort == 'Jurisdiccion.name')?'marcada':'';?>
        <span class="<?= $class?>"><?php echo $paginator->sort('Jurisdicción','Jurisdiccion.name');?></span>,

        <? $class = ($sort == 'Departamento.name')?'marcada':'';?>
        <span class="<?= $class?>"><?php echo $paginator->sort('Departamento','Departamento.name');?></span>,

        <? $class = ($sort == 'Localidad.name')?'marcada':'';?>
        <span class="<?= $class?>"><?php echo $paginator->sort('Localidad','Localidad.name');?></span>

    </div>
    <div class="grid_4">
        <?php echo $paginator->counter(array(
            'format' => __('Instituciones %start%-%end% de <strong>%count%</strong>', true))); ?>
    </div>
    <div class="clear"></div>

    <? if (sizeof($instits) > 0) :?>
    <ol id="items">
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

            <li onmouseover="jQuery(this).addClass('alt2row')" onmouseout="jQuery(this).removeClass('alt2row')" >
                <span class="items-nombre">
                    <?= "".($instit['Instit']['cue']*100)+$instit['Instit']['anexo']." - ". $instit['Instit']['nombre_completo']; ?>
                </span>

                    <div class="instit-items-domicilio1">
                        <p>Domicilio: <?= $instit['Instit']['direccion'] ?></p>
                        <p>Departamento: <?= $instit['Departamento']['name'] ?></p>
                    </div>
                    <div class="instit-items-domicilio2">
                        <p>Localidad: <?= $instit['Localidad']['name'] ?></p>
                        <p>Jurisdicción: <?= $instit['Jurisdiccion']['name'] ?></p>
                    </div>
                    <div class="instit-items-gestion"><?= $instit['Gestion']['name'] ?></div>
                    <p class="items-actions">
                        <a class="mas_info_gris_small"  href="<?= $html->url('/instits/view/'.$instit['Instit']['id'])?>" ></a>
                    </p>
            </li>

        <? endforeach?>
    </ol>

    <?endif?>

    <?php if ($paginator->numbers()) : ?>
        <div style="text-align:center; display:block;margin-bottom: 10px">
            <?php
            echo $paginator->prev('« Anterior ',null, null, array('class' => 'disabled', 'tag' => 'span'));
            echo " | ".$paginator->numbers(array('modulus'=>'9'))." | ";
            echo $paginator->next(' Siguiente »', null, null, array('class' => 'disabled'));
            ?>
            <span class="ajax_update" id="ajax_paginator_indicator" style="display:none; padding-left:10px;"><?php echo $html->image('ajax-loader.gif')?></span>
        </div>
    <?php endif ?>
</div>