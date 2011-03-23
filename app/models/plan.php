<?php
class Plan extends AppModel {

	var $name = 'Plan';

        
        /*
         * $asociarAnio lo que hace es agregar la Estructura y la Etapa a
         * la cual pertenece el a�o.
         * Esto es agregado en el vector de Anios que devuelve el Plan
         *
         * O sea, s�lo sirve para que el array de Planes me traiga m�s info
         * sobre los Anios
         *
         * Para poder utilizar esta variable es necesario pasar como parametro
         * en la busqueda al mismo estilo que se pasa un 'conditions', o 'contain'
         * seria algo asi $params['asociarAnio'] = true
         *
         * Esta variable es inicializada en "false" luego de cada find
         * 
         * @var $this->asociarAnio boolean
         */
	private $__asociarAnio = false; // Se utiliza en el paginador (asocia ultimo anio y todos los models relacionados por joins)

        /*
         * $__asociarCompleto sirve para realizar busquedas avanzadas
         *
         * Si asociarCompleto esta setteado en true, entonces el SELECT
         * se realizar� con infinidad de JOINS para que pueda buscar
         * Los modelos Joineados son:
                'Instit'
                'EstructuraPlan'
                'Etapa'
                'Anio'
                'Titulo'
                'SectoresTitulo',
         * 
         * Para poder utilizar esta variable es necesario pasar como parametro
         * en la busqueda al mismo estilo que se pasa un 'conditions', o 'contain'
         * seria algo asi $params['asociarCompleto'] = true
         *
         *
         * Esta variable es inicializada en "false" luego de cada find
         */
        private $__asociarCompleto = false;

        
	var $maxCiclo = "";
	var $traerUltimaAct = false; // se utiliza en el paginador.
	
	var $actsAs = array('Containable');

        var $order = array();

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array( 
			'Instit' ,
			'Oferta',
			'Titulo',
                        'EstructuraPlan'
            );

	var $hasMany = array(
            'Anio' => array(
                'order'=> array('Anio.plan_id', 'Anio.ciclo_id DESC', 'Anio.anio ASC'),
                'dependent'=> true, // borra en cascada
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
				'message' => 'Debe ingresar formato de a�o, con 4 d�gitos.'	
			)
		),
		'duracion_hs' => array(
			'number' => array(
				'rule' => VALID_NUMBER,
				'required' => true,
				'allowEmpty' => true,
				'message' => 'Debe ingresar un valor num�rico para las horas.'
			),
			'between' => array(
				'rule' => array('between','0','9'),
				'required' => true,
				'allowEmpty' => true,
				'message' => 'La duraci�n no puede ser un valor tan alto'
			
			)
		),
		'duracion_semanas' => array(
			'number' => array(
				'rule' => VALID_NUMBER,
				'required' => false,
				'allowEmpty' => true,
				'message' => 'Debe ingresar un valor num�rico para las semanas.'
			
			),
			'between' => array(
				'rule' => array('between','0','9'),
				'required' => false,
				'allowEmpty' => true,
				'message' => 'La duraci�n no puede ser un valor tan alto'
			
			)
		),
		'duracion_anios' => array(
			'number' => array(
				'rule' => VALID_NUMBER,
				'required' => true,
				'allowEmpty' => true,
				'message' => 'Debe ingresar un valor num�rico para los a�os.'
			
			),
			'between' => array(
				'rule' => array('between','0','9'),
				'required' => true,
				'allowEmpty' => true,
				'message' => 'La duraci�n no puede ser un valor tan alto'
			
			)
		),

