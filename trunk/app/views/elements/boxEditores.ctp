<?
if ($session->check('Auth.User')){
	if($session->read('Auth.User.role') == 'editor'){
	?>
		<div id="box_admin">
			<h1>Edición</h1>
			<ul>
				<li><? echo $html->link("Descargas","/Queries/descargar_queries") ?></li>
				<li><? echo $html->link("Departamentos","/departamentos") ?></li>
				<li><? echo $html->link("Localidades","/localidades") ?></li>
				<b>Depuración</b>
		<li><? echo $html->link("Depto y Loc","/depuradores/deptoyloc") ?></li>
		<li><? echo $html->link("Tipoinstits","/depuradores/tipoinstits") ?></li>				
			</ul>
		</div>

<?	}
} ?>