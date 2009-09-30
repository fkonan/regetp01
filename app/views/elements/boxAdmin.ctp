<?
if ($session->check('Auth.User')){
	if($session->read('Auth.User.role') == 'admin'){
	?>
		<div id="box_admin">
			<h1>Administración</h1>
			<ul>
				<li><? echo $html->link("Agregar Usuario","/Users/add") ?></li>
				<li><? echo $html->link("Listar Usuarios","/Users/listadoUsuarios") ?></li>

				<li><? echo $html->link("Ofertas","/ofertas") ?></li>
				<li><? echo $html->link("Ciclos","/ciclos") ?></li>
				
				<li><? echo $html->link("Dependencias","/dependencias") ?></li>
				<li><? echo $html->link("Etapas","/etapas") ?></li>
				<li><? echo $html->link("Gestiones","/gestiones") ?></li>
				<li><? echo $html->link("Tipos De Instits","/tipoinstits") ?></li>

				<li><? echo $html->link("Jurisdicciones","/jurisdicciones") ?></li>
				<li><? echo $html->link("Departamentos","/departamentos") ?></li>
				<li><? echo $html->link("Localidades","/localidades") ?></li>
				
				<li><? echo $html->link("Sectores","/Sectores") ?></li>
				
				<li><? echo $html->link("Descargas SQL","/Queries") ?></li>
				
				<li><? echo $html->link("Estadísticas","http://rfietp.inet.edu.ar/awstats/awstats.pl?config=rfietp") ?></li>
				
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