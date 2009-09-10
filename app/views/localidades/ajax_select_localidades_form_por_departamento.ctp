
<?php //debug($deptos);?>
<option value="0">Seleccione</option>

<?
foreach($localidades as $d):
		$poner = $d['Localidad']['name'];
		if($todos){
			$poner .= ' ('.$d['Departamento']['name'].')';
		}
	?>
		<option value="<?= $d['Localidad']['id']?>"><?= utf8_encode($poner)?></option>
	<?
endforeach;
	
?>