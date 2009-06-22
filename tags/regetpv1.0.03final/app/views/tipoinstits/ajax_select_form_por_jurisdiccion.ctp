
<option value="">Todas</option>
<?
/**
* ajax_select_form_por_jurisdiccion.ctp
*
*	devuelve las opciones para actualizar el select
*@var $tipoinstit = array();
**/


foreach ($tipoinstits as $inst){
	?>
		<option value="<?= $inst['Tipoinstit']['id']?>"><?= utf8_encode($inst['Tipoinstit']['name'])?></option>
	<?
}
	
?>