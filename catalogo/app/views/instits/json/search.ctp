<?php

foreach( $instits as &$i) {
    $i['Instit']['nombre_completo'] = utf8_encode($i['Instit']['nombre_completo']);
}


$cant = $paginator->counter(array('format' => '%count%'));

if ($cant > 1 ) {
    $texto = 'Instituciones encontradas';
} elseif( $cant == 1 ) {
    $texto = 'Institución encontrada';
} else {
    $texto = 'Instituciones encontradas. Redefina su búsqueda';
}

$numbers = $paginator->numbers() ? $paginator->numbers() : '';


$paginator = array(
    'cant' => $cant,
    'numbers' => $numbers,
    'texto' => utf8_encode($texto),
);


 $objeto = array(     
     'paginator' => $paginator,
     'data'      => $instits,
 );
 
 echo $javascript->object($objeto);
 ?>

