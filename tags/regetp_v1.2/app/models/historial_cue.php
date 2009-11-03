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
	
	
	/**
	 *  me guarda el cue anterior en el historico de CUEs
	 * @param cue $datosCueAnterior
	 * @return boolean si se guardo bien o no
	 */
	function hacerCambioDeCue($datosCueAnterior){
		$this->create();
		return $this->save($datosCueAnterior);
	}
	
	
	/**
	 * me devuelve los cues hitoricos de una institucion
	 * @param $instit_id
	 * @return array de HistorialCue con cues y anexos
	 */
	function cuesDeInstit($instit_id){
		$this->recursive = -1;
		return $this->find('all',array('conditions'=>array('instit_id'=>$instit_id)));
	}

	
	/**
	 * Esta funcion modifica el belongsTo con Instit de acuerdo
	 * al parametro que recibe
	 * @param string $type
	 * @return unknown_type
	 */
	function _setBelongsToInstitType($type){
		$this->belongsTo['Instit']['type'] = $type;
	}	
	
	/**
	 * Esta funcion modifica el belongsTo con Instit para
	 * que sea un full join
	 * @return unknown_type
	 */
	function setBelongsToInstitTypeFull(){
		$this->_setBelongsToInstitType("FULL");
	}	
}
?>