<?php
    echo $javascript->link('jquery.biggerlink.min.js',false);
?>
<div id="tabs-oferta-sup" class="oferta-contanier">
        <?php
        foreach($planes as $plan) {
            if (!empty($plan['Anio']))
            {
            ?>
            <div class="plan_item">
                <span style="float:right;"><?php echo $html->link("ver más",
                            array('controller'=> 'planes', 'action'=>'view', $plan['Plan']['id']),
                            null,null,false);
                      ?>
                </span>
                <table class="tabla_plan" width="100%"border="2" cellpadding="2" cellspacing="0">
                    <caption class="plan_title">
                        <?php echo $html->link(
                                $plan['Plan']['nombre'],
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
                <tr>
                    <th>Año</th>
                    <th>Matrícula</th>
                    <th>Secciones</th>
                    <th>Horas Taller</th>
                </tr>
                <?php
                foreach($plan['Anio'] as $anio){
                ?>
                <tr>
                    <td><?php echo $anio['anio']?>º</td>
                    <td><?php echo $anio['matricula']?></td>
                    <td><?php echo $anio['secciones']?></td>
                    <td><?php echo $anio['hs_taller']?></td>
                </tr>
                <?php
                }?>
             </table>
             </div>
            <br />
            <?php
            }
        }
        ?>
</div>
<script type="text/javascript">
    jQuery('#tabs-1 .plan_item').biggerlink();
</script>
