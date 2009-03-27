
<div class="instits form">
<h1>Editar Institución </h1>
<?php echo $form->create('Instit');?>
	<?php
		echo $form->input('id');	

		/**
		 *    ACTIVO
		 */	
		echo $form->input('activo',array('type'=> 'checkbox'));		
		
		
		/**
		 *    CUE
		 */
		echo $form->input('cue',array(	'maxlength'=>7,
										'label'=>array('text' => 'CUE','class'=>'input_label'),
										'class'=> 'input_text_peque'
									));

		/**
		 *    ANEXO
		 */									
		echo $form->input('anexo',array('maxlength'=>2,
										'label'=>array('class'=>'input_label'),
										'class'=> 'input_text_peque'
										));
		
		
		/**
		 *    ES ANEXO
		 */	
		echo $form->input('esanexo',array('type'=> 'checkbox','label'=>'Es Anexo'));

		
		/**
		 *    NOMBRE
		 */	
		echo $form->input('nombre');
		
		
		/**
		 *    Nro Instit
		 */	
		echo $form->input('nroinstit',array('label'=>array(	'text'=>'Nº de Institución',
															'class'=>'input_label'),
											'class'=> 'input_text_peque'
		));		
			
		
		/**
		 *    GESTION
		 */	
		echo $form->input('gestion_id',array('label'=>'Gestión'));
		
		/**
		 *    DEPENDENCIA
		 */	
		echo $form->input('dependencia_id');
		
		
		/**
		 *    AÑO CREACION
		 */	
		echo $form->input('anio_creacion',array('label'=>array('text'=>'Año de Creación',
																'class'=>'input_label'),
												'class'=> 'input_text_peque'
		));

		/**
		 *    DIRECCION
		 */	
		echo $form->input('direccion',array('label'=>array(	'text'=> 'Domicilio',
															'class'=>'input_label'),
											'class' => 'input_text_peque'
		));
		
		/**
		 *    LOCALIDAD
		 */	
		echo $form->input('localidad',array('label'=>array('class'=>'input_label'),
											'class' => 'input_text_peque'
		));	
		
		/**
		 *    DEPTO
		 */	
		echo $form->input('depto',array('label'=>array('class'=>'input_label','text'=>'Departamento'),
										'class' => 'input_text_peque'
		));
		
		
		/**
		 *    JURISDICCION 
		 * 			Y 
		 * 	TIPO DE INSTITUCION
		 */	
		$meter = '<span class="ajax_update" id="ajax_indicator" style="display:none;">'.$html->image('ajax-loader.gif').'</span>';
		echo $form->input('jurisdiccion_id', array('empty' => array('0'=>'Todas'),'id'=>'jurisdiccion_id','label'=>'Jurisdicción','after'=>$meter));		
		echo $form->input('tipoinstit_id', array('empty' => 'Todas','type'=>'select','label'=>'Tipo De Institución'));
		echo $ajax->observeField('jurisdiccion_id',
                                   array(  	'url' => '/tipoinstits/ajax_select_form_por_jurisdiccion',
                                   			//'controller' => 'TipoInstits',
                                   			//'action' => 'ajax_select_form_por_jurisdiccion',
		                                   	'update'=>'InstitTipoinstitId',
		                                   	'loading'=>'$("ajax_indicator").show();$("InstitTipoinstitId").disable()',
		                                   	'complete'=>'$("ajax_indicator").hide();$("InstitTipoinstitId").enable()',
		                                   	'onChange'=>true
                                   ));  
                                   
                                   
		/**
		 *    CODIGO POSTAL
		 */							
		echo $form->input('cp',array('label'=>array('class'=>'input_label','text'=>'CP'),
									 'class' => 'input_text_peque'
		));
		
		/**
		 *    TELEFONO
		 */	
		echo $form->input('telefono',array('label'=>array(	'text'=>'Teléfono',
														 	'class'=>'input_label'),
											'class' => 'input_text_peque'
		));	

		/**
		 *    WEB Y MAIL
		 */	
		echo $form->input('web',array('label'=>array('class'=>'input_label'),
									  'class' => 'input_text_peque'));
		echo $form->input('mail',array('label'=>array('text'=> 'E-Mail',
													  'class'=>'input_label'),
									   'class' => 'input_text_peque'
		));	
		
		
		
	/******************************************************************************
	* 
	* 
	*    DATOS DIRECTOR
	* 
	* 
	*/	
		?><H2>Datos Director</H2><?		
		echo $form->input('dir_nombre',array('label'=>array('text'=>'Nombre y Apellido',
															'class'=>'input_label'),
											 'class'=>'input_text_peque'));
		echo $form->input('dir_tipodoc_id',array('label'=>'Tipo de Documento',
												 'options'=>$this->requestAction('/Tipodocs/dame_tipodocs'),
												 'empty'=>array('Seleccionar')));
		echo $form->input('dir_nrodoc',array('label'=>array('text'=> 'Nº de Documento',
															'class'=>'input_label'),
											 'class'=>'input_text_peque'
		));
		echo $form->input('dir_telefono',array(	'label'=>array(	'text'=> 'Teléfono',
																'class'=>'input_label'),
											 	'class'=>'input_text_peque'
		));
		echo $form->input('dir_mail',array('label'=>array(	'text'=> 'E-Mail',
															'class'=>'input_label'),
											 'class'=>'input_text_peque'
		));
		
		
	/******************************************************************************
	* 
	* 
	*    DATOS VICE DIRECTOR
	* 
	* 
	*/	
		?><H2>Datos Vice Director</H2><?
		echo $form->input('vice_nombre',array('label'=>array(	'text'=> 'Nombre y Apellido',
																'class'=>'input_label'),
											 'class'=>'input_text_peque'
		));
		echo $form->input('vice_tipodoc_id',array('label'=>'Tipo de Documento',
												  'options'=>$this->requestAction('/Tipodocs/dame_tipodocs'),
												  'empty'=>'Seleccionar'));
		echo $form->input('vice_nrodoc',array('label'=>array(	'text'=> 'Nº de Documento',
																'class'=>'input_label'),
											  'class'=>'input_text_peque'
		));		
		
		
		
		
		
	/****************************************************************************
	 *    
	 * 
	 * 
	 * 				DATOS ADICIONALES
	 * 
	 * 
	 */	
		?><H2>Datos Adicionales</H2><?
		/**
		 *    INGRESO/ACTUALIZACION
		 */	
		echo $form->input('actualizacion',array('label'=>array(	'text'=> 'Ingreso/Actualización',
																'class'=>'input_label'),
											    'class'=>'input_text_peque'
		));
		
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
				$('InstitObservacion').observe('keyup', function(){					
					var maxlength = 100;
					if ($F('InstitObservacion') && $F('InstitObservacion').length > maxlength){
						var paso_flag = false;
						if(!paso_flag)alert('Solo puede escribir hasta 100 caracteres');
						$('InstitObservacion').setValue($F('InstitObservacion').substring(0, maxlength));
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
											  "options" => $ciclos,'label'=>'Alta',
											  "selected" => $this->data['Instit']['ciclo_alta']			
		));
		echo $form->input('ciclo_mod', array("type" => "select", 
											  "options" => $ciclos,
											  "label" => 'Modificación',
											  "selected" => date('Y')
		));
	?>
<?php echo $form->end('Guardar');?>
</div>

