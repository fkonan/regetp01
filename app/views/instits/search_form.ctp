<h2><?= __('Buscar Institución')?></h2>
	
	<div>
		<?= $form->create('Instit',array('action' => 'search')); 
				
		echo $form->input('cue', array('label'=>'Cue')); 
		echo $form->input('nombre', array('label'=>'Nombre de Institución')); 
		echo $form->input('direccion', array('label'=>'Domicilio'));	
		
		
		
		echo $form->input('gestion_id', array('empty' => 'Todas'));
		echo $form->input('dependencia_id', array('empty' => 'Todas'));
		
		echo $form->input('jurisdiccion_id', array('empty' => array('0'=>'Todas'),'id'=>'jurisdiccion_id'));
		echo $form->input('tipoinstit_id', array('empty' => 'Todas','disabled'=>true,'type'=>'select'));
		
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
      	
		
		echo $form->input('esanexo',array('type'=> 'checkbox'));
		echo $form->input('activo',array('type'=> 'checkbox'));

		
		/*
		 * <?= $form->input('Plan.oferta_id', array('options'=>$ofertas, 
												 'label'=>'Ofertas',
												 'empty' => 'Cualquiera')); ?>
		 */
		echo $form->end('Buscar'); ?>
		
	</div>