<h1>Descargas</h1>

<?php
echo $javascript->link('jquery-ui-1.8.5.custom.min.js',false);
echo $html->css('ajaxtabs.css',null, false);
echo $html->css('planes/ui_tabs.css',null, false);
echo $html->css('smoothness/jquery-ui-1.8.10.custom.css',null, false);
?>

<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('.js-tabs-ofertas').tabs();

        jQuery('.descarga_mas_info').click(function(){
            var $dialog = jQuery('<div id="create_dialog"></div>')
                .html('...Cargando vista previa de la descarga')
		.dialog({
                        width: 750,
                        height:400,
                        position: 'top',
                        zIndex: 3999,
			title: 'Vista Previa de la  Descarga',
                        beforeclose: function(event, ui) {
                            jQuery(".ui-dialog").remove();
                            jQuery("#create_dialog").remove();
                        }
            }).parents('.ui-dialog:eq(0)').wrap('<div class="descarga-dialog"></div>');

            jQuery.ajax({
              url: jQuery(this).find('a').attr('href'),
              cache: false,
              success: function(data) {
                $dialog.find('#create_dialog').html(data);

              }
            });
            return false;
        });
    })
</script>

<div>
    <div class="js-tabs-ofertas tabs">
        <ul id="ofertas-tabs" class="horizontal-shadetabs">
            <li>
                <a id="htab-h"
                   href="#ver-oferta-h">
                    Habituales
                </a>
            </li>
            <li>
                <a id="htab-t"
                   href="#ver-oferta-t">
                    Temporales
                </a>
            </li>
        </ul>

        <div id="ver-oferta-h" class="descargas-container" style="">
            <?php
            $i = 0;
            foreach ($queries['h'] as $q):?>
                    <div class="descarga_item <?php echo ($i%2 == 0)? 'altrow':''; ?>">
                        <div class="plan_title">
                            <span class="descarga_mas_info btn-print">
                                <? echo $html->link('Preview', array('action'=>'list_view',$q['Query']['id'],'preview:true'));?>
                            </span>
                            <?= $html->link('Nº' .$q['Query']['id'] . ' - '. $q['Query']['name'],'contruye_excel/'.$q['Query']['id']); ?>
                        </div>
                        <div>
                            <span class="plan_matricula_info">
                                <p><?php echo strip_tags($q['Query']['description'],'<br />'); ?></p>
                            </span>
                        </div>
                    </div>
                    <?php
                    $i++;
            endforeach;
            ?>
	</div>

        <div id="ver-oferta-t" class="descargas-container" style="">
            <p>Las siguientes descargas fueron requeridas para casos particulares. Las mismas son temporales y serán eliminadas eventualmente.</p>
            <?php
            $i = 0;
            foreach ($queries['t'] as $q):?>
                    <div class="descarga_item <?php echo ($i%2 == 0)? 'altrow':''; ?>">
                        <div class="plan_title">
                            <span class="descarga_mas_info btn-print">
                                <? echo $html->link('Preview', array('action'=>'list_view',$q['Query']['id'],'preview:true'));?>
                            </span>
                            <?= $html->link('Nº' .$q['Query']['id'] . ' - '. $q['Query']['name'],'contruye_excel/'.$q['Query']['id']); ?>
                        </div>
                        <div>
                            <span class="plan_matricula_info">
                                <p><?php echo strip_tags($q['Query']['description'],'<br />'); ?></p>
                            </span>
                        </div>
                    </div>
                    <?php
                    $i++;
            endforeach;
            ?>
	</div>

    </div>
</div>