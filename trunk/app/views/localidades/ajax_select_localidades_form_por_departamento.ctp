<option value="0">Seleccione</option>

<?
while (list($id, $valor) = each($localidades)):
	?>
		<option value="<?= $id?>"><?= utf8_encode($valor)?></option>
	<?
endwhile;
	
?>