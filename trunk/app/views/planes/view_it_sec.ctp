<div id="tabs-oferta-it-sec" class="oferta-contanier">
        <?php
        $i = 0;
        foreach($planes as $plan) {
            if ($ciclo > 0)
            {
                if (!empty($plan['Anio'])) {
                ?>
                <div class="plan_item">
                    <table class="tabla_plan" width="100%" border="2" cellpadding="2" cellspacing="0">
                        <caption>
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
                            <span style="float:right;"><?php echo $html->link("ver m�s",
                                array('controller'=> 'planes', 'action'=>'view', $plan['Plan']['id']),
                                null,null,false);
                            ?></span>
                        </caption>
                        <thead>
                            <tr>
                                <th>A�o</th>
                                <th>Etapa</th>
                                <th>Matr�cula</th>
                                <th>Secciones</th>
                                <th>Horas Taller</th>
                            </tr>
                        </thead>
                        <?php
                        foreach($plan['Anio'] as $anio){
                        ?>
                        <tr>
                            <td><?php echo $anio['anio']?>�</td>
                            <td><?php echo $anio['Etapa']['name'];?></td>
                            <td><?php echo $anio['matricula']?></td>
                            <td><?php echo $anio['secciones']?></td>
                            <td><?php echo $anio['hs_taller']?></td>
                        </tr>
                    <?php
                    }?>
                    </table>
                 </div>
                <?php
                }
            }
            else {
                $class = null;
                if ($i++ % 2 == 0)
                    $class = 'altrow';
            ?>
                <div class="plan_item <?php echo $class?>">
                    <span class="plan_title">
                                    <?php
                                    if (@current($plan['Anio'])) {
                                        $primer_anio = current($plan['Anio']);
                                        echo " (" . $primer_anio['ciclo_id'] . ")";

                                        ?>
                                        -
                                    <?php
                                    }
                                    echo $html->link($plan['Plan']['nombre'],
                                    array('action'=>'view', $plan['Plan']['id']),array('class'=>'title'));
                                    ?>
                    </span>
                    <span class="plan_mas_info">
                                    <?php
                                    echo $html->link("m�s info",array('controller'=> 'planes', 'action'=>'view', $plan['Plan']['id']),
                                    null,null,false);
                                    ?>
                    </span>
                    <div>
                        Matr�cula: <?php echo empty($plan['Plan']['matricula'])?0:$plan['Plan']['matricula']; ?>
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
