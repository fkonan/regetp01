<?php
class EstructuraPlanAnio extends AppModel {

	var $name = 'EstructuraPlanAnio';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'EstructuraPlan' => array('className' => 'EstructuraPlan',
								'foreignKey' => 'estructura_plan_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);

	var $hasMany = array(
			'Anio' => array('className' => 'Anio',
								'foreignKey' => 'estructura_planes_anio_id',
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