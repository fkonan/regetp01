<script type="text/javascript">
jQuery(document).ready(function() {
        if (jQuery("#arrowlink").attr("src") == "<?php echo $html->url('/img'); ?>/arrow_down.png") {
            jQuery("#arrowlink").attr("src", "<?php echo $html->url('/img'); ?>/arrow_up.png");
        }
        else {
            jQuery("#arrowlink").attr("src", "<?php echo $html->url('/img'); ?>/arrow_down.png");
        }
    });
</script>
<div class="titulosview">
    <ul>
        <li class="altrow">
            <strong><?php __('Oferta'); ?>:</strong> <?php echo $plan['Oferta']['name']; ?>
        </li>
        <li class="altrow">
            <strong><?php echo ($plan['Titulo']['marco_ref']==1)? "Con marco de referencia":"Sin marco de referencia"; ?></strong>
            <?php if ($plan['Titulo']['marco_ref'] == 1) { ?>
            [<a href="<?php echo $html->url('/pages/marcos')?>" style="color: #0082CA;">Ver documentación sobre marcos de referencia</a>]
            <?php } ?>
        </li>
        <li class="altrow">
            <strong><?php __('Sectores/Subsectores'); ?>:</strong>
        <?php
        foreach ($plan['Titulo']['SectoresTitulo'] as $sector) {
        ?>
                <?php echo $sector['Sector']['name']; ?>
                <?php echo (!empty($sector['Subsector']['name']) ? '/ '.$sector['Subsector']['name'] : '' ); ?>
        <?php
        }
        ?>
        </li>
        <li class="altrow">
            <strong><?php __('Normativa'); ?>:</strong> <?php echo $plan['Plan']['norma']; ?>
        </li>
        <?php
        if (!empty($plan['Anio'][0]['ciclo_id'])) {
        ?>
        <li class="altrow">
            <strong><?php __('Ultima actualización'); ?>:</strong> <?php echo $plan['Anio'][0]['ciclo_id']; ?>
        </li>
        <?php }?>
    </ul>
</div>
