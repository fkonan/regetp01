<?php
    echo $javascript->link('jquery.biggerlink.min.js', false);
?>
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
             <span style="float:right;">
                    <?php echo $html->link("ver más",
                        array('controller'=> 'planes', 'action'=>'view', $plan['id']),
                        null,null,false);
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
        else{
            $class = null;
            if ($i++ % 2 == 0)
                $class = 'altrow';
        ?>
            <div class="plan_item <?php echo $class?>">
                <span class="plan_title">
                                <?php if($ciclo == 0){ ?>
                                <b>
                                <?php  $primer_anio = current($plan['Anio']);
                                    echo (!empty($primer_anio['Anio']['ciclo_id'])?" (" .$primer_anio['Anio']['ciclo_id']. ") - ":"") ;
                                ?>
                                </b>
                                <?php
                                }
                                echo $html->link($plan['nombre'],
                                array('action'=>'view', $plan['id']),array('class'=>'title'));
                                ?>
                </span>
                <span class="plan_mas_info">
                                <?php
                                echo $html->link("más info",array('controller'=> 'planes', 'action'=>'view', $plan['id']),
                                null,null,false);
                                ?>
                </span>
                <div>
                    Matrícula: <?php echo empty($plan['matricula'])?"<span style='color:red'>0</span>":$plan['matricula']; ?>
                    <span class="plan_sector_info">
                         Sector: <span class="plan_sector_name"><?php echo $plan['Sector']['name']; ?></span>
                    </span>
                </div>
                <input class="plan_sector" type="hidden" value="<?php echo $plan['Sector']['id']?>"/>
                <input class="plan_ciclo" type="hidden" value="<?php echo empty($plan['Anio'][0]['ciclo_id'])?0:$plan['Anio'][0]['ciclo_id'] ?>"/>
            </div>
        <?php
        }
    }
    ?>
</div>
<script type="text/javascript">
    jQuery('#tabs-1 .plan_item').biggerlink();
</script>
