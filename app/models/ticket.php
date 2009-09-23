<?php
class Ticket extends AppModel {

	var $name = 'Ticket';
	var $validate = array(
		'instit_id' => array('numeric'),
		'user_id' => array('numeric'),
		'estado' => array('numeric')
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Instit' => array('className' => 'Instit',
								'foreignKey' => 'instit_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			),
			'User' => array('className' => 'User',
								'foreignKey' => 'user_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);

}
?>