
<div id="tab_oferta">
    <?php
    $i = 0;
    foreach($planes['Plan'] as $plan){
    
    ?>
    <?php if($ciclo > 0){ 
        if(!empty($plan['Anio'])){?>
    <div class="plan_item" title="Haciendo click verá más información de éste plan">
             <span  class="plan_etapa_name">
                    <?php echo $plan['EstructuraPlan']['Etapa']['name']?>
             </span>

             <span class="plan_mas_info btn-ir">
                    <?php echo $html->link("ver más",
                        array('controller'=> 'planes', 'action'=>'view', $plan['id']), array('title'=>'Ver mas información del plan'));
                    ?>
             </span>

            <table class="tabla_plan" cellpadding="2px" cellspacing="0px">
                <caption class="plan_title">
                     <?php echo $html->link($plan['nombre'],
                        array('controller'=> 'planes', 'action'=>'view', $plan['id']),
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
            foreach($plan['Anio'] as $anio){
            ?>
            <tr>
                <td><?php echo $anio['EstructuraPlanesAnio']['nro_anio']?>º</td>
                <td><?php echo $anio['Anio']['matricula']?></td>
                <td><?php echo $anio['Anio']['secciones']?></td>
                <td><?php echo $anio['Anio']['hs_taller']?></td>
            </tr>
            <?php
            }?>
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
<script type="text/javascript">
    jQuery('#tabs-1 .plan_item').biggerlink();
</script>
