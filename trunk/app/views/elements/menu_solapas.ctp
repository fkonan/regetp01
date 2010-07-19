<?php

/**
 *  me renderiza el menu con tabs
 * 
 *  @var array $elementos
 *          OPCIONES POSIBLES
 *              string 'nombre' = 'nombre' del elemento
 *              string 'link'   = link del elemento es una url de cake
 *              boolean activa  =  si existe este KEY lo toma como true
 *
 *
 */

if (empty($elementos)) {
    debug("Hay que pasarle parametros al menu");
}

?>

<div class="tabs-list">
    <?php
    foreach ($elementos as $e) {
        $claseActiva = 'tab-grande-activa';

        if (strtolower($this->here) == strtolower($html->url($e['link'],false))) {
            $claseActiva = 'tab-grande-inactiva';
        }
        ?>
    <span class="<?php echo $claseActiva?>">
        <?php echo $html->link($e['nombre'],$e['link']);?>
    </span>
        <?php
    }
    ?>
</div>