<?php
class Referente extends AppModel {

	var $name = 'Referente';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Tipodoc' => array('className' => 'Tipodoc',
								'foreignKey' => 'tipodoc_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			),
			'Jurisdiccion' => array('className' => 'Jurisdiccion',
								'foreignKey' => 'jurisdiccion_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);

	var $validate = array(
      	'name' => array(
			'rule' => 'notEmpty', // or: array('ruleName', 'param1', 'param2' ...)
			'required' => true,
			'allowEmpty' => false,
			//'on' => 'create', // or: 'update'
			'message' => 'Se debe ingresar un nombre para la Jurisdicción. No puede quedar vacío.')
   );
	
}
?>