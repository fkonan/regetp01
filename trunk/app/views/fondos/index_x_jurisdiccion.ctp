<div class="fondos index">
   <h1><?= $jurisdiccion['Jurisdiccion']['name']?>
   </h1>

    <div class="tabs">
            <div class="tabs-list">
                    <span class="tab-grande-inactiva"><?php echo $html->link('Datos',array('controller'=>'Jurisdicciones','action'=>'view', $jurisdiccion['Jurisdiccion']['id']));?></span>
                    <span class="tab-grande-activa"><?php echo $html->link('Planes de Mejora',array('controller'=>'Fondos','action'=>'index_x_jurisdiccion', $jurisdiccion['Jurisdiccion']['id']));?></span>
            </div>
            <div style="border-top:2px solid #9DA6C1" class="tabs-content">
                <br/>
                <?php
                if(count($fondos) == 1){
                ?>
                <p>La Jurisdicci&oacute;n presento 1 plan de mejora con un total de <strong>$ <?=number_format($sumalineas,2,",",".");?></strong></p>
                <?php
                }
                ?>
                <?php
                if(count($fondos) > 1){
                ?>
                <p>La Jurisdicci&oacute;n presento <?php echo count($fondos) ; ?> planes de mejora con un total de <strong>$ <?=number_format($sumalineas,2,",",".");?></strong></p>
                <?php
                }
                ?>
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
                            <dt></dt>
                        <dt>Memo:  <?php echo $fondo['Fondo']['memo']; ?></dt>
                        <!--<dt>Resolucion:</dt>
                        <dd><?php echo $fondo['Fondo']['resolucion']; ?></dd>
                        <dt>Descripcion:</dt>
                        <dd><?php echo $fondo['Fondo']['description']; ?></dd>
                        -->
                        </dl>

                         <h2 style="padding-left: 15px">Líneas de Acción</h2>
                        <div class="collapsibleContainer" title="Lineas de Accion">
                            <dl>
                            <?php
                                foreach ($fondo['LineasDeAccion'] as $linea):
                            ?>
                                <dt onmouseover="jQuery(this).toggleClass('item_fondos_seleccionado')"
                                    onmouseout="jQuery(this).toggleClass('item_fondos_seleccionado')">
                                    <?=$linea['name']?> (<?=$linea['description']?>)
                                </dt>
                                <dd>$ <?=number_format($linea['FondosLineasDeAccion']['monto'],2,",",".");?></dd>
                            <?php endforeach; ?>
                                <dt>&nbsp;</dt>
                            </dl>
                        </div>
                        <div class="total">
                            Total $ <?php echo number_format($fondo['Fondo']['total'],2,",","."); ?>
                        </div>
                     </li>
                <?php endforeach; ?>
                </ul>
           </div>
    </div>
    <?php
    $paginator->options(array('url' => $this->passedArgs));

    if($paginator->numbers()){
    ?>
            <div style="float:left" class="paging">
                    <?php echo $paginator->prev('<< '.__('anterior', true), array(), null, array('class'=>'disabled'));?>
             | 	<?php echo $paginator->numbers();?>
                    <?php echo $paginator->next(__('siguiente', true).' >>', array(), null, array('class'=>'disabled'));?>
            </div>
    <?php  }?>
</div>