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


        function arregladorDeAnios($plan_id, $ciclo_id = null){
            $this->Plan->id = $plan_id;
            $this->Plan->contain(array(
                'Instit',
                'EstructuraPlan.EstructuraPlanesAnio',
                'Anio' => array(
                    'Etapa',
                    'EstructuraPlanesAnio',
                    'conditions' => array(
                        'Anio.plan_id' => $plan_id,
                        'Anio.ciclo_id'=> $ciclo_id,
                    )),
            ));
            $plan = $this->Plan->read();

            // si no encontro un plan redirijo a la pagina ppal
            if (empty($plan)) {
                $this->flash("El plan no existe",'/');
            }
            

            // guardo en BD si me vino el formulario lleno
            if (!empty($this->data) && $this->Plan->tieneEstructuraDefinida()) {
                
                foreach ($this->data['Anio'] as &$a) {
                    $a['etapa_id'] = $plan['EstructuraPlan']['etapa_id'];
                    foreach ($plan['EstructuraPlan']['EstructuraPlanesAnio'] as $epp) {
                        if ($a['estructura_planes_anio_id'] == $epp['id']) {
                            $a['anio'] = $plan['EstructuraPlan']['EstructuraPlanesAnio']['id'];
                        }
                    }
                }
                if (!$this->Anio->saveAll($this->data['Anio'])){
                    debug($this->Anio->validationErrors);
                    $this->flash('No se pudieron guardar los años');
                }
            }
            

            
             //$ePlanId = $plan['Plan']['estructura_plan_id'];
            $ePlanId = $this->Plan->getEstructuraSugerida();
            
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

            $this->set('plan_id', $plan_id);
            $this->set('anios', $plan['Anio']);
            $this->set('estructura_planes_anios', $estructura_planes_anios);
            $this->set('planes' , $planes);
            
        }



        function listado() {
        $jurisdiccion_id = 0;
        $limit = 10;
        if(!empty($this->data['Plan'])) {

            $options['joins'] = array(
                array('table' => 'instits',
                    'alias' => 'Instits',
                    'type' => 'INNER',
                    'conditions' => array(
                        'Plan.instit_id = Instits.id',
                        'Instits.jurisdiccion_id' => $this->data['Plan']['jurisdiccion_id']
                    )
                )
            );

            $options['conditions'] = array(
                    'Plan.z_depurado' => 0,
                    'Plan.oferta_id' => array(3,4)
            );

            $options['limit'] = 10;

            $options['contain'] = array(
                     'Sector'=>array('Orientacion'),
                     'Anio' => array('order'=>array('ciclo_id'),'Ciclo')
            );

            //$planes = $this->Plan->find('all',$options);
//            $this->Instit->find('all', array(
//                'contain' => array(
//                    'Plan' => array(
//                        'conditions' => array('Plan.estructura_plan_id' => 0),
//                        'Anio' => array('Anio.estructura_planes_anio_id' => 0)
//                    )
//                ),
//                'conditions' => array(
//
//                )
//            ));

            $anios = $this->Anio->find('all', array(
                'contain' => 'Plan.Instit',
                'conditions'=> array(
                    'Anio.estructura_planes_anio_id' => 0,
                    'Plan.estructura_plan_id' => 0
                ),
                'group' => 'Instit.id',
                'limit' => $limit,
            ));
            

            $jurisdiccion_id = $this->data['Plan']['jurisdiccion_id'];
        }
        else{
            $planes = $this->Plan->find('all',array(
                        'contain' => array(
                            'Sector'=>array('Orientacion'),
                            'Anio' => array('order'=>array('ciclo_id'),'Ciclo')
                            ),
                        'conditions' => array(
                            'Plan.z_depurado' => 0,
                            'Plan.oferta_id' => array(3,4)
                            ),
                        'limit' => 10
                      ));
        }


$limit = 1;
            //$planes = $this->Plan->find('all',$options);
            $anios = $this->Instit->find('all', array(
                'limit' => $limit,
                'contain' => array(
                    'Plan' => array(
                       // 'conditions' => array('Plan.estructura_plan_id' => 0),
                        'Anio' => array('conditions' => array('Anio.estructura_planes_anio_id' => 0))
                    )
                ),
                'conditions' => array(
                    'Plan.estructura_plan_id' => 0,
                )
            ));
        

        debug($anios);
        
        $jurisdicciones = $this->Instit->Jurisdiccion->find('list');

        $this->set(compact('jurisdicciones'));
        $this->set('anios',$anios);
        $this->set('jurisdiccion_id',$jurisdiccion_id);

    }
}

?>