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
		echo $form->input('observacion',array(	'type'=>'textarea',
												'rows'=>3,
												'label'=>'Observaciones',
												'after'=>'<cite>Puede ingresar hasta 100 caracteres</cite>'));
			//agrego esto para que no se puedan imprimir mas de 100 caracteres en el textarea
			?>
			<script type="text/javascript">
				$('PlanObservacion').observe('keyup', function(){					
					var maxlength = 100;
					if ($F('PlanObservacion') && $F('PlanObservacion').length > maxlength){
						var paso_flag = false;
						if(!paso_flag)alert('Solo puede escribir hasta 100 caracteres');
						$('PlanObservacion').setValue($F('PlanObservacion').substring(0, maxlength));
						paso_flag = true;
					}
				});
			</script>
		
		
		<?
		
		
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
