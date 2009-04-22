<div id="box_loguin">
<? 
	//pr($session->read());
	// If the session info hasn't been set...
	if ($session->check('Auth.User')){
		echo "Hola <b>".$session->read('Auth.User.username')."!</b>";
		echo $html->link('Salir','/users/logout');
	}else{
	if($session->check('Message.auth')) $session->flash('auth');

		echo $form->create('User', array('action'=>'login','id'=>'menu_logeo'));
		echo $form->input('username',array('label'=>'Nick'));
		echo $form->input('password', array('type'=>'password'));
		echo $form->end('Entrar');
	} ?>
	
</div>