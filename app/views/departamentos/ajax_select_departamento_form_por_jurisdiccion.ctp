
<?
foreach ($deptos as $d){
	?>
		<option value="<?= $d['Departamento']['id']?>"><?= utf8_encode($d['Departamento']['name'])?></option>
	<?
}
	
?>