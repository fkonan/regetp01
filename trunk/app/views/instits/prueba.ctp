<?php
 echo $form->create('Instit', array('action'=> 'prueba'));
 echo $form->input('Plan.oferta_id', array('options'=> $ofertas));
 echo $form->end('enviar');
?>