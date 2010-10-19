<h1><?php  __('Oferta Educativa');?></h1>

<?php 
	echo $this->element('div_observaciones', array("observacion" => $plan['Plan']['observacion']));
?>

<?
$anexo = ($instit['anexo']<10)?'0'.$instit['anexo']:$instit['anexo'];
$cue_instit = $instit['cue'].$anexo;
?>
<h2><?php echo $cue_instit." - ".$instit['nombre_completo']; ?></h2>



<div class="planes view">
	<dl><?php $i = 0; $class = ' class="altrow"';?>

		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Oferta'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?= $plan['Oferta']['name']; ?>
			&nbsp;
		</dd>
		

		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Normativa'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $plan['Plan']['norma']; ?>
			&nbsp;
		</dd>

                <? if ( $plan['Titulo']['name'] ) { ?>
		<dt<?php if ($i % 2 == 0) echo $class;?>>
                    <?php __('T�tulo de Referencia'); ?>
                    
                </dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
                  <?php echo $plan['Titulo']['name']; ?>
                  <?php
                    echo ($plan['Titulo']['marco_ref'])?
                        $html->image('certificado.png', array(
                            'height'=>'17px',
                            'align'=>'absmiddle',
                            'style'=>'botom: -5px;',
                            'alt'=>'Con Marco de Referencia',
                            'title'=>'T�tulo con Marco de Referencia'))
                        :'';
                    ?>
                <? if ($plan['Titulo']['marco_ref']) { ?>
                    <span style="font-size:10px; font-style:italic;">(con Marco de Referencia)</span>
                <? } ?>
			&nbsp;
		</dd>
                <? } ?>

		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Nombre'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $plan['Plan']['nombre']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Perfil'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $plan['Plan']['perfil']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Sector'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php 	echo $plan['Sector']['name'];?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Subsector'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo ($plan['Subsector']['name']=="")? "&nbsp" : $plan['Subsector']['name']; ?>
			&nbsp;
		</dd>		
		
		
		<? if((($plan['Plan']['duracion_hs']+$plan['Plan']['duracion_semanas']+$plan['Plan']['duracion_anios'])>0)){ ?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Duraci�n del plan:'); ?></dt>
		<dd<?php echo $class;?>>
			&nbsp;
		</dd>
		<? } ?>
		
		<? if(($plan['Plan']['duracion_hs']>0)){ ?>
			<dt<?php echo $class;?>><?php __(' - Horas'); ?></dt>
			<dd<?php echo $class;?>>
				<?php echo $plan['Plan']['duracion_hs']; ?>
				&nbsp;
			</dd>
		<? } ?>
		
		<? if ($plan['Plan']['duracion_semanas']>0){ ?>
			<dt<?php $class;?>><?php __(' - Semanas'); ?></dt>
			<dd<?php echo $class;?>>
				<?php echo $plan['Plan']['duracion_semanas']; ?>
				&nbsp;
			</dd>
		<? } ?>
		
		<? if ($plan['Plan']['duracion_anios']>0){ ?>
			<dt<?php $class;?>><?php __(' - A�os'); ?></dt>
			<dd<?php echo $class;?>>
				<?php echo $plan['Plan']['duracion_anios']; ?>
				&nbsp;
			</dd>
		<? } ?>
		
		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Alta'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<? echo $plan['Plan']['ciclo_alta']?$plan['Plan']['ciclo_alta']:''; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modificaci�n'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<? echo $plan['Plan']['modified']?date("d/m/Y",strtotime($plan['Plan']['modified'])):''; ?>
			&nbsp;
		</dd>

	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Editar Oferta', true), array('action'=>'edit', $plan['Plan']['id'])); ?> </li>
		<li><?php echo $html->link(__('�Eliminar Oferta?', true), array('controller'=> 'planes', 'action'=>'delete', $plan['Plan']['id']), null, sprintf(__('Seguro que desea eliminar el Plan "%s"?', true), $plan['Plan']['nombre'])); ?></li>
	</ul>
</div>

	<?
	/**
	 *  Esto renderiza el Element de acuerdo a lo que el controlador diga.
	 *  SI el plan es FP, va agenerar una tabla para mostrar FP
	 *  Si el plan es otro tipo, renderizar� la tabla normal
	 */
	echo $this->renderElement($planes_view_tabla);
	?>
	
	
	<div class="actions">
		<ul>
			<?php //echo $html->link(__('Agregar Nuevo A�o', true), array('controller'=> 'anios', 'action'=>'add/'.$plan['Plan']['id']));?>
			<li><a href="<?= $html->url(array('controller'=> 'anios', 'action'=>'add/'.$plan['Plan']['id'] .'/' . $plan['Plan']['duracion_hs']))?>" onClick="window.open('<?= $html->url(array('controller'=> 'anios', 'action'=>'add/'.$plan['Plan']['id'] .'/' . $plan['Plan']['duracion_hs']))?>','_blank' , 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=310,height=500'); return false;">Agregar Datos</a></li>
		</ul>
	</div>
