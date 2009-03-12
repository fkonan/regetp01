<div class="instits form">
<h1>Editar Institución </h1>
<?php echo $form->create('Instit');?>
	<?php
		echo $form->input('id');		
		echo $form->input('activo',array('type'=> 'checkbox'));		
		echo $form->input('cue',array('maxlength'=>7,'label'=>'CUE'));
		echo $form->input('anexo',array('maxlength'=>2 ));
		echo $form->input('esanexo',array('type'=> 'checkbox','label'=>'Es Anexo'));
						
		echo $form->input('nombre');
		echo $form->input('nroinstit',array('label'=>'Nº de Institución'));			
		echo $form->input('gestion_id',array('label'=>'Gestión'));
		echo $form->input('dependencia_id');
		echo $form->input('anio_creacion',array('label'=>'Año de Creación'));		
		echo $form->input('direccion',array('label'=>'Domicilio'));
		echo $form->input('localidad');	
		echo $form->input('depto');
		

		$meter = '<span class="ajax_update" id="ajax_indicator" style="display:none;">'.$html->image('ajax-loader.gif').'</span>';
		echo $form->input('jurisdiccion_id', array('empty' => array('0'=>'Todas'),'id'=>'jurisdiccion_id','label'=>'Jurisdicción','after'=>$meter));		
		echo $form->input('tipoinstit_id', array('empty' => 'Todas','disabled'=>true,'type'=>'select','label'=>'Tipo De Institución','after'=> '<br /><cite>Para activar este campo, seleccione primero una jurisdicción</cite>'));
		echo $ajax->observeField('jurisdiccion_id',
                                   array(  	'url' => '/tipoinstits/ajax_select_form_por_jurisdiccion',
                                   			//'controller' => 'TipoInstits',
                                   			//'action' => 'ajax_select_form_por_jurisdiccion',
		                                   	'update'=>'InstitTipoinstitId',
		                                   	'loading'=>'$("ajax_indicator").show();$("InstitTipoinstitId").disable()',
		                                   	'complete'=>'$("ajax_indicator").hide();$("InstitTipoinstitId").enable()',
		                                   	'onChange'=>true
                                   ));  
                                   
                                   
								
		echo $form->input('cp');
		echo $form->input('telefono',array('label'=>'Teléfono'));				
		echo $form->input('web');
		echo $form->input('mail',array('label'=>'E-Mail'));	
		
		?><H3>Datos Director</H3><?		
		echo $form->input('dir_nombre',array('label'=>'Nombre y Apellido'));
		echo $form->input('dir_tipodoc_id',array('label'=>'Tipo de Documento'));
		echo $form->input('dir_nrodoc',array('label'=>'Nº de Documento'));
		echo $form->input('dir_telefono',array('label'=>'Teléfono'));
		echo $form->input('dir_mail',array('label'=>'E-Mail'));
		
		?><H3>Datos Vice Director</H3><?
		echo $form->input('vice_nombre',array('label'=>'Nombre y Apellido'));
		echo $form->input('vice_tipodoc_id',array('label'=>'Tipo de Documento'));
		echo $form->input('vice_nrodoc',array('label'=>'Nº de Documento'));		
		
		?><H3>Datos Extra</H3><?
		echo $form->input('actualizacion',array('label'=>'Actualización o Ingreso'));
		echo $form->input('observacion',array('type'=>'textarea',array('label'=>'Observaciones')));

//$this->data['Instit']['ciclo_alta']
		$ciclos = array('2006'=>'2006','2007'=>'2007','2008'=>'2008','2009'=>'2009','2010'=>'2010','2011'=>'2011');
		echo $form->input('ciclo_alta', array("type" => "select", 
											  "options" => $ciclos,'label'=>'Alta perteneciente al ciclo',
											  "selected" => $this->data['Instit']['ciclo_alta']));
		echo $form->input('ciclo_mod', array("type" => "select", 
											  "options" => $ciclos,
											  "label" => 'Ciclo Modificación',
											  'label'=>'Modificación perteneciente al ciclo',
											  "selected" => $this->data['Instit']['ciclo_mod']));
	?>
<?php echo $form->end('Submit');?>
</div>

