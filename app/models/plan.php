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
//			'Sector',
//			'Subsector',
			'Titulo',
                        'EstructuraPlan'
            );

	var $hasMany = array(
            'Anio' => array('order'=> array('Anio.plan_id', 'Anio.ciclo_id DESC', 'Anio.anio ASC'))
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
				'message' => 'Debe ingresar un sector.',
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
		),

                'titulo_id' => array(
                        'coincidir_con_oferta' => array(
                            'rule'   =>'coincidir_con_oferta',
                            'message'=>'El título seleccionado no corresponde a la oferta indicada.')
                )
	);


        /**
         * Me dice si el titulo de referencia
         * pertenece a la oferta
         * @return boolean
         */
        function coincidir_con_oferta(){
            if(!empty($this->data['Plan']['oferta_id'])){
                if (!empty($this->data['Plan']['titulo_id'])) {
                    $cond['conditions'] = array(
                        'Titulo.oferta_id'=>$this->data['Plan']['oferta_id'],
                        'Titulo.id'=>$this->data['Plan']['titulo_id'],
                    );
                    if ($this->Titulo->find('count',$cond) == 1){
                        return true;
                    } else {
                        return false;
                    }
                }
                return true;
            }
        }
        
	
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
                        $this->unBindModel(array('hasMany'=>array('Anio')));
			$this->bindModel(array('hasOne' => array('Anio')));
                        $field = $this->getPagFields();
	        
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
	        
                $extra = array(
                    'group' => $groupFields,
                    'fields' => $selectFields,
                    'contain'=>array(
                        'Instit', 'Oferta',
                        'Sector', 'Subsector', 'Titulo',
                        'EstructuraPlan'=>array('Etapa'),
                        'Anio'=> array('EstructuraPlanesAnio')
                        ),
                    );
                
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
        
    function paginate($conditions = null, $fields = null, $order = null, $limit = null, $page = 1, $recursive = null, $tieneHasMany = false) {
            if ($this->asociarAnio) {
                $this->bindModel(array('hasOne' => array('Anio')));
                $field = $this->getPagFields();

                if ($this->traerUltimaAct) {
                    $selectFields = array_merge($field,array('max("Anio"."ciclo_id") AS "Anio__ciclo_id"'));
                    $groupFields  = $field;
                } else {
                    $selectFields = array_merge($field, array('Anio.ciclo_id'));
                    $groupFields = $selectFields;
                }

                if ($this->maxCiclo != "" ) {
                    $groupFields = array_merge($groupFields ,array('1" HAVING max("Anio"."ciclo_id") = ' . $this->maxCiclo));
                }
                //$groupFields = array_merge($groupFields,array('Anio.anio'));
                //rompe vista TODOS en solapas de Oferta Educativa

                $extra = array(
                    'group' => $groupFields,
                    'fields' => $selectFields,
                    'contain'=>array(
                        'Instit', 'Oferta',
                        'Sector', 'Subsector', 'Titulo',
                        'EstructuraPlan'=>array('Etapa'),
                        'Anio.Etapa'
                        ),
                    //'order'=>'Anio.anio'  rompe vista TODOS en solapas de Oferta Educativa
                    );
                $parameters = compact('conditions', 'fields', 'order', 'limit', 'page');

                if ($recursive != $this->recursive) {
                    $parameters['recursive'] = $recursive;
                }

                return $this->find('all', array_merge($parameters, $extra));
            }
            else {
                $parameters = compact('conditions', 'fields', 'order', 'limit', 'page');

                if ($recursive != $this->recursive) {
                    $parameters['recursive'] = $recursive;
                }

                $extra = array();

                return $this->find('all', array_merge($parameters, $extra));
            }
        }

        public function findXCiclo($instit_id, $oferta_id, $ciclo_id){
            $condi = array();
            if (!empty($ciclo_id)) $condi = array('Anio.ciclo_id'=>$ciclo_id);
            
            return $this->find("all",array(
                      'conditions'=>array(
                                    'instit_id'=>$instit_id,
                                    'oferta_id'=>$oferta_id
                                    ),
                      'contain'=>array(
                                    'Sector','Subsector','EstructuraPlan','Instit',
                                    'Anio'=> array('Etapa','conditions'=>$condi)
                                    )

                      ));
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
                $conditions = array();

                if($ciclo == 0){
                    $conditions = array('plan_id'=>$plan_id);
                }
                else{
                    $conditions = array('plan_id'=>$plan_id,'ciclo_id'=>$ciclo);
                }

                $tot = $this->Anio->find('all',array(
                        'fields'=>'sum("Anio"."matricula") AS "Anio__matricula"',
                        'conditions'=> $conditions,
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

        function dame_ciclos_por_oferta_instits($instit_id, $agregar_anio_actual = true) {

		$vec = array();

                $oferta = $this->dameOfertaPorInstitucion($instit_id);
                foreach ($oferta as &$o) {
                    $o = array(
                        'ciclo' => array(),
                        'name' => '',
                        );
                }

		$sql   = " SELECT distinct oferta_id,o.abrev, ciclo_id";
                $sql  .= " FROM planes p";
                $sql  .= " INNER JOIN anios a ON a.plan_id = p.id";
                $sql  .= " INNER JOIN ofertas o ON o.id = p.oferta_id";
                $sql  .= " WHERE p.instit_id = " . $instit_id ;
                $sql  .= " GROUP by oferta_id, o.abrev, ciclo_id";
                $sql  .= " ORDER by oferta_id, o.abrev,ciclo_id DESC";

		$data = $this->query($sql);

                foreach ($data as $line){
			$oferta[$line[0]['oferta_id']]['ciclo'][] = $line[0]['ciclo_id'];
                        $oferta[$line[0]['oferta_id']]['name'] = $line[0]['abrev'];
                }

                $ciclos = $oferta;
                if ($agregar_anio_actual) {
                    // agregarle el año actual si no existe
                    $existe = false;
                    foreach ($ciclos as &$c) {
                        // le agrego solo si no existe
                        foreach ($c['ciclo'] as $cc) {
                            if (date('Y') == $cc )  {
                                $existe = true;
                                break;
                            }
                        }
                        if (!$existe) {
                             array_unshift(&$c['ciclo'],date('Y'));
                        }
                        $existe = false;
                    }
                }

		return $ciclos;
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
  					SELECT o.id AS id , o.name AS abrev
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
  					GROUP BY o.id, o.name
					ORDER BY o.name ASC
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



        /**
         *
         * Me busca entre los anios del Plan para identificar la estructura de su oferta
         * Si hay varios ciclos lectivos me busca el ultimo
         * Devuelve el ID de la estcuctura del plan
         * 
         * @param integer $plan_id
         * @param bool $busqueda_forzada forza la sugerencia por mas que ya tenga estructura asociada
         * @return integer  devuelve el ID de estructura_planes
         */
        function getEstructuraSugerida($plan_id=null, $busqueda_forzada=false){
            if (empty($plan_id)) {
                $plan_id = $this->id;
            }

            $this->recursive = -1;
            $plan = $this->findById($plan_id);
            // si el plan no es tecnico que devuelva -1
            if ($plan['Plan']['oferta_id'] != 3) {
                return -1;
            }
            if (!$busqueda_forzada) {
                // si ya tiene una estructura asignada                
                if ($plan['Plan']['estructura_plan_id'] != 0)
                    return $plan['Plan']['estructura_plan_id'];
            }

            $anios = $this->Anio->find('all',array(
                                    'fields'=> array('ciclo_id','etapa_id','count(etapa_id) AS "Anio__total"'),
                                    'conditions'=> array(
                                        'plan_id'=>$plan_id),
                                    'group'=> array('etapa_id', 'ciclo_id'),
                                    'order'=>'ciclo_id'));
            /*
            [0] => Array
                (
                    [Anio] => Array
                        (
                            [ciclo_id] => 2007
                            [etapa_id] => 4  // (C.B.)
                            [total] => 3
                        )

                )

            [1] => Array
                (
                    [Anio] => Array
                        (
                            [ciclo_id] => 2007
                            [etapa_id] => 5 // (C.S.)
                            [total] => 3
                        )

                )
             */
            // chequea si existen en un mismo ciclo distintas etapas
            $ciclo_anterior = '';
            $totales = '';
            foreach ($anios as $anio) {
                if ($anio['Anio']['ciclo_id'] != $ciclo_anterior)
                {
                    $ciclo_anterior = $anio['Anio']['ciclo_id'];
                    $etapas_en_ciclos[$anio['Anio']['ciclo_id']] = $anio['Anio']['etapa_id'];

                    $totales[$anio['Anio']['ciclo_id']][$anio['Anio']['etapa_id']] = $anio['Anio']['total'];
                }
                else {
                    // etapa repetida en un mismo ciclo
                    if (!@in_array($anio['Anio']['ciclo_id'], $ciclos_con_repeticiones)) {
                        $ciclos_con_repeticiones[] = $anio['Anio']['ciclo_id'];
                    }
                }
                $etapas[$anio['Anio']['ciclo_id']][$anio['Anio']['etapa_id']] = $anio['Anio']['total'];
            }
            
            // si hubo repeticiones pero el ultimo ciclo no tuvo, se sugiere el mismo
            if (!@in_array($ciclo_anterior, $ciclos_con_repeticiones))
            {
                $plan = $this->find('all', array(
                                    'fields'=> array('id'),
                                    'contain'=>array('Instit'=>array('fields'=>'jurisdiccion_id')),
                                    'conditions'=> array('Plan.id'=>$plan_id)
                                        ));
                if ($plan && !empty($etapas_en_ciclos))
                {
                    $etapa_id_de_este_ciclo = $etapas_en_ciclos[$ciclo_anterior];
                    $estructuraPlanes = $this->EstructuraPlan->JurisdiccionesEstructuraPlan->find('all',array(
                                        //'fields'=> array('id'),
                                        'contain'=>array(
                                           // 'EstructuraPlanesAnio',
                                            'EstructuraPlan.EstructuraPlanesAnio',
                                            ),
                                        'conditions'=> array(
                                            'EstructuraPlan.etapa_id'=>$etapa_id_de_este_ciclo,
                                            'JurisdiccionesEstructuraPlan.jurisdiccion_id'=>$plan['0']['Instit']['jurisdiccion_id']
                                            ),
                                    ));
                    

                    if ($estructuraPlanes) {
                        $cant_etapas_de_este_ciclo = $etapas[$ciclo_anterior][$etapa_id_de_este_ciclo];

                        if (count($estructuraPlanes) == 1) {
                            if (count($estructuraPlanes[0]['EstructuraPlan']['EstructuraPlanesAnio']) >= $cant_etapas_de_este_ciclo) {
                                    return $estructuraPlanes[0]['EstructuraPlan']['id'];
                                }
                        }
                        else {
                            foreach ($estructuraPlanes as $estructuraPlan) {
                                // si tengo una estructura mayor a la cant de Anios cargados, duda (0)
                                if (count($estructuraPlan['EstructuraPlan']['EstructuraPlanesAnio']) > $cant_etapas_de_este_ciclo) {
                                    return 0;
                                }
                            }

                            foreach ($estructuraPlanes as $estructuraPlan) {
                                // si tengo una estructura con la misma cant de Anios cargados, la retorna
                                if (count($estructuraPlan['EstructuraPlan']['EstructuraPlanesAnio']) == $cant_etapas_de_este_ciclo) {
                                    return $estructuraPlan['EstructuraPlan']['id'];
                                }
                            }
                        }
                        // si no coincide la cantidad de años, lo sugiere igual
                        //return $estructuraPlanes['0']['EstructuraPlan']['id'];
                    }
                }
            }
            return 0;
        }


        /**
         *  Me devuelve la Etapa del Plan obteniendo el valor de EstructuraPlan
         *  las etapas son: Ciclo Basico, Ciclo Superior, Polimodal, EGB3, etc etc
         * @param integer $plan_id
         * @return array del model Etapa, o false en caso de no tener etapa definida
         */
        function getEtapaDeEstructura($plan_id){
            $plan = $this->find('first', array(
                'contain' => array('EstructuraPlan.Etapa'),
                'conditions' => array('Plan.id'=>$plan_id),
            ));
            return  (!empty($plan['EstructuraPlan']['Etapa'])) ? $plan['EstructuraPlan']['Etapa']: false;
        }


        function getEstructuraOfertaYDatos(){
               $trayectosData['anios'] = array(12,13,14,15);
                $trayectosData['etapa_header'] = array(
                    array('title'=>'Ciclo Básico', 'anios'=>array(1,2,3)),
                    array('title'=>'Ciclo Superior', 'anios'=>array(4)),
                );
                $trayectosData['ciclo_lectivo'] = array(
                    array('title'=>2009,
                        'ciclos_data'=> array(
                            array(
                                'matricula'=>12,
                                'seccion'=>10,
                                'hs_taller'=>1,
                            ),
                            array(
                                'matricula'=>12,
                                'seccion'=>10,
                                'hs_taller'=>2,
                            ),
                            array(
                                'matricula'=>12,
                                'seccion'=>10,
                                'hs_taller'=>3,
                            ),
                            array(
                                'matricula'=>12,
                                'seccion'=>10,
                                'hs_taller'=>4,
                            ),
                        )),
                    array('title'=>2008,
                        'ciclos_data'=> array(
                            array(
                                'matricula'=>12,
                                'seccion'=>10,
                                'hs_taller'=>1,
                            ),
                            array(
                                'matricula'=>12,
                                'seccion'=>10,
                                'hs_taller'=>2,
                            ),
                            array(
                                'matricula'=>12,
                                'seccion'=>10,
                                'hs_taller'=>3,
                            ),
                            array(
                                'matricula'=>12,
                                'seccion'=>10,
                                'hs_taller'=>4,
                            ),
                        )),
                );
                return $trayectosData;
        }


        /**
         *
         * @param integer $plan_id id del plan, por defecto en nulo
         * @param integer $estructura_plan_id
         */
        function guardarEstructuraSiNoLaTiene($estructura_plan_id, $plan_id = null){
            $this->recursive = -1;
            
            if (!empty($plan_id)) $this->id = $plan_id;
            
            $plan = $this->read();

            if (empty($plan['Plan']['estructura_plan_id'])){
                if (!$this->saveField('estructura_plan_id', $estructura_plan_id)){
                    debug("error al guardar el ID del plan");
                }
            }
        }


        function tieneEstructuraDefinida($plan_id = null){
            if (empty($plan_id)) {
                $plan_id = $this->id;
            }
            $ep = $this->find('count', array(
                    'conditions' => array(
                        'Plan.estructura_plan_id <>' => 0,
                        'Plan.id' => $plan_id,
                        ),
                    'recursive' => -1,
                    ));

            return $ep;

        }



        /**
         * Verifica que todos los años del plan tengan la misma estructura que
         * su Plan padre
         * 
         * @param integer $plan_id
         * @return true si teiene estructura valida o un array con los años incorrectos en caso de no tenerla
         */
        function estructuraValida($plan_id = null){
            if (empty($plan_id)) {
                $plan_id = $this->id;
            }

            if (!empty($plan_id)){
                    // busca la estructura del plan
                    $ep = $this->find('first', array(
                        'conditions' => array(
                            'Plan.id' => $plan_id,
                            ),
                        'contain' => array('EstructuraPlan'),
                    ));

                    // Si el plan no es Secundario Tecnico
                    // devolver siempre que la estructura es valida
                    if ($ep['Plan']['oferta_id'] != 3) {
                        return true;
                    }
                    
                    // busco si hay anios que tengan otra estructura
                    $cant = $this->Anio->find('all', array(
                        'conditions' => array(
                            'Anio.plan_id' => $plan_id,
                            'OR' => array (
                                'EstructuraPlanesAnio.estructura_plan_id <>' => $ep['EstructuraPlan']['id'],
                                'Anio.estructura_planes_anio_id' => 0,
                                )
                        ),
                        'contain' => array(
                            'EstructuraPlanesAnio.EstructuraPlan',
                        ),
                        'order' => array('Anio.ciclo_id', 'EstructuraPlanesAnio.edad_teorica'),
                    ));
                    
                    // verifico que tenga estructura el año
                     $cant2 = $this->Anio->find('all', array(
                        'conditions' => array(
                            'Anio.plan_id' => $plan_id,
                        ),
                        'contain' => array('EstructuraPlanesAnio'),
                        'order' => array('Anio.ciclo_id', 'EstructuraPlanesAnio.edad_teorica'),
                    ));
                    $newVec = array();
                    foreach ($cant2 as $cc){
                        if (empty($cc['EstructuraPlanesAnio']['id'])){
                            $newVec[] = $cc;
                        }
                    }
                    if (count($newVec)>0){
                        $cant += $newVec;
                    }

                    return (count($cant) > 0)  ?    $cant   :    true;
            }
            return true;
        }

        /**
         * devuelve el ultimo ciclo lectivo del plan
         */
        function getUltimoCiclo($plan_id){
            $sql = ' SELECT max("Anio"."ciclo_id") AS "Anio__ciclo_id"
                       FROM planes p
                      INNER JOIN anios AS "Anio" ON "Anio".plan_id = p.id
                      WHERE p.id = ' . $plan_id;

            $data = $this->query($sql);

            $max_ciclo = 0;
            foreach ($data as $line){
                    $max_ciclo = $line['Anio']['ciclo_id'];
            }

            return $max_ciclo;
        }

        function filtrar_planes($planes,$filtro_titulo,$filtro_sector,$filtro_ciclo){
            return $planes;
        }

        

        
}
?>
