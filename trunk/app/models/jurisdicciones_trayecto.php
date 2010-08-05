<?php
class JurisdiccionesTrayecto extends AppModel {

	var $name = 'JurisdiccionesTrayecto';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Jurisdiccion' => array('className' => 'Jurisdiccion',
								'foreignKey' => 'jurisdiccion_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			),
			'Trayecto' => array('className' => 'Trayecto',
								'foreignKey' => 'trayecto_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);

}
?>