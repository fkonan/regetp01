<?php
class Ticket extends AppModel {

	var $name = 'Ticket';
	var $validate = array(
		'instit_id' => array('numeric'),
		'user_id' => array('numeric'),
		'estado' => array('numeric'),
		'observacion' => array(
				'notEmpty'=> array(
				'rule' => VALID_NOT_EMPTY,
				'required' => true,
				'allowEmpty' => false,
				//'on' => 'create', // or: 'update'
				'message' => 'Debe ingresar una Observación.')	
			)
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
	
	function dameProvinciasConPendientes()
	{
		$this->recursive = 0;
		$search = $this->find('all', array(
										'fields'=>array('Instit.jurisdiccion_id'),
										'conditions'=>array('Ticket.estado'=>0),
										'group'=>'Instit.jurisdiccion_id'));
		$juris_id = array();
		foreach($search as $key=>$value)
		{
			$juris_id[]=$value['Instit']['jurisdiccion_id'];
		}
		
		if(count($juris_id) < 1)
			$juris_id = "";
		
		$this->Instit->Jurisdiccion->recursive = -1;
		$prov_pend = array();
		$prov_pend = $this->Instit->Jurisdiccion->find('list', array(
								'conditions'=>array('Jurisdiccion.id'=>$juris_id)));
		
		return $prov_pend;	
	}

}
?>