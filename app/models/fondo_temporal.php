<?php
class FondoTemporal extends AppModel {

	var $name = 'FondoTemporal';
        var $useTable = 'z_fondo_work';
	/*var $validate = array(
		'instit_id' => array('numeric'),
		'jurisdiccion_id' => array('numeric'),
		'lineas_de_accion_id' => array('numeric'),
		'valor_asignado' => array('numeric'),
		'fecha_aprobacion' => array(
					'date'=> array(
									'rule' => 'date',
									'required' => true,
									'allowEmpty' => false,
									'message' => 'La fecha no es correcta.'	
									)
								)
		
		//'memo' => array('notempty'),
		//'resolucion' => array('notempty')
	);
	*/

        /*
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Instit' => array('className' => 'Instit',
								'foreignKey' => 'instit_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			),
			'Jurisdiccion' => array('className' => 'Jurisdiccion',
								'foreignKey' => 'jurisdiccion_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			),
			'LineasDeAccion' => array('className' => 'LineasDeAccion',
								'foreignKey' => 'lineas_de_accion_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);
 
        */

}
?>