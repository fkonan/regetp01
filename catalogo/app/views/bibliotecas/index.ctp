<h1>Biblioteca</h1>


<div class="grid_6 alpha">
    <h2>Marcos de Referencia</h2>
    <ul>
        <?php foreach($marcos_referencia as $mr){ ?>
        <li><?php echo $html->link($mr); ?></li>
        <?php } ?>
    </ul>
</div>

<div class="grid_6 omega">
    <h2>Resoluciones</h2>
    <ul>
        <?php foreach($resoluciones as $r){ ?>
        <li><?php echo $html->link($r); ?></li>
        <?php } ?>
    </ul>
</div>