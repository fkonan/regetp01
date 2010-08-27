<?
if(isset($script)){
echo $script;
}
?>
<?php
if (empty($this->data['Anio']['estructura_planes_anio_id'])) {
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
?>
<? $ganchito = $this->data['Anio']['anio'] == 1?'er':'º';?>
<h1 align="center"><?= "Editar Ciclo ".$this->data['Anio']['ciclo_id'] ?></h1>

<?php

/* variable que viene del controlador
                 * @var $trayectosDisponibles array */
$trayectosDisponibles;


if (empty($trayectosDisponibles)) {
    ?>
    <p class="msg-atencion" style="padding: 30px 20px;">
        La estructura de la oferta no es válida.<br>
        Debe indicarla antes de agregar nuevos datos haciendo <?php echo $html->link('click aquì','/planes/edit/'.$plan_id);?>.
    </p>
    <?php
    return 1;
}


//		$anios = array('1'=>1,'2'=>2,'3'=>3,'4'=>4,'5'=>5,'6'=>6,'7'=>7,'8'=>8,'9'=>9);
//		echo $form->input('anio',array( 'options'=>$anios ,'label'=>'Año'));
//		echo $form->input('etapa_id');

$anio_tmp = array();
$edades = array();
$datosMatriculas = array();
// debug($trayectosDisponibles);
if (!empty($trayectosDisponibles['EstructuraPlanesAnio'])):
    foreach ($trayectosDisponibles['EstructuraPlanesAnio'] as $a) {
        $anio_tmp[$a['nro_anio']] = array('id'=>$a['id'],'anio'=>$a['nro_anio'],'matricula'=>null,'secciones'=>null,'hs_taller'=>null, 'estructura_planes_anio_id'=>$a['id']);
        $edades[] = $a['anio_escolaridad'];
        $datosMatriculas[] =  array('matricula'=>null,'secciones'=>null,'hs_taller'=>null, 'estructura_planes_anio_id'=>$a['id']);
    }
endif;

// me armo el array de opciones para el elemento que renderiza el recuadro de estructura
$trayectosData = array(
        'editable' => true,
        //'anios' => $edades,
        'form_action' => 'saveAll',
        'etapa_header' => array(
                array(
                        'title' => $trayectosDisponibles['EstructuraPlan']['name'],
                        'estructura_plan_id' => $trayectosDisponibles['EstructuraPlan']['id'],
                        'anios' => $anios,
                )
        ),
        'ciclo_lectivo' => array(
                0 => array($anios),
        )
);

echo $this->element('planes_view_tabla_st', array('trayectosData'=>$trayectosData));

?>
<?php
}
?>
</fieldset>
</div>

