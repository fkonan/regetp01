<?php
    echo $javascript->link('zeroclipboard/ZeroClipboard.js');
?>
<div class="instits view">
    <h1>
         <?= $jurisdiccion['Jurisdiccion']['name']?>
    </h1>
    <div class="tabs">
            <div class="tabs-list">
                    <span class="tab-grande-activa"><?php echo $html->link('Datos',array('controller'=>'Jurisdicciones','action'=>'view', $jurisdiccion['Jurisdiccion']['id']));?></span>
                    <span class="tab-grande-inactiva"><?php echo $html->link('Planes de Mejora',array('controller'=>'Fondos','action'=>'index_x_jurisdiccion', $jurisdiccion['Jurisdiccion']['id']));?></span>
            </div>
        
            <div style="border-top:2px solid #9DA6C1" class="tabs-content">
                    <h2>Datos de Jurisdicción</h2>
                    <dl><?php $i = 0; $class = ' class="altrow"';?>
                            <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Nombre'); ?></dt>
                            <dd<?php if ($i++ % 2 == 0) echo $class;?>>
                                    <?php echo $jurisdiccion['Jurisdiccion']['name']; ?>
                                    &nbsp;
                            </dd>
                    </dl>
                    <br />

                    <div class="actions">
                            <ul>
                                    <li><?php echo $html->link(__('Editar Jurisdiccion', true), array('action'=>'edit', $jurisdiccion['Jurisdiccion']['id'])); ?> </li>
                            </ul>
                    </div>

            </div>
    </div>    
</div>

