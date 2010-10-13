
<div class="fondos index">
   <div id="escuela_estado" class="<? echo $instit['Instit']['activo']? 'instit_activa':'instit_inactiva';?>"><? echo $instit['Instit']['activo']? 'Instituci�n Ingresada al RFIETP':'Instituci�n NO Ingresada al RFIETP';?></div>
    <?
    $cue_instit = ($instit['Instit']['cue']*100)+$instit['Instit']['anexo'];
    ?>
    <br/>
    <h2><?= $cue_instit ?> - <?= $instit['Instit']['nombre_completo']?></h2>

    <div class="tabs">
            <div class="tabs-list">
                    <span class="tab-grande-inactiva"><?php echo $html->link('Datos B�sicos',array('controller'=>'Instits','action'=>'view', $instit['Instit']['id']));?></span>
                    <span class="tab-grande-inactiva"><?php echo $html->link('Oferta Educativa',array('controller'=>'Planes','action'=>'index', $instit['Instit']['id']));?></span>
                    <span class="tab-grande-activa"><?php echo $html->link('Planes de Mejora',array('controller'=>'Fondos','action'=>'index', $instit['Instit']['id']));?></span>
            </div>

            <div id="d_clip_button" class="my_clip_button2"></div>
            <input id="infoToCopy" type="hidden" value="<?= ($instit['Instit']['cue']*100)+$instit['Instit']['anexo'] . ' - ' . $instit['Instit']['nombre_completo'] . ' - ' . $instit['Instit']['direccion'] . ' - ' . $instit['Departamento']['name'] . ' - ' . $instit['Localidad']['name'] ?> "/>
            <script language="JavaScript">
                var clip = new ZeroClipboard.Client();

                ZeroClipboard.setMoviePath('<?php echo $html->url("/js/zeroclipboard/ZeroClipboard10.swf"); ?>');

                clip.setText( '' ); // will be set later on mouseDown
                clip.setHandCursor( true );
                clip.addEventListener( 'mouseDown', function(client) {
                   client.setText($("infoToCopy").value);
                } );

                clip.glue( 'd_clip_button' );
           </script>
            
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
                     <li class="item_fondos" STYLE="padding-right: 0px;">
                        <div class="header">
                            <dt><?php echo $fondo['Fondo']['anio'];?> - <?php echo $fondo['Fondo']['trimestre']; ?>� Trimestre </dt>
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
                        
                        <h2>Lineas de Acci�n</h2>
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
                            <dt>Total</dt>
                            <dd>$ <?php echo number_format($fondo['Fondo']['total'],2,",","."); ?></dd>
                        </div>
                     </li>
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