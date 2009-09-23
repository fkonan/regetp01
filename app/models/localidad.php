<?php
class Localidad extends AppModel {

	var $name = 'Localidad';
	var $validate = array(
		'name' => array('notempty')
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Departamento' => array('className' => 'Departamento',
								'foreignKey' => 'departamento_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);
	
	var $hasMany = array(
			'instit' => array('className' => 'instit',
								'foreignKey' => 'localidad_id',
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
	
	
	/**
	 * me trae las localidades Bindeadas con el departamento y la jurisdiccion
	 * y me desbindea las instituciones para hacer mucho mas performante la query
	 * @return array [localidad, departamento, jurisdiccion]
	 */
	function localidades_con_jurisdiccion($jurisdiccion_id)
	{
		$localidades = array(); //inicializacion de la variable del return
		
		$this->recursive = 0;

         $this->unBindModel(array('hasMany' => array('Instit')));

         $this->bindModel(array(
		    'belongsTo' => array(
		        'Jurisdiccion' => array(
		            'foreignKey' => false,
		            'conditions' => array('Jurisdiccion.id = Departamento.jurisdiccion_id')
		        )
		)));

         if ($jurisdiccion_id != 0){
         	$localidades = $this->find('all',array(	
         							'conditions' => array('Jurisdiccion.id' => $jurisdiccion_id),
         							'order'=>'Localidad.name ASC'
         	));
         }else{
         	$localidades = $this->find('all', array('order'=>'Localidad.name ASC'));   											 
         }
         
         return $localidades;
         
	}
	
	
	function listado_localidades_con_jurisdiccion($jurisdiccion_id)
	{
		$localidades = $this->localidades_con_jurisdiccion($jurisdiccion_id);
		
		foreach($localidades as $d):		
			$poner = $d['Localidad']['name'];
		
		// $todos es una variable boolean que me dice si se estan listando 
		// TODAS las localidades o solo las de un departamento en particular
			
			$depto = $d['Departamento']['name'];
			$jur = $d['Jurisdiccion']['name'];
		
			if(strlen($depto)>19){
				$depto = substr($depto,0,19);
				$depto .= '...';
			}
			if(strlen($jur)>19){
				$jur = substr($jur,0,19);
				$jur .= "...";
			}
			$poner .= " (Depto: $depto, Jur: $jur)";
			
			if(strlen($poner)>66){
				$poner = substr($poner,0,66);
				$poner .= "...)";
				
			}
			$loc_aux[$d['Localidad']['id']]   = $poner ;
			
		endforeach;
	
	
         return $loc_aux;
         
	}
	
	
}
?>