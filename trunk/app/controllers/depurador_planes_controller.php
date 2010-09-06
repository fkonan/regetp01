<?php
set_time_limit(30000000);

class DepuradorPlanesController extends AppController {

	var $name = 'DepuradorPlanes';
	var $helpers = array('Html', 'Form','Ajax');
	var $uses = array('Instit','Plan','Anio','Sector','Jurisdiccion',
                    'EstructuraPlan','JurisdiccionesEstructuraPlan','EstructuraPlanesAnio');
	var $db;

	var $layout = 'depurador';
	
	function index($id) {
            Configure::write('debug', '0');

            if ($id)
            {
                //$instit = $this->Instit->findById($id);
                $instit = $this->Instit->find('all', array(
                            'contain' => array(
                                'Jurisdiccion' => 'name',
                                'Gestion' => 'name',
                                'Departamento' => 'name',
                                'Localidad' => 'name',
                                'Plan' => array(
                                    'Anio' => array(
                                            'Etapa',
                                            'order'=>array('ciclo_id','etapa_id', 'anio')),
                                    'conditions'=> array('Plan.oferta_id'=> 3)
                                    )),
                            'conditions' => array('Instit.id'=> $id)
                ));
                //print_r($instit);
                $jurisdiccion_id = $instit[0]['Instit']['jurisdiccion_id'];

                // estructuras posibles en la jurisdiccion
                $estructuras = $this->JurisdiccionesEstructuraPlan->getEstructurasDeJurisdiccion($jurisdiccion_id, 'list');

                $this->set('instit',$instit[0]);
                $this->set('estructuras',$estructuras);
            }
        }

        function tr_plan($plan_id) {
            $plan = $this->Plan->find('all', array(
                            'contain' => array(
                                'Anio' => array(
                                        'Etapa',
                                        'order'=>array('ciclo_id','etapa_id', 'anio')),
                                ),
                            'conditions' => array('Plan.oferta_id'=> 3,'Plan.id'=> $plan_id)
                ));
            
            // funcion de Ale
            $return = $this->Plan->estructuraValida($plan_id);
            
            $anios_incorrectos = array();
            if (is_array($return))
                foreach($return as $anio) {
                $anios_incorrectos[] = $anio['Anio']['ciclo_id'];
            }
            //debug($anios_incorrectos);
            $this->set('anios_incorrectos', $anios_incorrectos);
            $this->set('plan', $plan[0]);
        }

        function cambiarEstructuraPlan($plan_id, $estructura_plan_id) {
            if ($estructura_plan_id > 0) {
                $this->Plan->recursive = -1;
                $plan = $this->Plan->read(null, $plan_id);
                $plan['Plan']['estructura_plan_id'] = $estructura_plan_id;

                $this->Plan->save($plan);
            }
            // renderiza el plan
            $this->redirect('/depurador_planes/tr_plan/'.$plan_id);
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


            $planes[$plan_id] = 'No mover de: '.$planes[$plan_id];

            $this->set('plan_id', $plan_id);
            $this->set('anios', $plan['Anio']);
            $this->set('estructura_planes_anios', $estructura_planes_anios);
            $this->set('planes' , $planes);
            
        }



        function listado() {
        $jurisdiccion_id = ' > 0';
        $limit = 10;
        $orderBy = 'i.cue*100+i.anexo';
        $errores = 0; // es una variable pasada en el form de la vista para usar el $orderBy
        
        if (!empty($this->data['Depurador']['jurisdiccion_id'])) {
           $jurisdiccion_id = " = ".$this->data['Depurador']['jurisdiccion_id'];
        }

        if (!empty($this->data['Depurador']['limit'])) {
           $limit = $this->data['Depurador']['limit'];
        }

        if (!empty($this->data['Depurador']['errores'])) {
            $errores = $this->data['Depurador']['errores'];
            switch ($errores){
                case 1: // ordeno por cantidad de errors
                     $orderBy = 'count(*) DESC';
                    break;
                case 2: // ordeno por cantidad de errors
                     $orderBy = 'count(*)';
                    break;
                case 0:
                default: // lo dejo como està
                    break;
            }
        }

        $selectSQL = "
                         select
                    i.id as \"Instit__id\" ,
                    i.nombre as \"Instit__nombre\" ,
                    i.cue as \"Instit__cue\" ,
                    i.anexo as \"Instit__anexo\",
                    count(*) as \"Instit__errores\"
                        from instits i
                        left join planes p on (p.instit_id = i.id)
                        left join anios a on (a.plan_id = p.id)
                        where
                 (
                        p.estructura_plan_id = 0
                        or
                        a.estructura_planes_anio_id = 0
                 )
                 and
                     p.oferta_id = 3
                 and
                    i.jurisdiccion_id $jurisdiccion_id
                        group by i.id, i.nombre, i.cue, i.anexo
                 order by $orderBy
";

        $institsMal = $this->Instit->query($selectSQL. "  limit $limit");

        $cantFaltan = $this->Instit->query("SELECT COUNT(*) AS \"count\" from ($selectSQL) as tablacount");
        $cantFaltan = empty($cantFaltan[0][0]['count']) ? 0     :   $cantFaltan[0][0]['count'];
       
        $jurisdicciones = $this->Instit->Jurisdiccion->find('list');

        $this->set('errores',$errores);
        $this->set(compact('jurisdicciones'));
        $this->set('institsMal',$institsMal);
        $this->set('cantFaltan',$cantFaltan);
        $this->set('jurisdiccion_id',$jurisdiccion_id);
        $this->set('limit',$limit);
    }
}

?>