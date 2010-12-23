<h1>Información</h1>
<?
echo $javascript->link(array(
    'jquery.autocomplete',
    'jquery.qtip.min',
    'jquery.blockUI',
    ));

echo $html->css('jquery.autocomplete.css');
?>
<style type="text/css">
.tooltip2 {
        padding-left: 15px;
        padding-right: 30px;
        vertical-align: middle;
        top: 30px;
	background-color:#DBEBF6;
	border:1px solid #fff;
	width:589px;
	display:none;
	color:#045FB4;
	text-align:left;
	font-size:12px;
	-moz-box-shadow:0 0 10px #000;
	-webkit-box-shadow:0 0 10px #000;
	}
</style>
<script type="text/javascript">
jQuery(document).ready(function() {
    jQuery(".msg-info[title]").tooltip({
	position: "bottom center",
	offset: [10, 0],
        tipClass: 'tooltip2',
	effect: "fade",
        delay: 60,
        fadeOutSpeed: 100,
        predelay: 400,
	opacity: 0.9
    });
});
<!--
        jQuery(document).keypress(function(event){
            var cKeyCode = event.keyCode;
             if (cKeyCode == 13){
                jQuery('#FormCategorias').submit();
            }
        });
//-->
</script>

<h2>Buscador</h2>
<?php


?>

<?php echo $form->create('Query',array(	'url'=>'/queries/descargar_queries/'.$categoria,
										'id'=>'FormCategorias'));?>
<?php		
		echo $form->input('categoria', array('type'=>'select',
											 'label'=>'Categoría',
											 'value'=>$categoria,
											 'options'=>$categorias,
											 'onChange'=>'jQuery("#FormCategorias").submit();'
											 ));
											 
		echo $form->input('description', array( 'label'=> 'Ingrese criterio de búsqueda',
												'type'=>'text',
										 		'after'=> '<cite>Busca tanto en el nombre del archivo como en la descripción.</cite>'));
		echo $form->end('Buscar');										 
?>

<h2>Descargas Excel</h2>
<div>
<br />
<ul>
<?
foreach ($queries as $q):?>
	<li>
		<?= $html->link($q['Query']['name'].'.xls','contruye_excel/'.$q['Query']['id']); ?>
		<?= "(".date("j F, Y, g:i a",strtotime($q['Query']['modified'])).")"; ?>
		<? if($q['Query']['ver_online']) echo $html->link('ver online', '/queries/list_view/'.$q['Query']['id']);?>
		<br /><?=  $q['Query']['description'] ?>
	</li>
	<br />
	<?php 
endforeach;
?>
</ul>
</div>