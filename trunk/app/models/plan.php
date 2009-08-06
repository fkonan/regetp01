<?php
class Plan extends AppModel {

	var $name = 'Plan';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Instit' => array('className' => 'Instit',
								'foreignKey' => 'instit_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			),
			'Oferta' => array('className' => 'Oferta',
								'foreignKey' => 'oferta_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			),
			'Sector' => array('className' => 'Sector',
								'foreignKey' => 'sector_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			),
	);

	var $hasMany = array(
			'Anio' => array('className' => 'Anio',
								'foreignKey' => 'plan_id',
								'dependent' => false,
								'conditions' => '',
								'fields' => '',
								'order' => array('ciclo_id DESC','etapa_id ASC, anio ASC'),
								'limit' => '',
								'offset' => '',
								'exclusive' => '',
								'finderQuery' => '',
								'counterQuery' => ''
			)
	);
	
	var $validate = array(
		'nombre' => array(
			'notEmpty'=> array(
				'rule' => VALID_NOT_EMPTY,
				'required' => true,
				'allowEmpty' => false,
				//'on' => 'create', // or: 'update'
				'message' => 'Debe ingresar el nombre.'	
			)
		),
		'ciclo_alta' => array(
			'notEmpty'=> array(
				'rule' => VALID_NOT_EMPTY,
				'required' => true,
				'allowEmpty' => false,
				//'on' => 'create', // or: 'update'
				'message' => 'Debe ingresar el ciclo de alta.'	
			),
			'year'=> array(
				'rule' => VALID_YEAR,
				'required' => true,
				'allowEmpty' => false,
				//'on' => 'create', // or: 'update'
				'message' => 'Debe ingresar formato de año, con 4 dígitos.'	
			)
		)
	);
	
	
	function beforeSave(){  		  		
  		if (isset($this->data['Plan']['sector_id'])):
  			if ($this->data['Plan']['sector_id'] != '' || $this->data['Plan']['sector_id'] != 0): 
  				$this->Sector->recursive = -1;
  				$this->Sector->id = $this->data['Plan']['sector_id'];
  				$sec_aux = $this->Sector->read();
  				$this->data['Plan']['sector'] = $sec_aux['Sector']['name'];
  			endif;
  		endif;
  		return true;
  	}

}
?>