<?
if ($session->check('Auth.User')){
	if(	$session->read('Auth.User.role') == 'desarrollo' ||
		$session->read('Auth.User.role') == 'admin'){
	?>
		<div id="box_admin">
			<h1>Administraci�n</h1>
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
				
				<li><? echo $html->link("Estad�sticas","http://rfietp.inet.edu.ar/awstats/awstats.pl?config=rfietp") ?></li>
				

			</ul>
		</div>

<?	}
} ?>