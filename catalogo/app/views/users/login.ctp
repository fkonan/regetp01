<?php echo $html->css('catalogo.users.login', false);?>
<div class="grid_6 prefix_3 suffix_3">
    <div class="boxblanca">
    
        <h3>Iniciar Sesión</h3>
        <?php
            if($session->check('Message.auth')) $session->flash('auth');
            echo $form->create('User', array('action'=>'login'));
            echo $form->input('username',array('label'=>'Usuario', 'id'=>'NombreUsuario'));
            echo $form->input('password', array('type'=>'password','label'=>'Contraseña','id'=>'Contrasenia'));
            echo $form->end(array('label'=>'Entrar', 'id'=>'entrar'));
        ?>
        <div class='clear'></div>    
    </div>
    <p>
        <b>Si usted no posee cuenta de usuario</b> debe solicitarla en la Unidad de Información, oficina 311. 
    </p>
</div>

