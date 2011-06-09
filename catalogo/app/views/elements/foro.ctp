<div style="margin-left: 10%">
    <div style="border-bottom: 1px dashed #000" class="grid_3 alpha"></div>
        <div class="clear"></div>

    <h4><?php echo $foroName; ?></h4>

    <?php if (!empty($participantes) && count($participantes) > 0) { ?>
        Participantes:<br />
        <ul>
            <?php foreach ($participantes as $p) { ?>
                <li><?php echo $p?></li>
            <?php } ?>
        </ul>
    <?php } 


    if ( !empty($docInfoSectorial) ) {
    ?>
        <p>Informe  sectorial: <?php echo $html->link('descargar', $docInfoSectorial) ?></p>
    <?php } ?>

</div>    