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
			)
		),
		'duracion_hs' => array(
			'number' => array(
				'rule' => VALID_NUMBER,
				'required' => true,
				'allowEmpty' => false,
				'message' => 'Debe ingresar un valor numérico para las horas.'
			
			),
			'maxLength' => array(
				'rule' => array('maxLength','9'),
				'required' => true,
				'allowEmpty' => false,
				'message' => 'La cantidad de horas debe ser de 9 dígitos.'
			
			)
		),
		'duracion_semanas' => array(
			'number' => array(
				'rule' => VALID_NUMBER,
				'required' => true,
				'allowEmpty' => false,
				'message' => 'Debe ingresar un valor numérico para las semanas.'
			
			),
			'maxLength' => array(
				'rule' => array('maxLength','9'),
				'required' => true,
				'allowEmpty' => false,
				'message' => 'La cantidad de semanas debe ser de 9 dígitos.'
			
			)
		),
		'duracion_anios' => array(
			'number' => array(
				'rule' => VALID_NUMBER,
				'required' => true,
				'allowEmpty' => false,
				'message' => 'Debe ingresar un valor numérico para los años.'
			
			),
			'maxLength' => array(
				'rule' => array('maxLength','9'),
				'required' => true,
				'allowEmpty' => false,
				'message' => 'La cantidad de años debe ser de 9 dígitos.'
			
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

  	function paginateCount($conditions = null, $recursive = 0)
  	{
		if ($this->asociarAnio)
		{
			$this->bindModel(array('hasOne' => array('Anio' => array('className'  => 'Anio','foreignKey' => 'plan_id',),),));
	        $field        = $this->getPagFields();
	        
	       	$selectFields = array("max(\"Anio\".\"ciclo_id\") AS Calculado__max_ciclo");
	       	$selectFields = array_merge($field, $selectFields); 

	        //debug($selectFields);
	        
	        $groupFields  = $field;
	        
	        if ($this->maxCiclo != "" )
	        {
	        	// le concateno al ultimo detalle del group el HAVING
	        	$groupFields = array_merge($groupFields ,array('1" HAVING max("Anio"."ciclo_id") = ' . $this->maxCiclo));
	        	//$groupFields[count($groupFields)-1] = $groupFields[count($groupFields)-1].'HAVING max("Anio"."ciclo_id") = "' . $this->maxCiclo;
	        	//$groupFields = array_merge($groupFields, array(" HAVING max(\"Anio\".\"ciclo_id\") = " . $this->maxCiclo));
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

	        $selectFields = array_merge($field , array("max(\"Anio\".\"ciclo_id\") AS Calculado__max_ciclo"));
	     //    debug($selectFields);
	        $groupFields  = $field;
	        
	        if ($this->maxCiclo != "" )
	        {
	        	//$groupFields[count($groupFields)-1] = $groupFields[count($groupFields)-1].'HAVING max("Anio"."ciclo_id") = "' . $this->maxCiclo;
	        	$groupFields = array_merge($groupFields ,array('1" HAVING max("Anio"."ciclo_id") = ' . $this->maxCiclo));
	        }	
	        
	        $extra      = array('group' => $groupFields,'fields' => $selectFields);
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
	
	
	
	function dameMatriculaDeCiclo($plan_id,$ciclo){
		$tot = $this->Anio->find('all',array(
			'fields'=>'sum(matricula) AS "Anio__matricula"',
			'conditions'=> array('plan_id'=>$plan_id,'ciclo_id'=>$ciclo),
			'limit'=> 1
		));
		return $tot[0]['Anio']['matricula'];
	}
	
	
	
}
?>