

<div class="instits form">
<h1>Editar Institución de <?php echo $this->data['Jurisdiccion']['name']?><br>  ¡¡ vamos que faltan solo <?php echo $falta_depurar?>!!</h1>

<br> CUE: <?= $this->data['Instit']['cue']*100+$this->data['Instit']['anexo'] ?> (id:<?php echo $this->data['Instit']['id']?>) 
<h2><?= $this->data['Instit']['nombre']?></h2>
<dl>
<dt>Dependencia:</dt><dd><?php echo "&nbsp; ".$this->data['Dependencia']['name']?></dd>
<dt>Gestión:</dt><dd><?php echo "&nbsp; ".$this->data['Gestion']['name']?></dd>
<dt>Jurisdicción:</dt><dd><?php echo "&nbsp; ".$this->data['Jurisdiccion']['name']?></dd>
<dt>Departamento:</dt><dd><?php echo "&nbsp; ".$this->data['Departamento']['name']?></dd>
<dt>Localidad:</dt><dd><?php echo "&nbsp; ".$this->data['Localidad']['name']?></dd>
</dl>
<br>
<?php echo $form->create('Instit',array('url'=>'/depuradores/tipoinstits','id'=>'InstitDepurarForm'));?>
	<?php		
				

		echo '<span class="ajax_update" id="ajax_indicator_dpto" style="display:none;">'.$html->image('ajax-loader.gif').'</span>';
		echo $form->input('tipoinstit_id', array('empty' => array(0=>'SIN DATOS'),
												 'type'=>'select',
												 'label'=>'Tipo de Institución'
												 ));
												 ///localidades/ajax_select_localidades_form_por_departamento
		echo $form->button('actualizar Tipos de instituciones',array('id'=>'boton-actualizar',
																		'onClick'=>"
																			new Ajax.Updater('InstitTipoinstitId','".$html->url('/tipoinstits/ajax_select_form_por_jurisdiccion')."', {
																			  method: 'get',
																			  parameters: {'jurisdiccion_id': '".$this->data['Instit']['jurisdiccion_id']."'},
																			  onLoading: function(){
																			  	$('ajax_indicator_dpto').show();
																			  },
																			  onSuccess: function(t) {
																			    $('ajax_indicator_dpto').hide();
																			  }
																			}); return false;
																		
																		"
		));
		 
												 
		echo $form->input('nombre');
		echo $form->input('nroinstit');

		
		echo $form->input('id');	
		echo $form->input('depto',array('type'=>'hidden'));
		echo $form->input('localidad',array('type'=>'hidden'));
		echo $form->input('cue',array('type'=>'hidden'));
		echo $form->input('anexo',array('type'=>'hidden'));
		echo $form->input('jurisdiccion_id',array('type'=>'hidden'));
		
		echo $form->input('anio_creacion',array('type'=>'hidden'));		
		echo $form->input('direccion',array('type'=>'hidden'));
		echo $form->input('cp',array('type'=>'hidden'));													 
		echo $form->input('ciclo_alta',array('type'=>'hidden'));
												 
		echo $form->end("Guardar");
		
		?> 
<h2> Listado de Planes</h2>

<ul>
		<?php 
		
		foreach ($this->data['Plan'] as $plan):
			echo "<li>".$plan['nombre']."(ciclo alta: ".$plan['ciclo_alta'].")</li>";
		endforeach;
		
		?>
</ul>
		
		
		