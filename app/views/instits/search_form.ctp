<h2><?= __('Buscar Institución')?></h2>
	
	<div>
		<?= $form->create('Instit',array('action' => 'search')); 
				
		echo $form->input('cue', array('label'=>'Cue')); 
		echo $form->input('nombre', array('label'=>'Nombre de Institución')); 
		echo $form->input('direccion', array('label'=>'Domicilio'));	
		
		echo $form->input('tipoinstit_id', array('empty' => 'Todas'));
		
		echo $form->input('gestion_id', array('empty' => 'Todas'));
		echo $form->input('dependencia_id', array('empty' => 'Todas'));
		
		echo $form->input('jurisdiccion_id', array('empty' => 'Todas'));
		
		echo $form->input('esanexo',array('type'=> 'checkbox'));
		echo $form->input('activo',array('type'=> 'checkbox'));

		
		/*
		 * <?= $form->input('Plan.oferta_id', array('options'=>$ofertas, 
												 'label'=>'Ofertas',
												 'empty' => 'Cualquiera')); ?>
		 */
		echo $form->end('Buscar'); ?>
		
	</div>