<?php 
/* @var $paginator PaginatorHelper */
foreach ( $titulos as &$t) {
    $t['Titulo']['name'] = utf8_encode($t['Titulo']['name']);
    $t['Oferta']['name'] = utf8_encode($t['Oferta']['name']);
}

$titulos = array(
    'cant' => $paginator->counter(array('format' => '%count%')),
    'data' => $titulos,
);

echo $javascript->object($titulos);
