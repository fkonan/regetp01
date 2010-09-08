<?php
echo $javascript->link(array(
    'jquery.loadmask.min',
    'jquery.autoscroll.packed'
    ));

?>
<script type="text/javascript">
    //jQuery.autoscroll.init();
    
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

        jQuery('#editor_anio').load(element.href, function() {
            jQuery.blockUI({
                message: "<div style='height:18px;background-color:#87AEC5'>\n\
                            <img style='cursor:pointer;float:right' src='<?php echo $html->url('/img/close.png')?>' class='cerrar'/>\n\
                          </div>" + jQuery('#editor_anio').html(),
                css: {
                    width:          'auto',
                    top:            '5%',
                    left:           '20%',
                    right:          '20%',
                    textAlign:      'left',
                    cursor:         'auto',
                    margin:         '10px'
                }
            });

            jQuery('.blockOverlay').attr('title','Cerrar').click(jQuery.unblockUI);
            jQuery('.cerrar').attr('title','Cerrar').click(jQuery.unblockUI);

            // lo vacía (para no duplicar ids) y oculta
            jQuery('#editor_anio').empty();
            jQuery('#editor_anio').hide();
        });


        return false;
    }

    function CrearPlan(element) {

        jQuery('#creador_plan').load(element.href, function() {
            jQuery.blockUI({
                message: "<div style='height:18px;background-color:#87AEC5'>\n\
                            <img style='cursor:pointer;float:right' src='<?php echo $html->url('/img/close.png')?>' class='cerrar'/>\n\
                          </div>" + jQuery('#creador_plan').html(),
                css: {
                    width:          'auto',
                    top:            '5%',
                    left:           '20%',
                    right:          '20%',
                    textAlign:      'left',
                    cursor:         'auto',
                    margin:         '10px'
                },
                fadeIn:  200,
                fadeOut:  400
            });

            jQuery('.blockOverlay').attr('title','Cerrar').click(jQuery.unblockUI);
            jQuery('.cerrar').attr('title','Cerrar').click(jQuery.unblockUI);

            // lo vacía (para no duplicar ids) y oculta
            jQuery('#creador_plan').empty();
            jQuery('#creador_plan').hide();

            jQuery('#sector_id').change( function() {
                jQuery('#sector_id').parents('form').ajaxSubmit({
                    beforeSend:function(request) {
                        request.setRequestHeader('X-Update', 'PlanSubsectorId');
                jQuery("#ajax_indicator2").show();
                jQuery("#PlanSubsectorId").attr("disabled","disabled")
                },
                complete:function(request, textStatus) {
                    jQuery("#ajax_indicator2").hide();
                    jQuery("#PlanSubsectorId").removeAttr("disabled")},
                success:function(data, textStatus) {
                    jQuery('#PlanSubsectorId').html(data);},
                async:true, type:'post', url:'<?=$html->url('/subsectores/ajax_select_subsector_form_por_sector')?>'
            });
            return false;});
        });

        
        return false;
    }

    function ChangeEstructura() {
        jQuery("div[estructura_plan_id]").hide();
        jQuery("div[estructura_plan_id=" + jQuery('#PlanEstructuraPlanId :selected').val() + "]").show();
    }

    

</script>

    <h1><?=$html->link('Depurador de Planes', '/depurador_planes/listado')?></h1>

    <div id="datos_instit">
            <?
            //el anexo viene con 1 solo digito por lo general. Pero para leerlo siempre hay que ponerlo
            // en formato de 2 digitos
            $armar_anexo = ($instit['Instit']['anexo']<10)?'0'.$instit['Instit']['anexo']:$instit['Instit']['anexo'];
            ?>
            <div class="instit_name"><b><?= "".($instit['Instit']['cue']*100)+$instit['Instit']['anexo']." - ". $instit['Instit']['nombre_completo']; ?></b></div>
            <div class="instit_atributte"><b>Domicilio: </b> <?= $instit['Instit']['direccion'] ?></div>
            <br />
            <div class="instit_atributte"><b>Gestión: </b><?= $instit['Gestion']['name'] ?></div>
            <div class="instit_atributte"><b>Jurisdicción: </b> <?= $instit['Jurisdiccion']['name'] ?></div>
            <br />
            <div class="instit_atributte"><b>Departamento: </b><?= $instit['Departamento']['name'] ?></div>
            <div class="instit_atributte"><b>Localidad: </b><?= $instit['Localidad']['name'] ?></div>
    </div>

    <div id="cuerpo">

        <div id="col_izq">

            <div class="row_header"></div>

            <?php
            foreach ($instit['Plan'] as $plan) {
            ?>
            <div class="planes_izq">
                <?=$plan['nombre']?><br />
                <?php echo $form->input('estructura_id', 
                        array(  'options'=>$estructuras,
                                'label'=>'',
                                'empty'=>' -Seleccione- ',
                                'style'=>'width:140px; font-size:8pt;',
                                'onchange'=>'javascript: CambiarEstructuraPlan('.$plan['id'].',this.value)',
                                'selected'=>$plan['estructura_plan_id'])); ?>
            </div>
            <?php } ?>

            <?=$html->link('+ Crear Plan', '/depurador_planes/add_plan/'.$instit['Instit']['id'], array('onclick' => 'return CrearPlan(this)'))?>
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

    <div id="editor_anio"></div>
    <div id="creador_plan"></div>
