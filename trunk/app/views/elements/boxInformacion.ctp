<?
if ($session->check('Auth.User')){
	if($session->read('Auth.User.role') == 'admin'){
	?>

<div id="boxInformacion">
	<h1>Unidad de Información</h1>
	<ul>
		<li><? echo $html->link("Descargas","/Queries/descargar_queries") ?></li>
		<b>Depuración</b>
		<li><? echo $html->link("Depto y Loc","/depuradores/deptoyloc") ?></li>
		<li><? echo $html->link("Tipoinstits","/depuradores/tipoinstits") ?></li>
	</ul>
</div>


<?	}
} ?>