<?
if(isset($script)){
echo $script;
}
?>
<?php
if (empty($this->data['Anio']['estructura_planes_anio_id'])) {

    // HACERLO DE LA FORMA VIEJA !!
    // SIN ESTRUCTURAR
    ?>
    <? $ganchito = $this->data['Anio']['anio'] == 1?'er':'º';?>
    <h1 align="center"> <?= "Editar ".$this->data['Anio']['anio']."$ganchito Año" ?></h1>
    <div class="anios form">
    <?php echo $form->create('Anio', array('action'=>'save'));?>
    <fieldset>
    <?php
    echo $form->input('id');
    echo $form->input('plan_id',array('type'=>'hidden'));
    $anios_list = array('1'=>1,'2'=>2,'3'=>3,'4'=>4,'5'=>5,'6'=>6,'7'=>7,'8'=>8,'9'=>9);
    echo $form->input('anio',array( 'options'=>$anios_list  ,'label'=>'Año'));
    echo $form->input('etapa_id');
    echo $form->hidden('ciclo_id');
    echo $form->hidden('estructura_planes_anio_id');

    echo $form->input('matricula',array('label'=>'Matrícula'));
    echo $form->input('secciones');
    echo $form->input('hs_taller',array('label'=>'Horas Taller'));
    echo $form->end('Guardar');
} else {


    // HACERLO DE LA NUEVA FORMA
    // DATOS ESTRUCTURADOS

    $ganchito = $this->data['Anio']['anio'] == 1?'er':'º';?>        
<h1 align="center"><?= "Editar Ciclo ".$this->data['Anio']['ciclo_id'] ?></h1>

<?php

/*
 * variable que viene del controlador
 * @var $trayectosDisponibles array 
 */
$trayectosDisponibles;


if (!empty($anios)  && empty($anios[0]['EstructuraPlanesAnio']['id'])){
    echo "<p class='error'>Mal Depurada la estructura, ejecute nuevamente el depurador</p>";
    echo "<p class='info'>Para ello debe volver a la  pestaña 'Oferta Educativa' y hacer click en 'Depurar Institución'</p>";
    return;
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
        'ciclos' => array($ciclo_seleccionado=>$anios), // relacionado con los "datos"
);


// verificar que estè estructurado el dato
// caso contrario mando a seleccionar estructura
if (empty($trayectosDisponibles) || empty($trayectosData)) {
    ?>
    <p class="msg-atencion" style="padding: 30px 20px;">
        La estructura de la oferta no es válida.<br>
        Debe indicarla antes de agregar nuevos datos haciendo <?php echo $html->link('click aquì','/planes/edit/'.$plan_id);?>.
    </p>
    <?php
    return 1;
}


echo $this->element('planes_view_tabla_st', array('trayectosData'=>$trayectosData));

?>
<?php
}
?>
</fieldset>
</div>

