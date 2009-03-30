<h1>Logueo De usuario</h1>
<?php
if($session->check('Message.auth')) $session->flash('auth');

echo $form->create('User', array('action'=>'login'));
echo $form->input('username');
echo $form->input('password', array('type'=>'password'));
echo $form->end('Entrar');

?><p><br><?
echo $html->link('¿No posee una cuenta de usuario?','/users/add');
?></p>

