<?php
echo $javascript->link('jquery.biggerlink.min.js');
?>
<div id="tabs-oferta" style="margin-bottom: 1em; padding: 10px">
    <span>Título: </span>
    <span style="margin-left:205px;">Sector: </span>
    <div style="margin-bottom:20px">
        <input id="buscador" type="text" style="width:30%; float:left"/>
        <span style="display:inline; vertical-align: bottom">
            <select id="sectores" style="width:30%;margin-left:20px">
                <option value="0">Todos</option>
                <?php
                foreach ($sectores as $sector) {
                    ?>
                <option value="<?php echo $sector['Sector']['id']?>"><?php echo $sector['Sector']['name']?></option>
                    <?
                }
                ?>
            </select>
        </span>
        <span style="display:inline; vertical-align: bottom">
            <select id="ciclos" style="width:20%;margin-left:20px">
                <option value="0">Todos</option>
            <?php
            foreach($ciclos_anios as $ciclos_anio){
            ?>
                <option value="<?php echo $ciclos_anio;?>"><?php echo $ciclos_anio;?></option>
            <?
            }
            ?>
            </select>
        </span>
    </div>
    <?php
    $i = 0;
    if ((isset($planes)) && (count($planes) > 0)) {
        foreach ($planes as $plan):
            if(count($plan['Anio']) > 0) {
                $class = null;
                if ($i++ % 2 == 0) {
                    $class = 'altrow';
                }
                ?>
    <div class="plan_item <?php echo $class?>">
        <span class="plan_title">
                        <?php
                        echo $html->link($plan['Plan']['nombre'],
                        array('action'=>'view', $plan['Plan']['id']),array('class'=>'title'));
                        ?>
        </span>
        <span style="float:right;">
                        <?php
                        echo $html->link("más info",array('controller'=> 'planes', 'action'=>'view', $plan['Plan']['id']),
                        null,null,false);
                        ?>
        </span>
        <div>
           Matrícula: <?php echo $plan['Anio'][0]['matricula']; ?>
            <span style="float:right;">
                 Sector: <span class="plan_name"><?php echo $plan['Sector']['name']; ?></span>
            </span>
        </div>
        <input class="plan_sector" type="hidden" value="<?php echo $plan['Sector']['id']?>"/>
        <input class="plan_ciclo" type="hidden" value="<?php echo $plan['Anio'][0]['ciclo_id']?>"/>
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
<script type="text/javascript">
    jQuery('#tabs-1 .plan_item').biggerlink();

    
</script>
