<?php


echo $form->create('Anio');

$i = 0;
foreach ($anios as $a) {
    echo $form->hidden($i.'.id');
    echo $form->input($i.'.trayecto_anio_id');
}

echo $form->end('Guardar');

?>
