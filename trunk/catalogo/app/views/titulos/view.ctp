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
<h2><?php echo $titulo['Titulo']['name']?></h2>
<div class="grid_12 boxblanca">
    <dl style="padding-left: 20px;">
        <dt ><?php __('Oferta'); ?>:</dt>
        <dd>
            <?php
            if(!empty($titulo['Oferta']['name'])) {
                echo $titulo['Oferta']['name'];
            }else {
                echo "<i>No declarado</i>";
            } ?>
        </dd>

        <dt ><?php __('Marco de referencia'); ?>:</dt>
        <dd>
            <?php
            if($titulo['Titulo']['marco_ref'] == 1) {
                echo "Con marco de referencia";
            }else {
                echo "Sin marco de referencia";
            } ?>
        </dd>

        <dt ><?php __('Sectores/Subsectores'); ?>:</dt>
        <dd>
            <?php
            foreach ($titulo['SectoresTitulo'] as $sector) {
                echo $sector['Sector']['name'];
                echo (!empty($sector['Subsector']['name']) ? '/'.$sector['Subsector']['name'] : '' );
                echo "<br />";
            } ?>
        </dd>
    </dl>
</div>
<div class="clear" style="height:20px;"></div>
<h4><?php  __('Instituciones con Planes de Estudio asociados');?></h4>
<div id="tituloPlanes" class="grid_12">
    <?php echo $this->requestAction('/titulos/ajax_view_planes_asociados/'.$titulo['Titulo']['id'], array('return')); ?>
</div>
