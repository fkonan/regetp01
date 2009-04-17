<?php
class Jurisdiccion extends AppModel {

	var $name = 'Jurisdiccion';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array(
			'Tipoinstit' => array('className' => 'Tipoinstit',
								'foreignKey' => 'jurisdiccion_id',
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
								'foreignKey' => 'jurisdiccion_id',
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
      	'name' => array(
			'notEmpty' => array( // or: array('ruleName', 'param1', 'param2' ...)
				'rule' => VALID_NOT_EMPTY,
				'required' => true,
				'allowEmpty' => false,
				//'on' => 'create', // or: 'update'
				'message' => 'Se debe ingresar un nombre para la Jurisdicción. No puede quedar vacío.'
			)
   		)
	);
	

}
?>