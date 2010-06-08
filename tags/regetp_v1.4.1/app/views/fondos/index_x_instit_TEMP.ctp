<!--<?
//echo $javascript->link('jquery-1.4.2.min');
//echo $javascript->link('diQuery-collapsiblePanel.js');
//echo $html->css('diQuery-collapsiblePanel.css');
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