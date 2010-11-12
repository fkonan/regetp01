<?php
echo $javascript->link('zeroclipboard/ZeroClipboard.js',false);
echo $javascript->link('jquery-ui-1.8.5.custom.min.js',false);

echo $javascript->link('jquery.loadmask.min',false);
    echo $javascript->link('async.js',false);

echo $html->css('ajaxtabs.css',null, false);
echo $html->css('planes/ui_tabs.css',null, false);

$link = "";
if($ticket_id != 0) {
    $link = "<a class='aPend' href=\"";
    $link .= $html->url(array('controller'=> 'tickets', 'action'=>$action.'/'.$ticket_id));
    $link .= "\" onClick=\"window.open('".$html->url(array('controller'=> 'tickets', 'action'=>$action.'/'.$ticket_id));
    $link .= "','_blank' , 'toolbar=0,scro  llbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=310,height=390');";
    $link .= " return false;\">Pendiente de Actualizaci�n</a>";
}
?>
<script language="JavaScript" type="text/javascript" defer="defer">
    jQuery(document).ready(function(){
        
        // introduce la logic que hacen funcionar al copy paste
        meterCopyPasteDelNombre('<?php echo $html->url("/js/zeroclipboard/ZeroClipboard10.swf"); ?>');
        

        jQuery('.js-tabs-ofertas').tabs({
            //ajaxOptions: { contentType: 'application/x-www-form-urlencoded; charset=utf-8' }
        });

        jQuery('.js-tabs-ciclos').tabs({
            spinner: '<?php echo $html->image('loadercircle16x16.gif') ?>'
            //ajaxOptions: { contentType: 'application/x-www-form-urlencoded; charset=utf-8' }
        });

        selectTabsInSession();

        PreparaTabsParaSession();

    });


    function PreparaTabsParaSession() {
        jQuery('#ofertas-tabs a').each(function(index, value) {
            jQuery(value).click(function() {
                Set_Cookie( 'tab_oferta', value.id, '', '/', '', '' );
            });
        });

        jQuery('#ciclos-tabs a').each(function(index, value) {
            jQuery(value).click(function() {
                Set_Cookie( 'tab_ciclo', value.id, '', '/', '', '' );
            });
        });
    }

    function selectTabsInSession () {
        if (Get_Cookie('tab_oferta')) {
            jQuery('#'+Get_Cookie('tab_oferta')).click();
        }

        if (Get_Cookie('tab_ciclo')) {
            jQuery('#'+Get_Cookie('tab_ciclo')).click();
        }
    }
</script>

<div id="escuela_estado" class="<? echo $planes['Instit']['activo']? 'instit_activa':'instit_inactiva';?>"><? echo $planes['Instit']['activo']? 'Instituci�n Ingresada al RFIETP':'Instituci�n NO Ingresada al RFIETP';?></div>
<?
$cue_instit = ($planes['Instit']['cue']*100)+$planes['Instit']['anexo'];
?>
<h2><?= $cue_instit ?> - <?= $planes['Instit']['nombre_completo']?></h2>

<br>
<div>
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
                        $link .= " return false;\">Pendiente de Actualizaci�n</a></div>";
                }
        ?>
        <?= $link?>

        <?
        //si el anexo tiene 1 solo digito le coloco un cero adelante
        $anexo = ($planes['Instit']['anexo']<10)?'0'.$planes['Instit']['anexo']:$planes['Instit']['anexo'];
        $cue_instit = $planes['Instit']['cue'].$anexo;
        ?>
        <?php
        if(empty($planes['Plan'])){
        ?>
            <div class="tabs-content">
                <h2>Listado de Ofertas <span style="float:right;font-size:9pt"><?php echo $html->link(__('Ver vista cl�sica', true), array('controller'=> 'planes', 'action'=>'index_clasico/'. $planes['Instit']['id']))?></span></h2>
                   <ul class="lista_fondos" style="padding-top: 20px;">
                        <p class='msg-atencion'>La Instituci�n no present� ofertas</p>
                   </ul>
            </div>
        <?php
        }
        ?>
        <?php
                //if(isset($sumatoria_matriculas['array_de_ciclos'])>0 && isset($sumatoria_matriculas['array_de_ofertas'])>0):
                if(!empty($planes['Plan'])):?>
                    <!-- TABS DE CICLOS ULT. ACTUALIZACIONES  -->
                    <div>
                        <div>
                            <?php if(isset($sumatoria_matriculas['array_de_ciclos'])>0 && isset($sumatoria_matriculas['array_de_ofertas'])>0):
                                        $v_matriculas_ciclos = array_reverse($sumatoria_matriculas['array_de_ciclos']);
                                ?>
                                <h2>Total de matriculados por oferta seg�n ciclo lectivo</h2>
                                        <div align="center">
                                                <table class="tabla" width="80" cellpadding = "0" cellspacing = "0" summary="En esta tabla se muestran los totales de
                                                                                                                                matr�culas por cada ciclo lectivo, para
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
                    </div>
                    <!-- EOF Tabla resumen de total de matriculas -->

                    <h2>Listado de Ofertas </h2>
                    <span style="float:right;font-size:9pt"><?php echo $html->link(__('Ver vista cl�sica', true), array('controller'=> 'planes', 'action'=>'index_clasico/'. $planes['Instit']['id']))?></span>

                    <div class="js-tabs-ofertas tabs planes-container">
                        <ul id="ofertas-tabs" class="planes-ofertas horizontal-shadetabs">
                                <?php
                                $tabsindex = 0;
                                foreach($ofertas as $ofertaId=>$ofertaName){
                                 ?>
                                    <li>
                                        <a id="htab-<?php echo $ofertaId; ?>"
                                           href="#ver-oferta-<?php echo $ofertaId; ?>">
                                            <?php echo $ofertaName?>
                                        </a>
                                    </li>
                                <?php 
                                    $tabsindex++;
                                }
                                ?>
                        </ul>

                        <div id="ciclos-tabs">
                        <?php
                        foreach ($ofertas as $ofertaId => $ofertaCiclo) {
                        ?>
                        <div id="ver-oferta-<?php echo $ofertaId?>" class="js-tabs-ciclos tabs ciclos-container">
                            <ul class="vertical-tabs vertical-shadetabs">
                            <?php
                                if (!empty($ciclos[$ofertaId]['ciclo'])) {
                                    foreach ($ciclos[$ofertaId]['ciclo'] as $anio) {
                                    ?>
                                <li>
                                    <?php
                                        echo $html->link('<span>'.$anio.'</span>',array(
                                                            'controller'=>'planes',
                                                            'action'=>$ofertasControllers[$ofertaId],
                                                            $planes['Instit']['id']."/".$ofertaId."/".$anio,
                                                            ), array(
                                                                'id'=>'vtab-'.$ofertaId.'-'.$anio,
                                                                'escape' => false
                                             ));
                                     ?>
                                </li>
                                     <?php
                                    }
                                }

                                ?>
                                <li>
                                <?php
                                    echo $html->link('<span>Todos</span>',array(
                                                        'controller'=>'planes',
                                                        'action'=>$ofertasControllers[$ofertaId],
                                                        $planes['Instit']['id']."/".$ofertaId."/0",
                                                        ), array(
                                                            'id'=>'vtab-'.$ofertaId.'-0',
                                                            'escape' => false
                                          ));
                                    ?>
                                </li>

                            </ul>
                            <!--[if IE 6]>
                            <br><br><br>
                            <![endif]-->
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
                <li><?php echo $html->link(__('Depurar Instituci�n', true), '/depuradorPlanes/index/'.$planes['Instit']['id']); ?> </li>
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
