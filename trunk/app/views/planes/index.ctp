<?php
    echo $javascript->link('zeroclipboard/ZeroClipboard.js');
    echo $javascript->link('jquery-ui-1.8.5.custom.min.js');
    echo $javascript->link('jquery.loadmask.min');
    echo $html->css('ajaxtabs.css');
    echo $html->css('smoothness/jquery-ui-1.8.5.custom.css');
    echo $html->css(array('jquery.loadmask'));
?>
<?php
	$link = "";
	if($ticket_id != 0)
	{
		$link = "<a class='aPend' href=\"";
		$link .= $html->url(array('controller'=> 'tickets', 'action'=>$action.'/'.$ticket_id));
		$link .= "\" onClick=\"window.open('".$html->url(array('controller'=> 'tickets', 'action'=>$action.'/'.$ticket_id));
		$link .= "','_blank' , 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=310,height=390');";
		$link .= " return false;\">Pendiente de Actualización</a>";
	}
?>
<div id="escuela_estado" class="<? echo $planes['Instit']['activo']? 'instit_activa':'instit_inactiva';?>"><? echo $planes['Instit']['activo']? 'Institución Ingresada al RFIETP':'Institución NO Ingresada al RFIETP';?></div>
<?
$cue_instit = ($planes['Instit']['cue']*100)+$planes['Instit']['anexo'];
?>
<h2><?= $cue_instit ?> - <?= $planes['Instit']['nombre_completo']?></h2>
<div class="tabs">
            <?php
                echo $this->element('menu_solapas_para_instit',array('instit_id' => $planes['Instit']['id']));
            ?>
            <div id="d_clip_button" class="my_clip_button2"></div>
            <input id="infoToCopy" type="hidden" value="<?= ($planes['Instit']['cue']*100)+$planes['Instit']['anexo'] . ' - ' .$planes['Instit']['nombre_completo'] . ' - ' . $planes['Instit']['direccion'] . ' - ' . $planes['Departamento']['name'] . ' - ' . $planes['Localidad']['name'] ?> "/>
            
            <div class="tabs-content">
                <div class="related">

                <?php
                        $link = "";
                        if($ticket_id != 0)
                        {
                                $link = "<div class='aPend' onmouseover=\"this.className='aPend_hover'\" onmouseout=\"this.className='aPend'\"> <a href=\"";
                                $link .= $html->url(array('controller'=> 'tickets', 'action'=>$action.'/'.$ticket_id));
                                $link .= "\" onClick=\"window.open('".$html->url(array('controller'=> 'tickets', 'action'=>$action.'/'.$ticket_id));
                                $link .= "','_blank' , 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=310,height=390');";
                                $link .= " return false;\">Pendiente de Actualización</a></div>";
                        }
                ?>
                <?=$link?>
                <?
                $paginator->options(array('url' => $url_conditions));
                ?>

                <?
                //si el anexo tiene 1 solo digito le coloco un cero adelante
                $anexo = ($planes['Instit']['anexo']<10)?'0'.$planes['Instit']['anexo']:$planes['Instit']['anexo'];
                $cue_instit = $planes['Instit']['cue'].$anexo;
                ?>
                <?php
                if(empty($planes['Plan'])){
                ?>
                    <div class="tabs-content">
                       <h2>Listado de Ofertas</h2>
                           <ul class="lista_fondos" style="padding-top: 20px;">
                           <p class='msg-atencion'>La Institución no presentó ofertas</p>
                       </ul>
                    </div>
                <?php
                }
                ?>
                <?php
                        //if(isset($sumatoria_matriculas['array_de_ciclos'])>0 && isset($sumatoria_matriculas['array_de_ofertas'])>0):
                        if(isset($planes['Plan'])  && count($planes['Plan'])>0):?>
                            <!-- TABS DE CICLOS ULT. ACTUALIZACIONES  -->
                            <div>
                            <?php if(isset($sumatoria_matriculas['array_de_ciclos'])>0 && isset($sumatoria_matriculas['array_de_ofertas'])>0):
                                        $v_matriculas_ciclos = array_reverse($sumatoria_matriculas['array_de_ciclos']);
                                ?>
                                <h2>Total de matriculados por oferta según ciclo lectivo</h2>
                                        <div align="center">
                                                <table class="tabla" width="80" cellpadding = "0" cellspacing = "0" summary="En esta tabla se muestran los totales de
                                                                                                                                matrículas por cada ciclo lectivo, para
                                                                                                                                cada oferta.">
                                                <tr>
                                                        <th>Oferta</th>
                                                        <?php
                                                        foreach($v_matriculas_ciclos as $ciclo):
                                                        echo "<th>$ciclo</th>";
                                                        endforeach;
                                                        ?>
                                                </tr>
                                                <?php
                                                foreach($sumatoria_matriculas['array_de_ofertas'] as $oferta):
                                                ?>
                                                <tr><?php
                                                        $primer_columna = true;
                                                        foreach($v_matriculas_ciclos as $ciclo):
                                                                if($primer_columna):
                                                                        echo "<td>".$oferta['abrev']."</td>";
                                                                $primer_columna = false;
                                                        endif;
                                                        echo "<td>".$sumatoria_matriculas['totales'][$ciclo][$oferta['abrev']]['total_matricula']."</td>";

                                                        endforeach;
                                                ?></tr><?php
                                                endforeach;
                                                ?>
                                                </table>
                                        </div>
                                </div>
                            <?php endif ?>
                            <div>
                                <h2>Listado de Ofertas</h2>
                                <div id="horizontal-tabs">
                                    <ul>
                                        <?php
                                        foreach($ciclos as $oferta=>$ciclo){
                                        ?>
                                            <li><a href="#fragment-<?php echo $oferta?>"><span><?php echo $ciclo['name']?></span></a></li>
                                        <?php
                                        }
                                        ?>
                                    </ul>
                                    <?php
                                    foreach($ciclos as $oferta=>$ciclo){
                                    ?>
                                    <div id="fragment-<?php echo $oferta?>" class="fragment">
                                        <div class="vertical-tabs">
                                            <ul>
                                                    <?php foreach($ciclo['ciclo'] as $anio){?>
                                                    <li><a href="<?php echo $html->url(array('controller'=>'planes', 'action'=>$ofertasControllers[$oferta], $planes['Instit']['id'], $oferta, $anio));?>"><span><?php echo $anio?></span></a></li>
                                                    <?php } ?>
                                            </ul>
                                        </div>
                                    </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                                    

                <?php endif;?>

                <div class="acl actions acl-editores acl-desarrolladores acl-administradores">
                        <ul>
                        <li><?php echo $html->link(__('Nueva Oferta', true), array('controller'=> 'planes', 'action'=>'add/'. $planes['Instit']['id']));?> </li>
                        <li><?php echo $html->link(__('Depurar Institución', true), '/depuradorPlanes/index/'.$planes['Instit']['id']); ?> </li>
                        <?php
                        // Si puede editar y tiene ticket edita, sino crea
                        if($action!='view')
                        {
                                if($ticket_id != 0)
                                        {
                                        ?><li><a href="<?= $html->url(array('controller'=> 'tickets', 'action'=>'edit/'.$ticket_id))?>" onClick="window.open('<?= $html->url(array('controller'=> 'tickets', 'action'=>'edit/'.$ticket_id))?>','_blank' , 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=310,height=390'); return false;">Editar Pendiente</a></li><?
                                        }
                                        else
                                        {
                                        ?><li><a href="<?= $html->url(array('controller'=> 'tickets', 'action'=>'add/'.$planes['Instit']['id']))?>" onClick="window.open('<?= $html->url(array('controller'=> 'tickets', 'action'=>'add/'.$planes['Instit']['id']))?>','_blank' , 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=310,height=260'); return false;">Nuevo Pendiente</a></li><?
                                        }
                                }
                                ?>
                        </ul>
                </div>
            </div>
    </div>
</div>
<script language="JavaScript"  type="text/javascript" defer="defer">
    jQuery(document).ready(function(){
        var clip = new ZeroClipboard.Client();

        ZeroClipboard.setMoviePath('<?php echo $html->url("/js/zeroclipboard/ZeroClipboard10.swf"); ?>');

        clip.setText( '' ); // will be set later on mouseDown
        clip.setHandCursor( true );
        clip.addEventListener( 'mouseDown', function(client) {
           client.setText(jQuery("#infoToCopy").val());
        } );

        clip.glue( 'd_clip_button' );

        jQuery("#horizontal-tabs").tabs({ selected: 0 });

    });

    jQuery(function() {
        jQuery(".vertical-tabs").tabs({ spinner: '<?php echo $html->image('loading.gif') ?>' }).addClass('ui-tabs-vertical ui-helper-clearfix');
        jQuery(".vertical-tabs li").removeClass('ui-corner-top').addClass('ui-corner-left');
    });

</script>

