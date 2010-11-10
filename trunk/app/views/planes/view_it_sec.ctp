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
                            <span style="float:right;"><?php echo $html->link("ver más",
                                array('controller'=> 'planes', 'action'=>'view', $plan['Plan']['id']),
                                null,null,false);
                            ?></span>
                        </caption>
                        <thead>
                            <tr>
                                <th>Año</th>
                                <th>Etapa</th>
                                <th>Matrícula</th>
                                <th>Secciones</th>
                                <th>Horas Taller</th>
                            </tr>
                        </thead>
                        <?php
                        foreach($plan['Anio'] as $anio){
                        ?>
                        <tr>
                            <td><?php echo $anio['anio']?>º</td>
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
            else { //mostrar todos
                $class = null;
                if ($i++ % 2 == 0)
                    $class = 'altrow';

                $ciclo_plan = '';
                $ciclo_id = 0;
                if (!empty($plan['Anio'][0]['ciclo_id']))
                    $ciclo_id = $plan['Anio'][0]['ciclo_id'];
                $ciclo_plan =  (!empty($ciclo_id)? $ciclo_id:"") ;
                
                echo $this->element('planes/plan_resumen_para_listado', array(
                    'class' => $class,
                    'plan'  => $plan,
                    'ciclo' => $ciclo_plan,
                ));               
            }
        }
        ?>
</div>
