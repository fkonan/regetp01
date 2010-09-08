<?php




if (!empty($anios))
{
    $j = 0;
    $etapa_anterior = '';
    $colors = array('color1','color2','color3');
    ?>
    <div id="timelineLimiterMini" style="padding:3px" class="clickeable <?php echo ($depurado)?'green':'red'?>">
        <div id="timelineScroll">
                <?php
                $j = 0;
                foreach($anios as $anio ):
                    if($etapa_anterior != $anio['Etapa']['id']){
                        if(!empty($etapa_anterior)){
                            echo '</ul></div>';
                        }
                        $etapa_anterior = $anio['Etapa']['id'];
                        ?>
                    <div class="event">
                    <div class="eventHeading <?php echo limpiar_nombre($anio['Etapa']['name'])?>"><?php echo $anio['Etapa']['name']?></div>
                        <ul class="eventList">
                <?php
                    }
                ?>
                            <li class="<?php echo limpiar_nombre($anio['Etapa']['name'])?>"><?php echo $anio['anio'];?>º</li>
                <?php
                endforeach;
                ?>
                        </ul>
                    </div>
            </div>
    </div>
<?php
}
else {
?>
<div class="vacio" id="timelineLimiterMini">
    <div id="timelineScroll">
        <p>Vacío</p>
    </div>
</div>
<?php
}
?>