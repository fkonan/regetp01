
<?php
    /* @var $ajax AjaxHelper */
    $ajax;
    /* @var $form FormHelper */
    $form;
    /* @var $html HtmlHelper */
    $html;
    
echo $html->css('planes/view_fp');
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
        foreach ($planes as $plan):
            if(count($plan['Anio']) > 0) {
                $class = null;
                if ($i++ % 2 == 0) {
                    $class = 'altrow';
                }
                ?>
    


    <div class="plan_item <?php echo $class?>">
        <span class="plan_title">
                        <?php
                        echo $html->link($plan['Plan']['nombre'],
                        array('action'=>'view', $plan['Plan']['id']),array('class'=>'title'));
                        ?>
        </span>
        <span class="plan_mas_info">
                        <?php
                        echo $html->link("más info",array('controller'=> 'planes', 'action'=>'view', $plan['Plan']['id']),
                        null,null,false);
                        ?>
        </span>
        <div>
           Matrícula: <?php echo empty($plan['Anio'][0]['matricula'])?"<span style='color:red'>0</span>":$plan['Anio'][0]['matricula']; ?>
            <span class="plan_sector_info">
                 Sector: <span class="plan_sector_name"><?php echo $plan['Sector']['name']; ?></span>
            </span>
        </div>
        <input class="plan_sector" type="hidden" value="<?php echo $plan['Sector']['id']?>"/>
        <input class="plan_ciclo" type="hidden" value="<?php echo empty($plan['Anio'][0]['ciclo_id'])?0:$plan['Anio'][0]['ciclo_id'] ?>"/>
    </div>
                <?php }
        endforeach;
    } else {
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

