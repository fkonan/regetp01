<div class="instits view">
    <br /><br />
    <h2>
         <?= $jurisdiccion['Jurisdiccion']['name']?>
    </h2>
    <div class="tabs">
            <?php echo $this->element('menu_solapas_para_jurisdicciones', array('jurisdiccion_id' => $jurisdiccion['Jurisdiccion']['id'])); ?>
        
            <div class="tabs-content">
                    <dl><?php $i = 0; $class = ' class="altrow"';?>

                        <h2>Datos de la autoridad</h2>
                            <?php
                            if(!empty($ministro)){
                            ?>
                                <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Cargo'); ?></dt>
                                <dd<?php if ($i++ % 2 == 0) echo $class;?>><?php echo $ministro['Cargo'][0]['nombre']; ?></dd>

                                <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Nombre'); ?></dt>
                                <dd<?php if ($i++ % 2 == 0) echo $class;?>><?php echo $ministro['Autoridad']['titulo'] . ' ' . $ministro['Autoridad']['nombre'] .  ' ' . $ministro['Autoridad']['apellido']; ?></dd>

                                <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Fecha de asunción'); ?></dt>
                                <dd<?php if ($i++ % 2 == 0) echo $class;?>><?php echo isNull($time->format('d/m/Y', $ministro['Autoridad']['fecha_asuncion']),'Vacío') ;?></dd>
                            <?php
                            }
                            else{
                            ?>
                                <p>No existen datos de la autoridad de la jurisdicción.</p>
                            <?php
                            }
                            ?>
                        <h2>Datos del Ministerio</h2>

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

