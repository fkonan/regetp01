<?php
class Jurisdiccion extends AppModel {

	var $name = 'Jurisdiccion';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array('Tipoinstit','Instit','Departamento');

        var $order = array('Jurisdiccion.name');

        var $belongsTo = array(
			'Localidad' => array('className' => 'Localidad',
								'foreignKey' => 'ministerio_localidad_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
        );

	var $validate = array(
      	'name' => array(
			'notEmpty' => array( // or: array('ruleName', 'param1', 'param2' ...)
				'rule' => VALID_NOT_EMPTY,
				'required' => true,
				'allowEmpty' => false,
				//'on' => 'create', // or: 'update'
				'message' => 'Se debe ingresar un nombre para la Jurisdicci�n. No puede quedar vac�o.'
			)
   		)
	);
	

}
?>