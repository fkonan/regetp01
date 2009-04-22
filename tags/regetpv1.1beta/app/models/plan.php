<?php
class Plan extends AppModel {

	var $name = 'Plan';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Instit' => array('className' => 'Instit',
								'foreignKey' => 'instit_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			),
			'Oferta' => array('className' => 'Oferta',
								'foreignKey' => 'oferta_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);

	var $hasMany = array(
			'Anio' => array('className' => 'Anio',
								'foreignKey' => 'plan_id',
								'dependent' => false,
								'conditions' => '',
								'fields' => '',
								'order' => array('ciclo_id ASC','etapa_id ASC, anio ASC'),
								'limit' => '',
								'offset' => '',
								'exclusive' => '',
								'finderQuery' => '',
								'counterQuery' => ''
			)
	);
	
	var $validate = array(
		'nombre' => array(
			'notEmpty'=> array(
				'rule' => VALID_NOT_EMPTY,
				'required' => true,
				'allowEmpty' => false,
				//'on' => 'create', // or: 'update'
				'message' => 'Debe ingresar el nombre.'	
			)
		),
		'ciclo_alta' => array(
			'notEmpty'=> array(
				'rule' => VALID_NOT_EMPTY,
				'required' => true,
				'allowEmpty' => false,
				//'on' => 'create', // or: 'update'
				'message' => 'Debe ingresar el ciclo de alta.'	
			),
			'year'=> array(
				'rule' => VALID_YEAR,
				'required' => true,
				'allowEmpty' => false,
				//'on' => 'create', // or: 'update'
				'message' => 'Debe ingresar formato de año, con 4 dígitos.'	
			)
		)
	);

}
?>