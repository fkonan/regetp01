
<?php

/* variable que viene del controlador
                 * @var $trayectosDisponibles array */
$trayectosDisponibles;



if (empty($trayectosDisponibles)) {
    ?>
    <p class="notice">
        Debe indicar una estructura de la oferta válida. Para ello
        debe ir a los datos del plan, editarlo, e indicárselo seleccionando por
        ejemplo: "Ciclo Básico".<br>
        <?php echo $html->link('editar plan','/planes/edit/'.$plan_id);?>
    </p>
    <?php
    return 1;
}


//		$anios = array('1'=>1,'2'=>2,'3'=>3,'4'=>4,'5'=>5,'6'=>6,'7'=>7,'8'=>8,'9'=>9);
//		echo $form->input('anio',array( 'options'=>$anios ,'label'=>'Año'));
//		echo $form->input('etapa_id');

$anios = array();
$edades = array();
$datosMatriculas = array();
// debug($trayectosDisponibles);
if (!empty($trayectosDisponibles['EstructuraPlanesAnio'])):
    foreach ($trayectosDisponibles['EstructuraPlanesAnio'] as $a) {
        $anios[] = $a['nro_anio'];
        $edades[] = $a['anio_escolaridad'];
        $datosMatriculas[] =  array('matricula'=>null,'secciones'=>null,'hs_taller'=>null, 'estructura_planes_anio_id'=>$a['id']);
}
endif;


// me armo el array de opciones para el elemento que renderiza el recuadro de estructura
$trayectosData = array(
        'editable' => true,
        'anios' => $edades,
        'form_action' => 'save',
        'etapa_header' => array(
                array(
                        'title' => $trayectosDisponibles['EstructuraPlan']['name'],
                        'anios' => $anios,
                )
        ),
        'ciclo_lectivo' => array(
                array(
                        'title' => 'Ciclo',
                        'ciclos_data' => $datosMatriculas,
                )
        )
);	

echo $this->element('planes_view_tabla_sectec_trayectos', array('trayectosData'=>$trayectosData));

?>