                'titulo_id' => array(
                        'coincidir_con_oferta' => array(
                            'rule'   =>'coincidir_con_oferta',
                            'message'=>'El t�tulo seleccionado no corresponde a la oferta indicada.')
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
        
	

        public function find($conditions = null, $fields = null, $order = null, $recursive = null) {

            if (!empty($fields['asociarAnio'])) {
               $this->__asociarAnio = true;
            }

            if (!empty($fields['asociarCompleto']) || $conditions == 'completo' || $conditions == 'countCompleto') {
               $this->__asociarCompleto = true;
            }

            if ($this->__asociarAnio || $this->__asociarCompleto) {
                if ($conditions == 'count') {
                    $ret = $this->__findCompleto('count', $fields, $order, $recursive);
                } else {
                    $ret = $this->__findCompleto('buscar',$fields, $order, $recursive);
                }
            } else {
               $ret = parent::find($conditions, $fields, $order, $recursive);
            }
            // luego de cada find vuelvo a inicializar las variables de asociacion
            $this->__asociarAnio = $this->__asociarCompleto = false; // las vuelvo a poner en false
            return $ret;
        }

        
        /**
         * Devuelve un find "all" pero con un monton de JOINS extra.
         * Adem�s, si se pone $this->__asociarAnio en true, trae los a�os
         * asociados con la informacion de EstructuraPlanesAnio y Etapa
         * 
         * @param array $parameters
         *                      ['asociarAnio'] = true   ::: trae los a�os
                                        asociados con la informacion de
         *                              EstructuraPlanesAnio y Etapa
         * @param string $buscaroSoloContar
         *                      Los valores posibles son: 'buscar' (por default)  o 'count'
         * @return array
         */
        function __findCompleto($buscaroSoloContar = 'buscar', $parameters = array(), $order = null, $recursive = null) {

                $parameters = array_merge($parameters, compact('conditions', 'fields', 'order', 'recursive'));

                if (isset ($parameters['asociarAnio'])) {
                   $this->__asociarAnio = $parameters['asociarAnio'];
                }
   
                if (isset ($parameters['asociarCompleto'])) {
                   $this->__asociarCompleto = $parameters['asociarCompleto'];
                }

                if (is_numeric($recursive) && $recursive != $this->recursive) {
                    $parameters['recursive'] = $recursive;
                }

                $parameters['joins'] = array(
                    array(
                        'table' => 'instits',
                        'type' => 'LEFT',
                        'alias' => 'Instit',
                        'conditions' => array('Instit.id = Plan.instit_id'),
                    ),
                    array(
                        'table' => 'estructura_planes',
                        'type' => 'LEFT',
                        'alias' => 'EstructuraPlan',
                        'conditions' => array('EstructuraPlan.id = Plan.estructura_plan_id'),
                    ),                    
                    array(
                        'table' => 'anios',
                        'type' => 'LEFT',
                        'alias' => 'Anio',
                        'conditions' => array('Plan.id = Anio.plan_id'),
                    ),
                    array(
                        'table' => 'etapas',
                        'type' => 'LEFT',
                        'alias' => 'Etapa',
                        'conditions' => array('Anio.etapa_id = Etapa.id'),
                    ),
                    array(
                        'table' => 'ciclos',
                        'type' => 'LEFT',
                        'alias' => 'Ciclo',
                        'conditions' => array('Ciclo.id = Anio.ciclo_id'),
                    ),
                    array(
                        'table' => 'titulos',
                        'type' => 'LEFT',
                        'alias' => 'Titulo',
                        'conditions' => array('Titulo.id = Plan.titulo_id'),
                    ),
                    array(
                        'table' => 'sectores_titulos',
                        'type' => 'LEFT',
                        'alias' => 'SectoresTitulo',
                        'conditions' => array('SectoresTitulo.titulo_id = Titulo.id'),
                    ),
                    array(
                        'table' => 'sectores',
                        'type' => 'LEFT',
                        'alias' => 'Sector',
                        'conditions' => array('SectoresTitulo.sector_id = Sector.id'),
                    ),
                    array(
                        'table' => 'orientaciones',
                        'type' => 'LEFT',
                        'alias' => 'Orientacion',
                        'conditions' => array('Orientacion.id = Sector.orientacion_id'),
                    ),
             );

            if ($buscaroSoloContar == 'count') {
                // si solo es para obtener el total no necesito seguir...
                //$parameters['fields'] = array('COUNT(*)');
                $paramsAux = $parameters;
                $paramsAux['group']= 'Plan.id';
                $paramsAux['fields']= 'Plan.id';
                unset($paramsAux['contain']);
                $this->recursive = -1;
                $query = $this->subquery('count', $paramsAux,'Plan');
                return count($this->query($query));
                //return parent::find('count', $parameters);
            }
  ;
            // recojo todas las instituciones que cumplan con los criterios de busqueda
            $planesIds = parent::find('list', $parameters);
            if (empty($planesIds) ) {
                // no hay instituciones que cumplan con esos criterios de busqueda
                return array();
            }

            $parameters['conditions'] = array('Plan.id' => $planesIds);

            unset( $parameters['limit'] );
            unset( $parameters['page'] );
            unset( $parameters['joins'] );

            if (empty($parameters['contain'])) {
                $parameters['contain'] = array(
                    'Instit' => array(
                        'Orientacion'
                        ),
                    'EstructuraPlan',
                    'Oferta',
                    'Titulo' => array(
                        'SectoresTitulo' => array(
                            'Sector' => array(
                                'Orientacion'
                                ),
                            ),
                        ),
                    'SectoresTitulo' => array(
                        'Subsector'
                        ),
                    'Anio' => array(
                        'EstructuraPlanesAnio',
                        'Etapa'
                        ),
                );
            }
            
            $planes = parent::find('all', $parameters);

            $ciclo_id = 0;
            if ( !empty($parameters['conditions']['Anio.ciclo_id'])) {
                $ciclo_id = $parameters['conditions']['Anio.ciclo_id'];
            }
            if ( !empty($parameters['conditions']['Ciclo.id'])) {
                $ciclo_id = $parameters['conditions']['Ciclo.id'];
            }

            if ($this->__asociarAnio) {
                foreach ( $planes as $key=>&$p) {
                    $aas = $this->Anio->getAniosDePlanPorCiclo($p['Plan']['id'], $ciclo_id);

                    // hago que tengo una estructura "linda" e igual a
                    // si no hubiese asociadoAnio, para mayor compatibilidad
                    unset($p['Anio']);
                    $p['Anio'] = $aas;
                    foreach ($p['Anio'] as &$a2){
                        $a2 = array_merge($a2, $a2['Anio']);
                        unset($a2['Anio']);
                    }

                }
            }

            // luego de cada find vuelvo a inicializar las variables de asociacion
            $this->__asociarAnio = $this->__asociarCompleto = false; // las vuelvo a poner en false
            
            return $planes;
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
		
	function dameMatriculaDeCiclo($plan_id = null,$ciclo = 0){
                if (!empty($plan_id)){
                    $this->id = $plan_id;
                }
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
	
  	
  	
  	
  	

        /**
         * Me devuelve la estructura de un Plan Tecnico (si no es tecnico,
         * o sea oferta_id = SEC_TEC, devuelve -1).
         * En el caso que la estructura no haya sido asignada, busca entre los anios
         * del Plan para identificar la estructura de su oferta
         * Si hay varios ciclos lectivos busca en el ultimo.
         * Devuelve el ID de la estcuctura del plan
         * 
         * @param integer $plan_id
         * @param bool $busqueda_forzada forza la sugerencia por mas que ya tenga estructura asociada
         * @return integer  devuelve el ID de estructura_planes. Si el plan NO es tecnico, devuelve -1
         */
        function getEstructuraSugerida($plan_id=null, $busqueda_forzada=false){
            if (empty($plan_id)) {
                $plan_id = $this->id;
            }

            $this->recursive = -1;
            $plan = $this->findById($plan_id);
            // si el plan no es tecnico que devuelva -1
            if ($plan['Plan']['oferta_id'] != SEC_TEC_ID) {
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
                        // si no coincide la cantidad de a�os, lo sugiere igual
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
                    array('title'=>'Ciclo B�sico', 'anios'=>array(1,2,3)),
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
         * Verifica que todos los a�os del plan tengan la misma estructura que
         * su Plan padre
         * 
         * @param integer $plan_id
         * @return true si teiene estructura valida o un array con los a�os incorrectos en caso de no tenerla
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
                    
                    // verifico que tenga estructura el a�o
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
