<h1>Información</h1>

<h2>Descargas Excel</h2>
<?php


?>
<div>
<br />
<ul>
<?
foreach ($queries as $q):?>
	<li>
		<?= $html->link($q['Query']['name'].'.xls','contruye_excel/'.$q['Query']['id']); ?>
		<?= "(".date("j F, Y, g:i a",strtotime($q['Query']['modified'])).")"; ?>
		<br /><?=  $q['Query']['description'] ?>
	</li>
	<br />
	<?php 
endforeach;
?>
</ul>
</div>