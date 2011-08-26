<?php
    echo $javascript->link(array(
    'jquery.autocomplete',
    'jquery.loadmask.min',
    ));
    echo $html->css(array('jquery.loadmask', 'jquery.autocomplete', 'catalogo.advanced_search', 'catalogo.titulos'), null, array(), false);
?>
<script type="text/javascript">
//    init('<?echo $html->url(array('controller'=>'localidades','action'=>'ajax_search_localidades'));?>');
</script>
<div class="grid_12 titulos search">
    
    <h1><?php __('Búsqueda de Títulos');?></h1>

    <div class="boxblanca inputs_largos">
        <h3>Seleccione criterios de búsqueda</h3>
        <?php
        echo $form->create('Titulo', array(
        'action' => $this->action,
        'name'=>'TituloSearchForm',
        'id' =>'TituloSearchForm',
            'type' => 'get',
        )
        );
        ?>
        <div class="box_izquierda">
            <h4>Nivel y Sector</h4>
            <?php
                echo $form->input('oferta_id',array( 'div' => true,
                                                    'class' => 'autosubmit ',
                                                    'label'=> 'Nivel',
                                                    'id' => 'ofertaId',
                                                    'empty' => 'Seleccione'
                                                   ));
               
                
                $meter = '<span id="ajax_indicator" style="display:none;">'.$html->image('ajax-loader.gif', array('style' => 'float:right; height: 19px;')).'</span>';

                echo $form->input('SectoresTitulo.sector_id', array( 'div' => true,
                                                 'class' => 'autosubmit ',
                                                 'type'=>'select',
                                                 'empty'=>'Seleccione',
                                                 'options'=>$sectores,
                                                 'label'=>'Sector',
                                                 'id'=>'sectorId',
                                                 'after'=>$meter));

                echo $form->input('SectoresTitulo.subsector_id', array( 'div' => true,
                                                        'class' => 'autosubmit ',
                                                        'empty' => 'Seleccione',
                                                        'type'=>'select',
                                                        'label'=>'Subsector',
                                                        'id'=>'subsectorId',
                                                        'after'=> $meter));

                echo $ajax->observeField('sectorId', array( 'url' =>'/subsectores/ajax_select_subsector_form_por_sector',
                                                            'update'=>'subsectorId',
                                                            'loading'=>'jQuery("#ajax_indicator").show();jQuery("#subsectorId").attr("disabled","disabled")',
                                                            'complete'=>'jQuery("#ajax_indicator").hide();jQuery("#subsectorId").removeAttr("disabled")',
                                                            'onChange'=>true ));

                
                echo $form->input('tituloname', array( 'label'=> 'Nombre del Título' ));
                ?>
        </div>
        <div class="box_derecha">
            <h4>Localización</h4>
            <?php
            
            echo $form->input('Instit.jurisdiccion_id', array('label'=>'Jurisdicción',
                                                                  'div' => false,
                                                                  'class' => 'autosubmit ',
                                                                  'empty' => array('0'=>'Seleccione'),
                                                                  'id'=>'jurisdiccion_id'));
            echo '<span class="ajax_update" id="ajax_indicator" style="display:none; margin-top: -32px; float: right; clear: none">'.$html->image('ajax-loader.gif').'</span>';
                
            echo $form->input('Instit.departamento_id', array(
                'label'=>'Departamento', 
                'empty' => 'Seleccione'));
            
            echo $ajax->observeField('jurisdiccion_id', array( 
                                    'url' =>'/departamentos/ajax_select_departamento_form_por_jurisdiccion',
                                    'update'=>'InstitDepartamentoId',
                                    'loading'=>'jQuery("#InstitDepartamentoId").attr("disabled","disabled")',
                                    'complete'=>'jQuery("#InstitDepartamentoId").removeAttr("disabled")',
                                    'onChange'=>true )
                    );
            
            
            echo $form->input('Localidad.name', array('label'=>'Localidad', 'empty' => 'Seleccione'));
           
            ?>
            <div class="clear" style="height:50px;"></div>
            
            <?php
            
            echo $form->end('Buscar');
            ?>

        </div>
        <div class="clear" style="height:15px;"></div>

        <div class="clear"></div>
    </div>




    <div class="clear separador"></div>

<?php

if ($vino_formulario) {
    

    $paginator->options(array( 'url' => $this->passedArgs,
                               'indicator'=> 'ajax_paginator_indicator'));
    ?>

    <div id="search_results" class="boxblanca">
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
        <?php endif; ?>
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
                <span class="<?= $class?>"><?php echo $paginator->sort("Nivel",'Oferta.name');?></span>

            </div>
            <div class="paging">
                <?php echo $paginator->counter(array(
                    'format' => __('Títulos %start%-%end% de <strong>%count%</strong>', true))); ?>
            </div>
            <div class="clear"></div>
        </div>
        <? if (!empty($titulos)) {?>
        <ul id="items" class="items">
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
                        ?>"
                        class="linkconatiner-more-info">

                        <span class="items-oferta">
                            <?php
                            echo (empty($titulo['Oferta']['name']))? "" : $titulo['Oferta']['name'];
                            ?>
                        </span>
                        <span class="items-nombre">
                                    <strong><?php
                                    /*$linkTitulo = $html->link(
                                            " (".count($titulo['Plan'])." planes)",
                                            '/titulos/corrector_de_planes/Plan.titulo_id:'.$titulo['Titulo']['id'],
                                            array('target'=>'_blank')
                                            );*/
                                    echo $titulo['Titulo']['name']; ?>
                                    </strong>
                        </span>



                <div class="clear"></div>
                </a>
            </li>
                <?php endforeach; ?>
        </ul>
            <?php
        }
        else {
            ?>
            <div class="clear"></div><br />
            <div id="no_results" style="color: red">No hay resultados</div><br />
            <div class="clear"></div>
        <?php
        }

        if ($paginator->numbers()) {
        ?>
            <div style="text-align:center; margin-bottom: 10px">
                <?php
                echo $paginator->prev('« Anterior ',null, null, array('class' => 'disabled', 'tag' => 'span'));
                echo " | ".$paginator->numbers(array('modulus'=>'9'))." | ";
                echo $paginator->next(' Siguiente »', null, null, array('class' => 'disabled'));
                ?>
            </div>

            <div id="ajax_paginator_indicator" style="display: none;text-align: center"><?php echo $html->image('ajax-loader.gif')?></div>
            <?php  } ?>
        <div class="clear"></div>
    </div>
<?php } ?>
    
</div>