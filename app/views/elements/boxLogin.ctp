<div id="box_loguin">
	<div id="box_loguin_form">
<? 
	//pr($session->read());
	// If the session info hasn't been set...
	if ($session->check('Auth.User')){
		echo "<h4>Hola ".$session->read('Auth.User.username')." id(".$session->read('Auth.User.id').")</h4>";
		echo "<div class='box_link'>".$html->link('Logout','/users/logout')."</div>";
	}else{
/*
 * 
 * 
 * por ahora no quiero que me muestre el formulario para loguin
 * asique lo dejo comentado temporalmente
 * 
	if($session->check('Message.auth')) $session->flash('auth');

	echo $form->create('User', array('action'=>'login','id'=>'menu_logeo'));
	echo $form->input('username');
	echo $form->input('password', array('type'=>'password'));
	echo $form->end('Entrar');
	*/
?>	</div>

	<ul id="box_loguin_registro" class="box_link">
	<li><? echo $html->link('registrarse','/users/add')?></li>
	</ul>
<?  } ?>
	
</div>