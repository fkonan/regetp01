<?php echo $html->css('biblioteca')?>

<div class="biblioteca">
    <div class="grid_6 alpha">
    <?php
    $arrayWritter->files = 'files';
    $arrayWritter->folders = 'folders';
    echo $arrayWritter->write($archivos);    
    ?>
    </div>
    
    <div class="grid_6 omega">
    <?php
    $arrayWritter->files = 'files';
    $arrayWritter->folders = 'folders';
    echo $arrayWritter->write($archivos2);    
    ?>
    </div>
</div>