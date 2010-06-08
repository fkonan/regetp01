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
   <h1><?= $jurisdiccion['Jurisdiccion']['name']?>
   </h1>

   <h2>Listado de Planes de Mejora</h2>
                <ul style="padding-top: 20px" class="lista_fondos">

                <?php
                if(empty($fondos)){
                ?>
                    <p class='msg-atencion'>La Jurisdicci&oacute;n no presenta planes de mejora</p>
                <?php
                }
                $i = 0;
                foreach ($fondos as $fondo):
                ?>
                     <li class="item_fondos" STYLE="padding-right: 0px;">
                        <div class="header">
                            <dt><?php echo $fondo['Fondo']['anio'];?> - <?php echo $fondo['Fondo']['trimestre']; ?>º Trimestre </dt>
                        </div>
                        <dl>
                        <dt>Memo:</dt>
                        <dd><?php echo $fondo['Fondo']['memo']; ?></dd>
                        <!--<dt>Resolucion:</dt>
                        <dd><?php echo $fondo['Fondo']['resolucion']; ?></dd>
                        <dt>Descripcion:</dt>
                        <dd><?php echo $fondo['Fondo']['description']; ?></dd>
                        -->
                        </dl>

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
                     </li>
                <?php endforeach; ?>
                </ul>
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
