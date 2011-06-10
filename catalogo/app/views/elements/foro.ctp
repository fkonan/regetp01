<div>
    <div id="<?php echo $foroName; ?>" style="border-bottom: 1px dashed #000" class=""></div>
        <div class="clear"></div>

    <h4><?php echo $foroName; ?></h4>
    <?php
    if ( !empty($docInfoSectorial) ) {
    ?>
        <p>Informe  sectorial: <?php echo $html->link('descargar', $docInfoSectorial) ?></p>
    <?php } ?>

    <?php if (!empty($participantes) && count($participantes) > 0) { ?>
        Participantes:<br />
        <ul>
            <?php foreach ($participantes as $p) { ?>
                <li><?php echo $p?></li>
            <?php } ?>
        </ul>
    <?php } 

?>

</div>    