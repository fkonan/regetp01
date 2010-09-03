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
            Configure::write('debug', '0');

            if ($id)
            {
                //$instit = $this->Instit->findById($id);
                $instit = $this->Instit->find('all', array(
                            'contain' => array(
                                'Jurisdiccion' => 'name',
                                'Plan' => array(
                                    'Anio' => array(
                                            'Etapa',
                                            'order'=>array('ciclo_id','etapa_id', 'anio')),
                                    'conditions'=> array('Plan.oferta_id'=> 3)
                                    )),
                            'conditions' => array('Instit.id'=> $id)
                ));
                //debug($instit);
                $jurisdiccion_id = $instit[0]['Instit']['jurisdiccion_id'];

                // estructuras posibles en la jurisdiccion
                $estructuras = $this->JurisdiccionesEstructuraPlan->getEstructurasDeJurisdiccion($jurisdiccion_id, 'list');

                $this->set('instit',$instit[0]);
                $this->set('estructuras',$estructuras);
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
            $this->Plan->id = $plan_id;
            $this->Plan->contain(array(
                'Instit',
                'Anio' => array(
                    'Etapa',
                    'EstructuraPlanesAnio',
                    'conditions' => array(
                        'Anio.plan_id' => $plan_id,
                        'Anio.ciclo_id'=> $ciclo_id,
                    )),
            ));
            $plan = $this->Plan->read();

            
             //$ePlanId = $plan['Plan']['estructura_plan_id'];
            $ePlanId = $this->Plan->getEstructuraSugerida();
            debug($ePlanId);
            
            //$ePlanId = 4;

            // traigo los anios posibles para la estructura definida en estructura_plan_id
            $estructura_planes_anios = $this->Anio->EstructuraPlanesAnio->find('list', array(
                'fields' => array('id','nro_anio'),
                'conditions' => array(
                    'EstructuraPlanesAnio.estructura_plan_id' => $ePlanId,
                ),
            ));


            // traigo TODOS los planes de la institucion, por si quiere MOVER
            // el dato de los anios hacia otro plan
            $planes = $this->Plan->find('list', array(
                'fields' => array('id','nombre'),
                'conditions' => array(
                    'Plan.oferta_id' => 3,
                    'Plan.instit_id' => $plan['Instit']['id'],
                )
            ));


            $planes[$plan_id] = '::: Dejarlo en el plan que estaba ::: '.$planes[$plan_id];


            $this->set('anios', $plan['Anio']);
            $this->set('estructura_planes_anios', $estructura_planes_anios);
            $this->set('planes' , $planes);
            
        }
}

?>