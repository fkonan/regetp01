<?php
class Plan extends AppModel {

	var $name = 'Plan';
	var $asociarAnio = false; // Se utiliza en el paginador
	var $maxCiclo = "";
	var $traerUltimaAct = false; // se utiliza en el paginador.
	
	var $actsAs = array('Containable');

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array( 
			'Instit' ,
			'Oferta',
			'Sector',
			'Subsector',
			'Titulo',
	);

	var $hasMany = array(
			'Anio' => array('className' => 'Anio',
								'foreignKey' => 'plan_id',
								'dependent' => true,
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
		'subsector_id' => array(
			'correcto_subsector' => array(
				'rule' => array('controlar_coincidencia_sector_subsector'),
				'message'=> 'El subsector no corresponde al sector.'	
			)
		),
		'duracion_hs' => array(
			'number' => array(
				'rule' => VALID_NUMBER,
				'required' => true,
				'allowEmpty' => true,
				'message' => 'Debe ingresar un valor numérico para las horas.'
			),
			'between' => array(
				'rule' => array('between','0','9'),
				'required' => true,
				'allowEmpty' => true,
				'message' => 'La duración no puede ser un valor tan alto'
			
			)
		),
		'duracion_semanas' => array(
			'number' => array(
				'rule' => VALID_NUMBER,
				'required' => false,
				'allowEmpty' => true,
				'message' => 'Debe ingresar un valor numérico para las semanas.'
			
			),
			'between' => array(
				'rule' => array('between','0','9'),
				'required' => false,
				'allowEmpty' => true,
				'message' => 'La duración no puede ser un valor tan alto'
			
			)
		),
		'duracion_anios' => array(
			'number' => array(
				'rule' => VALID_NUMBER,
				'required' => true,
				'allowEmpty' => true,
				'message' => 'Debe ingresar un valor numérico para los años.'
			
			),
			'between' => array(
				'rule' => array('between','0','9'),
				'required' => true,
				'allowEmpty' => true,
				'message' => 'La duración no puede ser un valor tan alto'
			
			)
		)
	);
	
	function beforeSave()
	{  		
  		//TODO Elimiar esto cuando se elimine el campo sectores de la tabla planes
		if(empty($this->data['Plan']['sector'])){
			$this->data['Plan']['sector'] = 'SECTOR SIN DATO';
		}
		  		  		
  		if (isset($this->data['Plan']['duracion_hs'])):
  			if ($this->data['Plan']['duracion_hs'] == ''): 
  				$this->data['Plan']['duracion_hs'] = 0;
  			endif;
  		else:
  			$this->data['Plan']['duracion_hs'] = 0;
  		endif;
  		
  		
  		if (isset($this->data['Plan']['duracion_semanas'])):
  			if ($this->data['Plan']['duracion_semanas'] == ''): 
  				$this->data['Plan']['duracion_semanas'] = 0;
  			endif;
  		else:
  			$this->data['Plan']['duracion_semanas'] = 0;
  		endif;
  		
  		
  		if (isset($this->data['Plan']['duracion_anios'])):
  			if ($this->data['Plan']['duracion_anios'] == ''): 
  				$this->data['Plan']['duracion_anios'] = 0;
  			endif;
  		else:
  			$this->data['Plan']['duracion_anios'] = 0;
  		endif;
  		
  		
  		return true;
  	}

  	/**
  	 * Se tuvo que redefinir esta funcion para poder agregar el ultimo 
  	 * año que presenta cada plan
  	 * 
  	 * @return cantidad de registros
  	 */
  	
  	function paginateCount($conditions = null, $recursive = 0)
  	{
		if ($this->asociarAnio)
		{
			$this->bindModel(array('hasOne' => array('Anio' => array('className'  => 'Anio','foreignKey' => 'plan_id',),),));
	        $field        = $this->getPagFields();
	        
			if ($this->traerUltimaAct){
				$selectFields = array_merge($field,array("max(\"Anio\".\"ciclo_id\") AS Calculado__max_ciclo"));
	        	$groupFields  = $field;
			} else {
				$selectFields = array_merge($field, array('Anio.ciclo_id'));
				$groupFields = $selectFields;
			}				

	        if ($this->maxCiclo != "" ){
	        	// le concateno al ultimo detalle del group el HAVING
	        	$groupFields = array_merge($groupFields ,array('1" HAVING max("Anio"."ciclo_id") = ' . $this->maxCiclo));
	        }	
	        
	        $extra           = array('group' => $groupFields,'fields' => $selectFields);  	                    
        	$parameters      = compact('conditions');
        	$this->recursive = 0;

        	return count($this->find('all', array_merge($parameters, $extra)));
  		}
  		else
  		{
			$parameters = compact('conditions');

			if ($recursive != $this->recursive){
				$parameters['recursive'] = $recursive;
			}

			$extra = array();

			return $this->find('count', array_merge($parameters, $extra));
  		}        	
    }

  	/**
  	 * Se tuvo que redefinir esta funcion para poder agregar el ultimo 
  	 * año que presenta cada plan
  	 * 
  	 * @return cantidad de registros
  	 */
        
    function paginate($conditions = null, $fields = null, $order = null, $limit = null, $page = 1, $recursive = null, $tieneHasMany = false)
	{
		if ($this->asociarAnio)
		{
			$this->bindModel(array('hasOne' => array('Anio' => array('className'  => 'Anio','foreignKey' => 'plan_id',),),));
	        $field = $this->getPagFields();

			if ($this->traerUltimaAct){
				$selectFields = array_merge($field,array("max(\"Anio\".\"ciclo_id\") AS \"Anio__ciclo_id\""));
	        	$groupFields  = $field;
			} else {
				$selectFields = array_merge($field, array('Anio.ciclo_id'));
				$groupFields = $selectFields;
			}				
	        
	        if ($this->maxCiclo != "" ){
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
   
	function setAsociarAnio($asociar){
		$this->asociarAnio = $asociar;	
	}   

	function setMaxCiclo($ciclo){
		$this->maxCiclo = $ciclo;	
	}   
	
	function setTraerUltimaAct($ult){
		$this->traerUltimaAct = $ult;	
	}   
	
	function getTraerUltimaAct(){
		return $this->traerUltimaAct;	
	}
	
  	/**
  	 * Suma las matriculas para un determinado plan y ciclo. 
  	 * 
  	 * 
  	 * @return matricula de determinado plan, ciclo.
  	 */
		
	function dameMatriculaDeCiclo($plan_id,$ciclo){
		$tot = $this->Anio->find('all',array(
			'fields'=>'sum(matricula) AS "Anio__matricula"',
			'conditions'=> array('plan_id'=>$plan_id,'ciclo_id'=>$ciclo),
			'limit'=> 1
		));
		return $tot[0]['Anio']['matricula'];
	}
	
	function controlar_coincidencia_sector_subsector(){
  		if (isset($this->data[$this->name]['subsector_id'])){
  			if ($this->data[$this->name]['subsector_id'] == ''){
  				$this->data[$this->name]['subsector_id'] = 0;
  				return true;
  			}
  			
  			if ($this->data[$this->name]['subsector_id'] == 0) return true;
  			
  			if ($this->data[$this->name]['subsector_id'] != ''){
		  		$sector_id = $this->data[$this->name]['sector_id'];
		  		$subsector_id = $this->data[$this->name]['subsector_id'];
		  		$this->Subsector->recursive = -1;
		  		$tot = $this->Subsector->find('count',array('conditions'=> array('Subsector.id'=>$subsector_id, 'Subsector.sector_id'=>$sector_id)));
		  		return ($tot > 0);
  			}
  		}
  		return false;
  	}
    	
  	
  	//TODO validar la oferta con la clase de institucion
  	function validar_oferta_id_con_claseinstit()
  	{
		return true;
  	}
	
  	
  	
  	//TODO refactoring, deberia devolver simplemente el ciclo y no un array
	/**
  	 * Esta funcion recibe el id de institucion y 
  	 * devuelve la última actualización (ciclo) que presenten sus planes
  	 *
  	 * @param $instit_id
  	 * @return Array $vec[ciclo_id][ciclo_id]
  	 */
  	
  	function dame_max_ciclos_por_instits($instit_id){
  		
		$vec = array();

		$sql  = " SELECT ciclo_id
					 FROM   planes p,
					 	(        
       					SELECT plan_id, max(ciclo_id) AS ciclo_id 
        				 FROM   anios AS an      
        					GROUP BY plan_id        
        				) max_ciclo              
					WHERE p.id = max_ciclo.plan_id  
					AND   p.instit_id = $instit_id
					GROUP BY ciclo_id
					ORDER BY ciclo_id ASC
				";
		
		$data = $this->query($sql);

		foreach ($data as $line){
			$vec[$line[0]['ciclo_id']] = $line[0]['ciclo_id']; 
		}

		return $vec;
  	}

  	function dame_ciclos_por_instits($instit_id){
  		
		$vec = array();

		$sql  = " SELECT ciclo_id ";
		$sql .= " FROM   planes p ";
		$sql .= "       ,anios  a ";
		$sql .= " WHERE  p.instit_id = " . $instit_id;
		$sql .= " AND    a.plan_id   = p.id ";
		$sql .= " GROUP  BY ciclo_id ";
		$sql .= " ORDER  BY ciclo_id ASC";
		
		$data = $this->query($sql);

		foreach ($data as $line){
			$vec[$line[0]['ciclo_id']] = $line[0]['ciclo_id']; 
		}

		return $vec;
  	}
  	
  	
  	
  	/**
  	 * Me devuelve el ultimo ciclo y la matricula del ultimo ciclo de la institucion
  	 * @param integer $instit_id
  	 * @return array $vec[max_ciclo] y 
  	 * 				 $vec[matricula]
  	 */
  	function dameMatriculaUltimoCiclo($instit_id){
  		$sql = "
  		SELECT max(a.ciclo_id) as max_ciclo, sum(a.matricula) as matricula
		FROM   planes p
		LEFT JOIN anios a ON (a.plan_id = p.id) 
		WHERE 
		p.instit_id = $instit_id
		";
  		
  		$data = $this->query($sql);
  		return $data[0][0];
  	}
  	
  	
  	
  	//TODO faltaria hacer el test de esto
  	/**
  	 * Me devuelve los sectores que abarca la institucion
  	 * @param integer $instit_id ID de la institucion
  	 * @param integer $ciclo_id (ciclo del año 2006, 2007, etc)
  	 * @return array $sectores[id][abrev]
  	 */
  	function dameSectoresPorInstitucion($instit_id,$ciclo_id){

		$vec = array();
		
		
		$sql = "
						SELECT s.id   AS id  , s.name AS name
						FROM   planes   p 
						LEFT JOIN sectores s ON (p.sector_id = s.id)
						LEFT JOIN anios a ON (a.plan_id = p.id)
						WHERE
						p.instit_id = $instit_id";
		
  		if ((int)$ciclo_id > 0){
			$sql .= " 	AND a.ciclo_id = $ciclo_id";
		}
		
		$sql .= "
						GROUP BY s.id, s.name 
						ORDER BY s.name ASC
		";
		
		
		$data = $this->query($sql);

		foreach ($data as $line){
			if (strlen($line[0]['name']) > 20){
				$vec[$line[0]['id']] = substr($line[0]['name'],0,20) . "..."; 
			} else {
				$vec[$line[0]['id']] = $line[0]['name'];
			}
		}

		return $vec;
  	}

  	
  	//TODO faltaria hacer el test de esto
  	/**
  	 * Me devuelve las ofertas que tiene la institucion pasada como parametro agrupada por oferta.
  	 * O sea, me indica la variedad de niveles que tiene una escuela.
  	 * Ej: SEC, SUP, IT .... o .... SEC, SUP
  	 * 
  	 * @param integer $instit_id ide de la institucion en cuestion
  	 * @param integer $ciclo_id id del ciclo que estoy buscando(2006, 2007. 2008, ¿2009?)
  	 * @return array $oferta[id][abrev]
  	 */
  	function dameOfertaPorInstitucion($instit_id,$ciclo_id = 0){
  		$sql = "  		
  					SELECT o.id AS id , o.abrev AS abrev
					FROM   planes   p
					LEFT JOIN ofertas o ON (o.id = p.oferta_id)
					LEFT JOIN anios    a ON (a.plan_id = p.id)
					WHERE  
					p.instit_id = $instit_id
				";
  		
		if ((int)$ciclo_id > 0){
			$sql .= " AND a.ciclo_id = " . $ciclo_id;
		}					

		$sql .= " 		
  					GROUP BY o.id, o.abrev 
					ORDER BY o.abrev ASC
				";

	
  		$data = $this->query($sql);
		$vec = array();
		foreach ($data as $line){
			$vec[$line[0]['id']] = $line[0]['abrev'];
		}
		
		return $vec;
  	}
  	
  	
	//TODO faltaria hacer el test de esto
  	/**
  	 * Me devuelve las ofertas que tiene la institucion pasada como parametro.
  	 * Me devuelve el listadop de ofertas al ciclo que se le pasa como parametro
  	 * 
  	 * @param integer $instit_id ide de la institucion en cuestion
  	 * @param integer $ciclo_id id del ciclo que estoy buscando(2006, 2007. 2008, ¿2009?)
  	 * @return array $oferta[id][abrev]
  	 */
  	function dameListadoOfertasPorInstitucion($instit_id,$ciclo_id = 0){
  		$condiciones = array();
  		$condiciones[]['Plan.instit_id'] = $instit_id;
  		if($ciclo_id){
  			$condiciones[]['Anio.ciclo_id'] = $ciclo_id;
  		}
  		$vec = $this->Anio->find('all',array(
  					'contain'=>array('Plan'=>array('Oferta(abrev)')), 
  					'group'=>'"Plan"."id", "Plan"."instit_id", "Plan"."oferta_id", "Plan"."old_item", "Plan"."norma", "Plan"."nombre", "Plan"."perfil", "Plan"."sector", "Plan"."duracion_hs", "Plan"."duracion_semanas", "Plan"."duracion_anios", "Plan"."matricula", "Plan"."observacion", "Plan"."ciclo_alta", "Plan"."ciclo_mod", "Plan"."created", "Plan"."modified", "Plan"."sector_id", "Plan"."subsector_id"',
  					'fields'=>'"Plan"."id" AS "Plan__id", "Plan"."instit_id" AS "Plan__instit_id", "Plan"."oferta_id" AS "Plan__oferta_id", "Plan"."old_item" AS "Plan__old_item", "Plan"."norma" AS "Plan__norma", "Plan"."nombre" AS "Plan__nombre", "Plan"."perfil" AS "Plan__perfil", "Plan"."sector" AS "Plan__sector", "Plan"."duracion_hs" AS "Plan__duracion_hs", "Plan"."duracion_semanas" AS "Plan__duracion_semanas", "Plan"."duracion_anios" AS "Plan__duracion_anios", "Plan"."matricula" AS "Plan__matricula", "Plan"."observacion" AS "Plan__observacion", "Plan"."ciclo_alta" AS "Plan__ciclo_alta", "Plan"."ciclo_mod" AS "Plan__ciclo_mod", "Plan"."created" AS "Plan__created", "Plan"."modified" AS "Plan__modified", "Plan"."sector_id" AS "Plan__sector_id", "Plan"."subsector_id" AS "Plan__subsector_id"',
  					'conditions'=>$condiciones));
  		
		return $vec;
  	}

}
?>