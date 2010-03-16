<?php
class Titulo extends AppModel {

	var $name = 'Titulo';
	var $validate = array(
		'name' => array('notempty'),
		'marcoref' => array('boolean'),
		'oferta_id' => array('numeric')
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Oferta' => array('className' => 'Oferta',
								'foreignKey' => 'oferta_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);

}
?>