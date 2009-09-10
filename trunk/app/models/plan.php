<?php
class Plan extends AppModel {

	var $name = 'Plan';
	var $asociarAnio = false; // Se utiliza en el paginador
	var $maxCiclo = "";

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
		),
		'sector_id' => array(
			'notEmpty'=> array(
				'rule' => VALID_NOT_EMPTY,
				'required' => true,
				'allowEmpty' => false,
				'message' => 'Debe ingresar un sector.'	
			))
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

  	function paginateCount($conditions = null, $recursive = 0)
  	{
		if ($this->asociarAnio)
		{
			$this->bindModel(array('hasOne' => array('Anio' => array('className'  => 'Anio','foreignKey' => 'plan_id',),),));
	        $field        = $this->getPagFields();
   	        $selectFields = $field . ",max(\"Anio\".\"ciclo_id\") AS Calculado__max_ciclo";
	        $selectFields = $selectFields . ",sum(\"Anio\".\"matricula\") AS Calculado__sum_matricula";
			$groupFields  = $field;
	        
	        if ($this->maxCiclo != "" )
	        {
	        	$groupFields = $groupFields . " HAVING max(\"Anio\".\"ciclo_id\") = " . $this->maxCiclo;
	        }	
	        
	        $extra           = array('group' => $groupFields,'fields' => $selectFields);  	                    
        	$parameters      = compact('conditions');
        	$this->recursive = 0;

        	return count($this->find('all', array_merge($parameters, $extra)));
  		}
  		else
  		{
			$parameters = compact('conditions');

			if ($recursive != $this->recursive)
			{
				$parameters['recursive'] = $recursive;
			}

			$extra = array();

			return $this->find('count', array_merge($parameters, $extra));
  		}        	
    }

	function paginate($conditions = null, $fields = null, $order = null, $limit = null, $page = 1, $recursive = null, $tieneHasMany = false)
	{
		if ($this->asociarAnio)
		{
			$this->bindModel(array('hasOne' => array('Anio' => array('className'  => 'Anio','foreignKey' => 'plan_id',),),));
	        $field = $this->getPagFields();

	        $selectFields = $field . ",max(\"Anio\".\"ciclo_id\") AS Calculado__max_ciclo";
	        $selectFields = $selectFields . ",sum(\"Anio\".\"matricula\") AS Calculado__sum_matricula";
	        $groupFields  = $field;
	        
	        if ($this->maxCiclo != "" )
	        {
	        	$groupFields = $groupFields . " HAVING max(\"Anio\".\"ciclo_id\") = " . $this->maxCiclo;
	        }	
	        
	        $extra      = array('group' => $groupFields,'fields' => explode(",",$selectFields));
			$parameters = compact('conditions', 'fields', 'order', 'limit', 'page');

			if ($recursive != $this->recursive)
			{
				$parameters['recursive'] = $recursive;
    	    }

			return $this->find('all', array_merge($parameters, $extra));
		}
		else
		{
			$parameters = compact('conditions', 'fields', 'order', 'limit', 'page');

			if ($recursive != $this->recursive)
			{
				$parameters['recursive'] = $recursive;
			}

			$extra = array();

			return $this->find('all', array_merge($parameters, $extra));
		}
	}    	
   
	function setAsociarAnio($asociar)
	{
		$this->asociarAnio = $asociar;	
	}   

	function setMaxCiclo($ciclo)
	{
		$this->maxCiclo = $ciclo;	
	}   
}
?>