<div class="related">
    <?php if (!empty($anios)) {
        //reccorro por cada ciclo
        while (list($key,$ciclo) = each($anios)) {
            $i = 0;
            $tiene_estructura = false;

            if(!empty($ciclo) && !empty($ciclo[0]['estructura_planes_anio_id'])){
                $tiene_estructura = true;
                $plan_id = $ciclo[0]['plan_id'];
            }
            ?>
    <h2>
    <span style="float:left"><?php echo "Ciclo $key" ?></span>
    <span class="acl actions acl-editores acl-administradores acl-desarrolladores">
    <?php if($tiene_estructura){
            echo $html->link(
                    $html->image("modify.png", array("alt" => "Editar")),
                    array('controller'=> 'anios', 'action'=>'editCiclo', $plan_id, $key),
                    array(
                        'style'=> 'margin-left: 10px;',
                        'class'=>'ajax-link'),null,false);

            echo $html->link(
                    $html->image(
                            "delete.png", array(
                                "alt" => "Borrar"
                                )
                            ),
                    array(
                        'controller'=> 'anios',
                        'action'=>'deleteCiclo', $plan_id, $key
                        ),
                    array(
                        'style'=> 'float: right;'
                        ),
                    sprintf('Seguro que desea eliminar el ciclo %s?',$key),
                    false);
    }
    ?>
    </span>
    </h2>
    <table cellpadding = "0" cellspacing = "0">
        <tr>
            <th><?php __('Año'); ?></th>
            <th><?php __('Etapa'); ?></th>
            <th><?php __('Matrícula'); ?></th>
            <th><?php __('Secciones'); ?></th>
            <th><?php __('Horas Taller'); ?></th>
            <th class="actions"><?php __('');?></th>
        </tr>
                <?php
                $tot_matricula = 0;
                $tot_secciones = 0;

                foreach ($ciclo as $anio):
                    $class = null;
                    if ($i++ % 2 == 0) {
                        $class = ' class="altrow"';
                    }
                    ?>

        <tr id="fila_plan_<?= $anio['ciclo_id'].'_'.$anio['anio']?>" <?php echo $class;?>>
            <td><?php echo @$anio['EstructuraPlanesAnio']['alias'];?></td>
            <td><?php echo $this->requestAction('/Etapas/dame_nombre/'.$anio['etapa_id']);?></td>
            <td><?php echo  empty($anio['matricula'])?'-':$anio['matricula'];
            $tot_matricula += $anio['matricula']; ?></td>
            <td><?php echo empty($anio['secciones'])?'-':$anio['secciones'];
            $tot_secciones += $anio['secciones'];?></td>
            <td><?php echo empty($anio['hs_taller'])?'-':$anio['hs_taller'];?></td>
            <td class="acl actions acl-editores acl-administradores acl-desarrolladores">
                <?if(!$tiene_estructura){?>
                <a href="<?= $html->url(array('controller'=> 'anios', 'action'=>'edit/'.$anio['id']))?>"
                   class="ajax-link">Editar</a>
                   <?php echo $html->link(__('Borrar', true), array('controller'=> 'anios', 'action'=>'delete', $anio['id']), null, sprintf(__('Seguro que desea eliminar el año # %s? del ciclo # %s', true), $anio['anio'], $anio['ciclo_id'])); ?>
                <?php }?>
            </td>
        </tr>
        <?php endforeach; //el que recorre los anios del ciclo	?>


        <tr <?php echo $class;?> >
            <td style="border-top: 1px silver solid;"><?php echo '';?></td>
            <td style="border-top: 1px silver solid;"><?php echo '<b>Totales</b>';?></td>
            <td style="border-top: 1px silver solid;"><b><?php echo $tot_matricula;?></b></td>
            <td style="border-top: 1px silver solid;"><b><?php echo $tot_secciones;?></b></td>
            <td style="border-top: 1px silver solid;"><?php echo '';?></td>
            <td class="actions" style="border-top: 1px silver solid;"><?php echo '';?></td>
        </tr>
    </table>
            <?php }// fin del WHILE...el que recorre los ciclos, los años?>

        <?php }else {?>
    <h2>No Hay Ciclos</h2>
    <?
} ?>
</div>