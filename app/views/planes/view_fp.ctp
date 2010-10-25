<?php
    echo $javascript->link('jquery.biggerlink.min.js');
?>
<div id="tabs-oferta" style="margin-bottom: 1em; padding: 10px">
    <div style="margin-bottom:20px">
        <span>Buscar: </span><input id="buscador" type="text"/>
    </div>
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
            <!--<div style="border:1px solid #E0EAEF;margin-bottom:15px;padding:5px;cursor:pointer">-->
            <div class="plan_item">
                <div class="plan_title">
                    <?php echo $html->link($plan['Plan']['nombre'], array('action'=>'view', $plan['Plan']['id'])); ?>
                    <span style="float:right;"><?php echo $html->link("ver más",
                        array('controller'=> 'planes', 'action'=>'view', $plan['Plan']['id']),
                        null,null,false);
                    ?></span>
                </div>
                <div>
                    Sector: <span class="plan_name"><?php echo $plan['Sector']['name']; ?></span>
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
<script type="text/javascript">
    jQuery('#tabs-1 .plan_item').biggerlink();

    jQuery('#buscador').live('keyup', function() {
        jQuery('.plan_item .plan_title a').each(function () {
            if(limpiarCadena(jQuery(this).html()).indexOf(limpiarCadena(jQuery('#buscador').val())) >= 0 ){
                jQuery(this).parent().parent().show();
            }
            else{
                jQuery(this).parent().parent().hide();
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