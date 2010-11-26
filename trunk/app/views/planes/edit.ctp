<?
echo $javascript->link(array('jquery.autocomplete', 'jquery.blockUI', 'jquery.loadmask.min', 'views/planes/add'));
echo $html->css('jquery.autocomplete.css');
?>
<script type="text/javascript">
    jQuery(document).ready(function () {
        toggleTitulos();
        toggleEstructuraPlan();

        jQuery("#PlanEstructuraPlanId").change(function(){
            jQuery("div[estructura_plan_id]").hide();
            jQuery("div[estructura_plan_id=" + jQuery(this).val() + "]").show();
            jQuery("#PlanTituloName").val('');
            jQuery("#PlanTituloId").val('');
        });

        jQuery("#PlanEstructuraPlanId").change();


        jQuery("#PlanTituloName").autocomplete("<?echo $html->url(array('controller'=>'titulos','action'=>'ajax_search'));?>", {
            dataType: "json",
            delay: 200,
            max:30,
            cacheLength:0,
            extraParams: {
                oferta_id: function() { return jQuery('#PlanOfertaId').val(); },
                sector_id: function() { return jQuery('#sector_id').val(); },
                subsector_id: function() { return jQuery('#PlanSubsectorId').val(); }
            } ,
            parse: function(data) {
                return jQuery.map(data, function(titulo) {
                    return {
                        data: titulo,
                        value: titulo.id,
                        result: formatResult(titulo)
                    }
                });
            },
            formatItem: function(item) {
                return formatResult(item);
            }
        }).result(function(e, item) {
            if(item.type == 'Vacio'){
                jQuery("#PlanTituloName").val('');
                jQuery("#PlanTituloId").val('');
            }
            else{
                jQuery("#PlanTituloId").val(item.id);
            }
        });

        jQuery("#PlanTituloName").attr('autocomplete','off');

        jQuery("#sector_id").change(function(){
            jQuery("#PlanTituloName").val('');
            jQuery("#PlanTituloId").val('');
        });

        jQuery("#PlanSubsectorId").change(function(){
            jQuery("#PlanTituloName").val('');
            jQuery("#PlanTituloId").val('');
        });
    });
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

        if (empty($this->data['Anio']))
        {
            echo $form->input('oferta_id',array('empty'=>'Seleccione','onchange'=>'toggleTitulos();'));
        ?>
            <div id="PlanEstructura">
                <span id="selectEstructura" style="float:left">
                    <?php
                            echo $form->input('estructura_plan_id',array('empty'=>'Seleccione'));
                    ?>
                </span>
                <span id="graficosEstructura">
                    <?php if(sizeof($estructuraPlanesGrafico)  > 0){ ?>
                    <?
                            foreach($estructuraPlanesGrafico as $estructura){
                    ?>

                    <div id="timelineLimiterMini" estructura_plan_id="<?php echo $estructura['EstructuraPlan']['id']?>" class="clickeable" style="display:none">
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
                </span>
            </div>
        <?php
        }
        else {
            echo $form->input('oferta_id_aux',array('type'=>'select', 'empty'=>$this->data['Oferta']['name'], 'label'=>'Oferta', 'disabled'=>true));
            echo $form->input('oferta_id',array('type'=>'hidden'));
            ?>
            <div id="PlanEstructura">
            <?php
                echo $form->input('estructura_plan_id',array('disabled'=>true));
            ?>
            </div>
            <?php
        }
        
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

        $meter = '<span class="ajax_update" id="ajax_indicator" style="display:none;">'.$html->image('ajax-loader.gif').'</span>';
        echo $form->input(
                'tituloName',
                array(
                    'label'=> 'Título de Referencia',
                    'id' => 'PlanTituloName',
                    'style'=>'max-width: 550px;',
                    'value'=> @$this->data['Titulo']['name'],
                    'after'=> $meter.'<cite>Seleccione primero una oferta.</cite>',
                    'div'=>array('id'=>'divPlanTituloName')));
        echo $form->input('titulo_id',array('type'=>'hidden'));

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
