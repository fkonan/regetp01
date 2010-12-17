<?
echo $javascript->link(array('jquery.autocomplete', 'jquery.blockUI', 'jquery.loadmask.min', 'views/planes/add'));
echo $html->css('jquery.autocomplete.css');
?>
<script type="text/javascript">
    init("<?echo $html->url(array('controller'=>'titulos','action'=>'ajax_search'));?>");
</script>

<h1>Nueva Oferta Educativa</h1>

<?
$anexo = ($instit['anexo']<10)?'0'.$instit['anexo']:$instit['anexo'];
$cue_instit = $instit['cue'].$anexo;
?>
<h2><?php echo $cue_instit." - ".$instit['nombre_completo']; ?></h2>

<div class="planes form">
<?php echo $form->create('Plan',array('id'=>'planAdd','action'=>'add/'.$instit['id']));?>
	<fieldset>
	
	<?php
		echo $form->input('instit_id',array('type'=>'hidden','value'=>$instit['id']));
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
                //echo $form->input('estructura_plan_id',array('id'=>'PlanEstructuraPlanId', 'empty'=>'Seleccione'));

                
                echo $ajax->observeField(
                'PlanOfertaId',
                array(
                    'update'=> 'PlanTituloName',
                    'url'=>'/titulos/list_por_oferta_id',
                    'loading'=>'jQuery("#ajax_indicator").show();jQuery("#PlanTituloName").attr("disabled","disabled")',
                    'complete'=>'jQuery("#ajax_indicator").hide();jQuery("#PlanTituloName").removeAttr("disabled")',
                    'onChange'=>true)
                     );
        
		echo $form->input('norma',array('label'=>'Normativa'));
		
                echo $form->input('nombre');
		echo $form->input('perfil');
		
		
		$meter = '<span class="ajax_update" id="ajax_indicator2" style="display:none;">'.$html->image('ajax-loader.gif').'</span>';
		echo $form->input('sector_id',array('type'=>'select','empty'=>'Seleccione','options'=>$sectores,'label'=>'Sector','id'=>'sector_id','after'=>$meter));

		echo $form->input('subsector_id', array('empty' => 'Seleccione','type'=>'select','label'=>'Subsector','after'=> $meter.'<br /><cite>Seleccione primero un sector.</cite>'));
		echo $ajax->observeField('sector_id',
                                   array(  	'url' => '/subsectores/ajax_select_subsector_form_por_sector',
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
                    'after'=> $meter.'<cite>Seleccione primero una oferta.</cite>',
                    'div'=>array('id'=>'divPlanTituloName')));
                echo $form->input('titulo_id',array('type'=>'hidden'));
                                   
		echo "<br>Duración:";
		echo $form->input('duracion_hs',array('label'=>'- Horas','maxlength'=>9));
		//echo $form->input('duracion_semanas',array('label'=>'- Semanas','maxlength'=>9));
		echo $form->input('duracion_anios',array('label'=>'- Años','maxlength'=>9));

		
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
                          'label'=>'Alta',
                          "selected" => date('Y')
		));
	?>
	</fieldset>
<?php echo $form->end('Guardar');?>
</div>
	
