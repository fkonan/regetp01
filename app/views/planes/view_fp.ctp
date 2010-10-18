<div style="margin-bottom: 1em; padding: 10px">
        <table cellpadding="0" cellspacing="0" class="tabla-con-bordes-celeste">
        <tr>
            <th><?php echo 'Nombre del Título/Certificación'?></th>
            <th><?php echo 'Sector';?></th>
            <th><?php echo 'Mat.';?></th>
            <th><?php echo '&nbsp';?></th>

        </tr>
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
                        <tr id="fila_plan_<?= $plan['Plan']['id'];?>" <?php echo $class;?>
                                        onclick="window.location='<?= $html->url(array('controller'=> 'Planes', 'action'=>'view/'.$plan['Plan']['id']))?>'"
                                        onmouseout="jQuery('#fila_plan_<?= $plan['Plan']['id'];?>').removeClass('fila_marcada')"
                                        onmouseover="jQuery('#fila_plan_<?= $plan['Plan']['id'];?>').addClass('fila_marcada')"
                        >

                                <td>
                                        <?php echo $plan['Plan']['nombre']; ?>
                                </td>
                                <td>
                                        <?php echo $plan['Sector']['name']; ?>
                                </td>
                                <td>
                                        <?php echo $plan['Anio'][0]['matricula']; ?>
                                </td>
                                <td>
                                        <?php echo $html->link(__('Ver', true), array('action'=>'view', $plan['Plan']['id'])); ?>
                                </td>
                        </tr>
        <?php }
        endforeach;
        } else {
        ?>
                <tr>
                        <td colspan=4>
                                &nbsp;
                        </td>
                </tr>
                <tr>
                        <td colspan=4>
                                <?php $año_actual = date('Y',strtotime('now'));?>
                                <?php if($datoUltimoCiclo['max_ciclo'] != $año_actual && $current_ciclo == $año_actual):?>
                                        <p class='msg-atencion'>La Instituci&oacute;n no presenta actualizaciones para este año</p>
                                <?php else:?>
                                        <p class='msg-atencion'>No se obtuvieron resultados</p>
                                <?php endif;?>
                        </td>
                </tr>
        <?php
        } ?>
        </table>
</div>