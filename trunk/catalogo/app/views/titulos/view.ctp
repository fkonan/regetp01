<script type="text/javascript">
jQuery(document).ready(function() {

    jQuery("#resumenplanes").hide();

    jQuery("#resumenlink").click(function() {
        jQuery("#resumenplanes").toggle('slow');

        if (jQuery("#arrowlink").attr("src") == "<?php echo $html->url('/img'); ?>/arrow_down.png") {
            jQuery("#arrowlink").attr("src", "<?php echo $html->url('/img'); ?>/arrow_up.png");
        }
        else {
            jQuery("#arrowlink").attr("src", "<?php echo $html->url('/img'); ?>/arrow_down.png");
        }
    });
});
</script>
<div class="titulosview">
    <dl><?php $i = 0; $class = ' class="altrow"';?>
            <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Oferta'); ?></dt>
            <dd<?php if ($i++ % 2 == 0) echo $class;?>>
                    <?php echo $titulo['Oferta']['name']; ?>
                    &nbsp;
            </dd>
            <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Marco de referencia'); ?></dt>
            <dd<?php if ($i++ % 2 == 0) echo $class;?>>
                    <?php echo ($titulo['Titulo']['marco_ref']==1)? "Con marco de referencia":"Sin marco de referencia"; ?>
                    &nbsp;
            </dd>
            <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Sectores/Subsectores'); ?></dt>
            <?php
            foreach ($titulo['SectoresTitulo'] as $sector) {
            ?>
                <dd<?php if ($i++ % 2 == 0) echo $class;?>>
                    <?php echo $sector['Sector']['name']; ?>
                    <?php echo (!empty($sector['Subsector']['name']) ? '/ '.$sector['Subsector']['name'] : '' ); ?>
                </dd>
            <?php
            }
            ?>
    </dl>
    <br />
    <h3><?php  __('Instituciones con Planes de Estudio asociados');?></h3>
    <div id="tituloPlanes">
        <?php echo $this->requestAction('/titulos/ajax_view_planes_asociados/'.$titulo['Titulo']['id'], array('return')); ?>
    </div>
</div>
