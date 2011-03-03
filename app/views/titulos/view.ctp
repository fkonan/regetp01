<div class="titulos view">
<h2><?php  __('Título de Referencia');?></h2>

	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Oferta'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $titulo['Oferta']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Nombre'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $titulo['Titulo']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Marco de referencia'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo ($titulo['Titulo']['marco_ref']==1)? "Con marco de referencia":"Sin marco de referencia"; ?>
			&nbsp;
		</dd>
	</dl>

<h2><?php  __('Sectores/Subsectores');?></h2>

    <dl><?php $i = 0; $class = ' class="altrow"';?>
        <?php
        foreach ($titulo['SectoresTitulo'] as $sector) {
        ?>
            <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Sectores'); ?></dt>
            <dd<?php if ($i++ % 2 == 0) echo $class;?>>
                    <?php echo $sector['Sector']['name']; ?>
                    <?php echo (!empty($sector['Subsector']['name']) ? '/ '.$sector['Subsector']['name'] : '' ); ?>
            </dd>
        <?php
        }
        ?>
    </dl>

<br />
    <div class="acl actions acl-editores acl-desarrolladores acl-administradores">
            <ul>
                    <li><?php echo $html->link(__('Editar Título', true), array('action'=>'edit', $titulo['Titulo']['id'])); ?> </li>
                    <li><?php echo $html->link(__('Eliminar Título', true), array('action'=>'delete', $titulo['Titulo']['id']), null, sprintf(__('Eliminar %s?', true), $titulo['Titulo']['name'])); ?> </li>
            </ul>
    </div>

<h2><?php  __('Planes de Estudio asociados');?></h2>
    <div id="tituloPlanes">
        <?php echo $this->requestAction('/titulos/ajax_view_planes_asociados/'.$titulo['Titulo']['id'], array('return')); ?>
    </div>

<h2><?php  __('Resumen de Planes de Estudio');?></h2>
    <?php
    foreach ($planesResumen as $planResumen) {
        $class = '';
        if ($i++ % 2 == 0) {
            $class = 'altrow';
        }
    ?>
    <ul>
        <li><?php echo $planResumen['Plan']['nombre']." (".$planResumen[0]['count'].")"; ?></li>
    </ul>
    <?php
    }
    ?>
</div>
<br />
<div class="actions">
    <ul>
        <li><?php echo $html->link(__('Volver al Buscador de Títulos de Referencia', true), array('action'=>'index')); ?> </li>
    </ul>
</div>
