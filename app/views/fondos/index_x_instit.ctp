<?php
    echo $javascript->link('zeroclipboard/ZeroClipboard.js');
?>

<?php
if ($session->check('Auth.User')) {
    if(	$session->read('Auth.User.role') == 'desarrollo') {
        ?>

<div class="fondos index">
   <div id="escuela_estado" class="<? echo $instit['Instit']['activo']? 'instit_activa':'instit_inactiva';?>"><? echo $instit['Instit']['activo']? 'Institución Ingresada al RFIETP':'Institución NO Ingresada al RFIETP';?></div>
    <?
    $cue_instit = ($instit['Instit']['cue']*100)+$instit['Instit']['anexo'];
    ?>
    <h2><?= $cue_instit ?> - <?= $instit['Instit']['nombre_completo']?></h2>

    <div class="tabs">
            <div class="tabs-list">
                    <span class="tab-grande-inactiva"><?php echo $html->link('Datos Básicos',array('controller'=>'Instits','action'=>'view', $instit['Instit']['id']));?></span>
                    <span class="tab-grande-inactiva"><?php echo $html->link('Oferta Educativa',array('controller'=>'Planes','action'=>'index', $instit['Instit']['id']));?></span>
                    <span class="tab-grande-activa"><?php echo $html->link('Planes de Mejora',array('controller'=>'Fondos','action'=>'index_x_instit', $instit['Instit']['id']));?></span>
            </div>

            <div id="d_clip_button" class="my_clip_button2"></div>
            <input id="infoToCopy" type="hidden" value="<?= ($instit['Instit']['cue']*100)+$instit['Instit']['anexo'] . ' - ' . $instit['Instit']['nombre_completo'] . ' - ' . $instit['Instit']['direccion'] . ' - ' . $instit['Departamento']['name'] . ' - ' . $instit['Localidad']['name'] ?> "/>
            
            <div style="border-top:2px solid #9DA6C1" class="tabs-content">

                <h2>Listado de Planes de Mejora</h2>
                <p><strong>La institución presento <?php echo count($fondos) ?> planes de mejora con un total de $ <?=number_format($sumalineas,2,",",".");?></strong></p>
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


<?
/*
 *       ACA ABAJO ESTA LO QUE HAY QUE BORRAR LUEGO DE LA MIGRACIÓN DEFINITIVA
 *
 *          es la vista con un mensaje diciendo que aun no esta listo
 * y solo se ve para el desarrollador los datos de Fondo
 *
*/
?>
        <?php
    } else {
      ?>

      
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
                    <span class="tab-grande-activa"><?php echo $html->link('Planes de Mejora',array('controller'=>'Fondos','action'=>'index_x_instit', $instit['Instit']['id']));?></span>
            </div>
            <div id="d_clip_button" class="my_clip_button2"></div>
            <input id="infoToCopy" type="hidden" value="<?= ($instit['Instit']['cue']*100)+$instit['Instit']['anexo'] . ' - ' . $instit['Instit']['nombre_completo'] . ' - ' . $instit['Instit']['direccion'] . ' - ' . $instit['Departamento']['name'] . ' - ' . $instit['Localidad']['name'] ?> "/>
            <script language="JavaScript"  type="text/javascript" defer="defer">
                var clip = new ZeroClipboard.Client();

                ZeroClipboard.setMoviePath('<?php echo $html->url("/js/zeroclipboard/ZeroClipboard10.swf"); ?>');

                clip.setText( '' ); // will be set later on mouseDown
                clip.setHandCursor( true );
                clip.addEventListener( 'mouseDown', function(client) {
                   client.setText(jQuery("#infoToCopy").val());
                } );

                clip.glue( 'd_clip_button' );
           </script>

            <div style="border-top:2px solid #9DA6C1" class="tabs-content">
                <p><p><p><p>
                    <p class='msg-atencion'>Los datos sobre planes de mejora aprobados serán publicados a la brevedad.</p>
                </p></p> </p></p>
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

        <?
    }
    
}?>
<script language="JavaScript" type="text/javascript" defer="defer">
    jQuery(document).ready(function(){
        var clip = new ZeroClipboard.Client();

        ZeroClipboard.setMoviePath('<?php echo $html->url("/js/zeroclipboard/ZeroClipboard10.swf"); ?>');

        clip.setText( '' ); // will be set later on mouseDown
        clip.setHandCursor( true );
        clip.addEventListener( 'mouseDown', function(client) {
           client.setText(jQuery("#infoToCopy").val());
        } );

        clip.glue( 'd_clip_button' );
    })
</script>