<h1>Nueva Oferta Educativa</h1>

<?
$anexo = ($instit['anexo']<10)?'0'.$instit['anexo']:$instit['anexo'];
$cue_instit = $instit['cue'].$anexo;
?>
<h2><?php echo $cue_instit." - ".$instit['nombre_completo']; ?></h2>

<div class="planes form">
<?php echo $form->create('Plan',array('action'=>'add/'.$instit['id']));?>
	<fieldset>
	
	<?php
		echo $form->input('instit_id',array('type'=>'hidden','value'=>$instit['id']));
		echo $form->input('oferta_id');
		echo $form->input('norma',array('label'=>'Normativa'));
		echo $form->input('nombre');
		echo $form->input('perfil');
		
		
		$meter = '<span class="ajax_update" id="ajax_indicator" style="display:none;">'.$html->image('ajax-loader.gif').'</span>';
		echo $form->input('sector_id',array('type'=>'select','empty'=>'Seleccione','options'=>$sectores,'label'=>'Sector','id'=>'sector_id','after'=>$meter));

		echo $form->input('subsector_id', array('empty' => 'Seleccione','type'=>'select','label'=>'Subsector','after'=> $meter.'<br /><cite>Seleccione primero un sector.</cite>'));
		echo $ajax->observeField('sector_id',
                                   array(  	'url' => '/subsectores/ajax_select_subsector_form_por_sector',
		                                   	'update'=>'PlanSubsectorId',
		                                   	'loading'=>'$("ajax_indicator").show();$("PlanSubsectorId").disable()',
		                                   	'complete'=>'$("ajax_indicator").hide();$("PlanSubsectorId").enable()',
		                                   	'onChange'=>true
                                   ));
                                   
		echo "<br>Duraci�n:";
		echo $form->input('duracion_hs',array('label'=>'- Horas','maxlength'=>9));
		echo $form->input('duracion_semanas',array('label'=>'- Semanas','maxlength'=>9));
		echo $form->input('duracion_anios',array('label'=>'- A�os','maxlength'=>9));

		
		echo "<br>";
		/**
		 *    OBSERVACION
		 */	
		echo $form->input('observacion');
		
		
		/**
		 *    CICLOS ALTA Y MODIFICACION
		 */	
		$ciclos = $this->requestAction('/Ciclos/dame_ciclos');
		echo $form->input('ciclo_alta', array("type" => "select", 
											  "options" => $ciclos,'label'=>'Alta',
											  "selected" => date('Y')			
		));
	?>
	</fieldset>
<?php echo $form->end('Guardar');?>
</div>
	
