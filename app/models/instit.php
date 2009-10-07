<?php
class Instit extends AppModel {

	var $name = 'Instit';
	var $asociarPlan = false;

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Gestion' => array('className' => 'Gestion',
								'foreignKey' => 'gestion_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			),
			'Dependencia' => array('className' => 'Dependencia',
								'foreignKey' => 'dependencia_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			),
			'Tipoinstit' => array('className' => 'Tipoinstit',
								'foreignKey' => 'tipoinstit_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			),
			'Jurisdiccion' => array('className' => 'Jurisdiccion',
								'foreignKey' => 'jurisdiccion_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			),
			'Departamento' => array('className' => 'Departamento',
								'foreignKey' => 'departamento_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			),
			'Localidad' => array('className' => 'Localidad',
								'foreignKey' => 'localidad_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);

	var $hasMany = array(
			'Plan' => array('className' => 'Plan',
								'foreignKey' => 'instit_id',
								'dependent' => false,
								'conditions' => '',
								'fields' => '',
								'order' => '',
								'limit' => '',
								'offset' => '',
								'exclusive' => '',
								'finderQuery' => '',
								'counterQuery' => ''
			),
			'HistorialCue' => array('className' => 'HistorialCue',
								'foreignKey' => 'instit_id',
								'dependent' => true,
								'conditions' => '',
								'fields' => '',
								'order' => 'HistorialCue.created DESC',
								'limit' => '',
								'offset' => '',
								'exclusive' => '',
								'finderQuery' => '',
								'counterQuery' => ''
			),
			'Ticket' => array('className' => 'Ticket',
								'foreignKey' => 'instit_id',
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

	var $validate = array(
      	'cue' => array(
			/**
			 * Aca se verifica que los numeros iniciales del  CUE sean
			 * macheados con la jurisdiccion para comprobar la validez del CUE.
			 * 
			 */
			'cue_y_anexo_unico' => array(
				'rule' => array('cue_y_anexo_unico'),
				'message'=> 'El CUE o el ANEXO ya existen.'
			),

			/**
			 * Aca se verifica que los numeros iniciales del  CUE sean
			 * macheados con la jurisdiccion para comprobar la validez del CUE.
			 * 
			 */
			'jurisdiccion_y_cue_match' => array(
				'rule' => array('controlar_coincidencia_cue_jurisdiccion'),
				'message'=> 'El CUE no corresponde a la Jurisdicción.'
			),
			
			/*
			 * Esta validacion controla que el cue sea ingersado correctamente. 
			 * En este caso, corrobora que los 2 primeros digitos correspondan a los
			 * codigos de cada provincia, establecidos tal como se utilizan en la 
			 * oficina de informacion 309
			 * 
			 * 
			 */
			'jurisdiccion_correcta' => array(
				'rule' => '/^(2|6|02|06|10|14|18|22|26|30|34|38|42|46|50|54|58|62|66|70|74|78|82|86|90|94)[0-9]{5}$/',
				'required' => true,
				'allowEmpty' => false,
				'message' => 'El CUE ingresado no es válido. No concuerda con el código de jurisdicción'
			
			),
			
			
			'notEmpty' => array( // or: array('ruleName', 'param1', 'param2' ...)
				'rule' => VALID_NOT_EMPTY,
				'required' => true,
				'allowEmpty' => false,
				//'on' => 'create', // or: 'update'
				'message' => 'El CUE no puede quedar vacío.'
			),
			'number' => array(
				'rule' => VALID_NUMBER,
				'required' => true,
				'allowEmpty' => false,
				'message' => 'Debe ingresar un valor numérico para el CUE.'
			
			),
			'between' => array(
				'rule' => array('between','6','7'),
				'required' => true,
				'allowEmpty' => false,
				'message' => 'El CUE debe ser de 6 ó 7 dígitos. No es necesario el cero inicial en CUEs de 6 dígitos. Ej: 600118, 5000216.'
			
			)		
   		),
   		'anexo' => array(
			'notEmpty' => array( // or: array('ruleName', 'param1', 'param2' ...)
				'rule' => VALID_NOT_EMPTY,
				'required' => true,
				'allowEmpty' => false,
				//'on' => 'create', // or: 'update'
				'message' => 'El Número de Anexo no puede quedar vacío.'
			),
			'number' => array(
				'rule' => VALID_NUMBER,
				'required' => true,
				'allowEmpty' => false,
				'message' => 'Debe ingresar un número de Anexo.'
			
			),
			'between' => array(
				'rule' => array('between','1','2'),
				'required' => true,
				'allowEmpty' => false,
				'message' => 'Válidos: 0 a 99.'
			
			)	
   		),
   		'anio_creacion' => array(
   			'year' => array(
				'rule' => VALID_YEAR,
				'required' => false,
				'allowEmpty' => true,
				'message' => 'Debe ingresar un año de 4 dígitos. Si no conoce la fecha de creación, debe dejar el campo vacío.'
			),
		),
		'direccion' => array(
			'notEmpty' => array( // or: array('ruleName', 'param1', 'param2' ...)
				'rule' => VALID_NOT_EMPTY,
				'required' => true,
				'allowEmpty' => false,
				//'on' => 'create', // or: 'update'
				'message' => 'La dirección no puede quedar vacía.'
			),
		),
		'departamento_id' => array(
			'rule' => array('controlar_coincidencia_jurisdiccion_departamento'),
			'message'=> 'El departamento no corresponde a esa jurisdicción.',	
		),
		'localidad_id' => array(
			'rule' => array('controlar_coincidencia_departamento_localidad'),
			'message'=> 'La localidad no corresponde a ese Departamento.'
		),
		'cp' => array(
			'notEmpty' => array( // or: array('ruleName', 'param1', 'param2' ...)
				'rule' => VALID_NOT_EMPTY,
				'required' => true,
				'allowEmpty' => false,
				//'on' => 'create', // or: 'update'
				'message' => 'El Código Postal no puede quedar vacío.'
			),
		),
		'mail' => array(
			'email' => array(
				'rule' => VALID_EMAIL,
				'required' => false,
				'allowEmpty' => true,
				//'on' => 'create', // or: 'update'
				'message' => 'La dirección de e-mail no es válida.'
			)
		),
		'mail_alternativo' => array(
			'email' => array(
				'rule' => VALID_EMAIL,
				'required' => false,
				'allowEmpty' => true,
				//'on' => 'create', // or: 'update'
				'message' => 'La dirección de e-mail no es válida.'
			)
		),
   		'dir_nrodoc' => array(
   			'number' => array(
				'rule' => VALID_NUMBER,
				'required' => false,
				'allowEmpty' => true,
				'message' => 'Debe ingresar un valor numérico.'
			),
		),
		'dir_mail' => array(
			'email' => array(
				'rule' => VALID_EMAIL,
				'required' => false,
				'allowEmpty' => true,
				//'on' => 'create', // or: 'update'
				'message' => 'La dirección de e-mail no es válida.'
			)
		),
		'dir_mail_alternativo' => array(
			'email' => array(
				'rule' => VALID_EMAIL,
				'required' => false,
				'allowEmpty' => true,
				//'on' => 'create', // or: 'update'
				'message' => 'La dirección de e-mail no es válida.'
			)
		),
		'vice_nrodoc' => array(
   			'number' => array(
				'rule' => VALID_NUMBER,
				'required' => false,
				'allowEmpty' => true,
				'message' => 'Debe ingresar un valor numérico.'
			),
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
				'message' => 'Debe ingresar formato de año, con 4 dígitos. Ej: 2008.'	
			)
		),
		
		'jurisdiccion_id' => array(
			'notEmpty' => array(
				'rule' => VALID_NOT_EMPTY,
				'required' => true,
				'allowEmpty' => false,
				'message' => 'Seleccione una Jurisdicción.'
			),
			'jurisdiccion' => array(
				'rule' => '/^(2|6|10|14|18|22|26|30|34|38|42|46|50|54|58|62|66|70|74|78|82|86|90|94)$/',
				'required' => true,
				'allowEmpty' => false,
				'message' => 'Seleccione una Jurisdicción.'
			
			)
		),
		'tipoinstit_id' => array(
			'notEmpty' => array(
				'rule' => VALID_NOT_EMPTY,
				'required' => true,
				'allowEmpty' => false,
				//'message' => 'Seleccione un Tipo de Institución.'
				'message' => 'Seleccione un Tipo de Establecimiento.'
			),
		),
		
		'gestion_id' => array(
			'notEmpty' => array(
				'rule' => VALID_NOT_EMPTY,
				'required' => true,
				'allowEmpty' => false,
				'message' => 'Seleccione un Ámbito de Gestión.'
			)
		)
	);
	
	
	/*
	function unbindModelAll() {
	    $unbind = array();
	    foreach ($this->belongsTo as $model=>$info)
	    {
	      $unbind['belongsTo'][] = $model;
	    }
	    foreach ($this->hasOne as $model=>$info)
	    {
	      $unbind['hasOne'][] = $model;
	    }
	    foreach ($this->hasMany as $model=>$info)
	    {
	      $unbind['hasMany'][] = $model;
	    }
	    foreach ($this->hasAndBelongsToMany as $model=>$info)
	    {
	      $unbind['hasAndBelongsToMany'][] = $model;
	    }
	    parent::unbindModel($unbind);
  	} 
  	
  	
  	function unbindModelosInnecesarios() {
	    $unbind = array();
	    foreach ($this->belongsTo as $model=>$info)
	    {
	      $unbind['belongsTo'][] = $model;
	    }
	    parent::unbindModel($unbind);
  	} 
  	*/
  	
  	/**
  	 * Validacion de CUE por jurisdiccion
  	 *
  	 * @return unknown
  	 */
  	function controlar_coincidencia_cue_jurisdiccion(){
  		$jur_id = $this->data[$this->name]['jurisdiccion_id'];
  		
  		if($jur_id < 10){
  			$jur_id = "0$jur_id";
  		}
  		
  		$tam = strlen($this->data[$this->name]['cue']);
  		if($tam == 7){
  			$jur = substr($this->data[$this->name]['cue'],0,2);
  		} elseif($tam == 6){
  			$jur = substr($this->data[$this->name]['cue'],0,1);
  			$jur = "0$jur";
  		}
  		else return false;
  		
  		return ($jur_id == $jur)?true:false;
  	}
  
	
  	/**
  	 * Esta funcion fue redefinida para que me agregue
  	 * el nombre completo en el array data de la institucion
  	 * Entonces, lo que yo logro es que desde mi aplicacion
  	 * puedo hacer un $this->data[Instit]['nombre_completo']
  	 * y me va a mostrar el nombre completo tal como si me lo hubiese 
  	 * traido de la BD
  	 *
  	 * @param $conditions
  	 * @param $fields
  	 * @param $order
  	 * @param $recursive
  	 * @return Array $data
  	 */
  	function find($conditions = null, $fields = array(), $order = null, $recursive = null) {
  		$instituciones_data = parent::find($conditions, $fields, $order, $recursive);

		if (is_array($instituciones_data) && sizeof($instituciones_data)>0 && $conditions != 'list' && $conditions != 'count'):
		/*
		 * primero calculo laprofundiddad
		 * o sea, quiero saber cuantos nivles del array tengo que ir para 
		 * llegar alos datos de Instit
		 */  		
			$array_recorro = $instituciones_data;
		 
	  		list($key, $idata) = each($array_recorro);  	
	  		$aux = "$key";  $instit = "Instit";		
	  		if($aux == $instit){
	  			$profundidad = 0;
	  		}else{
	  			$profundidad = 1;
	  		}
	  		
	  		$aux = &$instituciones_data;
	  		if ($profundidad == 1):
			  	for ($i=0; $i<sizeof($instituciones_data);$i++):	
			  		$aux = &$instituciones_data[$i]; 		
			  		$aux['Instit']['nombre_completo'] = "";	
			  		
		  			$nombre = (isset($aux['Instit']['nombre']))?$aux['Instit']['nombre']:'';
			  		$numero = (isset($aux['Instit']['nroinstit']))?$aux['Instit']['nroinstit']:'';
			  		
			  		if(isset($aux['Tipoinstit']['name'])){			
				  		$nombre_tipoinstit = $aux['Tipoinstit']['name'];
				  		
					  	$aux['Instit']['nombre_completo'] = ($nombre_tipoinstit=='SIN DATOS')?'':$nombre_tipoinstit;
					  	$aux['Instit']['nombre_completo'] .= ($numero > 0 || $numero != '')?" Nº $numero":"";
	  					if (($nombre_tipoinstit != 'SIN DATOS' ||  $numero > 0)&& $nombre){
							$aux['Instit']['nombre_completo'] .= " ";
						}
					  	$aux['Instit']['nombre_completo'] .= ($nombre != '')?$nombre:"";
			  		}
			  		else {
			  			$aux['Instit']['nombre_completo'] .= ($numero > 0 || $numero != '')?" Nº $numero":"";
			  			$aux['Instit']['nombre_completo'] .= ($nombre != '')?$nombre:"";
			  		}
			  	endfor;
			 else:	 
			 	$aux['Instit']['nombre_completo'] = "";	
			 	$nombre = (isset($aux['Instit']['nombre']))?$aux['Instit']['nombre']:'';
			  	$numero = (isset($aux['Instit']['nroinstit']))?$aux['Instit']['nroinstit']:'';
			  	
			  	$nombre_tipoinstit = 'SIN DATOS';
			  	if(isset($aux['Tipoinstit']['name'])){
				  	$nombre_tipoinstit = $aux['Tipoinstit']['name'];
				 	$aux['Instit']['nombre_completo'] = ($nombre_tipoinstit=='SIN DATOS')?'':$nombre_tipoinstit;
					$aux['Instit']['nombre_completo'] .= ($numero > 0 || $numero != '')?" Nº $numero":"";
			  	}
			  		
				if (($nombre_tipoinstit != 'SIN DATOS' ||  $numero > 0)&& $nombre){
					$aux['Instit']['nombre_completo'] .= " ";
				}
				$aux['Instit']['nombre_completo'] .= ($nombre != '')?$nombre:"";
			endif;
	  	endif;
  		
  		return $instituciones_data;
  	}
  	 	
  
  	/**
  	 * 
  	 * @param $id de la institucion
  	 * @return me devuelve algo como esto:
  	 
  	Array
(
    [totales] => Array        (
            [2007] => Array                (
                    [FP] => Array                        (
                            [total_matricula] => 24                        )

                    [SEC] => Array                        (
                            [total_matricula] => 0                        )
                )

    [array_de_ciclos] => Array        (
            [0] => Array                (
                    [0] => Array                        (
                            [ciclo_id] => 2007
                        )
                )

            [1] => Array                (
                    [0] => Array                        (
                            [ciclo_id] => 2008
                        )
                )

            [2] => Array                (
                    [0] => Array                        (
                            [ciclo_id] => 2009
                        )
                )
        )

    [array_de_ofertas] => Array        (
            [0] => Array                (
                    [0] => Array                        (
                            [id] => 1
                            [abrev] => FP
                        )
                )

            [1] => Array                (
                    [0] => Array                        (
                            [id] => 3
                            [abrev] => SEC
                        )
                )
        )
)
        
                    
                    la matriz que formo teiene que ser para armar una tabla de la siguiente forma:
                    
                    ¬ OFERTA   -    Ciclo 2006    -   Ciclo 2007
                    ¬   FP     -        12        -      100
                    ¬   MT     -        154       -      44



  	 */
  	function dameSumatoriaDeMatriculasPorOferta($id){
  		$matriz_rtado = array();
  		
  		$data_cliclos_involucrados = "SELECT a.ciclo_id
										FROM anios as a
										LEFT JOIN planes as p on (p.id = a.plan_id)
										LEFT JOIN instits as i on (i.id = p.instit_id)
										WHERE 
										i.id = $id
										GROUP BY a.ciclo_id
										ORDER BY a.ciclo_id DESC
										LIMIT 5";
  
  		
  		$data_ofertas_involucradas = "SELECT o.id, o.abrev
										FROM ofertas as o
										LEFT JOIN planes as p on (p.oferta_id = o.id)
										LEFT JOIN anios as a on (a.plan_id = p.id)
										LEFT JOIN instits as i on (i.id = p.instit_id)
										WHERE 
										i.id = $id
										GROUP BY o.id, o.abrev
										ORDER BY o.id, o.abrev";
  		
  		
  		$ciclos  = $this->query($data_cliclos_involucrados);
  		$ofertas = $this->query($data_ofertas_involucradas);
  		
  		foreach ($ofertas as $o):
  			$matriz_rtado['array_de_ofertas'][] = $o[0];
  		endforeach;
  		
  		
  		foreach($ciclos as $c):
  			$ciclo = $c[0]['ciclo_id'];
  			$matriz_rtado['array_de_ciclos'][] = $ciclo;
  			foreach($ofertas as $o):
  				$oferta = $o[0]['id'];
  				$oferta_abrev = $o[0]['abrev'];
  				
  				$sql_suma_matriculas = "SELECT sum(a.matricula)
										FROM anios as a
										LEFT JOIN planes as p ON (p.id = a.plan_id)
										LEFT JOIN ofertas as o ON (o.id = p.oferta_id)
										LEFT JOIN instits as i ON (i.id = p.instit_id)
										WHERE i.id = $id
										AND a.ciclo_id = $ciclo
										AND o.id = $oferta";
  				 $aux = $this->query($sql_suma_matriculas);
  				 if(isset($aux[0][0]['sum'])):
  				 	$matriz_rtado['totales'][$ciclo][$oferta_abrev]['total_matricula'] = (int)$aux[0][0]['sum'];
  				 else:
  				 	$matriz_rtado['totales'][$ciclo][$oferta_abrev]['total_matricula'] = "<cite>Sin Datos</cite>";
  				 endif;
  			endforeach;  		
  		endforeach;
  		
  		return $matriz_rtado;
  	}
  	
  	
  	function controlar_coincidencia_jurisdiccion_departamento(){
  		if (isset($this->data[$this->name]['departamento_id'])){
  			if ($this->data[$this->name]['departamento_id'] == '') return false;
  			
  			if ($this->data[$this->name]['departamento_id'] != ''){
		  		$jur_id = $this->data[$this->name]['jurisdiccion_id'];
		  		$depto_id = $this->data[$this->name]['departamento_id'];
		  		$this->Departamento->recursive = -1;
		  		$tot = $this->Departamento->find('count',array('conditions'=> array('Departamento.id'=>$depto_id, 'Departamento.jurisdiccion_id'=>$jur_id)));
		  		return ($tot > 0);
  			}
  		}
  		return false;
  	}
  	
  	
  	function controlar_coincidencia_departamento_localidad(){
  		if (isset($this->data[$this->name]['jurisdiccion_id'])){
  			if ($this->data[$this->name]['jurisdiccion_id'] == 2){
  				return true	;		
  			}
  		}
  		
  		if (isset($this->data[$this->name]['localidad_id'])){
  			if ($this->data[$this->name]['localidad_id'] == '') return false;
  			
  			if ($this->data[$this->name]['localidad_id'] != ''){
		  		$loc = $this->data[$this->name]['localidad_id'];
		  		$depto_id = $this->data[$this->name]['departamento_id'];
		  		$this->Departamento->recursive = -1;
		  		$tot = $this->Localidad->find('count',array('conditions'=> array('Localidad.id'=>$loc, 'Localidad.departamento_id'=>$depto_id)));
		  		return ($tot > 0);
  			}
  		}  		
  		
  		return false;
  	}
  	
  	
  	
  	/**
  	 *  
  	 *  me dice si una institucion cambio de cue
  	 *  si el cue fue modificado, entonces me devuelve un array con lso datos viejos
  	 *  caso contrario me devuelve null 
  	 * 
  	 * @param $institData es el $this->data del formulario
  	 * @return array son los datos de la Institucion
  	 */
  	function cambioCue($institData){
  		$this->id = $institData['Instit']['id'];
  		$instit = $this->read(array('id','cue','anexo'));
  		
  		if(isset($institData['Instit']['cue']) && isset($institData['Instit']['anexo']) && isset($institData['Instit']['id'])){
  			if (($this->data['Instit']['cue']*100+$this->data['Instit']['anexo']) != ($institData['Instit']['cue']*100+$institData['Instit']['anexo'])){
  				return $instit;
  			}
  			return null;
  		}
  		//else debug('vino vacio el cue, anexo o id de institucion y no se puede comprobar si hubo cambio de cue');
  	}
  	
  	
  	function beforeSave(){
  		
  		// -----------------------------------------------------------------------------------------------------------------------------------------------------------
  		// prevenir el error de NOT NULL en postgres
  		//
  		if($this->data[$this->name]['anio_creacion']== ''){
  			$this->data[$this->name]['anio_creacion'] = 0;
  		}
  		  		
  		$this->data[$this->name]['depto'] = ' ';
  		$this->data[$this->name]['localidad'] = ' ';
  		if (isset($this->data[$this->name]['localidad_id'])):
			$this->Localidad->recursive = -1;
			if($this->data[$this->name]['localidad_id'] != ""):
	  			$localidad = $this->Localidad->findById($this->data[$this->name]['localidad_id']);
	  			if (isset($localidad['Localidad']['name'])):
	  				$this->data[$this->name]['localidad'] = $localidad['Localidad']['name'];
	  			endif;
	  		endif;
	  	endif;
  		
	  	if (isset($this->data[$this->name]['departamento_id'])):  			
  			$this->Departamento->recursive = -1;
	  		if($this->data[$this->name]['departamento_id'] != ""):
	  			$departamento = $this->Departamento->findById($this->data[$this->name]['departamento_id']);	  		 			
	  			if (isset($departamento['Departamento']['name'])):
	  				$this->data[$this->name]['depto'] = $departamento['Departamento']['name'];
	  			endif;
	  		endif;
  		endif;
  		// -----------------------------------------------------------------------------------------------------------------------------------------------------------
	
  		return true;
  	}
  	
  	
  	/**
  	 * Verifica si el CUE ingresado es válido 
  	 * por ahora es utilizado para poder realizar búsqedas
  	 * @param string $cue
  	 * @return 	0 si vino vacio el cue
  	 * 			-1 si no es digito o vinieron < de 3 digitos
  	 * 			-6 si tiene 6 digitos pero no es de ciudad ni buenos aires
  	 * 			-7 si tienen 7 digitos pero no son de
  	 */
	function isCUEValid($cue = '') {
		if($cue=='') return 0;
		
		//este valida que no se hayan ingresado letras, ni puntos ni nada raro
		if(!preg_match('/^[0-9]{3,9}$/', $cue)) return -1;
		
		
		switch(strlen($cue)){
			case 6:
				// si son de buenos aires o ciudad
				if(!preg_match('/^(2|6|02|06)[0-9]*$/', $cue)) return -6;
				break;
			case 7:
				// para el resto de las provincias
				if(!preg_match('/^(02|06|0|14|18|22|26|30|34|38|42|46|50|54|58|62|66|70|74|78|82|86|90|94)[0-9]*$/', $cue)) return -7;
				break;	
			case 8:
				// si son de buenos aires o ciudad con anexo
				if(!preg_match('/^(2|6)[0-9]*$/', $cue)) return -8;
				break;		
			case 9:
				// para el resto de las provincias con anexo
				if(!preg_match('/^(02|06|10|14|18|22|26|30|34|38|42|46|50|54|58|62|66|70|74|78|82|86|90|94)[0-9]*$/', $cue)) return -9;
				break;
			default: 
				return 2;
				break;
		}
		
		return 1;
	}
	
	
	function paginateCount($conditions = null, $recursive = 0){
  	
 		if ($this->asociarPlan){
  			$this->getPagFields();
	  		$this->bindModel(array('hasOne' => array(
        	                      'Plan' => array(
                                     'className'  => 'Plan',
                                     'foreignKey' => 'instit_id',
                                                 ),
                                               ),
                              )
   	                    );
	        $selectFields = $this->getPagFields();
        	$extra = array('group' => $selectFields,'fields' => $selectFields);  	                    
        	$parameters = compact('conditions');
        	$this->recursive = 0;
        	return count($this->find('all', array_merge($parameters, $extra)));
  		} else {
            $parameters = compact('conditions');
			if ($recursive != $this->recursive) {
				$parameters['recursive'] = $recursive;
			}
			$extra = array();
			return $this->find('count', array_merge($parameters, $extra));
  		}        	
    }

    
	function paginate($conditions = null, $fields = null, $order = null, $limit = null, $page = 1, $recursive = null, $tieneHasMany = false) {
	
		if ($this->asociarPlan){
			$this->bindModel(array('hasOne' => array('Plan' => array('className'  => 'Plan',
                                                                 'foreignKey' => 'instit_id',
                                                                ),),));

	        $selectFields = $this->getPagFields();
    	    $extra = array('group' => $selectFields,'fields' => $selectFields);
			$parameters = compact('conditions', 'fields', 'order', 'limit', 'page');

			if ($recursive != $this->recursive){
				$parameters['recursive'] = $recursive;
    	    }

			return $this->find('all', array_merge($parameters, $extra));

		} else {
			$parameters = compact('conditions', 'fields', 'order', 'limit', 'page');
			if ($recursive != $this->recursive) {
				$parameters['recursive'] = $recursive;
			}
			$extra = array();
			return $this->find('all', array_merge($parameters, $extra));
		}
	}    	
  	

   /**
    * si me encuentra algo me tira FALSO, asi evitamos duplicados
    * @return boolean
    */
	function cue_y_anexo_unico()
  	{
  		return (count($this->__getInstitByCUEandAnexo())==0)?true:false;
  	}

  	
  	
  	/**
  	 * me inserta 1 array pero se fija antes que la institucion no exista
  	 * si existe, no me lo inserta. hace que siempre sean unicas las instits
  	 * 
  	 * @param array $vector1[key_index][Instit][campo]
  	 * @param array $vector2[key_index][Instit][campo]
  	 * @return array 
  	 */
  	private function __armarVectorSinInstitsRepetidas($vector1, $vector2)
  	{
  		$v_final = array();
  		foreach($vector2 as $v2):
  			$encontro = false;
  			foreach($vector1 as $v1):  				
  				if($v2['Instit']['id'] == $v1['Instit']['id']){
  					$encontro = true;
  					break;
  				}
  			endforeach;
  			if(!$encontro){
  				$v_final[] = $v2;
  			}
  		endforeach;
  		
  		$v_final = array_merge($vector1, $v_final);
  		
  		return $v_final;
  	}
   
   
	/**
	 * Me devuelve todas la Instituciones similares
	 * @param $this->$data
	 * @return array de Instituciones
	 */
	function getSimilars($data) 
	{
		$similars = array();
		$this->data = $data;
		
		// busco por cue y anexo
		if( $this->data['Instit']['cue'] != "" && $this->data['Instit']['anexo'] != "")
		{
			$bycueanexo = $this->__getInstitByCUEandAnexo();
			if(count($bycueanexo)>0) 
			{
				$this->validationErrors += array( 'cue' => 'Hay una institución con éste CUE y Anexo');
				$this->validationErrors += array( 'anexo' => 'Hay una institución con éste CUE y Anexo');
				$similars = $this->__armarVectorSinInstitsRepetidas($similars,$bycueanexo);
			}
		}
				
		// busco por ubicacion
		if( $this->data['Instit']['localidad_id'] != "" &&
			$this->data['Instit']['direccion'] != "")
		{
			$conditions = array("localidad_id" => $this->data['Instit']['localidad_id'], 
								"lower(direccion)  SIMILAR TO ?" => $this->convertir_para_busqueda_avanzada($this->data['Instit']['direccion']));
			$byubucation = $this->find('all',array('conditions'=> $conditions));
			if(count($byubucation)>0)
			{
				$this->validationErrors += array( 'direccion' => 'Hay una institución con la misma dirección en ésta localidad');
				$this->validationErrors += array( 'localidad_id' => '');
				
				$similars = $this->__armarVectorSinInstitsRepetidas($similars,$byubucation);
			}
		}
			
		// busco por nombre y localidad
		if( $this->data['Instit']['nombre'] != "" && $this->data['Instit']['localidad_id'] != "")
		{
			$nombre = $this->convertir_para_busqueda_avanzada($this->data['Instit']['nombre']);
		
			$conditions = array("lower(nombre)  SIMILAR TO ?" => $nombre,
								"localidad_id" => $this->data['Instit']['localidad_id']);
			$bynameyloc = $this->find('all',array('conditions'=> $conditions));
			if(count($bynameyloc)>0) 
			{
				$this->validationErrors += array( 'nombre' => 'Hay una institución en la misma localidad con éste nombre');
				$this->validationErrors += array( 'localidad_id' => 'Hay una institución con el mismo nombre, en ésta localidad');
				$similars = $this->__armarVectorSinInstitsRepetidas($similars,$bynameyloc);
			}
		}
			
		// busco por nombre
		if( $this->data['Instit']['nombre'] != "" &&
			$this->data['Instit']['nroinstit'] != "" &&
			$this->data['Instit']['tipoinstit_id'] != "")
		{
			$nombre = $this->convertir_para_busqueda_avanzada($this->data['Instit']['nombre']);
			$conditions = array("lower(nombre)  SIMILAR TO ?" => $nombre,
								"lower(nroinstit)  SIMILAR TO ?" => $this->convertir_para_busqueda_avanzada($this->data['Instit']['nroinstit']),
								"tipoinstit_id" => $this->data['Instit']['tipoinstit_id']);
			$byname = $this->find('all',array('conditions'=> $conditions));
			if(count($byname)>0) 
			{
				$this->validationErrors += array( 'nombre' => 'Hay una institución con el mismo nombre, tipo o número');
				$this->validationErrors += array( 'nroinstit' => '');
				$this->validationErrors += array( 'tipoinstit_id' => '');
				$similars = $this->__armarVectorSinInstitsRepetidas($similars,$byname);
			}
		}
			
		// busco por juridiccion, tipo y numero
		if( $this->data['Instit']['localidad_id'] != "" &&
			$this->data['Instit']['nroinstit'] != "" &&
			$this->data['Instit']['tipoinstit_id'] != "")
		{
			$conditions = array("Instit.localidad_id" => $this->data['Instit']['localidad_id'],
								"lower(nroinstit)  SIMILAR TO ?" => $this->convertir_para_busqueda_avanzada($this->data['Instit']['nroinstit']),
								"tipoinstit_id" => $this->data['Instit']['tipoinstit_id']);
			$byjurid = $this->find('all',array('conditions'=> $conditions));
			if(count($byjurid)>0) 
			{
				$this->validationErrors += array( 'nroinstit' => 'Hay una institución con la misma localidad, tipo o número');
				$this->validationErrors += array( 'localidad_id' => '');
				$this->validationErrors += array( 'tipoinstit_id' => '');
				$similars = $this->__armarVectorSinInstitsRepetidas($similars,$byjurid);
			}
		}
					
		return $similars;
	}
	
	
	/**
	 * Me devuelve instituciones cuyo cue y anexo coinciden
	 * toma los valores de $this->data
	 * @return array find('all')
	 */
	function __getInstitByCUEandAnexo()
	{
		$condiciones = array();		
			
		// cuando se edita uina institucion
		// tengo que buscar todas las intituciones que no sea ésta misma en cuestión
		if (isset($this->data[$this->name]['id'])){
			if($this->data[$this->name]['id']!= null){
				$condiciones = array_merge($condiciones, array('Instit.id <>'=>$this->data[$this->name]['id']));
			}
		}	
		if (isset($this->data[$this->name]['cue'])){
			if($this->data[$this->name]['cue']!= null){
				$condiciones = array_merge($condiciones, array('cue'=>$this->data[$this->name]['cue']));
			}
		}	
		if (isset($this->data[$this->name]['anexo'])){
			if($this->data[$this->name]['anexo']!= null){
				$condiciones = array_merge($condiciones, array('anexo'=>$this->data[$this->name]['anexo']));
			}
		}
 		$this->recursive = -1;
  		return $this->find('all',array('conditions'=>$condiciones));
	}
	
	
	
	/**
	 *  Cambia el "*" utilizado en la busqueda por un "%"
	 * @param string $texto con *
	 * @return string @return texto con % para el LIKE de SQL
	 */
	function cambioComodin($texto) {
		return str_replace('*', '%', $texto);
	}
}
?>