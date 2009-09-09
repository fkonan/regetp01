
<h1><?= __('Buscar Institución')?></h1>
	
	<div>
		<?= $form->create('Instit',array('action' => 'search','name'=>'InstitSearchForm'));?> 
				
		<?= $form->input('cue', array('label'=> 'CUE', 'maxlength'=>7 ,'after'=> '<cite>Ej: 600118 o 5000216. No introducir número de anexo</cite>')); ?>
				
		
		<?php 
			// 		JURISDICCION
			$meter = '<span class="ajax_update" id="ajax_indicator" style="display:none;">'.$html->image('ajax-loader.gif').'</span>';
			echo $form->input('jurisdiccion_id', array('empty' => array('0'=>'Todas'),'id'=>'jurisdiccion_id','label'=>'Jurisdicción','after'=>$meter));
		?>
		
		<?= $form->button('Buscar',array('onclick'=>'enviar()'));?>

		
		<h2><a href="#VerUbicacion" onclick="$('search-ubicacion').toggle()">por su ubicación</a></h2>
		<div id="search-ubicacion" class="search-div" style="display: none">
				
			<div id= "departamento-select">		
				<?php 
				// 		DEPARTAMENTO
				$meter = '<span class="ajax_update" id="ajax_indicator_dpto" style="display:none;">'.$html->image('ajax-loader.gif').'</span>';
				echo $form->input('Departamento.id', array('type'=> 'select', 'empty' => 'Seleccione','label'=>'Departamento','after'=> $meter.'<br><cite>Seleccione primero una jurisdicción</cite>'));                                   
		        echo $ajax->observeField('jurisdiccion_id',
		                                   array(  	'url' => '/departamentos/ajax_select_departamento_form_por_jurisdiccion',
				                                   	'update'=>'DepartamentoId',
				                                   	'loading'=>'$("ajax_indicator").show();$("DepartamentoId").disable();$("LocalidadId").update();',
				                                   	'complete'=>'$("ajax_indicator").hide();$("DepartamentoId").enable(); $("departamento-select").show();',
				                                   	'onChange'=>true
		                                   ));
				?>
			</div>
		
			<div id="localidad-select">
				<?php 
				//		LOCALIDAD
				echo $form->input('Localidad.id', array('empty' => 'Seleccione','type'=>'select','label'=>'Localidad','after'=>'<br><cite>Seleccione primero un Departamento</cite>'));                                   
		        echo $ajax->observeField('DepartamentoId',
		                                   array(  	'url' => '/localidades/ajax_select_localidades_form_por_departamento',
				                                   	'update'=>'LocalidadId',
				                                   	'loading'=>'$("ajax_indicator_dpto").show();$("LocalidadId").disable()',
				                                   	'complete'=>'$("ajax_indicator_dpto").hide();$("LocalidadId").enable(); $("localidad-select").show();',
				                                   	'onChange'=>true
									)); 				
				?>	
			</div>
			
			<?php echo $form->input('direccion', array('label'=>'Domicilio')); ?>
		
			<?php echo $form->button('Buscar',array('onclick'=>'enviar()'));?>
		</div>
		
		
		<h2><a href="#VerDenominacion" onclick="$('search-denominacion').toggle()">por su nombre</a></h2>
		<div id="search-denominacion"  class="search-div" style="display: none">
			<?php 
			echo $form->input('tipoinstit_id', array('empty' => 'Todas','disabled'=>true,'type'=>'select','label'=>'Tipo de Institución','after'=> '<br /><cite>Para activar este campo, seleccione primero una jurisdicción</cite>'));		
				echo $ajax->observeField('jurisdiccion_id',
		                                   array(  	'url' => '/tipoinstits/ajax_select_form_por_jurisdiccion',
		                                           	'update'=>'InstitTipoinstitId',
				                                   	'loading'=>'$("ajax_indicator").show();$("InstitTipoinstitId").disable()',
				                                   	'complete'=>'$("ajax_indicator").hide();$("InstitTipoinstitId").enable()',
				                                   	'onChange'=>true
		                                   ));  
		                                   
			echo $form->input('nroinstit', array('label'=>'N° de Institución')); 
			
			echo $form->input('nombre', array('label'=>'Nombre de Institución','after'=> '<cite>Ej: "Sarmiento" o "Gral. Belgrano". No confundir el nombre con el tipo de institución</cite>'));
			
			echo $form->button('Buscar',array('onclick'=>'enviar()'));
			?>
		</div>
		
		
		
		<h2><a href="#VerOtros" onclick="$('search-otros').toggle()">por otras características</a></h2>
		
		<div id="search-otros"  class="search-div" style="display: none">
			<?php 
			echo $form->input('Plan.oferta_id',array('options'=>$ofertas, 'empty'=>'Seleccionar', 'label'=>'Con Oferta'));
			
			// esto solo lo ven los editores y los administradores
			if($session->read('Auth.User.role') == 'editor' || $session->read('Auth.User.role') == 'admin'){
				echo $form->input('Plan.sector',array(
								'label'=>'Sector',
								'after'=>'<cite>Ej: Mecánica Automotriz, Informática, etc</cite>'));
			}
				
			echo $form->input('gestion_id', array('empty' => 'Todas', 'label'=> 'Ámbito de Gestión'));
		
			
			echo $form->input('dependencia_id', array('empty' => 'Todas','label'=>'Tipo de Dependencia'));
			
			// no hay busqueda por anexo
			//$array_anexo = array('-1'=>'Buscar Todas','0'=>'No','1'=>'Si');
			//echo $form->input('esanexo',array('options'=> $array_anexo,'label'=>'Anexo'));
			
			$array_activa = array('-1'=>'Buscar Todas','0'=>'No','1'=>'Si');
			echo $form->input('activo',array('options'=> $array_activa,
							  'label'=>'Institución Ingresada al RFIETP'));
			?>
			<?php echo $form->button('Buscar',array('onclick'=>'enviar()'));?>
		</div>
		
		<?php echo $form->end(null); ?>
		
	</div>
	

