<?php
echo $javascript->link('jquery-ui-1.8.5.custom.min', false);
echo $html->css('smoothness/jquery-ui-1.8.6.custom',null, false);
?>

<h2><?php __('Crear Descarga');?></h2>
<div class="queries form">
<?php echo $form->create('Query');?>
	<fieldset>
	<?php
		echo $form->input('name');
		echo $form->input('description');

                echo $form->input('expiration_time');
		
                echo $form->input('pquery_category_id', array('label' => 'Categoria', 'options' => $pquery_categories));

		echo $form->input('query');
	?>
	</fieldset>
<?php echo $form->end('Guardar');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Listado de Descargas', true), array('action'=>'index'));?></li>
	</ul>
</div>
