
    <h1>Institución desactualizada</h1>

    <p>
        No es necesario completar el formulario, pero nos seria de mucha
        ayuda si agrega una descripción sobre el problema detectado.
    </p>

    <?php


    echo $form->create('Correo', array('action' => 'desactualizada'));
    echo $form->hidden('instit_id');
    echo $form->input('descripcion', array('label'=>'Descripción', 'type' => 'text'));
    echo $form->input('from', array('label'=>'Ingrese su Nombre', 'class'=> ''));
    echo $form->input('mail', array('label'=>'Ingrese su e-mail'));
    echo $form->input('telefono', array('label'=>'Ingrese su teléfono'));
    echo $form->end('Enviar');
    ?>
