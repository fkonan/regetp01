<h1>Total de Instituciones por jurisdicción</h1>
<br>
<div align="center">
<table width="80" cellpadding = "0" cellspacing = "0" summary="En esta tabla se muestran los totales de 
														ofertas por cada jurisdicción.">
	<!--  CAPTION>Total de ofertas por jurisdicción</CAPTION -->
	<tr class="altrow2">
		<?php 
		foreach($headers as $h):
			echo "<th>".$h."</th>";
		endforeach;
		?>		
	</tr>	
	
		<?php
		$i = 0;
		foreach($intits as $j):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr <?php echo $class;?>>
		<?php
			foreach($j as $key=>$value): 
				echo "<td>".$value."</td>";
			endforeach; 
		?>
		</tr>
		<?php 
		endforeach;
		?>
	
</table>
<div>