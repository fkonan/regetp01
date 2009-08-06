<?php
class Instit extends AppModel {

	var $name = 'Instit';

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
				'message'=> 'El CUE o el ANEXO ya existen.',
				'on' => 'create'
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
				'message' => 'Seleccione un Tipo de Institución.'
			),
		)
	);
	
	
	
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
		 
		 	$profundidad = 0;
	  		while (list($key, $idata) = each($array_recorro)):  	
	  			$aux = "$key";
	  			$instit = "Instit";		
	  			if($aux == $instit){
	  				break;
	  			}else{
	  				$profundidad++;
	  			}
	  		endwhile;
	  			  	
	  		$aux = &$instituciones_data;
	  		if ($profundidad >0):

			  	for ($i=0; $i<sizeof($instituciones_data);$i++):		
			  		$aux = &$instituciones_data[$i]; 		
		  		
			  		$nombre = $aux['Instit']['nombre'];
			  		$numero = $aux['Instit']['nroinstit'];
			  		if(isset($aux['Tipoinstit']['name'])){			
				  		$nombre_tipoinstit = $aux['Tipoinstit']['name'];
				  		
					  	$aux['Instit']['nombre_completo'] = ($nombre_tipoinstit=='SIN DATOS')?'':$nombre_tipoinstit;
					  	$aux['Instit']['nombre_completo'] .= ($numero > 0 || $numero != '')?" Nº $numero":"";
	  					if (($nombre_tipoinstit != 'SIN DATOS' ||  $numero > 0)&& $nombre){
							$aux['Instit']['nombre_completo'] .= " ";
						}
					  	$aux['Instit']['nombre_completo'] .= ($nombre != '')?$nombre:"";
			  		}
			  	endfor;
			 else:	 
			 	$nombre = $aux['Instit']['nombre'];
			  	$numero = $aux['Instit']['nroinstit'];
			  	$nombre_tipoinstit = $aux['Tipoinstit']['name'];
			 	$aux['Instit']['nombre_completo'] = ($nombre_tipoinstit=='SIN DATOS')?'':$nombre_tipoinstit;
				$aux['Instit']['nombre_completo'] .= ($numero > 0 || $numero != '')?" Nº $numero":"";
				
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
  			if ($this->data[$this->name]['departamento_id'] == '') return true;
  			
  			if ($this->data[$this->name]['departamento_id'] != ''){
		  		$jur_id = $this->data[$this->name]['jurisdiccion_id'];
		  		$depto_id = $this->data[$this->name]['departamento_id'];
		  		$this->Departamento->recursive = -1;
		  		$tot = $this->Departamento->find('count',array('conditions'=> array('Departamento.id'=>$depto_id, 'Departamento.jurisdiccion_id'=>$jur_id)));
		  		return ($tot > 0);
  			}
  		}
  		return true;
  	}
  	
  	
	function controlar_coincidencia_localidad_lugar(){
		if (isset($this->data[$this->name]['localidad_id']) && isset($this->data[$this->name]['lugar_id'])){
			if ($this->data[$this->name]['lugar_id'] == "") return true;
				$localidad_id = $this->data[$this->name]['localidad_id'];
			  	$lugar_id = $this->data[$this->name]['lugar_id'];
			  	$this->Lugar->recursive = -1;
			  	$tot = $this->Lugar->find('count',array('conditions'=> array('Lugar.id'=>$lugar_id, 'Lugar.localidad_id'=>$localidad_id)));
			  	return ($tot > 0);
		}
		return true;
  	}
  	
  	
  	function beforeSave(){
  		//prevenir el error de NOT NULL en postgres
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

  		return true;
  	}
  	
  	
  	function cue_y_anexo_unico(){
  		$cue   = $this->data[$this->name]['cue'];
  		$anexo = $this->data[$this->name]['anexo'];
  		$condiciones = array('cue'=>$cue,'anexo'=>$anexo);
  		
  		//si me encuentra algo me tira FALSO, asi evitamos duplicados
  		return ($this->find('count',array('conditions'=>$condiciones))>0)?false:true;
  	}
  	
}
?>