<?php
    echo $html->css('catalogo.instits', false);
    echo $html->css('catalogo.advanced_search', false);

    $paginator->options(array(
        'url'     => $this->passedArgs,
        'update'  => 'tituloPlanes',
        'indicator' => 'spinner',
        ));
?>
<div class="grid_10 alpha omega prefix_1 suffix_1 boxblanca" id="search_results">
    <div class="clear"></div>
    <div class="grid_10 alpha list-header">
        <div class="grid_6 alpha">
            <?php
            $sort = 'cue';
            if(isset($this->passedArgs['sort'])){
            $sort = $this->passedArgs['sort'];
            }
            ?>
            Ordenar por:
            <? $class = ($sort == 'Instit.cue')?'marcada':'';?>
            <span class="<?= $class?>"><?php echo $paginator->sort('CUE','Instit.cue');?></span>,

            <? $class = ($sort == 'Localidad.name')?'marcada':'';?>
            <span class="<?= $class?>"><?php echo $paginator->sort('Localidad','Localidad.name');?></span>,

            <? $class = ($sort == 'Departamento.name')?'marcada':'';?>
            <span class="<?= $class?>"><?php echo $paginator->sort('Departamento','Departamento.name');?></span>,

            <? $class = ($sort == 'Jurisdiccion.name')?'marcada':'';?>
            <span class="<?= $class?>"><?php echo $paginator->sort('Jurisdiccion','Jurisdiccion.name');?></span>

        </div>
        <div class="grid_4 omega">
            <?php echo $paginator->counter(array(
                'format' => __('Instituciones %start%-%end% de <strong>%count%</strong>', true))); ?>
        </div>
    </div>
    <div class="clear"></div>

    <ol id="items" class="grid_10 alpha omega">
        <?php foreach($planes as $plan) : ?>
            <?  $año_actual = date("Y");
                $fecha_hasta = "$año_actual-07-21"; //hasta julio
                $fecha_desde = "$año_actual-01-01"; //desde enero
                $clase = '';
                if($plan['Instit']['activo']) {
                    $clase .= ' escuela_activa';
                }else {
                    $clase .= ' escuela_inactiva';
                }
            ?>

            <li class="grid_10 alpha omega" style="margin-bottom: 5px;">
                <span class="items-nombre grid_10 alpha omega">
                    <?= "".($plan['Instit']['cue']*100)+$plan['Instit']['anexo']." - ". $plan['Instit']['nombre_completo']; ?>
                </span>
                <div class="clear"></div>
                <div class="instit-items-domicilio1 alpha grid_3">
                    <p>Domicilio: <?= $plan['Instit']['direccion'] ?></p>
                    <p>Departamento: <?= $plan['Instit']['Departamento']['name'] ?></p>
                </div>
                <div class="instit-items-domicilio2 grid_3">
                    <p>Localidad: <?= $plan['Instit']['Localidad']['name'] ?></p>
                    <p>Jurisdicción: <?= $plan['Instit']['Jurisdiccion']['name'] ?></p>
                </div>
                <div class="instit-items-gestion grid_3"><?= $plan['Instit']['Gestion']['name'] ?></div>
                <p class="items-actions grid_1">
                    <a href="<?= $html->url('/instits/view/'.$plan['Instit']['id'])?>">
                        <?php
                            echo $html->image('../css/img/lupagris_small.png', array(
                                'alt' => 'Mas informacion',
                                'style' => 'border:0;',
                                ));
                        ?>
                    </a>
                </p>
            </li>

        <? endforeach?>
    </ol>
 
    <?php
    if ($paginator->numbers()) {
    ?>
        <div style="text-align:center; display:block;margin-bottom: 10px">
            <?php
            echo $paginator->prev('« Anterior ',null, null, array('class' => 'disabled', 'tag' => 'span'));
            echo " | ".$paginator->numbers(array('modulus'=>'9'))." | ";
            echo $paginator->next(' Siguiente »', null, null, array('class' => 'disabled'));
            ?>
            <span class="ajax_update" id="ajax_paginator_indicator" style="display:none; padding-left:10px;"><?php echo $html->image('ajax-loader.gif')?></span>
        </div>
        <?php  } ?>
</div>