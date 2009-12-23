<?php
class LineasDeAccion extends AppModel {

	var $name = 'LineasDeAccion';
	var $validate = array(
		'name' => array('notempty')
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array(
			'Fondo' => array('className' => 'Fondo',
								'foreignKey' => 'lineas_de_accion_id',
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