
<?php

/* variable que viene del controlador
                 * @var $trayectosDisponibles array */
$trayectosDisponibles;

// verificar que estè estructurado el dato
// caso contrario mando a seleccionar estructura
if (empty($trayectosDisponibles)) {
    ?>
    <p class="msg-atencion" style="padding: 30px 20px;">
        La estructura de la oferta no es válida.<br>
        Debe indicarla antes de agregar nuevos datos haciendo <?php echo $html->link('click aquì','/planes/edit/'.$plan_id);?>.
    </p>
    <?php
    return 1;
}


// me armo el array de opciones para el elemento que renderiza el recuadro de estructura
$trayectosData = array(
        'editable' => true,
        'form_action' => 'saveAll',
        'estructura' => array( // relacionado con la estructura para el encabezado
                array(
                    'title' => $trayectosDisponibles['EstructuraPlan']['name'],
                    'estructura_plan_id' => $trayectosDisponibles['EstructuraPlan']['id'],
                    'anios' => $trayectosDisponibles['EstructuraPlanesAnio'],
                )
        ),
);

echo $this->element('planes_view_tabla_st', array('trayectosData'=>$trayectosData));

?>