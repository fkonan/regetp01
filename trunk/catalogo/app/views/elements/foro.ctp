<h4><?php echo $foroName; ?></h4>

<?php if (!empty($participantes) && count($participantes) > 0) { ?>
    <b>Participantes:</b><br />
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

