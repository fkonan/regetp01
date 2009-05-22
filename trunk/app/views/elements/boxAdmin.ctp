<?
if ($session->check('Auth.User')){
	if($session->read('Auth.User.role') == 'admin'){
	?>
		<div id="divAdmin">
			<h1>Administración</h1>
			<ul>
				<li><? echo $html->link("Agregar Usuario","/Users/add") ?></li>
			</ul>
		</div>

<?	}
} ?>