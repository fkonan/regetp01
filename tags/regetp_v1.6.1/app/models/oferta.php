<?php
class Oferta extends AppModel {

	var $name = 'Oferta';
        var $order = 'Oferta.name';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array(
			'Plan' => array('className' => 'Plan',
								'foreignKey' => 'oferta_id',
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

	var $validate = array(
		'abrev' => array(
			'notEmpty'=> array(
				'rule' => VALID_NOT_EMPTY,
				'required' => true,
				'allowEmpty' => false,
				//'on' => 'create', // or: 'update'
				'message' => 'Debe ingresar una abreviatura.'	
			)
		),
		'name' => array(
			'notEmpty'=> array(
				'rule' => VALID_NOT_EMPTY,
				'required' => true,
				'allowEmpty' => false,
				//'on' => 'create', // or: 'update'
				'message' => 'Debe ingresar el nombre.'	
			)
		)
	);
}
?>