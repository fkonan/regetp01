<?
if ($session->check('Auth.User')){
	if(	$session->read('Auth.User.role') == 'admin' || 
		$session->read('Auth.User.role') == 'desarrollo' ||
		$session->read('Auth.User.role') == 'editor'){
	?>

<div id="boxInformacion">
	<h1 id="boxInformacion" class="menu_head">Unidad de Información</h1>
        <ul class="menu_body">
		<li><? echo $html->link("Nueva Institución","/Instits/add") ?></li>
		<li><? echo $html->link("Descargas","/Queries/descargar_queries") ?></li>
		<li><? echo $html->link("Títulos","/Titulos") ?></li>
	</ul>
			
</div>


<?	}
} ?>