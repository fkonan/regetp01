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
    <?
    $cue_instit = ($instit['Instit']['cue']*100)+$instit['Instit']['anexo'];
    ?>
    <br/>
    <h2><?= $cue_instit ?> - <?= $instit['Instit']['nombre_completo']?></h2>

    <div class="tabs">
            <div class="tabs-list">
                    <span class="tab-grande-inactiva"><?php echo $html->link('Datos Básicos',array('controller'=>'Instits','action'=>'view', $instit['Instit']['id']));?></span>
                    <span class="tab-grande-inactiva"><?php echo $html->link('Oferta Educativa',array('controller'=>'Planes','action'=>'index', $instit['Instit']['id']));?></span>
                    <span class="tab-grande-activa"><?php echo $html->link('Planes de Mejora',array('controller'=>'Fondos','action'=>'index', $instit['Instit']['id']));?></span>
            </div>

            <div style="border-top:2px solid #9DA6C1" class="tabs-content">

                <h2>Listado de Planes de Mejora</h2>
                <ul style="padding-top: 20px" class="lista_fondos">

                <?php
                if(empty($fondos)){
                ?>
                    <p class='msg-atencion'>La Instituci&oacute;n no presenta planes de mejora</p>
                <?php
                }
                $i = 0;
                foreach ($fondos as $fondo):
                ?>
                     <dl class="item_fondos" STYLE="padding-right: 0px;">
                        <div class="header">
                            <dt><?php echo $fondo['Fondo']['anio'];?> - <?php echo $fondo['Fondo']['trimestre']; ?>º Trimestre </dt>
                        </div>
                        <dt>Memo:</dt>
                        <dd><?php echo $fondo['Fondo']['memo']; ?></dd>
                        <!--<dt>Resolucion:</dt>
                        <dd><?php echo $fondo['Fondo']['resolucion']; ?></dd>
                        <dt>Descripcion:</dt>
                        <dd><?php echo $fondo['Fondo']['description']; ?></dd>
                        -->
                        
                        <h2>Lineas de Acción</h2>
                        <div class="collapsibleContainer" title="Lineas de Accion">
                            <dl>
                            <?php
                                foreach ($fondo['LineasDeAccion'] as $linea):
                            ?>
                                <dt><?=$linea['name']?> (<?=$linea['description']?>) </dt> <dd>$ <?=number_format($linea['FondosLineasDeAccion']['monto'],2,",",".");?></dd>
                            <?php endforeach; ?>
                            </dl>
                        </div>
                        <div class="total">
                            <dt>Total:</dt>
                            <dd>$ <?php echo number_format($fondo['Fondo']['total'],2,",","."); ?></dd>
                        </div>
                     </dl>
                <?php endforeach; ?>
                </ul>
           </div>
    </div>
    <?php
        if($paginator->numbers()){
    ?>
            <div style="float:left" class="paging">
                    <?php echo $paginator->prev('<< '.__('anterior', true), array(), null, array('class'=>'disabled'));?>
             | 	<?php echo $paginator->numbers();?>
                    <?php echo $paginator->next(__('siguiente', true).' >>', array(), null, array('class'=>'disabled'));?>
            </div>
    <?php  }?>
</div>


<!--<div class="actions">
	<ul>
		<li><?php echo $html->link(__('New Fondo', true), array('action' => 'add')); ?></li>
	</ul>
</div>-->