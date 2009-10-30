
<h1><?=$html->image('cambio_cue.gif');echo __('  Buscar Histórico de Institución');?></h1>
<p>
Esta opción de búsqueda permite visualizar las instituciones a las que  
ha sido asociado un determinado CUE a lo largo del tiempo. Soporta búsquedas por
coincidencia parcial (Ej: Si se ingresa "118" el programa encuentra todos los CUEs que contengan "118" en cualquier posición).
También permite incluir el anexo (Ej: "60011800").
<br>

</p>



<h2>Buscar</h2>

	<div>
		<?= $form->create('HistorialCues',array('action' => 'search','name'=>'HistorialCuesSearchForm'));?> 
		<?= $form->input('cue', array('label'=> 'CUE', 'maxlength'=>9 ,'after'=> '<cite>Ej: 600118 o 5000216.</cite>')); ?>
		<?= $form->button('Buscar',array('onclick'=>'enviar()'));?>
	</div>
	<?php echo $form->end(null); ?>
<? 
// con esto agrego la funcionalidad para que al preswionar ENTER me envie el formulario
//echo $javascript->link('form_regetp_ria');?>
<script type="text/javascript">
	function enviar(){
	  	$('HistorialCuesSearchForm').submit();
	}
</script>
