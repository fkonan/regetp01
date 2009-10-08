<?php
class Tipoinstit extends AppModel {

	var $name = 'Tipoinstit';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Jurisdiccion' => array('className' => 'Jurisdiccion',
								'foreignKey' => 'jurisdiccion_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);

	var $hasMany = array(
			'Instit' => array('className' => 'Instit',
								'foreignKey' => 'tipoinstit_id',
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
      	'name' => array(
			'rule' => 'notEmpty', // or: array('ruleName', 'param1', 'param2' ...)
			'required' => true,
			'allowEmpty' => false,
			//'on' => 'create', // or: 'update'
			'message' => 'Se debe ingresar un nombre para la Jurisdicción. No puede quedar vacío.')
   );
   
   
   
   /**
    * me devuelve todos los tipos de institucion para la priovincia requerida
    * 
    * @param $jur_id ID de jurisdiccion que quiero encontrar = 0 por default (trae todas)
    * @param $recursive -1 por default
    * @return array del find(all)
    */
   function dame_por_jurisdiccion($jur_id = 0, $recursividad = -1){
   		$this->recursive = $recursividad;
   		if($jur_id == 0 ){//buscar a todas
         	$inss = $this->find('all',array('order'=>'Tipoinstit.name ASC'));
        }else{
         	$inss = $this->find('all',array('conditions' => array('jurisdiccion_id' => $jur_id),
         											  'order'=>'Tipoinstit.name ASC'));
        }
        return $inss;
   }
	
}
?>