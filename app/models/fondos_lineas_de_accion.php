<?php
class FondosLineasDeAccion extends AppModel {

	var $name = 'FondosLineasDeAccion';
	var $validate = array(
		'fondo_id' => array('numeric'),
		'lineas_de_accion_id' => array('numeric'),
		'monto' => array('money')
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'Fondo' => array(
			'className' => 'Fondo',
			'foreignKey' => 'fondo_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'LineasDeAccion' => array(
			'className' => 'LineasDeAccion',
			'foreignKey' => 'lineas_de_accion_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

}
?>