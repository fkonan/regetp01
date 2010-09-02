<?php
class JurisdiccionesEstructuraPlan extends AppModel {

	var $name = 'JurisdiccionesEstructuraPlan';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Jurisdiccion' => array('className' => 'Jurisdiccion',
								'foreignKey' => 'jurisdiccion_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			),
			'EstructuraPlan' => array('className' => 'EstructuraPlan',
								'foreignKey' => 'estructura_plan_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);


        /**
         *
         *  Me devuelve todas las EstructuraPlan disponibles para una determinada
         *  jurisdiccion.
         *
         * 
         * @param integer $jurisdiccion_id ID de la jurisdiccion donde quiero buscar las estructuras
         * @param string $find_type las posibilidades son:
         *                                                  'all'
         *                                                  'list'
         * @return array del model 'EstructuraPlan' encontradas
         */
        function getEstructurasDeJurisdiccion($jurisdiccion_id, $find_type = 'all') {
             $trayecto_anios = $this->find('all', array(
                'fields' => array('EstructuraPlan.name'),
                'contain' => array(
                    'EstructuraPlan.EstructuraPlanesAnio',
                ),
                'conditions'=> array(
                    'JurisdiccionesEstructuraPlan.jurisdiccion_id' => $jurisdiccion_id,
                )));

             // si es del tipo list convierto el resultado a ese formato
             if ($find_type == 'list') {
                 $nuevoTA = array();
                 foreach ($trayecto_anios as $ta) {
                    $estrucID = $ta['EstructuraPlan']['id'];
                    $estrucNAME = $ta['EstructuraPlan']['name'];
                    $nuevoTA[ $estrucID ] = $estrucNAME;
                 }
                 $trayecto_anios = $nuevoTA;

             }

            return $trayecto_anios;
        }

}
?>