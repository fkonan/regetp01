<b><?php echo $html->image('attention_icon.gif', array('align:absmiddle')); ?> Existen Títulos con nombre similar:</b>
<div>
    <?php
    $abrio = false;
    foreach ($similars as $k=>$titulo) {
        $pos = strstr($titulo['Titulo']['name'], $name);
        if ($k > 5 && !$abrio) {
    ?>
        <a href="#" id="linkmas" onclick="jQuery('#vermas').attr('style', 'display:block'); jQuery(this).hide(); jQuery('#linkmenos').show();">ver más...</a>
        <a href="#" id="linkmenos" style="display:none;" onclick="jQuery('#vermas').attr('style', 'display:none'); jQuery(this).hide(); jQuery('#linkmas').show();">ver menos...</a>
        <div id="vermas" style="display:none;">
    <?php
            $abrio = true;
        }
    ?>
        &bull; <?=$titulo['Titulo']['name']?><br />
    <?php
    }

    if ($abrio) {
    ?>
        </div>
    <?php
    }
    ?>
</div>