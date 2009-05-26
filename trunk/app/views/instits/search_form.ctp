
<h1><?= __('Buscar Institución')?></h1>
	
	<div>
		<?= $form->create('Instit',array('action' => 'search')); 

		echo $form->input('cue', array('label'=> 'CUE', 'maxlength'=>7 ,'after'=> '<cite>Ej: 600118 o 5000216. No introducir número de anexo</cite>')); 
		echo $form->input('nombre', array('label'=>'Nombre de Institución')); 
		echo $form->input('direccion', array('label'=>'Domicilio'));	
		
				
		echo $form->input('gestion_id', array('empty' => 'Todas', 'label'=> 'Ámbito de Gestión'));
		
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
		
		echo $form->input('localidad', array('label'=>'Localidad')); 
		echo $form->input('depto', array('label'=> 'Departamento'));
		echo $form->input('dependencia_id', array('empty' => 'Todas','label'=>'Tipo de Dependencia'));
		
		// no hay busqueda por anexo
		//$array_anexo = array('-1'=>'Buscar Todas','0'=>'No','1'=>'Si');
		//echo $form->input('esanexo',array('options'=> $array_anexo,'label'=>'Anexo'));
		
		$array_activa = array('-1'=>'Buscar Todas','0'=>'No','1'=>'Si');
		echo $form->input('activo',array('options'=> $array_activa,
						  'label'=>'Institución Ingresada al RFIETP'));
		
		
		echo $form->end('Buscar'); ?>
		
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
	//var formaux = new FormRia()
	//formaux.agregarOnEnterPressParaElFormulario('InstitSearchForm');
//-->
</script>