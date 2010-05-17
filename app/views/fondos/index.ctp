<!--<?
echo $javascript->link('jquery-1.4.2.min');
echo $javascript->link('diQuery-collapsiblePanel.js');
echo $html->css('diQuery-collapsiblePanel.css');
?>
<script language="javascript" type="text/javascript">
    jQuery.noConflict();

    jQuery(document).ready(function() {
        jQuery(".collapsibleContainer").collapsiblePanel();
        jQuery(".collapsibleContainerContent").hide();
    });
</script>
-->


<div class="fondos index">
    <div id="escuela_estado" class="<? echo $instit['Instit']['activo']? 'instit_activa':'instit_inactiva';?>"><? echo $instit['Instit']['activo']? 'Institución Ingresada al RFIETP':'Institución NO Ingresada al RFIETP';?></div>
    <div class="tabs">
            <div class="tabs-list">
                    <span class="tab-grande-inactiva"><?php echo $html->link('Datos',array('controller'=>'Instits','action'=>'view', $instit['Instit']['id']));?></span>
                    <span class="tab-grande-inactiva"><?php echo $html->link('Oferta Educativa',array('controller'=>'Planes','action'=>'index', $instit['Instit']['id']));?></span>
                    <span class="tab-grande-activa"><?php echo $html->link('Planes de Mejora',array('controller'=>'Fondos','action'=>'index', $instit['Instit']['id']));?></span>
            </div>

            <div class="tabs-content">
                <?
                $cue_instit = ($instit['Instit']['cue']*100)+$instit['Instit']['anexo'];
                ?>
                <br>
                <h1><?= $cue_instit ?>
                     - <?= $instit['Instit']['nombre_completo']?>
                </h1>

                <h2>Fondos</h2>

                <ul class="lista_fondos">
                <?php
                $i = 0;
                foreach ($fondos as $fondo):
                ?>
                     <dl class="item_fondos" STYLE="padding-right: 0px;">
                        <dt>Periodo:</dt>
                        <dd><?php echo $fondo['Fondo']['anio'];?> - <?php echo $fondo['Fondo']['trimestre']; ?>º Trimestre</dd>
                        <dt>Memo:</dt>
                        <dd><?php echo $fondo['Fondo']['memo']; ?></dd>
                        <!--<dt>Resolucion:</dt>
                        <dd><?php echo $fondo['Fondo']['resolucion']; ?></dd>
                        <dt>Descripcion:</dt>
                        <dd><?php echo $fondo['Fondo']['description']; ?></dd>
                        -->
                        <dt>Total:</dt>
                        <dd>$<?php echo $fondo['Fondo']['total']; ?></dd>
                        <h2>Lineas de Accion</h2>
                        <div class="collapsibleContainer" title="Lineas de Accion">
                            <dl>
                            <?php
                                foreach ($fondo['LineasDeAccion'] as $linea):
                            ?>
                                <dt><?=$linea['description']?> (<?=$linea['name']?>) </dt> <dd>$<?=$linea['FondosLineasDeAccion']['monto']?></dd>
                            <?php endforeach; ?>
                            </dl>
                        </div>
                     </dl>
                <?php endforeach; ?>
                </ul>
           </div>
    </div>
</div>


<!--<div class="actions">
	<ul>
		<li><?php echo $html->link(__('New Fondo', true), array('action' => 'add')); ?></li>
	</ul>
</div>-->