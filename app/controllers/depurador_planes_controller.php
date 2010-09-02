<?php
set_time_limit(30000000);

class DepuradorPlanesController extends AppController {

	var $name = 'DepuradorPlanes';
	var $helpers = array('Html', 'Form','Ajax');
	var $uses = array('Instit','Plan','Anio','Sector','Jurisdiccion',
                    'EstructuraPlan','JurisdiccionesEstructuraPlan','EstructuraPlanesAnio');
	var $db;
	
	
	function index($id) {
            $this->layout = '';
            //Configure::write('debug', '0');

            if ($id)
            {
                //$instit = $this->Instit->findById($id);
                $instit = $this->Instit->find('all', array(
                            'contain' => array(
                                'Jurisdiccion' => 'name',
                                'Plan' => array(
                                'Anio' => array(
                                        'Etapa',
                                        'order'=>array('ciclo_id','etapa_id', 'anio'))
                                    )),
                            'conditions' => array('Instit.id'=> $id)
                ));
                //debug($instit);

                $this->set('instit',$instit[0]);
            }
        }

        function test_graficador($id, $ciclo, $depurado) {
            $plan = $this->Plan->find('first',
                    array('conditions'=>array(
                                'Plan.id' => $id
                            ),
                          'contain'=>array('Anio'=>array('Etapa','conditions'=>array('Anio.ciclo_id'=>$ciclo)))
                        )
                    );

            $this->set('plan', $plan);
            $this->set('depurado', $depurado);
        }
}

?>