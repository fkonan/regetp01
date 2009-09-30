<?
if ($session->check('Auth.User')){
	if($session->read('Auth.User.role') == 'editor'){
	?>
		<div id="box_admin">
			<h1>Edición</h1>
			<ul>
				<li><? echo $html->link("Nueva Institución","/Instits/add") ?></li>
				<li style="text-align: center;">-</li>
				<li><? echo $html->link("Descargas","/Queries/descargar_queries") ?></li>
				
				
				<li><? echo $html->link("Sectores","/Sectores") ?></li>
				
				
				<li style="text-align: center;">-</li>
				
				<script>
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
				
				<li><a id="pendientes" href="javascript:;" onClick="view_prov();">Pendientes</a></li>
				                                   
				<div id="prov" style="display: none;">
					<?php
						$prov_pend = $this->requestAction('/tickets/provincias_pendientes');
						foreach($prov_pend as $key=>$prov)
						{		
							?><li>
								<? echo $html->link($prov['Jurisdiccion']['name'],"/tickets/index/".$prov['Jurisdiccion']['id']) ?>
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