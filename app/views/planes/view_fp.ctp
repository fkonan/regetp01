
<?php
    /* @var $ajax AjaxHelper */
    $ajax;
    /* @var $form FormHelper */
    $form;
    /* @var $html HtmlHelper */
    $html;
    
echo $html->css('planes/view_fp');
echo $javascript->link('jquery.pajinate.js',false);
?>
<div id="tabs-oferta-fp" class="oferta-contanier">

    <?php
    echo $ajax->form('planes/view_fp','post', array('id'=>'formPlanesViewFp'));
    echo $form->input('Plan.nombre', array('label'=>'Título'));
    echo $form->input('Sector.id', array('label'=>'Sector',  'options'=> $sectores, 'empty'=>'Todos'));
    if($ciclo == 0){
        echo $form->input('Plan.ciclo_id', array('label'=>'Ciclo', 'options'=>$ciclos_anios, 'empty'=>'Todos'));
    }
    echo $form->end();
    ?>

    <div class="clear"></div>
    <br>
    <?php
    $i = 0;
    if ((isset($planes)) && (count($planes) > 0)) {
    ?>
    <?php
        foreach ($planes['Plan'] as $plan):
            if(count($plan['Anio']) > 0) {
        ?>
        <?php
                $class = '';
                if ($i++ % 2 == 0) {
                    $class = 'altrow';
                }
                
                $ciclo_plan = '';

                if (!empty($plan['Anio'][0]['Anio']['ciclo_id']) && $ciclo==0) {
                    $primer_anio = current($plan['Anio'][0]);
                    $ciclo_plan =  (!empty($primer_anio['ciclo_id'])? $primer_anio['ciclo_id']:"") ;

                }

                echo $this->element('planes/plan_resumen_para_listado', array(
                    'class' => $class,
                    'plan'  => $plan,
                    'ciclo' => $ciclo_plan,
                ));
                ?>
            <?php
            }
        endforeach;
    ?>
    <div class="navigation"></div>
    <?php
    } 
    else {
    ?>
    <div>
            <?php $año_actual = date('Y',strtotime('now'));?>
            <?php if($datoUltimoCiclo['max_ciclo'] != $año_actual && $current_ciclo == $año_actual):?>
        <p class='msg-atencion'>La Instituci&oacute;n no presenta actualizaciones para este año</p>
            <?php else:?>
        <p class='msg-atencion'>No se obtuvieron resultados</p>
            <?php endif;?>
    </div>
        <?} ?>
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

