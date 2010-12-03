<?php
if (empty($planes)) {
    ?>
<p class="msg-atencion"><br /><br />La Institución no presenta actualizaciones para este año</p>
<?
}
?>
<div id="tab_oferta">
    <?php
    $i = 0;
    foreach($planes as $plan){
    
    ?>
    <?php if($ciclo > 0){ 
        if(!empty($plan['Anio'])){?>
    <div class="plan_item" title="Haciendo click verá más información de éste plan">
             <span  class="plan_etapa_name">
                    <?php echo $plan['EstructuraPlan']['Etapa']['name']?>
             </span>

             <span class="plan_mas_info btn-ir">
                    <?php echo $html->link("ver más",
                        array('controller'=> 'planes', 'action'=>'view', $plan['Plan']['id']), array('title'=>'Ver mas información del plan'));
                    ?>
             </span>

            <table class="tabla_plan" cellpadding="2px" cellspacing="0px">
                <caption class="plan_title">
                     <?php echo $html->link($plan['Plan']['nombre'],
                        array('controller'=> 'planes', 'action'=>'view', $plan['Plan']['id']),
                        null,null,false);
                    ?>

                     <?php
                        if($ciclo == 0){
                            $primer_anio = current($plan['Anio']);
                            echo " (" . $primer_anio['ciclo_id'] . ")";
                        }
                     ?>
                </caption>
                <thead>
                    <tr>
                        <th>Año</th>
                        <th>Matrícula</th>
                        <th>Secciones</th>
                        <th>Horas Taller</th>
                    </tr>
                </thead>
            <?php
            $sumMatricula = 0;
            $sumSecciones = 0;
            foreach($plan['Anio'] as $anio){
            ?>
            <tr>
                <td><?php echo $anio['EstructuraPlanesAnio']['alias']?></td>
                <td><?php echo $anio['Anio']['matricula']?></td>
                <td><?php echo $anio['Anio']['secciones']?></td>
                <td><?php echo $anio['Anio']['hs_taller']?></td>
            </tr>
            <?php
            $sumMatricula += $anio['Anio']['matricula'];
            $sumSecciones += $anio['Anio']['secciones'];
            }?>

            <tfoot>
                    <tr>
                        <th>Totales</th>
                        <th><?php echo $sumMatricula ?></th>
                        <th><?php echo $sumSecciones ?></th>
                        <th>&nbsp;</th>
                    </tr>
            </tfoot>
         </table>
         </div>
         <div class="clear"></div><br />
        <?php
            }
        }
        else{ // listar todos
            $class = null;
            if ($i++ % 2 == 0)
                $class = 'altrow';

            $primer_anio = current($plan['Anio']);
            $ciclo_plan =  (!empty($primer_anio['Anio']['ciclo_id'])? $primer_anio['Anio']['ciclo_id']:"") ;

            echo $this->element('planes/plan_resumen_para_listado', array(
                'class' => $class,
                'plan'  => $plan,
                'ciclo' => $ciclo_plan,
            ));
        }
    }
    ?>
</div>
