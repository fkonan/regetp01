<?php
class EstructuraPlan extends AppModel {

	var $name = 'EstructuraPlan';

        var $validate = array(
		'name' => array(
			'notEmpty'=> array(
				'rule' => VALID_NOT_EMPTY,
				'required' => true,
				'allowEmpty' => false,
				//'on' => 'create', // or: 'update'
				'message' => 'Debe ingresar el nombre.'
			)
		),
        );

        var $belongsTo = array(
			'Etapa' => array('className' => 'Etapa',
								'foreignKey' => 'etapa_id',
								'conditions' => '',
								'fields' => '',
								'order' => 'Etapa.orden'
			)
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array(
                        'Plan',
			'EstructuraPlanesAnio',
                        'JurisdiccionesEstructuraPlan',
	);

}
?>