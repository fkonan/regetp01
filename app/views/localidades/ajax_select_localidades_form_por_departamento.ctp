

<?
foreach ($localidades as $d){
	?>
		<option value="<?= $d['Localidad']['id']?>"><?= utf8_encode($d['Localidad']['name'])?></option>
	<?
}
	
?>