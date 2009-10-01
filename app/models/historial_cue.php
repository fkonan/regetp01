<?php
class HistorialCue extends AppModel {

	var $name = 'HistorialCue';
	var $validate = array(
		'instit_id' => array('numeric'),
		'cue' => array('numeric'),
		'anexo' => array('numeric')
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'Instit' => array(
			'className' => 'Instit',
			'foreignKey' => 'instit_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	function hacerCambioDeCue($datosCueAnterior){
		$this->create();
		return $this->save($datosCueAnterior);
	}

	function _setBelongsToInstitType($type){
		$this->belongsTo['Instit']['type'] = $type;
	}	
	
	function setBelongsToInstitTypeFull(){
		$this->_setBelongsToInstitType("FULL");
	}	
}
?>