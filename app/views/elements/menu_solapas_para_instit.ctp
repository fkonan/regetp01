<?php

/**
 *  me renderiza el menu de instits con tabs
 *
 *  le tengo que pasar el $instit_id para que funcione
 *
 *
 */

if (empty($instit_id)) {
    debug("Hay que pasarle un ID de institución al menu");
}

$menuOptions = array(
        array(
                'nombre'=> 'Datos Básicos',
                'link'=> array('controller'=>'Instits','action'=>'view', $instit_id),
        ),
        array(
                'nombre'=> 'Oferta Educativa',
                'link'=> array('controller'=>'Planes','action'=>'index', $instit_id),
        ),
        array(
                'nombre'=> 'Planes de Mejora',
                'link'=> array('controller'=>'Fondos','action'=>'index_x_instit', $instit_id),
                'options'=> array('class'=>'acl-directores acl-administradores acl-desarrolladores'),
        ),
);

echo $this->element('menu_solapas',array('elementos' => $menuOptions));