<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery(".clickeable").click(function(){
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
<h2><?php __('JurisdiccionesEstructuraPlan');?></h2>
<?php echo $form->create('JurisdiccionesEstructuraPlan', array('action'=>'index'));?>
<?php echo $form->hidden('jurisdiccion_id',array('name'=>'data[jurisdiccion_id]','value'=> $jurisdiccion_id))?>

<?php
$i = 0;
$j = 0;
$etapa_anterior = '';
$colors = array('green','blue','chreme');
foreach ($trayectos_asignados as $jurisdiccionesTrayecto):
?>
            <?php echo $form->hidden('estructura_plan_id',array('name'=>'data[JurisdiccionesEstructuraPlan]['. $i . '][estructura_plan_id]','value'=> $jurisdiccionesTrayecto['EstructuraPlan']['id']))?>
            <?php echo $jurisdiccionesTrayecto['EstructuraPlan']['name']; ?>
            <div id="timelineLimiter" class="clickeable green">
                <div id="timelineScroll" style="margin-left: 0px;">
                    <span style="width:55px;display:inline;float:left;margin-top:7px">Edades:</span>
                    <ul class="edadesList">
                        <?php
                        $j = 0;
                        foreach($jurisdiccionesTrayecto['EstructuraPlan']['EstructuraPlanesAnio'] as $anio ):
                        ?>
                            <li><?php echo $anio['edad_teorica'];?>º</li>
                        <?php
                        endforeach;
                        ?>
                    </ul>
                    <div class="events">
                        <div class="event">
                            <div class="eventHeading <?php echo $colors[$j++%3]?>"><?php echo $jurisdiccionesTrayecto['EstructuraPlan']['Etapa']['name']?></div>
                                <ul class="eventList">
                        <?php
                        $j = 0;
                        foreach($jurisdiccionesTrayecto['EstructuraPlan']['EstructuraPlanesAnio'] as $anio ):
                        ?>
                            <li><?php echo $anio['anio'];?></li>
                        <?php
                        endforeach;
                        ?>
                                </ul>
                        </div>
                        <div class="instit_link_list" style="clear:none">
                            <?php echo $form->checkbox('asignado',array('name'=>'data[JurisdiccionesEstructuraPlan]['. $i . '][asignado]','checked'=>'checked')); ?>
                        </div>
                    </div>
                </div>
            </div>
<?php
$j = 0;
$i++;
endforeach; ?>


















<?php
foreach ($trayectos_restantes as $jurisdiccionesTrayecto):
?>
            <?php echo $form->hidden('estructura_plan_id',array('name'=>'data[JurisdiccionesEstructuraPlan]['. $i . '][estructura_plan_id]','value'=> $jurisdiccionesTrayecto['EstructuraPlan']['id']))?>
            <?php echo $jurisdiccionesTrayecto['EstructuraPlan']['name']; ?>
            <div id="timelineLimiter" class="clickeable">
                <div id="timelineScroll" style="margin-left: 0px;">
                     <span style="width:55px;display:inline;float:left;margin-top:7px">Edades:</span>
                    <ul class="edadesList">
                        <?php
                        $j = 0;
                        foreach($jurisdiccionesTrayecto['EstructuraPlanesAnio'] as $anio ):
                        ?>
                            <li><?php echo $anio['edad_teorica'];?></li>
                        <?php
                        endforeach;
                        ?>
                    </ul>
                    <div class="events">
                        <div class="event">
                            <div class="eventHeading <?php echo $colors[$j++%3]?>"><?php echo $jurisdiccionesTrayecto['Etapa']['name']?></div>
                            <ul class="eventList">
                                <?php
                                $j = 0;
                                foreach($jurisdiccionesTrayecto['EstructuraPlanesAnio'] as $anio ):
                                ?>
                                            <li><?php echo $anio['anio'];?>º</li>
                                <?php
                                endforeach;
                                ?>
                            </ul>
                        </div>
                        <div class="instit_link_list" style="clear:none">
                            <?php echo $form->checkbox('asignado',array('name'=>'data[JurisdiccionesEstructuraPlan]['. $i . '][asignado]')); ?>
                        </div>
                    </div>
                </div>
            </div>
<?php
$i++;
endforeach; ?>

</div>
<?php echo $form->end('Guardar');?>
