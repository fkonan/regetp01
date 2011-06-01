<?php
echo $html->css(array('catalogo.titulos'));
?>
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
    <ul style="padding-left:5px;">
        <li class="altrow">
            <strong><?php __('Oferta'); ?>:</strong> <?php echo $titulo['Oferta']['name']; ?>
        </li>
        <li class="altrow">
            <strong><?php __('Marco de referencia'); ?>:</strong> <?php echo ($titulo['Titulo']['marco_ref']==1)? "Con marco de referencia":"Sin marco de referencia"; ?>
        </li>
        <li class="altrow">
            <strong><?php __('Sectores/Subsectores'); ?>:</strong>
        <?php
        foreach ($titulo['SectoresTitulo'] as $sector) {
        ?>
                <?php echo $sector['Sector']['name']; ?>
                <?php echo (!empty($sector['Subsector']['name']) ? '/ '.$sector['Subsector']['name'] : '' ); ?>
        <?php
        }
        ?>
        </li>
    </ul>
    
    <h4><?php  __('Instituciones con Planes de Estudio asociados');?></h4>
    <div id="tituloPlanes">
        <?php echo $this->requestAction('/titulos/ajax_view_planes_asociados/'.$titulo['Titulo']['id'], array('return')); ?>
    </div>
</div>
