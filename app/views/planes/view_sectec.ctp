<?php
if (empty($planes)) {
    ?>
<p class="msg-atencion"><br /><br />La Instituci�n no presenta actualizaciones para este a�o</p>
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
    <div class="plan_item" title="Haciendo click ver� m�s informaci�n de �ste plan">
             <span  class="plan_etapa_name">
                    <?php echo $plan['EstructuraPlan']['Etapa']['name']?>
             </span>

             <span class="plan_mas_info btn-ir">
                    <?php echo $html->link("ver m�s",
                        array('controller'=> 'planes', 'action'=>'view', $plan['Plan']['id']), array('title'=>'Ver m�s informaci�n del plan'));
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
                        <th>A�o</th>
                        <th>Matr�cula</th>
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
                <td><?php echo $anio['matricula']?></td>
                <td><?php echo $anio['secciones']?></td>
                <td><?php echo $anio['hs_taller']?></td>
            </tr>
            <?php
            $sumMatricula += $anio['matricula'];
            $sumSecciones += $anio['secciones'];
            }?>

            <tfoot>
                    <tr>
                        <td>Total</td>
                        <td><?php echo $sumMatricula ?></td>
                        <td><?php echo $sumSecciones ?></td>
                        <td>&nbsp;</td>
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
            $ciclo_plan =  (!empty($primer_anio['ciclo_id'])? $primer_anio['ciclo_id']:"") ;

            echo $this->element('planes/plan_resumen_para_listado', array(
                'class' => $class,
                'plan'  => $plan,
                'ciclo' => $ciclo_plan,
                'hstaller'  => true,
            ));
        }
    }
    ?>
</div>
