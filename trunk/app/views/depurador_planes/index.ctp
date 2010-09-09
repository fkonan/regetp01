<?php
echo $javascript->link(array(
    'jquery.loadmask.min',
    'jquery.autoscroll.packed'
    ));

?>
<script type="text/javascript">
       
//    jQuery(document).ready(function(){
//        console.debug($('.timelineLimiterMini'));
//        $('.timelineLimiterMini').mouseover(function(){
//
//        });
//    });
    
    function block(formData, jqForm, options) {
        jQuery('#consoleResultWrapper').mask('Buscando');
        return true;
    }
    function unblock(formData, jqForm, options) {
        jQuery('#consoleResultWrapper').mask('Buscando');
        return true;
    }

    function RenderPlan(plan_id) {
        jQuery(document).ready(function() {
           jQuery('#plan_'+plan_id).load('<?=$html->url('/depurador_planes/tr_plan/')?>'+plan_id);
        });
    }

    function CambiarEstructuraPlan(plan_id, estructura_plan_id) {
        if (estructura_plan_id > 0) {
            jQuery(document).ready(function() {
                jQuery('#plan_'+plan_id).load('<?=$html->url('/depurador_planes/cambiarEstructuraPlan/')?>'+plan_id+'/'+estructura_plan_id);
            });
        }
    }

    function EditarCiclo(element) {

        var $dialog = $('<div></div>')
                .html('... cargando años')
		.dialog({
                        width: 550,
                        position: 'top',
			title: 'Depurar Datos de los Años'
		})
                .load(element.href);

        return false;
    }

    function CrearPlan(element) {        
        var $dialog = $('<div></div>')
                .html('... cargando nuevo plan')
		.dialog({
                        width: 750,
                        position: 'top',
			title: 'Nuevo Plan'
		})
                .load(element.href, function(){
                    jQuery('#sector_id').change( function() {
                        jQuery('#sector_id').parents('form').ajaxSubmit({
                            beforeSend:function(request) {
                                request.setRequestHeader('X-Update', 'PlanSubsectorId');
                                jQuery("#ajax_indicator2").show();
                                jQuery("#PlanSubsectorId").attr("disabled","disabled")
                            },
                            complete:function(request, textStatus) {
                                jQuery("#ajax_indicator2").hide();
                                jQuery("#PlanSubsectorId").removeAttr("disabled")
                            },
                            success:function(data, textStatus) {
                                jQuery('#PlanSubsectorId').html(data);
                            },
                            async:true,
                            type:'post',
                            url:'<?=$html->url('/subsectores/ajax_select_subsector_form_por_sector')?>'
                        });
                    })
                });
  
        return false;
    }

    function ChangeEstructura() {
        jQuery("div[estructura_plan_id]").hide();
        jQuery("div[estructura_plan_id=" + jQuery('#PlanEstructuraPlanId :selected').val() + "]").show();
    }

    

</script>

    <div id="datos_instit">
            <?
            //el anexo viene con 1 solo digito por lo general. Pero para leerlo siempre hay que ponerlo
            // en formato de 2 digitos
            $armar_anexo = ($instit['Instit']['anexo']<10)?'0'.$instit['Instit']['anexo']:$instit['Instit']['anexo'];
            $nombreInstit = "".($instit['Instit']['cue']*100)+$instit['Instit']['anexo']." - ". $instit['Instit']['nombre_completo'];
            ?>
            <div class="instit_name"><b><?= $html->link($nombreInstit, '/instits/view/'.$instit['Instit']['id']) ?></b></div>           
            <div class="instit_atributte"><b>Domicilio: </b> <?= $instit['Instit']['direccion'] ?></div>
            <br />
            <div class="instit_atributte"><b>Gestión: </b><?= $instit['Gestion']['name'] ?></div>
            <div class="instit_atributte"><b>Jurisdicción: </b> <?= $instit['Jurisdiccion']['name'] ?></div>
            <br />
            <div class="instit_atributte"><b>Departamento: </b><?= $instit['Departamento']['name'] ?></div>
            <div class="instit_atributte"><b>Localidad: </b><?= $instit['Localidad']['name'] ?></div>
    </div>

    <div id="volver"><h1><?=$html->link('Volver al Depurador de Planes', '/depurador_planes/listado')?></h1></div>

    <div id="cuerpo">

        <div id="col_izq">
            <div style="border-bottom:1px solid black; height:21px;"><?=$html->link('+ Crear Plan', '/depurador_planes/add_plan/'.$instit['Instit']['id'], array('onclick' => 'return CrearPlan(this)'))?></div>
            <?php
            foreach ($instit['Plan'] as $plan) {
            ?>
            <div class="planes_izq">
                <?= $html->link($plan['nombre'],'/planes/view/'.$plan['id'])?><br />

                <br>
                <?php echo $form->input('estructura_id', 
                        array(  'options'=>$estructuras,
                                'label'=>'',
                                'empty'=>' -Seleccione- ',
                                'style'=>'width:165px; font-size:8pt;',
                                'onchange'=>'javascript: CambiarEstructuraPlan('.$plan['id'].',this.value)',
                                'selected'=>$plan['estructura_plan_id'],
                                'style'=>'float:left; width: 150px;',
                            )); ?>
                <div><b><?= $html->link(':: TODO OK', '/depuradorPlanes/darle_ok_al_plan/'.$plan['id']) ?></b></div>
            </div>
            <?php } ?>

            <div><?=$html->link('+ Crear Plan', '/depurador_planes/add_plan/'.$instit['Instit']['id'], array('onclick' => 'return CrearPlan(this)'))?></div>
        </div>
        <!-- pantalla principal -->

        <div id="col_der">
            
            <table class="table_planes_der">
                <tr class="tr_header">
                <?php
                for ($i=2006; $i <= date('Y'); $i++) {
                ?>
                    <th><?=$i?></th>
                <?php } ?>
                </tr>

                <?php
                foreach ($instit['Plan'] as $plan) {
                ?>
                <tr class="tr_plan" id="plan_<?=$plan['id']?>">
                    <script type="text/javascript">RenderPlan(<?=$plan['id']?>);</script>
                </tr>
                <?php } ?>

            </table>
        </div>
    </div>

   
