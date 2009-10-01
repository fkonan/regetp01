
<h1><?=$html->image('cambio_cue.gif');echo __('  Buscar Histórico de Institución');?></h1>
	
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
