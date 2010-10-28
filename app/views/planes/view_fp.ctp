<?php
echo $javascript->link('jquery.biggerlink.min.js');
?>
<div id="tabs-oferta" style="margin-bottom: 1em; padding: 10px">
    <span>Título: </span>
    <span style="margin-left:205px;">Sector: </span>
    <div style="margin-bottom:20px">
        <input id="buscador" type="text" style="width:230px; float:left"/>
        <span style="display:inline; vertical-align: bottom">
            <select id="sectores" style="width:200px;margin-left:20px">
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

    jQuery('#buscador').live('keyup', function() {
        jQuery('.plan_item .plan_title > .title').each(function () {
            if(limpiarCadena(jQuery(this).html()).indexOf(limpiarCadena(jQuery('#buscador').val())) >= 0)
            {
                if((jQuery(this).parent().parent().find(".plan_sector").val() == jQuery('#sectores').val()) || jQuery('#sectores').val() == 0){
                    jQuery(this).parent().parent().show();
                }
                else{
                    jQuery(this).parent().parent().hide();
                }
            }
            else{
                jQuery(this).parent().parent().hide();
            }
        });
    });

    jQuery('#sectores').live('change', function() {
        jQuery('.plan_item .plan_sector').each(function () {
            if(jQuery(this).val() == jQuery('#sectores').val() || jQuery('#sectores').val() == 0){
                if(limpiarCadena(jQuery(this).parent().find(".plan_title > .title").html()).indexOf(limpiarCadena(jQuery('#buscador').val())) >= 0)
                {
                    jQuery(this).parent().show();
                }
                else{
                    jQuery(this).parent().hide();
                }
            }
            else{
                jQuery(this).parent().hide();
            }
        });
    });

    function limpiarCadena(string) {
        string = string.toUpperCase();
        string=string.replace(/^\s+|\s+$/g,""); // trim
        string=string.replace(/(À|Á|Â|Ã|Ä|Å|Æ)/gi,'A'); // cambio las "A"s exoticas por "A"s sencillas mediante expresiones regulares
        string=string.replace(/(È|É|Ê|Ë)/gi,'E'); //lo mismo con las "E" y resto de vocales y la "Ñ"
        string=string.replace(/(Ì|Í|Î|Ï)/gi,'I');
        string=string.replace(/(Ò|Ó|Ô|Ö)/gi,'O');
        string=string.replace(/(Ù|Ú|Û|Ü)/gi,'U');
        string = string.toLowerCase();

        return string;
    }
</script>
