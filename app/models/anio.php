<?php
class Anio extends AppModel {

	var $name = 'Anio';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
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
				//'on' => 'create', // or: 'update'
				'message' => 'Debe ingresar un número de año.'	
			),
			'rango1a7'=> array(
				'rule' => '/^([1-7]|99)$/',
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
		)
	);

	
/********************************************************************
	 * 
	 * 
	 *  RequestAction
	 * 
	 * 
	 */
	
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
		
		foreach($temp as $v){
			//como el array vine ordenado por cicl_id descendiente, si leo otro ciclo y 
			//es distinto es porque estoy en un año anterir, por lo tanto 
			//debo cortar la ejecucion y entregar el array como quedó
			if ($ciclo_aux != $v['Anio']['ciclo_id']) break; 
			
			$aux_vec[$v['Anio']['plan_id']] = $v[0]['matricula'];
		}
		
		return $aux_vec;
	}
	
}
?>