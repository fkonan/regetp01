<?php
// test
class Anio extends AppModel {

	var $name = 'Anio';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'EstructuraPlanesAnio' => array('className' => 'EstructuraPlanesAnio',
								'foreignKey' => 'estructura_planes_anio_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			),
                        'Plan' => array('className' => 'Plan',
								'foreignKey' => 'plan_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			),
			'Ciclo' => array('className' => 'Ciclo',
								'foreignKey' => 'ciclo_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			),
			'Etapa' => array('className' => 'Etapa',
								'foreignKey' => 'etapa_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);
	

	
	var $validate = array(
		'anio' => array(
			'notEmpty'=> array(
				'rule' => VALID_NOT_EMPTY,
				'required' => true,
				'allowEmpty' => false,
				'message' => 'Debe ingresar un número de año.'
			),
			'rango1a7'=> array(
				'rule' => '/^([1-9]|99)$/',
				'required' => true,
				'allowEmpty' => false,
				//'on' => 'create', // or: 'update'
				'message' => 'Debe ingresar un número de año entre 1 y 7.'
			)
		),
		'etapa_id'=>array(
			'notEmpty'=> array(
				'rule' => VALID_NOT_EMPTY,
				'required' => true,
				'allowEmpty' => false,
				//'on' => 'create', // or: 'update'
				'message' => 'Debe ingresar la etapa a la que corresponde el año seleccionado. (CB, EGB3, Polimodal, etc).'
			),
		),
		'secciones'=>array(
			'notEmpty'=> array(
				'rule' => VALID_NUMBER,
				'required' => false,
				'allowEmpty' => true,
				//'on' => 'create', // or: 'update'
				'message' => 'Debe ingresar un valor numérico.'	
			),
		),
		'hs_taller'=>array(
			'notEmpty'=> array(
				'rule' => VALID_NUMBER,
				'required' => false,
				'allowEmpty' => true,
				//'on' => 'create', // or: 'update'
				'message' => 'Debe ingresar un valor numérico.'	
			),
		),
		'matricula'=>array(
			'notEmpty'=> array(
				'rule' => VALID_NUMBER,
				'required' => false,
				'allowEmpty' => true,
				//'on' => 'create', // or: 'update'
				'message' => 'Debe ingresar un valor numérico.'	
			),
		),

                'estructura_planes_anio'=>array(
			'estructuraValida'=> array(
				'rule' => 'validacionEstructura',
				'required' => false,
				'allowEmpty' => true,
				'message' => 'La estructura de la oferta no es correcta, verificarla junto a la estructura del plan (polimodal, CS, CB, etc).'
			),
		),

                'estructura_planes_anio'=>array(
			'elPlanTieneEstructuraDefinida'=> array(
				'rule' => 'elPlanTieneEstructuraDefinida',
				'required' => false,
				'allowEmpty' => true,
				'message' => 'El Plan no tiene ninguna estructura definida. Edite el plan antes de ingresar datos de los años'
			),
		),
	);

	
	
	/**
	 * Me devuelve un array con el total de matriculas del plan
	 *	retorna un array cuya 'key' es el id del plan y el valor, es la matricula
	 * @param $plan_id
	 * @return Array $aux_vec('plan_id'=>'matricula')
	 */
	function matricula_del_plan($plan_id){
		$aux_vec[$plan_id] = 0;
		$this->recursive = -1;
		$temp= $this->find('all',array(
						'conditions'=>array('plan_id'=>$plan_id),
						'group'=>array('ciclo_id','plan_id'),
						'order'=>array('ciclo_id DESC'),					
						'fields'=>array('sum(matricula) as "matricula"','plan_id','ciclo_id')));	


		//esta linea es para que solo muestre los datos de matricula del 
		//ULTIMO ciclo (año lectivo) cargado
		if($temp){	
			$ciclo_aux = $temp[0]['Anio']['ciclo_id'];
		} 
		
		//reordeno el vector para que quede de una manera linda para recorrerlo con foreach en la vista
		foreach($temp as $v){
			//como el array vine ordenado por cicl_id descendiente, si leo otro ciclo y 
			//es distinto es porque estoy en un año anterir, por lo tanto 
			//debo cortar la ejecucion y entregar el array como quedó
			if ($ciclo_aux != $v['Anio']['ciclo_id']) break; 
			
			$aux_vec[$v['Anio']['plan_id']] = $v[0]['matricula'];
		}
		
		return $aux_vec;
	}
	
	/**
	 * Me dice en que ciclo lectivo estan las ultimas matriculas del plan
	 * o sea, me dice, cual es el ultimo ciclo lectivo del plan
	 *
	 * @param $plan_id
	 * @return Id Ciclo_ID (en realidad es un año, 2006,2008,2009, etc)
	 */
	function ciclo_lectivo_matricula_del_plan($plan_id){
		$this->recursive = -1;
		$temp= $this->find('first',array(
						'conditions'=>array('plan_id'=>$plan_id),
						'order'=>array('ciclo_id DESC'),
						'fields'=>array('plan_id','ciclo_id')));	

		return $temp['Anio']['ciclo_id'];
	}


        function elPlanTieneEstructuraDefinida($plan_id = null){
            if (empty($plan_id)) {
                $plan_id = $this->data['Anio']['plan_id'];
            }
            return $this->Plan->tieneEstructuraDefinida($plan_id);

        }

        
        function validacionEstructura($plan_id = null) {
            if (empty($plan_id)) {
                $plan_id = $this->data['Anio']['plan_id'];
            }
            $aniosMal = $this->estructuraValida($plan_id);

            return (count($aniosMal) > 0) ? false : true;
        }
        

        function estructuraValida($plan_id = null){
            if (empty($plan_id)) {
                $plan_id = $this->data['Anio']['plan_id'];
            }
            
            if (!empty($plan_id)){
                    // busca la estructura del plan
                    $ep = $this->Plan->find('first', array(
                        'conditions' => array(
                            'Plan.id' => $plan_id,
                            ),
                        'contain' => array('EstructuraPlan'),
                    ));
                    
                    // busco si hay anios que tengan otra estructura
                    $cant = $this->find('all', array(
                        'conditions' => array(
                            'OR' => array (
                                'EstructuraPlanesAnio.estructura_plan_id <>' => $ep['EstructuraPlan']['id'],
                                'Anio.estructura_planes_anio_id' => 0,
                                )
                        ),
                        'contain' => array(
                            'EstructuraPlanesAnio',
                        ),
                        'order' => array('Anio.ciclo_id', 'EstructuraPlanesAnio.edad_teorica'),
                    ));

                    return (count($cant) > 0)  ?    $cant   :    true;
            }
            return true;
        }
	
}
?>