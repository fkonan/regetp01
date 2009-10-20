<div class="instits form">
<?php echo $form->create('Plan',array(	'url'=>'/depuradores/sectores/'.$jur_id,
										'id'=>'FormSectorJurisdiccion'));?>
<?php		
		echo $form->input('Instit.jurisdiccion_id', array('empty' => 'Todos',
											 'type'=>'select',
											 'label'=>'Selecciones una Jurisdicción',
											 'value'=>$jur_id,
											 'options'=>$jurisdicciones,
											 'onChange'=>'$("FormSectorJurisdiccion").submit();'
											 ));
		echo $form->end(null);										 
?> 

<h1>Plan ID: <?= $this->data['Plan']['id']?>
<br>  ¡¡ vamos que faltan solo <?php echo $falta_depurar?>!!</h1>


<?php echo $form->create('Plan',array('url'=>'/depuradores/sectores/'.$jur_id,'id'=>'PlanDepurarForm'));?>
<?php		
		echo $form->hidden('id',array('value'=>$this->data['Plan']['id']));
		
		echo $form->input('nombre', array('value'=>$this->data['Plan']['nombre']));
				
		echo '<span class="ajax_update" id="ajax_indicator_dpto" style="display:none;">'.$html->image('ajax-loader.gif').'</span>';
		echo $form->input('sector_id', array('empty' => array(0=>'SIN DATOS'),
											 'type'=>'select',
											 'label'=>'Sector ('.$this->data['Plan']['sector'].')',
											 'options'=>$sectores
											 ));
		echo $form->end("Guardar");
?> 

<script type="text/javascript">
<!--
Event.observe(window, "keypress", function(e){ 
		var cKeyCode = e.keyCode || e.which; 
		if (cKeyCode == Event.KEY_RETURN){ 
			$('PlanDepurarForm').submit();
		} 
	});
-->
</script>


<h2>Establecimiento</h2>
<dl>
<dt>CUE:</dt><dd><?= $this->data['Instit']['cue']*100+$this->data['Instit']['anexo'] ?> (id:<?php echo $this->data['Instit']['id']?>)</dd>
<dt>Nombre:</dt><dd><?= $html->link($this->data['Instit']['nombre'],'/instits/view/'.$this->data['Instit']['id']);?></dd>
</dl>
<br>