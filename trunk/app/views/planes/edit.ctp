<h1>Editar Plan</h1>

<?
$anexo = ($instit['anexo']<10)?'0'.$instit['anexo']:$instit['anexo'];
$cue_instit = $instit['cue'].$anexo;
?>
<h2><?php echo $cue_instit." - ".$instit['nombre_completo']; ?></h2>

<div class="planes form">
<?php echo $form->create('Plan');?>
	<fieldset>
	<?php
		echo $form->input('id');
		echo $form->input('instit_id',array('type'=>'hidden'));
		echo $form->input('oferta_id');
		echo $form->input('norma',array('label'=>'Normativa'));
		echo $form->input('nombre');
		echo $form->input('perfil');
		echo $form->input('sector');
		
		echo "<br>Duración:";
		echo $form->input('duracion_hs',array('label'=>' - Horas'));
		echo $form->input('duracion_semanas',array('label'=>' - Semanas'));
		echo $form->input('duracion_anios',array('label'=>' - Años'));

		
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
											  "options" => $ciclos,'label'=>'Alta'			
		));
		
	?>
	</fieldset>
<?php echo $form->end('Guardar');?>
</div>
