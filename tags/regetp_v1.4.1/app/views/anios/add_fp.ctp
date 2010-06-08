<?

if(isset($script)){
	echo $script;
}
?>

<? $ganchito = $this->data['Anio']['anio'] == 1?'er':'º';?>	
<h1 align="center"> <?= "Nuevo Ciclo FP/CL" ?></h1>
<div class="anios form">
<?php echo $form->create('Anio');?>
	<fieldset>	
	<?php
	
		echo $form->input('plan_id',array('type'=>'hidden','value'=>$plan_id));
		
		echo $form->input('anio',array('type'=>'hidden','value'=>99));
		echo $form->input('etapa_id',array('type'=>'hidden','value'=>99));
		echo $form->input('ciclo_id',array('selected'=> date('Y')));

		echo $form->input('hs_taller',array('label'=>'Duración en Horas','value'=>$duracion_hs));
		echo $form->input('matricula',array('label'=>'Matrícula'));
		
		
	?>
	</fieldset>
<?php echo $form->end('Guardar');?>
</div>
