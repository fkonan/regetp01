<div class="instits form">
<h1>Selecciones una Jurisdicción</h1>
<?php echo $form->create('Plan',array('url'=>'/depuradores/planes/'.$jur_id));?>
<?php		
		echo $form->input('Instit.jurisdiccion_id', array('empty' => 'Todos',
											 'type'=>'select',
											 'label'=>'Jurisdicción',
											 'options'=>$jurisdicciones
											 ));
												 ///localidades/ajax_select_localidades_form_por_departamento
		 
		echo $form->end("Cambiar");
?> 

<h1>Editar Plan de <?php echo $this->data['Plan']['nombre']?><br>  ¡¡ vamos que faltan solo <?php echo $falta_depurar?>!!</h1>
<br>
<h2>Establecimiento</h2>
<dl>
<dt>CUE:</dt><dd><?= $this->data['Instit']['cue']*100+$this->data['Instit']['anexo'] ?> (id:<?php echo $this->data['Instit']['id']?>)</dd>
<dt>Nombre:</dt><dd><?= $html->link($this->data['Instit']['nombre'],'/instits/view/'.$this->data['Instit']['id']);?></dd>
</dl>
<br>
<h2>Plan</h2>

<?php echo $form->create('Plan',array('url'=>'/depuradores/planes/'.$jur_id,'id'=>'PlanDepurarForm'));?>
<?php		
		echo $form->hidden('id',array('value'=>$this->data['Plan']['id']));
		
		echo $form->input('nombre', array('value'=>$this->data['Plan']['nombre']));
				
		echo '<span class="ajax_update" id="ajax_indicator_dpto" style="display:none;">'.$html->image('ajax-loader.gif').'</span>';
		echo $form->input('sector_id', array('empty' => array(0=>'SIN DATOS'),
											 'type'=>'select',
											 'label'=>'Sector ('.$this->data['Plan']['sector'].')',
											 'options'=>$sectores
											 ));
												 ///localidades/ajax_select_localidades_form_por_departamento
		 
		echo $form->end("Guardar");
?> 
