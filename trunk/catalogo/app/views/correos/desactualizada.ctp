<h1>Institución desactualizada</h1>

<p>
    Si quiere actualizar, agregar o modificar los datos de una institución complete el siguiente formulario
</p>

<?php
echo $form->create('Correo', array('action' => 'desactualizada'));
echo $form->hidden('instit_id');
echo $form->input('descripcion', array('label'=>'Descripción', 'type' => 'text', 'rows' => '4'));
echo $form->input('from', array('label'=>'Nombre', 'class'=> ''));
echo $form->input('mail', array('label'=>'E-mail'));
echo $form->input('telefono', array('label'=>'Teléfono'));
?>
<br />
<?php
echo $form->end('Enviar');
?>
