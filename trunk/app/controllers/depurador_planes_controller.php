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


        function arregladorDeAnios($plan_id, $ciclo_id){
            $anios = $this->Anio->find('all', array(
                'contain' => array(
                    'Plan.Instit',
                    'EstructuraPlanesAnio',
                    'Etapa',
                ),
                'conditions'=> array(
                    'Anio.plan_id' => $plan_id,
                    'Anio.ciclo_id'=> $ciclo_id,
                ),
            ));

            $iJurId = 0;
            if (!empty($anios)) {
                $iJurId = $anios[0]['Plan']['Instit']['jurisdiccion_id'];
            }

            $trayecto_anios = $this->Anio
                    ->EstructuraPlanesAnio->EstructuraPlan->JurisdiccionesEstructuraPlan
                    ->getEstructurasDeJurisdiccion($iJurId, 'list');
            
            $this->set(compact('anios', 'trayecto_anios'));
            
        }
}

?>