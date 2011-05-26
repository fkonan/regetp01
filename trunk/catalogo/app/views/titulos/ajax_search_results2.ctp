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
<div id="search_results" class="grid_10 prefix_1 suffix_1 boxblanca">
    <div class="grid_4 suffix_4">
        Ordenar por: 
        <?php echo $paginator->sort('Nombre','name');?>, <?php echo $paginator->sort("Oferta",'Oferta.name');?>
    </div>
    <div class="grid_4">
        <?php echo $paginator->counter(array(
            'format' => __('Títulos %start%-%end% de <strong>%count%</strong>', true))); ?>
    </div>
    <div class="clear"></div>

    <? if (sizeof($titulos) > 0) {?>
    <ol id="items">
            <?php
            $i = 0;
            foreach ($titulos as $titulo):
                ?>
        <li onmouseover="jQuery(this).addClass('alt2row')" onmouseout="jQuery(this).removeClass('alt2row')" >
            <span class="items-nombre">
                        <?php
                        /*$linkTitulo = $html->link(
                                " (".count($titulo['Plan'])." planes)",
                                '/titulos/corrector_de_planes/Plan.titulo_id:'.$titulo['Titulo']['id'],
                                array('target'=>'_blank')
                                );*/
                        echo $titulo['Titulo']['name']; ?>
            </span>
            <!--<p>
                    <?php
                    if ($titulo['Titulo']['marco_ref']==1) {
                        echo $html->image('check_blue.jpg');
                    }
                    ?>
            </p>-->
            <p class="titulos-items-oferta">
                        <?php
                        echo (empty($titulo['Oferta']['name']))? "" : $titulo['Oferta']['name'];
                        echo $form->input('oferta_'.$titulo['Titulo']['id'], array('type' => 'hidden', 'value' => $titulo['Titulo']['oferta_id']));
                        ?>
            </p>
            <p class="items-actions">
                <a class="mas_info_gris_small" onclick="viewTitulo('<?php echo $html->url('/titulos/view/'.$titulo['Titulo']['id']);?>', '<?php echo $titulo['Titulo']['name'];?>');" style="cursor:pointer;"></a>
            </p>
        </li>
            <?php endforeach; ?>
    </ol>
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
</div>