<?php
class Sector extends AppModel {

	var $name = 'Sector';
	
	var $actsAs = array('Containable');

        var $order = 'Sector.name';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array(
                        'Sectores_titulo',
			'Plan' => array('className' => 'Plan',
								'foreignKey' => 'sector_id',
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
	
	var $belongsTo = array('Orientacion');


         var $hasAndBelongsToMany = array(
            'Titulo' =>
                array('className'             => 'Titulo',
                     'joinTable'              => 'sectores_titulos',
                     'foreignKey'             => 'sector_id',
                     'associationForeignKey'  => 'titulo_id',
                     'with'                   => '',
                     'conditions'             => '',
                     'order'                  => '',
                     'limit'                  => '',
                     'unique'                 => false,
                     'finderQuery'            => '',
                     'deleteQuery'            => '',
                     'insertQuery'            => ''
                ),
             );

}
?>