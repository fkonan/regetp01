<?php
class Tipoinstit extends AppModel {

	var $name = 'Tipoinstit';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Jurisdiccion' => array('className' => 'Jurisdiccion',
								'foreignKey' => 'jurisdiccion_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);

	var $hasMany = array(
			'Instit' => array('className' => 'Instit',
								'foreignKey' => 'tipoinstit_id',
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
			'rule' => 'notEmpty', // or: array('ruleName', 'param1', 'param2' ...)
			'required' => true,
			'allowEmpty' => false,
			//'on' => 'create', // or: 'update'
			'message' => 'Se debe ingresar un nombre para la Jurisdicción. No puede quedar vacio.')
   );
	
}
?>