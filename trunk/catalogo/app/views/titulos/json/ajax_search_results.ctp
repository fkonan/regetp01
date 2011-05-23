<?php 

/* @var $paginator PaginatorHelper */
foreach ( $titulos as &$t) {
    $t['Titulo']['name'] = utf8_encode($t['Titulo']['name']);
    $t['Oferta']['name'] = utf8_encode($t['Oferta']['name']);
}

/* @var $paginator PaginatorHelper */
foreach ( $filtros['Oferta'] as $key=>&$f) {
    $f = utf8_encode($f);
}

foreach ( $filtros['Sector'] as $key=>&$f) {
    $f = utf8_encode($f);
}

foreach ( $filtros['Jurisdiccion'] as $key=>&$f) {
    $f = utf8_encode($f);
}

foreach ( $filtros['Departamento'] as $key=>&$f) {
    $f = utf8_encode($f);
}

foreach ( $filtros['Localidad'] as $key=>&$f) {
    $f = utf8_encode($f);
}

$cant = $paginator->counter(array('format' => '%count%'));

$texto = 'Títulos encontrados';
if ( $cant == 1) {
    $texto = 'Título encontrado';
}

$numbers = $paginator->numbers() ? $paginator->numbers() : '';

$paginator = array(
    'cant' => $cant,
    'numbers' => $numbers,
    'texto' => utf8_encode($texto),
);

$titulos = array(
    'paginator' => $paginator,
    'data' => $titulos,
    'filtros' => $filtros
);

echo $javascript->object($titulos);
