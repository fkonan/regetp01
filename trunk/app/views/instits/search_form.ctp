<h2><?= __('Buscar Institución')?></h2>
	
	<div>
		<?= $form->create('Instit',array('action' => 'search')); 
				
		echo $form->input('cue', array('label'=> 'CUE')); 
		echo $form->input('nombre', array('label'=>'Nombre de Institución')); 
		echo $form->input('direccion', array('label'=>'Domicilio'));	
		
		
		
		echo $form->input('gestion_id', array('empty' => 'Todas', array('label'=> 'Gestión')));
		echo $form->input('dependencia_id', array('empty' => 'Todas'));
		
		echo $form->input('jurisdiccion_id', array('empty' => array('0'=>'Todas'),'id'=>'jurisdiccion_id','label'=>'Jurisdicción'));
		echo $form->input('tipoinstit_id', array('empty' => 'Todas','disabled'=>true,'type'=>'select','label'=>'Tipo De Institución'));
		
		?><div id="div_tipo_instit"></div><?
		echo '<span class="ajax_update" id="ajax_indicator" style="display:none;">'.$html->image('ajax-loader.gif').'</span>';
		
		echo $ajax->observeField('jurisdiccion_id',
                                   array(  	'url' => '/tipoinstits/ajax_select_form_por_jurisdiccion',
                                   			//'controller' => 'TipoInstits',
                                   			//'action' => 'ajax_select_form_por_jurisdiccion',
		                                   	'update'=>'InstitTipoinstitId',
		                                   	'loading'=>"$('div_tipo_instit').show()",
		                                   	'complete'=>'$("ajax_indicator").hide();$("div_tipo_instit").show();$("InstitTipoinstitId").enable()',
		                                   	'onChange'=>true
                                   ));  
      	
		
		$array_anexo = array('-1'=>'Buscar Todas','0'=>'No','1'=>'Si');
		echo $form->input('esanexo',array('options'=> $array_anexo,'label'=>'Anexo'));
		$array_activa = array('-1'=>'Buscar Todas','0'=>'No','1'=>'Si');
		echo $form->input('activo',array('options'=> $array_activa,'label'=>'Institución Activa'));

		
		/*
		 * <?= $form->input('Plan.oferta_id', array('options'=>$ofertas, 
												 'label'=>'Ofertas',
												 'empty' => 'Cualquiera')); ?>
		 */
		echo $form->end('Buscar'); ?>
		
	</div>