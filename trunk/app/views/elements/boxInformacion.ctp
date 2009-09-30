<?
if ($session->check('Auth.User')){
	if($session->read('Auth.User.role') == 'admin'){
	?>

<div id="boxInformacion">
	<h1>Unidad de Información</h1>
	<ul>
		<li><? echo $html->link("Nueva Institución","/Instits/add") ?></li>
		<li><? echo $html->link("Descargas","/Queries/descargar_queries") ?></li>
		<li><a id="pendientes" href="#Pendientes" onClick="return false;">Pendientes</a></li>
				    
				<script>
					$('pendientes').observe('click',view_prov);
					
					function view_prov()
					{
						if($('prov').style.display=='block')
						{
							$('prov').style.display='none';	
						}
						else
						{
							$('prov').style.display='block';
						}

						return false;
					}
				</script>    
				                                   
				<div id="prov" style="display: none;">
					<?php
						
						$prov_pend = $this->requestAction('/tickets/provincias_pendientes');
						
						foreach($prov_pend as $prov)
						{		
							?><li>
								<? echo $html->link($prov['name'],"/tickets/index/".$prov['id']) ?>
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
				</div>
				
	</ul>
</div>


<?	}
} ?>