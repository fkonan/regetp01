<b><?php echo $html->image('attention_icon.gif', array('align:absmiddle')); ?> Existen T�tulos con nombre similar:</b>
<div>
    <?php
    $abrio = $identicos = false;
    foreach ($similars as $k=>$titulo) {
        if ($titulo['Titulo']['name'] == $name) {
            $identicos = true;
        }
        else {
            $identicos = false;
        }

        if ($k > 5 && !$abrio) {
    ?>
        <a href="#" id="linkmas" onclick="jQuery('#vermas').attr('style', 'display:block'); jQuery(this).hide(); jQuery('#linkmenos').show();">ver m�s...</a>
        <a href="#" id="linkmenos" style="display:none;" onclick="jQuery('#vermas').attr('style', 'display:none'); jQuery(this).hide(); jQuery('#linkmas').show();">ver menos...</a>
        <div id="vermas" style="display:none;">
    <?php
            $abrio = true;
        }
    ?>
            &bull; <?php if ($identicos) {?><span style="color:red;"><? }?><?=$titulo['Titulo']['name']?><?php if ($identicos) {?></span><? }?><br />
    <?php
    }

    if ($abrio) {
    ?>
        </div>
    <?php
    }
    ?>
</div>