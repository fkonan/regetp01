<div style="padding-bottom: 10px;">
    <div id="<?php echo $foroName; ?>" style="border-bottom: 1px dashed #000" class=""></div>

    <h3>Foro del Sector <?php echo $foroName; ?></h3>
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
   
    <p>
        <!-- Informe Sectorial -->    
        <?php if (!empty($docInfoSectorial) ):?>
            <div class="clear"></div>
            <?php echo $html->link('Informe sectorial', $docInfoSectorial, array('target'=>'_blank')) ?>
        <?php endif ?>
        <br />
        <!-- Familia Profesional -->    
        <?php if (!empty($fliaProfesional) ):?>        
            <?php echo $html->link('Familia profesional del sector '.$fliaProfesional["nombre"], $fliaProfesional["link"], array('target'=>'_blank')) ?>
        <?php else: ?>
            <p style="color:red">Falta familia profesional</p>
        <?php endif ?>
    </p>
</div>    