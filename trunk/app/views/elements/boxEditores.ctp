<?
if ($session->check('Auth.User')){
	if($session->read('Auth.User.role') == 'editor'){
	?>
		<div id="box_admin">
			<h1>Edición</h1>
			<ul>
				<li><? echo $html->link("Nueva Institución","/Instituciones/add") ?></li>
				<li>-----------------------------</li>
				<li><? echo $html->link("Descargas","/Queries/descargar_queries") ?></li>
				
				
				<li><? echo $html->link("Sectores","/Sectores") ?></li>
			</ul>
		</div>

<?	}
} ?>