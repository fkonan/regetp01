<?php
class Trayecto extends AppModel {

	var $name = 'Trayecto';


	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array(
			'TrayectoAnio' => array('className' => 'TrayectoAnio',
								'foreignKey' => 'trayecto_id',
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