<?
echo $javascript->link(array('jquery.autocomplete'));
echo $html->css('jquery.autocomplete.css');
?>
<script language="javascript">
    jQuery(document).ready(function() {
        jQuery("#QueryCategoria").autocomplete("<?echo $html->url(array('controller'=>'queries','action'=>'listado_categorias'));?>", {
            dataType: "json",
            delay: 400,
            max:30,
            cacheLength:1,
            parse: function(data) {
                return jQuery.map(data, function(cat) {
                    return {
                        data: cat,
                        value: cat.categoria,
                        result: cat.categoria
                    }
                });
            },
            formatItem: function(cat) {
                return cat.categoria;
            }
        });
    });
</script>
<div class="queries form">
<?php echo $form->create('Query');?>
	<fieldset>
 		<legend><?php __('Editar Query');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('name');
		echo $form->input('description');

		echo $form->input('categoria', array('label'=>'Categoria','title'=>'Ingrese al menos 1 letra para que comience la busqueda de Categorias'));
		
		echo "<div>";
		echo $form->input('ver_online',array('label'=>'¿Ver Online?','after'=>'si se tilda esta opción se habiiltará la query para ver de forma online como una página normal.'));
		echo "</div>";
		
		echo $form->input('query');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Query.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Query.id'))); ?></li>
		<li><?php echo $html->link(__('List Queries', true), array('action'=>'index'));?></li>
	</ul>
</div>
