<?php 
//colocar el CSS en $script_for_layout. o sea, en el HEADER del HTML
echo $html->css('edit_form',false);
?>

<div id="instits-similares">
	<ul>
		<?php foreach ($similares as $s):?>
			<li><?php echo $html->link($s['Instit']['nombre_completo'],'/instits/view/'.$s['Instit']['id'],array('target'=>'_blank'))?></li>
		<?php endforeach;?>
	</ul>
</div>


<div class="instits form">
<h1>Nueva Institución </h1>
<?php echo $form->create('Instit');?>
	<?php
		echo $form->input('id');	

		/**
		 *    ACTIVO
		 */	
		echo $form->input('activo',array('type'=> 'checkbox','checked'=>true,'label'=>'Institución ingresada al RFIETP'));		
		
		
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
		 *    GESTION
		 */	
		echo $form->input('gestion_id',array('label'=>'Gestión','label'=>'Ámbito de Gestión'));
		
		/**
		 *    DEPENDENCIA
		 */	
		echo $form->input('dependencia_id', array('label'=>'Tipo de Dependencia'));
		/**
		 *    NOMBRE DE LA DEPENDENCIA
		 */	
		echo $form->input('nombre_dep',array('label'=>'Nombre de la Dependencia'));
		
		
		
		/**
		 *   AJAX ::> JURISDICCION - Departamentop - Localidad - Tipo de Institucion 
		 */	
		$meter = '<span class="ajax_update" id="ajax_indicator" style="display:none;">'.$html->image('ajax-loader.gif').'</span>';
		echo $form->input('jurisdiccion_id', array('empty' => array('0'=>'Todas'),'id'=>'jurisdiccion_id','label'=>'Jurisdicción','after'=>$meter));		
		
		
			// DEPARTAMENTO
		$meter = '<span class="ajax_update" id="ajax_indicator_dpto" style="display:none;">'.$html->image('ajax-loader.gif').'</span>';
		echo $form->input('departamento_id', array('empty' => 'Seleccione','type'=>'select','label'=>'Departamento','after'=> $meter.'<br /><cite>Seleccione primero una jurisdicción.</cite>'));                                   
        echo $ajax->observeField('jurisdiccion_id',
                                   array(  	'url' => '/departamentos/ajax_select_departamento_form_por_jurisdiccion',
		                                   	'update'=>'InstitDepartamentoId',
		                                   	'loading'=>'$("ajax_indicator").show();$("InstitDepartamentoId").disable()',
		                                   	'complete'=>'$("ajax_indicator").hide();$("InstitDepartamentoId").enable()',
		                                   	'onChange'=>true
                                   ));
			//LOCALIDAD
		echo $form->input('localidad_id', array('empty' => 'Seleccione','label'=>'Localidad','after'=> '<br /><cite>Seleccione primero un Departamento.</cite>'));                                   
        echo $ajax->observeField('InstitDepartamentoId',
                                   array(  	'url' => '/localidades/ajax_select_localidades_form_por_departamento',
		                                   	'update'=>'InstitLocalidadId',
		                                   	'loading'=>'$("ajax_indicator_dpto").show();$("InstitLocalidadId").disable()',
		                                   	'complete'=>'$("ajax_indicator_dpto").hide();$("InstitLocalidadId").enable()',
		                                   	'onChange'=>true
                                   ));  
        echo $form->input('lugar',array('label'=>'Lugar: Barrio/Pueblo/Comuna/'));                      
                                   
           // TIPO DE INSTITUCION                  
		//echo $form->input('tipoinstit_id', array('empty' => 'Todas','disabled'=>true,'type'=>'select','label'=>'Tipo De Institución','after'=> '<br /><cite>Para activar este campo, seleccione primero una jurisdicción</cite>'));
		echo $form->input('tipoinstit_id', array('empty' => 'Seleccione','label'=>'Tipo de Institución','after'=> '<br /><cite>Seleccione primero una jurisdicción, asi selecciona los tipos de institución posibles</cite>'));
		echo $ajax->observeField('jurisdiccion_id',
                                   array(  	'url' => '/tipoinstits/ajax_select_form_por_jurisdiccion',
		                                   	'update'=>'InstitTipoinstitId',
		                                   	'loading'=>'$("ajax_indicator").show();$("InstitTipoinstitId").disable()',
		                                   	'complete'=>'$("ajax_indicator").hide();$("InstitTipoinstitId").enable()',
		                                   	'onChange'=>true
                                   )); 
		?>
		
		
		<script type="text/javascript">
		/*
				Este Script lo que hace es tomar la jurisdiccion en base al numero de CUE pasado
		*/
		
			// Observer del cambio en el numero de CUE
			Event.observe('InstitCue', 'change', function() {
				var cue = new String($F('InstitCue'));
				var send = false;
				var cue_jur = new String();

				//Evaluo si concuerda con el codigo de institucion
				if (cue.match(/^(10|14|18|22|26|30|34|38|42|46|50|54|58|62|66|70|74|78|82|86|90|94)[0-9]{5}$/)){
					$('jurisdiccion_id').setValue(cue.substring(0,2));
					cue_jur= cue.substring(0,2);
					send = true;
				}else if(cue.match(/^(2|6)[0-9]{5}$/)){
					$('jurisdiccion_id').setValue(cue.substring(0,1));
					cue_jur = cue.substring(0,1); 
					send = true;
				}
				//si el CUE era valido, se envia una peticion AJAX para obtener los datos del tipo de INstitucion para esa jurisdiccion
				if(send){
					new Ajax.Updater('InstitTipoinstitId','<?= $html->url('/tipoinstits/ajax_select_form_por_jurisdiccion')?>', {
						'onLoading': function(){$("ajax_indicator").show();$("InstitTipoinstitId").disable()},
						'onComplete': function(){$("ajax_indicator").hide();$("InstitTipoinstitId").enable()},
						'onChange': true,
						parameters: {'data[Instit][jurisdiccion_id]': cue_jur}
						}); 
					
					new Ajax.Updater('InstitDepartamentoId','<?= $html->url('/departamentos/ajax_select_departamento_form_por_jurisdiccion')?>', {
						'onLoading': function(){$("ajax_indicator").show();$("InstitTipoinstitId").disable()},
						'onComplete': function(){$("ajax_indicator").hide();$("InstitTipoinstitId").enable()},
						'onChange': true,
						parameters: {'data[Instit][jurisdiccion_id]': cue_jur}
						}); 

				}						
			});
		</script>
		
		<?
         		
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
		 *    CODIGO POSTAL
		 */							
		echo $form->input('cp',array('label'=>array('text'=>'Código Postal','class'=>'input_label'),
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
		echo $form->input('mail',array('label'=>array('text'=> 'E-Mail',
													  'class'=>'input_label'),
									   'class' => 'input_text_peque'
		));	
		echo $form->input('web',array('label'=>array('class'=>'input_label'),
									  'class' => 'input_text_peque'));
		
		
		
		
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
		echo $form->input('observacion');
		
		
		
		/**
		 *    CICLOS ALTA Y MODIFICACION
		 */	
		$ciclos = $this->requestAction('/Ciclos/dame_ciclos');
		echo $form->input('ciclo_alta', array("type" => "select", 
											  "options" => $ciclos,'label'=>'Alta',
											  "selected" => date('Y')			
		));
		
		//forzar al checkbox siempre
		$this->data['Instit']['force_save'] = 0;
		echo $form->input('force_save',array('type'=> 'checkbox','checked'=>false,'label'=>'Forzar guardado.'));
	?>
<?php echo $form->end('Guardar');?>
</div>

