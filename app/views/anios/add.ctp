<?

if(isset($script)){
	echo $script;
}
?>

<? $ganchito = $this->data['Anio']['anio'] == 1?'er':'º';?>	
<h1 align="center"> <?= "Agregar Datos" ?></h1>
<div class="">
<?php echo $form->create('Anio');?>
	<fieldset>	
	<?php
	
		echo $form->input('plan_id',array('type'=>'hidden','value'=>$plan_id));
		$trayectosDisponibles;
//		$anios = array('1'=>1,'2'=>2,'3'=>3,'4'=>4,'5'=>5,'6'=>6,'7'=>7,'8'=>8,'9'=>9);
//		echo $form->input('anio',array( 'options'=>$anios ,'label'=>'Año'));
//		echo $form->input('etapa_id');
                
                $anios = array();
                $edades = array();
                $datosMatriculas = array();
                foreach ($trayectosDisponibles['EstructuraPlanesAnio'] as $a) {
                    $anios[] = $a['nro_anio'];
                    $edades[] = $a['anio_escolaridad'];
                    $datosMatriculas[] =  array('matricula'=>'Matrícula','seccion'=>'Sección','hs_taller'=>'Hs Taller');
                }
                $trayectosData = array(
                    'editable' => true,
                    'anios' => $edades,
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
		echo $form->input('ciclo_id',array('selected'=> date('Y')));		

                echo $this->element('planes_view_tabla_sectec_trayectos', array('trayectosData'=>$trayectosData));
		echo $form->input('matricula',array('label'=>'Matrícula'));
		echo $form->input('secciones');
		echo $form->input('hs_taller',array('label'=>'Horas Taller'));
	?>
	</fieldset>
<?php echo $form->end('Guardar');?>
</div>
