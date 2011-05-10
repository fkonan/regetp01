<?php

foreach( $instits as &$i) {
    $i['Instit']['nombre_completo'] = utf8_encode($i['Instit']['nombre_completo']);
}

 $objeto = array(
     'cant' => $paginator->counter(array('format' => '%count%')),
     'data'      => $instits,
 );
 
 echo $javascript->object($objeto);
 ?>

