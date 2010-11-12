
<?php
    /* @var $ajax AjaxHelper */
    $ajax;
    /* @var $form FormHelper */
    $form;
    /* @var $html HtmlHelper */
    $html;
    
echo $html->css('planes/view_fp', null, null, false);
echo $javascript->link('jquery.pajinate.js',false);


$paginator->options(array('url' => $url_conditions, 'update'=>'tabs-oferta-fp'));


?>


<div id="tabs-oferta-fp" class="oferta-contanier">

    <?php
    if (empty($planes) && !$es_una_busqueda) {
    ?>
    <p class="msg-atencion"><br /><br />La Institución no presenta actualizaciones para este año</p>
    <?
        exit ();
    }

    echo $ajax->form(
            '/planes/view_fp/',
            'post',
            array(
                'id'=>'formPlanesViewFp',
                'url' => '/planes/view_fp/'.$instit_id.'/'.$oferta_id.'/'.$ciclo,
                'update' => 'tabs-oferta-fp',
                )
            );
    echo $form->input('Plan.nombre', array('label'=>'Título'));
    echo $form->input('Sector.id', array('label'=>'Sector',  'options'=> $sectores, 'empty'=>'Todos'));
    if($ciclo == 0){
        //echo $form->input('Plan.ciclo_id', array('label'=>'Ciclo', 'options'=>$ciclos_anios, 'empty'=>'Todos'));
    }
    echo $form->end('Buscar');



    if (empty($planes) && $es_una_busqueda) {
    ?>
    <p class="msg-atencion"><br /><br />Búsqueda sin resultados</p>
    <?
        exit();
    }
    ?>
    
    <div class="clear"></div>
    <br>
    <div id="listado_de_planes">
    <?php
    $i = 0;
    if (!empty($planes)) {
        
        foreach ($planes as $plan):
            //debug($plan);
            $class = '';
            if ($i++ % 2 == 0) {
                $class = 'altrow';
            }
            $ciclo_plan = '';
            if($ciclo == 0){
                if (!empty($plan['Anio'][0]['ciclo_id']) && $ciclo==0) {
                    $primer_anio = current($plan['Anio']);
                    $ciclo_plan =  (!empty($primer_anio)? $primer_anio:"") ;
                }
            }

            echo $this->element('planes/plan_resumen_para_listado', array(
                'class' => $class,
                'plan'  => $plan,
                'ciclo' => $ciclo_plan,
            ));            
         endforeach;
    ?>
    <div class="navigation"></div>
    <?php
    }
    ?>
    </div>

    <div id="paginator_prev_next_links">
            <?php
            if($paginator->numbers()){
                    echo $paginator->prev('« Anterior ',null, null, array('class' => 'disabled'));
                    echo " | ".$paginator->numbers(array('modulus'=>'9'))." | ";
                    echo $paginator->next(' Siguiente »', null, null, array('class' => 'disabled'));
            }
            ?>
    </div>

</div>

<script language="JavaScript"  type="text/javascript" defer="defer">
    setearBuscador();
    
    function setearBuscador() {
        if ( Get_Cookie( 'planes_buscadorfp_titulo' )) {
            jQuery('#PlanNombre').val(Get_Cookie( 'planes_buscadorfp_titulo' ));
        }

        if ( Get_Cookie( 'planes_buscadorfp_sector' )) {
            jQuery('#SectorId').val(Get_Cookie( 'planes_buscadorfp_sector' ));
        }

        if ( Get_Cookie( 'planes_buscadorfp_ciclo' )) {
            jQuery('#PlanCicloId').val(Get_Cookie( 'planes_buscadorfp_ciclo' ));
        }

        togglePlanes('#tabs-oferta-fp .plan_item');
    }

    
</script>

