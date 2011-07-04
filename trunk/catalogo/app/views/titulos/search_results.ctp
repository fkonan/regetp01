<?php
$paginator->options(array(  'update' => 'consoleResult',
                            'url' => $this->passedArgs,
                            'indicator'=> 'ajax_paginator_indicator'));
?>
<script type="text/javascript">
    // si hay una búsqueda nueva que no recuerde paginación de session
    if (jQuery("#TituloBusquedanueva").val() == 1) {
        jQuery("#TituloBysession").val(0);
    }
</script>
<div id="search_results" class="boxblanca">
    <h3>Listado de resultados</h3>
    <div class="list-header">
        <div class="sorter">
            <?php
            $sort = 'Titulo.name';
            if(isset($this->passedArgs['sort'])){
            $sort = $this->passedArgs['sort'];
            }
            ?>
            Ordenar por:
            <? $class = ($sort == 'Titulo.name')?'marcada':'';?>
            <span class="<?= $class?>"><?php echo $paginator->sort('Nombre','Titulo.name');?></span>,

            <? $class = ($sort == 'Oferta.name')?'marcada':'';?>
            <span class="<?= $class?>"><?php echo $paginator->sort("Oferta",'Oferta.name');?></span>

        </div>
        <div class="paging">
            <?php echo $paginator->counter(array(
                'format' => __('Títulos %start%-%end% de <strong>%count%</strong>', true))); ?>
        </div>
        <div class="clear"></div>
    </div>
    <? if (!empty($titulos)) {?>
    <ol id="items" class="items">
        <?php
        $i = 0;
        foreach ($titulos as $titulo):
        ?>
        <li>
            <a href="<?php echo $html->url(array(
                                    'controller' => 'titulos',
                                    'action' => 'view',
                                    'id' => $titulo['Titulo']['id'],
                                    'slug' => slug($titulo['Titulo']['name'])))
                    ?>" style="display:block;">
            <div class="items-nombre">
                        <strong><?php
                        /*$linkTitulo = $html->link(
                                " (".count($titulo['Plan'])." planes)",
                                '/titulos/corrector_de_planes/Plan.titulo_id:'.$titulo['Titulo']['id'],
                                array('target'=>'_blank')
                                );*/
                        echo $titulo['Titulo']['name']; ?>
                        </strong>
            </div>
            <!--<p>
                    <?php
                    if ($titulo['Titulo']['marco_ref']==1) {
                        echo $html->image('check_blue.jpg');
                    }
                    ?>
            </p>-->
            <div class="items-oferta">
                        <?php
                        echo (empty($titulo['Oferta']['name']))? "" : $titulo['Oferta']['name'];
                        ?>
            </div>
            <div class="items-actions">
                <span class="mas_info_azul_small"></span>
            </div>
            <div class="clear"></div>
            </a>
        </li>
            <?php endforeach; ?>
    </ol>
        <?php
    }
    else {
        ?>
    <div id="no_results">No hay resultados</div>
    <?php
    }

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
    <div class="clear"></div>
</div>