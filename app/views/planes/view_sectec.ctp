<?php
    echo $javascript->link('jquery.biggerlink.min.js');
?>
<div id="tabs-1">
        
        <?php
        foreach($planes as $plan){
        ?>
        <div style="border:1px solid #E0EAEF;margin-bottom:15px;padding:5px">
        <h2>
            <?php echo $plan['Plan']['EstructuraPlan']['Etapa']['name']?> - <?php echo $plan['Plan']['nombre']?>
        </h2>
        <!--<?php echo $html->link(
                    $html->image("modify.png", array("alt" => "Editar")),
                    array('controller'=> 'anios', 'action'=>'editCiclo', $plan['Plan']['id'], $ciclo),
                    array(
                        'style'=> 'float:right;margin-left: 10px;',
                        'onclick'=>'agregar_datos_anios(this);return false;',
                        'class'=>'ajax-link'),null,false);
        ?>-->
            <table width="100%"border="2" cellpadding="2" cellspacing="0">
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
                <td><?php echo $anio['EstructuraPlanesAnio']['nro_anio']?>º</td>
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
        ?>
</div>
<script type="text/javascript">
    jQuery('#tabs-1 .plan_item').biggerlink();
</script>
