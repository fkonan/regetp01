<?php
//debug($anios);

$ids_de_anios = array_keys($estructura_planes_anios);


if (!empty($plan['EstructuraPlan']['id'])) {

    echo $form->create('Anio', array('url'=>'/depurador_planes/arregladorDeAnios/'.$plan['Plan']['id']));


    echo "<hr>";

    $i = 0;
    echo "<h3 style='text-align: center'>Estructura del plan: ".$plan['EstructuraPlan']['name']."</h3>";
    foreach ($anios as $a) {
        echo "<div style='padding-bottom: 0.5em;'>";

        echo "Dato actual: <b>".$a['anio']."º ".$a['Etapa']['name']."</b><br>";
        echo $form->hidden($i.'.id', array('value'=>$a['id']));

        // armo el input de la estructura con sugerencia
        $asug = null;
        $label = 'Nuevo Año ';
        if (!empty($ids_de_anios)) {
            $asug = array_shift($ids_de_anios);
            $label = 'Nuevo Año <b style="color:red; font-size: 7pt;">*** SUGERIDO ***</b> ';
        }
        echo $form->input($i.'.estructura_planes_anio_id', array(
        'label'=>$label,
        'options'=>$estructura_planes_anios,
        'default' => $asug,
        'style' => 'font-size: 13pt; margin:0px; padding: 0px;',
        ));

        echo '<div>Mover este año a otro Plan: ';
        echo $form->input($i.'.plan_id', array(
            'div' => false,
            'label' => false,
            'default' => $plan['Plan']['id'],
            ));
        echo '</div>';

        echo "</div>";
        echo "<hr>";

        $i++;

    }

    echo $form->end('Guardar');
}

else {
    ?>
<br><br>
<p>
<h1 class="message">No se pueden editar los años si aún no le seleccionó una estructura al Plan</h1>
</p>
<br><br><?php
}

?>
