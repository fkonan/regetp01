<?php
class Orientacion extends AppModel {

    var $name = 'Orientacion';
    var $order = 'Orientacion.name';

    //The Associations below have been created with all possible keys, those that are not needed can be removed
    var $hasMany = array(
            'Sector' => array('className' => 'Sector',
                            'foreignKey' => 'orientacion_id',
                            'dependent' => false,
                            'conditions' => '',
                            'fields' => '',
                            'order' => '',
                            'limit' => '',
                            'offset' => '',
                            'exclusive' => '',
                            'finderQuery' => '',
                            'counterQuery' => ''
            ),
            'Instit' => array('className' => 'Instit',
                            'foreignKey' => 'orientacion_id',
                            'dependent' => false,
                            'conditions' => '',
                            'fields' => '',
                            'order' => '',
                            'limit' => '',
                            'offset' => '',
                            'exclusive' => '',
                            'finderQuery' => '',
                            'counterQuery' => ''
            )
    );

}
?>