<!-- 
	 Con este script hago que cuando se pulse ENTER 
	 se envie el formulario 
 -->
 
<? 
// con esto agrego la funcionalidad para que al preswionar ENTER me envie el formulario
//echo $javascript->link('form_regetp_ria');?>
<script type="text/javascript">
<!--
	//var formaux = new FormRia();
	//formaux.agregarOnEnterPressParaElFormulario('InstitSearchForm');

	// los tengo que activar atodos porque sino cuando el usuario
	// hace un BACK aparecen desactivados
	$('LocalidadId').enable();
	$('InstitDireccion').enable();	  
	$('InstitTipoinstitId').enable();
	$('InstitNroinstit').enable();
	$('InstitNombre').enable();	  		
	$('PlanOfertaId').enable();
	$('PlanSector').enable();
	$('InstitGestionId').enable();
	$('InstitDependenciaId').enable();
	$('InstitActivo').enable();

		
	function enviar()
	{
	  	if($('search-ubicacion').visible() == false){
	  		$('DepartamentoId').disable();
	  		$('LocalidadId').disable();
	  		$('InstitDireccion').disable();
	  	}
	  	
	  	if($('search-denominacion').visible() == false){
	  		$('InstitTipoinstitId').disable();
	  		$('InstitNroinstit').disable();
	  		$('InstitNombre').disable();
	  	}
	  	
	  	if($('search-otros').visible() == false){
	  		$('PlanOfertaId').disable();
	  		$('PlanSector').disable();
	  		$('InstitGestionId').disable();
	  		$('InstitDependenciaId').disable();
	  		$('InstitActivo').disable();
	  	}
	  	
	  	$('InstitSearchForm').submit();
	  }

	
//-->
</script>
