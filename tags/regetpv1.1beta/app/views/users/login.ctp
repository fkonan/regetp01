<h1>Logueo De usuario</h1>
<?php
if($session->check('Message.auth')) $session->flash('auth');

echo $form->create('User', array('action'=>'login'));
echo $form->input('username');
echo $form->input('password', array('type'=>'password'));
echo $form->end('Entrar');

?>
<br><br>
<p>
<b>Si usted no posee cuenta de usuario</b> debe acreditar un nick y un password en la Unidad de Informacón, oficina 309. 
</p>

