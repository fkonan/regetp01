<div style="margin-bottom: 1em; padding: 10px">
        <?php
        $i = 0;
        if ((isset($planes)) && (count($planes) > 0)){
                foreach ($planes as $plan):
                        if(count($plan['Anio']) > 0){
                        $class = null;
                        if ($i++ % 2 == 0) {
                                $class = ' class="altrow"';
                        }
                ?>
                        <div style="border:1px solid #E0EAEF;margin-bottom:15px;padding:5px;cursor:pointer">
                                <span style="float:right;display:block;clear:both">
                                        <?php echo $html->link(__('Ver', true), array('action'=>'view', $plan['Plan']['id'])); ?>
                                </span>
                                <div>
                                    Nombre:<?php echo $plan['Plan']['nombre']; ?>
                                </div>
                                <div>
                                    Sector: <?php echo $plan['Sector']['name']; ?>
                                </div>
                                <div>
                                    Matricula: <?php echo $plan['Anio'][0]['matricula']; ?>
                                </div>
                                
                        </div>
        <?php }
        endforeach;
        } else {
        ?>
                
                        <div>
                                <?php $año_actual = date('Y',strtotime('now'));?>
                                <?php if($datoUltimoCiclo['max_ciclo'] != $año_actual && $current_ciclo == $año_actual):?>
                                        <p class='msg-atencion'>La Instituci&oacute;n no presenta actualizaciones para este año</p>
                                <?php else:?>
                                        <p class='msg-atencion'>No se obtuvieron resultados</p>
                                <?php endif;?>
                        </div>
        <?} ?>
</div>