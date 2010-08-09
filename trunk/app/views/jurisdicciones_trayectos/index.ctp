<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery("#timelineLimiter").click(function(){
            jQuery(this).toggleClass("green");
            if(jQuery(this).hasClass("green")){
                jQuery(this).find("#JurisdiccionesTrayectoAsignado").attr("checked", "checked");
            }else{
                jQuery(this).find("#JurisdiccionesTrayectoAsignado").removeAttr("checked");
            }
            
        });
    });
</script>
<div class="jurisdiccionesTrayectos index">
<h2><?php __('JurisdiccionesTrayectos');?></h2>

<?php echo $form->create('JurisdiccionesTrayecto', array('action'=>'index'));?>
<?php echo $form->hidden('jurisdiccion_id',array('name'=>'data[jurisdiccion_id]','value'=> $jurisdiccion_id))?>

<?php
$i = 0;
$j = 0;
$etapa_anterior = '';
$colors = array('green','blue','chreme');
foreach ($trayectos_asignados as $jurisdiccionesTrayecto):
?>
            <?php echo $form->hidden('trayecto_id',array('name'=>'data[JurisdiccionesTrayecto]['. $i . '][trayecto_id]','value'=> $jurisdiccionesTrayecto['Trayecto']['id']))?>
            <!--<?php echo $jurisdiccionesTrayecto['Trayecto']['name']; ?>-->
            <div id="timelineLimiter" class="green">
            <div id="timelineScroll" style="margin-left: 0px;">
            <?php
            $j = 0;
            foreach($jurisdiccionesTrayecto['Trayecto']['TrayectoAnio'] as $anio ):
                if($etapa_anterior != $anio['Etapa']['id']){
                    if(!empty($etapa_anterior)){
                        echo '</ul></div>';
                    }
                    $etapa_anterior = $anio['Etapa']['id'];
                    ?>
                <div class="event">
                <div class="eventHeading <?php echo $colors[$j++%3]?>"><?php echo $anio['Etapa']['name']?></div>
                    <ul class="eventList">
            <?php
                }
            ?>
                        <li><?php echo $anio['anio'];?>º</li>
            <?php 
            $j++;
            endforeach;
            ?>
                    </ul>
                </div>
            <div class="instit_link_list" style="clear:none">
                <?php echo $form->checkbox('asignado',array('name'=>'data[JurisdiccionesTrayecto]['. $i . '][asignado]','checked'=>'checked')); ?>
            </div>
            </div>
            </div>
<?php
$i++;
endforeach; ?>

<?php
$etapa_anterior = '';
foreach ($trayectos_restantes as $jurisdiccionesTrayecto):
?>
            <?php echo $form->hidden('trayecto_id',array('name'=>'data[JurisdiccionesTrayecto]['. $i . '][trayecto_id]','value'=> $jurisdiccionesTrayecto['Trayecto']['id']))?>
            <!--<?php echo $jurisdiccionesTrayecto['Trayecto']['name']; ?>-->
            <div id="timelineLimiter">
            <div id="timelineScroll" style="margin-left: 0px;">
            <?php
            $j = 0;
            foreach($jurisdiccionesTrayecto['TrayectoAnio'] as $anio ):
                if($etapa_anterior != $anio['Etapa']['id']){
                    if(!empty($etapa_anterior)){
                        echo '</ul></div>';
                    }
                    $etapa_anterior = $anio['Etapa']['id'];
                    ?>
                <div class="event">
                <div class="eventHeading <?php echo $colors[$j++%3]?>"><?php echo $anio['Etapa']['name']?></div>
                    <ul class="eventList">
            <?php
                }
            ?>
                        <li><?php echo $anio['anio'];?>º</li>
            <?php
            $j++;
            endforeach;
            ?>
                    </ul>
                </div>
            <div class="instit_link_list" style="clear:none">
                <?php echo $form->checkbox('asignado',array('name'=>'data[JurisdiccionesTrayecto]['. $i . '][asignado]')); ?>
            </div>
            </div>
            </div>
<?php
$i++;
endforeach; ?>

</div>
<?php echo $form->end('Guardar');?>
