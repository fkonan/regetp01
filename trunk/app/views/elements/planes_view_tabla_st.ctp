<?php
/**
 *
 *  Este elemento genera una tabla toda hecha en CSS que muestra la estructura
 *  de un Ciclo, Oferta, o Plan.
 *
 *
 *  es necesario pasarle un array con la siguiente forma:
 *
 *  $trayectosData['editable'] si esta en "true" hace que los valores:
 *                             matricula, secciones y hs taller sean editables
 *
 *  array $trayectosData['anios']
 *      Listado de años teoricos. Ej: array(12,13,14,15,16)
 *
 *  string $trayectosData['nombre_etapa']
 *      Nombre del ciclo a renderizar
 *
 *  array  $trayectosData['etapa_header'] listado de etapas distintas
 *  string $trayectosData['etapa_header'][x]['title'] nombre de la Etapa *
 *  string $trayectosData['etapa_header'][x]['estructura_plan_id'] id la EtapaPlan
 *  array  $trayectosData['etapa_header'][x]['anios'] listado de años. Ej: 1°, 2°, 3°
 *
 *  array $trayectosData['ciclos_data'][integer CICLO] nombre o numero de año. Ej: 2009,2010
 *
 *                                            [integer ANIO] listado de
 *                                                      ['matricula']
 *                                                      ['seccion']
 *                                                      ['hs_taller']
 *
 *
 *
 *
 *
 *
 *
 *    -----   Ejemplo de un array con informacion ------
 $trayectosData['anios'] = array(12,13,14,15,16);
 $trayectosData['etapa_header'] = array(
 array('title'=>'Ciclo Básico', 'anios'=>array(1,2,3)),
 array('title'=>'Ciclo Superior', 'anios'=>array(4,5)),
 );
 $trayectosData['ciclo_lectivo'] = array(
 array('title'=>2009,
 'ciclos_data'=> array(
 array(
 'matricula'=>12,
 'seccion'=>10,
 'hs_taller'=>1,
 ),
 array(
 'matricula'=>12,
 'seccion'=>10,
 'hs_taller'=>2,
 ),
 array(
 'matricula'=>12,
 'seccion'=>10,
 'hs_taller'=>3,
 ),
 array(
 'matricula'=>12,
 'seccion'=>10,
 'hs_taller'=>4,
 ),
 array(
 'matricula'=>12,
 'seccion'=>10,
 'hs_taller'=>5,
 ),
 ))
 );

 *
 *
 *
 *
 *
 *
 *
 */

////////////////////////////////////////////////////////////



$esEditable = false;
if (!empty($trayectosData['editable'])) {
    if ($trayectosData['editable']) {
        $esEditable = true;
    }
}

// Inicio del HTML a mostrar
echo $html->css('element_sectec_trayectos','stylesheet', array('media'=>'screen'));

if (empty($trayectosData)) {
    debug("la variable trayectosData es necesaria para generar la maqueta de la estructura de éste elemento.");
}

if (!empty($trayectosData['form_action'])) {
    $form_action = $trayectosData['form_action'];
} else {
    $form_action = 'add';
}
?>
<?php
echo $form->create('Anio', array('action'=>$form_action));
$estructura_plan_id = $trayectosData['etapa_header'][0]['estructura_plan_id'];
echo $form->hidden('Info.estructura_plan_id', array('value'=>$estructura_plan_id));
echo $form->hidden('Info.plan_id', array('value'=>$plan_id));
?>
<table border="2" widtd="100%" cellpadding="2" cellspacing="0">
    <tr>
            <th colspan="2"><?php echo $trayectosData['etapa_header'][0]['title']?></th>
            <th>Matrícula</th>
            <th>Secciones</th>
            <th>Horas Taller</th>
    </tr>
<?php
$i = 0;
$j = 0;
debug($trayectosData);
//foreach($trayectosData['ciclo_lectivo'][0] as $anio_ciclo=>$ciclo){

    foreach($trayectosData['anios'] as $a){
        $cicloLectivo = array_shift($trayectosData['ciclo_lectivo']);
    //foreach($ciclo as $anio=>$datos_anio){
        if(!empty($cicloLectivo[0][0])){
            $cicloLectivo =  $cicloLectivo[0][0]['Anio'];
        }        
        echo $form->hidden($j.'.estructura_planes_anio_id',array('value'=>$cicloLectivo['estructura_planes_anio_id']));
?>
    <tr>
<?php
        if($i == 0){
?>
            <td rowspan="<?php echo sizeof($ciclo)?>">
            <?php
            if (!empty($ciclo_seleccionado)) {
                $attrs = array('disabled'=>true);
                $defaultVal = $ciclo_seleccionado;
                echo $form->hidden('Info.ciclo_id', array('value'=>$ciclo_seleccionado));
            } else {
                $attrs = array();
                $defaultVal = date('Y',strtotime('now'));
            }
            echo $form->select('Info.ciclo_id',$ciclos, $defaultVal, $attrs,false);
            ?>
            </td>
<?php
        }
        
?>
            <?php echo $form->hidden($j.'.id',array( 'label'=>false, 'value'=>empty($cicloLectivo["id"])?null:$cicloLectivo["id"]))?>
            <td><?php echo $cicloLectivo["anio"]?>º</td>
            <td><?php echo $form->input($j.'.matricula',array( 'label'=>false, 'value'=>is_null($cicloLectivo["matricula"])?null:$cicloLectivo["matricula"]))?></td>
            <td><?php echo $form->input($j.'.secciones',array( 'label'=>false, 'value'=>is_null($cicloLectivo["secciones"])?null:$cicloLectivo["secciones"]))?></td>
            <td><?php echo $form->input($j.'.hs_taller',array( 'label'=>false, 'value'=>is_null($cicloLectivo["hs_taller"])?null:$cicloLectivo["hs_taller"]))?></td>
    </tr>
<?php
        $i++;
        $j++;
    }
    $i = 0;
?>
<?php
//}
?>
</table>
<?php
echo $form->end('Guardar');
?>



       



