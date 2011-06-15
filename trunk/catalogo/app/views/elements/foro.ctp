<div>
    <div id="<?php echo $foroName; ?>" style="border-bottom: 1px dashed #000" class=""></div>

    <h4>Foro del sector <?php echo $foroName; ?></h4>
    <?php
    $i = 0;
    if (!empty($participantes) && count($participantes) > 0) {?>
        Participantes:<br />
        <ul class="grid_4">
            <?php foreach ($participantes as $p) { ?>
                <?php $i++; if($i == ceil(count($participantes)/2)+1):?>
                    </ul><ul class="grid_3">
                <?php endif ?>
                <li><?php echo $p?></li>
            <?php } ?>
        </ul>
    <?php } ?>
    <div class="clear"></div>
    <p>
    <?php if (!empty($fliaProfesional) ):?>        
        <?php echo $html->link('Familia profesional del sector '.$fliaProfesional["nombre"], $fliaProfesional["link"]) ?>
    <?php endif ?>
    <?php if (!empty($docInfoSectorial) ):?>
        <div class="clear"></div>
        <?php echo $html->link('Informe sectorial', $docInfoSectorial) ?>
    <?php endif ?>
    </p>
</div>    