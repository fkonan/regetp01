<div class="instits view">
    <h1>
         <?= $jurisdiccion['Jurisdiccion']['name']?>
    </h1>
    <div class="tabs">
            <div class="tabs-list">
                    <span class="tab-grande-activa"><?php echo $html->link('Datos Básicos',array('controller'=>'Jurisdicciones','action'=>'view', $jurisdiccion['Jurisdiccion']['id']));?></span>
                    <span class="tab-grande-inactiva"><?php echo $html->link('Planes de Mejora',array('controller'=>'Fondos','action'=>'index_x_jurisdiccion', $jurisdiccion['Jurisdiccion']['id']));?></span>
            </div>
        
            <div style="border-top:2px solid #9DA6C1" class="tabs-content">
                    <h2>Datos de Jurisdicción</h2>
                    <dl><?php $i = 0; $class = ' class="altrow"';?>

                        <h3>Datos de la autoridad</h3>

                            <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Cargo'); ?></dt>
                            <dd<?php if ($i++ % 2 == 0) echo $class;?>><?php echo $jurisdiccion['Jurisdiccion']['autoridad_cargo']; ?></dd>

                            <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Nombre'); ?></dt>
                            <dd<?php if ($i++ % 2 == 0) echo $class;?>><?php echo $jurisdiccion['Jurisdiccion']['autoridad_nombre']; ?></dd>

                            <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Fecha de asunción'); ?></dt>
                            <dd<?php if ($i++ % 2 == 0) echo $class;?>><?php echo date("d/m/Y", strtotime($jurisdiccion['Jurisdiccion']['autoridad_fecha_asuncion'])); ?></dd>

                        <h3>Datos del Ministerio</h3>

                            <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Denominación'); ?></dt>
                            <dd<?php if ($i++ % 2 == 0) echo $class;?>><?php echo $jurisdiccion['Jurisdiccion']['ministerio_nombre']; ?></dd>

                            <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Dirección'); ?></dt>
                            <dd<?php if ($i++ % 2 == 0) echo $class;?>><?php echo $jurisdiccion['Jurisdiccion']['ministerio_direccion']; ?></dd>

                            <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Código Postal'); ?></dt>
                            <dd<?php if ($i++ % 2 == 0) echo $class;?>><?php echo $jurisdiccion['Jurisdiccion']['ministerio_codigo_postal']; ?></dd>

                            <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Teléfono'); ?></dt>
                            <dd<?php if ($i++ % 2 == 0) echo $class;?>><?php echo $jurisdiccion['Jurisdiccion']['ministerio_telefono']; ?></dd>

                            <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Email'); ?></dt>
                            <dd<?php if ($i++ % 2 == 0) echo $class;?>><?php echo $jurisdiccion['Jurisdiccion']['ministerio_mail']; ?></dd>

                            <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Localidad'); ?></dt>
                            <dd<?php if ($i++ % 2 == 0) echo $class;?>><?php echo $jurisdiccion['Localidad']['name']; ?></dd>
                    </dl>
                    <br />
            </div>
    </div>    
</div>

