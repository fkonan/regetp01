<?php
class EtapasJurisdiccion extends AppModel {

	var $name = 'EtapasJurisdiccion';
	var $asociarAnio = false; // Se utiliza en el paginador
	var $maxCiclo = "";
	var $traerUltimaAct = false; // se utiliza en el paginador.
	
	var $actsAs = array('Containable');

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array( 
			'Etapa' ,
			'Jurisdiccion',
	);

        var $hasMany = array(
			'Etapa' => array('className' => 'Anio',
                                                            'foreignKey' => 'etapa_id',
                                                            'dependent' => false,
                                                            'conditions' => '',
                                                            'fields' => '',
                                                            'order' => '',
                                                            'limit' => '',
                                                            'offset' => '',
                                                            'exclusive' => '',
                                                            'finderQuery' => '',
                                                            'counterQuery' => ''
			),
                        'Jurisdiccion' => array('className' => 'Jurisdiccion',
                                                            'foreignKey' => 'jurisdiccion_id',
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
}
?>