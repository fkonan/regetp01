<script type="text/javascript">
     function toggleTitulos(){
         if (jQuery('#PlanOfertaId').val() != '') {
            jQuery('#divPlanTituloId').show();
        }
        else {
             jQuery('#divPlanTituloId').hide();
        }

        toggleEstructuraPlan();
    }

    jQuery(document).ready(function () {
        toggleTitulos();
        toggleEstructuraPlan();

        jQuery(".clickeable").click(function(){
            jQuery(".green").toggleClass("green");
            jQuery(this).removeClass("yellow");
            jQuery(this).toggleClass("green");
            jQuery('#estructura_plan_id').remove();
            if(jQuery(this).hasClass("green")){
                jQuery('#planAdd').append("<input id='estructura_plan_id' name='data[Plan][estructura_plan_id]' type='hidden' value='" + jQuery(this).attr("estructura_plan_id") + "' />");
                jQuery(this).find("#JurisdiccionesEstructuraPlanAsignado").attr("checked", "checked");
            }else{
                jQuery(this).find("#JurisdiccionesEstructuraPlanAsignado").removeAttr("checked");
            }
        });
    });

    function toggleEstructuraPlan() {
        if (jQuery('#PlanOfertaId :selected').val() != 2 && jQuery('#PlanOfertaId :selected').val() != 3) {
            jQuery('#PlanEstructuraPlanId').hide();
        }
        else {
            jQuery('#PlanEstructuraPlanId').show();
        }
    }
</script>

<h1>Editar Plan</h1>

<?
$anexo = ($instit['anexo']<10)?'0'.$instit['anexo']:$instit['anexo'];
$cue_instit = $instit['cue'].$anexo;
?>
<h2><?php echo $cue_instit." - ".$instit['nombre_completo']; ?></h2>

<div class="planes form">
    <?php echo $form->create('Plan',array('id'=>'planAdd'));?>
    <fieldset>
        <?php
        echo $form->input('id');
        echo $form->input('instit_id',array('type'=>'hidden'));
        
        echo $form->input('oferta_id',array('empty'=>'Seleccione','onchange'=>'toggleTitulos();'));
        ?>

        <?php
        if(!empty($this->data['Plan']['estructura_plan_id'])){
        ?>
            <input id='estructura_plan_id' name='data[Plan][estructura_plan_id]' type='hidden' value='<?php echo $this->data['Plan']['estructura_plan_id']?>' />
        <?php
        }
        ?>
        <div id="PlanEstructuraPlanId">
            <?php if(sizeof($estructuraPlanes)  > 0){ ?>
            <label>Elija una de las estructuras:</label>
            <?
                    foreach($estructuraPlanes as $estructura){
            ?>
            <?php

            $esSugerida = false;
            $esElegida = false;

            if(empty($this->data['Plan']['estructura_plan_id'])){
                if($estructura['EstructuraPlan']['id'] == $estructuraSugeridaId){
                    $esSugerida = true;
                }
            }
            elseif($this->data['Plan']['estructura_plan_id'] == $estructura['EstructuraPlan']['id']){
                $esElegida = true;
            }
            ?>
            <div id="timelineLimiterMini" estructura_plan_id="<?php echo $estructura['EstructuraPlan']['id']?>" class="clickeable <?php echo ($esSugerida)?' yellow':(($esElegida)?' green':'')?>">
                <i><?php echo $estructura['EstructuraPlan']['name'];?><?php echo ($esSugerida)?' (Sugerida)':''?> </i>
                <div id="timelineScroll" style="margin-left: 0px;">
                    <div>
                        <div class="event">
                            <div class="eventHeading blue"><?php echo $estructura['EstructuraPlan']['Etapa']['name']?></div>
                                <ul class="eventList">
                        <?php
                        $j = 0;
                        foreach($estructura['EstructuraPlan']['EstructuraPlanesAnio'] as $anio ):
                        ?>
                            <li><?php echo $anio['nro_anio'];?>º</li>
                        <?php
                        endforeach;
                        ?>
                                </ul>
                        </div>
                    </div>
                </div>
            </div>
        <?php
                }
            }
            else{
        ?>
            <div class="message">No existen estructuras asignadas a la jurisdicción</div>
        <?php }?>
        </div>

        <?php
        
        $meter = '<span class="ajax_update" id="ajax_indicator" style="display:none;">'.$html->image('ajax-loader.gif').'</span>';
        echo $form->input(
                'titulo_id',
                array(
                    'empty'=>'Seleccione',
                    'label'=> 'Título de Referencia',
                    'after'=> $meter.'<br /><cite>Seleccione primero una oferta.</cite>',
                    'div'=>array('id'=>'divPlanTituloId')));
        echo $ajax->observeField(
                'PlanOfertaId',
                array(
                    'update'=> 'PlanTituloId',
                    'url'=>'/titulos/list_por_oferta_id',
                    'loading'=>'jQuery("#ajax_indicator").show();jQuery("#PlanTituloId").attr("disabled","disabled")',
                    'complete'=>'jQuery("#ajax_indicator").hide();jQuery("#PlanTituloId").removeAttr("disabled")',
                    'onChange'=>true)
                     );
                

        echo $form->input('norma',array('label'=>'Normativa'));

        $meter = '<span class="ajax_update" id="ajax_indicator2" style="display:none;">'.$html->image('ajax-loader.gif').'</span>';
        
        echo $form->input('nombre');
        echo $form->input('perfil');

        echo $form->input('sector_id',array(
                'type'=>'select',
                'empty'=>'Seleccione',
                'options'=>$sectores,
                'label'=>'Sector','id'=>'sector_id',
                'after'=>'<span class="ajax_update" id="ajax_indicator" style="display:none;">'
                            .$html->image('ajax-loader.gif')
                        .'</span>'
            ));


        echo $form->input('subsector_id', array('empty' => 'Seleccione',
        'type'=>'select',
        'label'=>'Subsector',
        'after'=> $meter.'<br /><cite>Seleccione primero un sector.</cite>'));
        echo $ajax->observeField(
            'sector_id',
            array(
                'url' => '/subsectores/ajax_select_subsector_form_por_sector',
                'update'=>'PlanSubsectorId',
                'loading'=>'jQuery("#ajax_indicator2").show();jQuery("#PlanSubsectorId").attr("disabled","disabled")',
                'complete'=>'jQuery("#ajax_indicator2").hide();jQuery("#PlanSubsectorId").removeAttr("disabled")',
                'onChange'=>true
        ));

        echo "<br>Duración:";
        echo $form->input('duracion_hs',array('label'=>' - Horas','maxlength'=>9));
        //echo $form->input('duracion_semanas',array('label'=>' - Semanas','maxlength'=>9));
        echo $form->input('duracion_anios',array('label'=>' - Años','maxlength'=>9));


        echo "<br>";
        /**
         *    OBSERVACION
         */
        echo $form->input('observacion');


        /**
         *    CICLOS ALTA Y MODIFICACION
         */
        echo $form->input('ciclo_alta', array(
            "type" => "select",
            "options" => $ciclos,
            'label'=>'Alta'
        ));

        ?>
    </fieldset>
    <?php echo $form->end('Guardar');?>
</div>
