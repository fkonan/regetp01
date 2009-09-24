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

	/**
	 * 
	 * @param $instit_id
	 * @return unknown_type
	 */
	function dameTicketPendiente($instit_id)
	{
		$this->recursive = -1;
		return  $this->find('first', array('conditions' => array('Ticket.instit_id' => $instit_id, 'Ticket.estado' => 0)));
	}

}
?>