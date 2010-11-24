<?php
class Titulo extends AppModel {

	var $name = 'Titulo';
	var $order = 'Titulo.name';
	
	var $validate = array(
		'name' => array('notempty'),
		'marco_ref' => array('boolean'),
		'oferta_id' => array('numeric')
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Oferta' => array('className' => 'Oferta',
								'foreignKey' => 'oferta_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);
	
	
	var $hasMany = array('Plan', 'Sectores_titulo');

        var $hasAndBelongsToMany = array(
            'Sector' =>
                array('className'             => 'Sector',
                     'joinTable'              => 'sectores_titulos',
                     'foreignKey'             => 'titulo_id',
                     'associationForeignKey'  => 'sector_id',
                     'with'                   => '',
                     'conditions'             => '',
                     'order'                  => '',
                     'limit'                  => '',
                     'unique'                 => false,
                     'finderQuery'            => '',
                     'deleteQuery'            => '',
                     'insertQuery'            => ''
                ),
            'Subsector' =>
                array('className'             => 'Subsector',
                     'joinTable'              => 'ectores_titulos',
                     'foreignKey'             => 'titulo_id',
                     'associationForeignKey'  => 'subsector_id',
                     'with'                   => '',
                     'conditions'             => '',
                     'order'                  => '',
                     'limit'                  => '',
                     'unique'                 => false,
                     'finderQuery'            => '',
                     'deleteQuery'            => '',
                     'insertQuery'            => ''
                )
        );

}
?>