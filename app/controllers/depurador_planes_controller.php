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

        if ($id) {
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
                                    'conditions'=> array('Plan.oferta_id'=> 3),
                                    'order' => array('')
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


    function arregladorDeAnios($plan_id, $ciclo_id = null) {
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
        if (!empty($this->data)) {
             //debug($this->data);
            if (!$this->Plan->tieneEstructuraDefinida()) {
                $this->Session->setFlash('El plan seleccionado no tiene estructura definida, no puede ser guardado. Primero seleccione una estructura al plan.');
                $this->redirect('/depuradorPlanes/index/'.$plan['Instit']['id']);
            }

            // meto la etapa y el añio de la estructura para mantener los viejos campos
            foreach ($this->data['Anio'] as &$a) {
                if ($a['plan_id'] != $plan_id) {
                    $plan_aux = $this->Plan->find('all', array(
                                    'contain' => array('EstructuraPlan.EstructuraPlanesAnio'),
                                    'conditions'=>array('Plan.id'=>$a['plan_id'])));

                    // puede ser vacio si no esta estructurado ese plan
                    $a['etapa_id'] = $plan_aux[0]['EstructuraPlan']['etapa_id'];
                }
                else {
                     $a['etapa_id'] = $plan['EstructuraPlan']['etapa_id'];
                }

                foreach ($plan['EstructuraPlan']['EstructuraPlanesAnio'] as $epp) {
                    if ($a['estructura_planes_anio_id'] == $epp['id']) {
                        $a['anio'] =  $epp['nro_anio'];
                    }
                }
            }
            
            if (!$this->Anio->saveAll($this->data['Anio'])) {
                $txt = '';
                foreach($this->Anio->validationErrors as $kk=>$eee) {
                    $txt .= empty($txt)?'':', ';
                    $txt .= array_shift($eee);
                }
                $this->Session->setFlash('Error al guardar debido a el/los siguientes errores: '.$txt);
            }
           
            $this->Session->setFlash('Se guardó todo Bien');
            $this->redirect('/depuradorPlanes/index/'.$plan['Instit']['id']);
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

        $this->set('plan', $plan);
        $this->set('anios', $plan['Anio']);
        $this->set('estructura_planes_anios', $estructura_planes_anios);
        $this->set('planes' , $planes);

    }



    function listado() {
        $jurisdiccionSql = ' > 0';
        $jurisdiccion_id = 0;
        $limit = 10;
        $orderBy = 'i.cue*100+i.anexo';
        $errores = 0; // es una variable pasada en el form de la vista para usar el $orderBy

        if (!empty($this->data['Depurador']['jurisdiccion_id'])) {           
            $jurisdiccion_id = $this->data['Depurador']['jurisdiccion_id'];
        } else {
            if ($this->data['Depurador']['jurisdiccion_id'] !== '') {
                if ($this->Session->check('jurisdiccion_id')) {
                    $jurisdiccion_id = $this->Session->read('jurisdiccion_id');
                }
            }
        }
        $this->Session->write('jurisdiccion_id', $jurisdiccion_id);
        if ($jurisdiccion_id > 0) {
            $jurisdiccionSql = " = ".$jurisdiccion_id;
        }

        if (!empty($this->data['Depurador']['limit'])) {
            $limit = $this->data['Depurador']['limit'];
        } else {
            if ($this->data['Depurador']['limit'] !== '') {
                if ($this->Session->check('limit')) {
                    $limit = $this->Session->read('limit');
                }
            }
        }
        $this->Session->write('limit', $limit);

        if (!empty($this->data['Depurador']['errores'])) {
            $errores = $this->data['Depurador']['errores'];
        } else {
            if ($this->data['Depurador']['errores'] !== '') {
                if ($this->Session->check('errores')) {
                    $errores = $this->Session->read('errores');
                }
            }
        }
        $this->Session->write('errores', $errores);
        switch ($errores) {
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
                    i.jurisdiccion_id $jurisdiccionSql
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


    function add_plan($instit_id) {
        if (!empty($this->data) && !$instit_id) {
            $this->Session->setFlash(__('Institución incorrecta', true));
            $this->redirect('/depuradorPlanes/listado');
        }
        if (!empty($this->data)) {
            $this->Plan->create();
            if ($this->Plan->save($this->data)) {
                $this->Session->setFlash(__('Se ha creado un nuevo Plan', true));

                // redirige al depurador
                $this->redirect('/depuradorPlanes/index/'.$instit_id);
            }
            else {
                $this->Session->setFlash(__('No se ha podido crear el Plan. Por favor, intente nuevamente.', true));
            }
        }

        $this->Plan->Instit->recursive = 1;
        $instit = $this->Plan->Instit->read(null, $instit_id);
        $this->set('instit',$instit['Instit']);

        $titulos = $this->Plan->Titulo->find('list',array('conditions'=> array('Titulo.oferta_id'=>3)));
        $sectores = $this->Plan->Sector->find('list',array('order'=>'Sector.name'));
        //$subsectores = $this->Plan->Subsector->con_sector('list',array('conditions'=> array('Subsector.sector_id'=>5)));
        $ciclos = $this->Plan->Anio->Ciclo->find('list');


        $estructuraPlanesGrafico = $this->Plan->EstructuraPlan->JurisdiccionesEstructuraPlan->find('all',array(
                'contain'=>array(
                        'EstructuraPlan'=>array('Etapa','EstructuraPlanesAnio'=>array('order'=> array('EstructuraPlanesAnio.edad_teorica')))
                ),
                'conditions'=>array('jurisdiccion_id'=>$instit['Instit']['jurisdiccion_id'])
        ));

        $estructura_planes = array();
        foreach($estructuraPlanesGrafico as $estructura) {
            $estructura_planes[$estructura['EstructuraPlan']['id']] = $estructura['EstructuraPlan']['name'];

        }

        $this->set(compact('subsectores','sectores','titulos', 'ciclos', 'estructura_planes','estructuraPlanesGrafico'));

        $this->rutaUrl_for_layout[] =array('name'=> 'Datos Institución','link'=>'/Instits/view/'.$instit['Instit']['id'] );
    }
}

?>