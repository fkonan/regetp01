<?php
class Titulo extends AppModel {

	var $name = 'Titulo';
	var $order = 'Titulo.name';
	
	var $validate = array(
		'name' => array('notempty'),
		'marco_ref' => array('boolean'),
		'oferta_id' => array('numeric'),
		/*'sector_id' => array(
			'notEmpty'=> array(
				'rule' => VALID_NOT_EMPTY,
				'required' => true,
				'allowEmpty' => false,
				'message' => 'Debe ingresar un sector.',
			)
		),
		'subsector_id' => array(
			'correcto_subsector' => array(
				'rule' => array('controlar_coincidencia_sector_subsector'),
				'message'=> 'El subsector no corresponde al sector.'
			)
		)*/
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
	
	
	var $hasMany = array(
            'Plan',
            'SectoresTitulo', // esta es la tabla HABTM, pero la necesito aca para hacer consultas mas especificas
            );

        var $hasAndBelongsToMany = array(
            'Sector' => array('joinTable' => 'sectores_titulos'),
            'Subsector' => array('joinTable' => 'sectores_titulos')
        );

}
?>