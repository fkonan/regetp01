<h1>Descargas</h1>

<?php
echo $javascript->link('jquery-ui-1.8.5.custom.min.js',false);
echo $html->css('ajaxtabs.css',null, false);
echo $html->css('planes/ui_tabs.css',null, false);
echo $html->css('smoothness/jquery-ui-inet.custom.css',null, false);
?>

<script type="text/javascript">
    jQuery(document).ready(function(){
        
        
        jQuery(".acordiones").accordion();

        jQuery('.acordion .head').click(function() {
		$(this).next().toggle('slow');
		return false;
	}).next().hide();

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
            <div class="acordiones">
            <?php
            $i = 0;
            foreach ($queries['h'] as $q):?>

                    <h3>
                        <a href="#"><?php echo 'Nº' .$q['Query']['id'] . ' - '. $q['Query']['name']?></a>
                    </h3>
                    <div>
                        <div style="border:3px solid #F0F7FC;background-color: #EDEAEA;margin: 1px; padding: 2px;float:right">
                            <span class="descarga_mas_info">
                                <? echo $html->link($html->image("preview.png"),
                                                    array('action'=>'list_view', $q['Query']['id'],'preview:true'),
                                                    array(),
                                                    null,
                                                    false
                                                   );?>
                            </span>
                            <span>
                                <? echo $html->link($html->image("download.png"),
                                                    array('action'=>'contruye_excel', $q['Query']['id']),
                                                    array(),
                                                    null,
                                                    false
                                                   );?>
                            </span>
                            <?php if($q['Query']['ver_online']){?>
                            <span>
                                <? echo $html->link($html->image("view.png"),
                                                    array('action'=>'list_view', $q['Query']['id']),
                                                    array(),
                                                    null,
                                                    false
                                                   );?>
                            </span>
                            <?php } ?>
                        </div>
                        <p><?php echo strip_tags($q['Query']['description'],'<br />'); ?></p>
                    </div>
                    <!--<div class="descarga_item <?php echo ($i%2 == 0)? 'altrow':''; ?>">
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
                    -->
                    <?php
                    $i++;
            endforeach;
            ?>
            </div>
	</div>
        <div id="ver-oferta-t" class="descargas-container" style="">
            <p>Las siguientes descargas fueron requeridas para casos particulares. Las mismas son temporales y serán eliminadas eventualmente.</p>
            <div class="acordiones">
            <?php
            $i = 0;
            foreach ($queries['t'] as $q):?>

                    <h3>
                        <a href="#"><?php echo 'Nº' .$q['Query']['id'] . ' - '. $q['Query']['name']?></a>
                    </h3>
                    <div>
                        <div style="border:3px solid #F0F7FC;background-color: #EDEAEA;margin: 1px; padding: 2px;float:right">
                            <span class="descarga_mas_info">
                                <? echo $html->link($html->image("preview.png"),
                                                    array('action'=>'list_view', $q['Query']['id'],'preview:true'),
                                                    array(),
                                                    null,
                                                    false
                                                   );?>
                            </span>
                            <span>
                                <? echo $html->link($html->image("download.png"),
                                                    array('action'=>'contruye_excel', $q['Query']['id']),
                                                    array(),
                                                    null,
                                                    false
                                                   );?>
                            </span>
                            <?php if($q['Query']['ver_online']){?>
                            <span>
                                <? echo $html->link($html->image("view.png"),
                                                    array('action'=>'list_view', $q['Query']['id']),
                                                    array(),
                                                    null,
                                                    false
                                                   );?>
                            </span>
                            <?php } ?>
                            
                        </div>
                        <p><?php echo strip_tags($q['Query']['description'],'<br />'); ?></p>
                    </div>
                    <!--<div class="descarga_item <?php echo ($i%2 == 0)? 'altrow':''; ?>">
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
                    -->
                    <?php
                    $i++;
            endforeach;
            ?>
            </div>
        </div>
    </div>
</div>