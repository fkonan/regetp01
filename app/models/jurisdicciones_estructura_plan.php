<?php
class JurisdiccionesEstructuraPlan extends AppModel {

	var $name = 'JurisdiccionesEstructuraPlan';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Jurisdiccion' => array('className' => 'Jurisdiccion',
								'foreignKey' => 'jurisdiccion_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			),
			'EstructuraPlan' => array('className' => 'EstructuraPlan',
								'foreignKey' => 'estructura_plan_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);

}
?>