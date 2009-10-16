<?php
class Sector extends AppModel {

	var $name = 'Sector';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array(
			'Plan' => array('className' => 'Plan',
								'foreignKey' => 'sector_id',
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