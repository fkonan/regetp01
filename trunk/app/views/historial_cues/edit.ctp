<?php 

echo $form->create('HistorialCue');
echo $form->input('id');
echo $form->input('cue');
echo $form->input('anexo');
echo $form->input('created');
echo $form->input('observaciones');
echo $form->input('instit_id',array('type'=>'hidden'));
echo $form->end('Guardar');

?>