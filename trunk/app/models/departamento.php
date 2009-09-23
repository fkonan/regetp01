<?php
class Departamento extends AppModel {

	var $name = 'Departamento';
	var $validate = array(
		'name' => array('notempty')
	);

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
			'Localidad' => array('className' => 'Localidad',
								'foreignKey' => 'departamento_id',
								'dependent' => true,
								'conditions' => '',
								'fields' => '',
								'order' => '',
								'limit' => '',
								'offset' => '',
								'exclusive' => '',
								'finderQuery' => '',
								'counterQuery' => ''
			),
			'instit' => array('className' => 'instit',
								'foreignKey' => 'departamento_id',
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
	
	
	function de_jurisdiccion($jurisdiccion_id){
		$this->recursive = 0;
         
         if($jurisdiccion_id != 0 ){
        	$deptos = $this->find('all',array('order'=>'Departamento.name ASC',
        													'conditions' => array('jurisdiccion_id' => $jurisdiccion_id),
        													));
         }else{
        	$deptos = $this->find('all',array('order'=>'Departamento.name ASC'
        													));
         }
	}

}
?>