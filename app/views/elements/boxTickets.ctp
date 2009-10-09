<?
if ($session->check('Auth.User')){
	if(	$session->read('Auth.User.role') == 'admin' || 
		$session->read('Auth.User.role') == 'superusuario' ||
		$session->read('Auth.User.role') == 'editor'){
	?>

<div id="boxTickets">
	<h1>Pendientes de Actualización</h1>
	

<ul>
	<?php
			$prov_pend = array();
			$prov_pend = $this->requestAction('/tickets/provincias_pendientes');
			
			
			while(list($id,$name) = each($prov_pend))
			{		
				?><li>
					<? echo $html->link($name,"/tickets/index/".$id) ?>
				  </li>
				<?php
			}
			
			if(count($prov_pend) < 1)
			{		
				?><li>
					<? echo $html->link("No hay pendientes","/pages/home/") ?>
				  </li>
				<?php
			}									
		?> 

</ul>

</div>	
	<?php 
	
	}
}
	?>