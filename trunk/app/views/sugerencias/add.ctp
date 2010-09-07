<div class="sugerencias form">
    <h1>
        <?php echo $html->image('bulbIcon_normal.png', array(
        'height'=>'40px',
        'align'=>'absmiddle',
        'style'=>'botom: -5px;',
        'alt'=>'idea',
        'title'=>'Idea')); ?>
        <?php __('Sugerencias');?>
    </h1>

    <br>
    
    <p>
    Puede dejarnos un mensaje con sugerencias, opiniones, defectos y mejoras a
    realizar en la página web del registro federal de instituciones de ETP 
    <i>(http://rfietp.inet.edu.ar)</i>.<br>
    El objetivo es canalizar su experiencia hasta aquí recogida y poder mejorar
    ésta aplicación para su mayor utilidad.
    </p>

    
    <?php echo $form->create('Sugerencia');?>
    
    <fieldset>
        <?php
        // echo $form->input('asunto');
        //echo $form->hidden( 'asunto' );
        echo $form->hidden('asunto', array('value'=>'Sugerencia por medio Web'));
        echo $form->input('mensaje', array('label'=>''));
        echo $form->hidden('user_id', array('value'=>$session->read('Auth.User.id')));
        echo $form->hidden('email', array('value'=>$session->read('Auth.User.mail')));
        echo $form->hidden('IP', array('value'=>$_SERVER['REMOTE_ADDR']));
        // echo $form->input('leido');
        ?>
    </fieldset>
    <?php echo $form->end('Enviar Sugerencia');?>
</div>

