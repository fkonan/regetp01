<?php
echo $javascript->link('jquery-ui-1.8.5.custom.min', false);
echo $html->css('smoothness/jquery-ui-1.8.6.custom',null, false);
?>
<script type="text/javascript">
jQuery(document).ready(function() {
    jQuery("#vigenciaDatePicker").datepicker({ minDate: 1, dateFormat: 'dd/mm/yy' });
    
    toogleVigencia();
});

function toogleVigencia() {
    if (jQuery("#categoria").val() == 't') {
        jQuery('.vigenciaDatePickerDiv').show();
    }
    else {
        jQuery('.vigenciaDatePickerDiv').hide();
    }
}
</script>
<div class="queries form">
<?php echo $form->create('Query');?>
	<fieldset>
 		<legend><?php __('Crear Descarga');?></legend>
	<?php
		echo $form->input('name');
		echo $form->input('description');
		
                /* @var $ajax AjaxHelper */
		//echo $ajax->autoComplete('categoria', '/pquery/queries/listado_categorias');
                echo $form->input('categoria', array('type' => 'select',
                                            'id' => 'categoria',
                                            'options' => array('t'=>'Temporales', 'h'=>'Habituales'),
                                            'style' => 'width:150px; clear:none; float:left;',
                                            'onchange' => 'toogleVigencia();',
                                            'default' => 't'));

                echo $form->input('vigencia', array('id'=>'vigenciaDatePicker',
                                                    'type'=>'text',
                                                    'div' => 'vigenciaDatePickerDiv',
                                                    'style' => 'width:100px; clear:none; float:left;'));
                
		//echo $form->input('ver_online',array('label'=>'¿Ver Online?','after'=>'si se tilda esta opcion se habiiltara la query para ver de forma online como una pagina normal.'));
		
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
