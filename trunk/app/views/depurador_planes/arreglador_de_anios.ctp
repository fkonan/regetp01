<?php
//debug($anios);

$ids_de_anios = array_keys($estructura_planes_anios);



echo $form->create('Anio', array('url'=>'/depurador_planes/arregladorDeAnios/'.$plan_id));


echo "<hr>";

$i = 0;
foreach ($anios as $a) {
    echo "<p>";
   
    echo "Dato actual: <b>".$a['anio']."º ".$a['Etapa']['name']."</b><br>";
    echo $form->hidden($i.'.id', array('value'=>$a['id']));

    // armo el input de la estructura con sugerencia
    $asug = null;
    $label = 'Nuevo Año';
    if (!empty($ids_de_anios)) {    
        $asug = array_shift($ids_de_anios);
        $label = 'Nuevo Año <b style="color:red; font-size: 7pt;">*** SUGERIDO ***</b>';
    }
    echo $form->input($i.'.estructura_planes_anio_id', array(
        'label'=>$label,
        'options'=>$estructura_planes_anios,
        'default' => $asug,
        ));

    echo $form->input($i.'.plan_id', array('label'=>'Mover èste año a otro Plan'));

    echo "</p>";
    echo "<hr>";

}

echo $form->end('Guardar');

?>
