<?php
class PlanesController extends AppController {

    var $name = 'Planes';
    var $helpers = array('Html','Form','Ajax');

    function beforeFilter() {
        parent::beforeFilter();
        //preparo la rutaUrl_for_layout ver en appController para mas informacion
        $this->rutaUrl_for_layout[] = array('name'=> 'Buscador','link'=>'/Instits/search_form' );

    }


    /**
     * Listado de planes para una determinada institucion
     * @param $id ID de institucion
     */
    function index($id = null) {

        // posibles controllers de ofertas
        $ofertasControllers[FP_ID] = 'view_fp';
        $ofertasControllers[ITINERARIO_ID] = 'view_it_sec';
        $ofertasControllers[SEC_TEC_ID] = 'view_sectec';
        $ofertasControllers[SUP_TEC_ID] = 'view_sup';
        $ofertasControllers[SEC_ID] = 'view_it_sec';
        $ofertasControllers[SUP_ID] = 'view_sup';

        $v_plan_matricula = array();

        if (empty($id)) {
            $this->Session->setFlash(__('La institución pasada como parámetro es inválida.', true));
            $this->redirect('/pages/home');
        }

        /* *************************** */
        /*  Si tiene ticket pendiente  */

        $data_ticket = $this->Plan->Instit->Ticket->dameTicketPendiente($id);
        $ticket_id = isset($data_ticket['Ticket']['id'])?$data_ticket['Ticket']['id']:0;
        $this->set('ticket_id', $ticket_id);

        $action = ($this->Auth->user('role')=='admin' || $this->Auth->user('role')=='editor' || $this->Auth->user('role')=='desarrollo')?'edit':'view';
        $this->set('action', $action);

        /*  Fin Si tiene ticket pendiente * */
        /* ******************************** */

        //seteo el ID a la Instit
        $this->Plan->Instit->id = $id;
        $this->Plan->Instit->read();

        if(!empty($this->Plan->Instit->data)) {
            $cont = 0;
            foreach ($this->Plan->Instit->data['Plan'] as $p):
                $v_plan_matricula[$cont] = $this->Plan->Anio->matricula_del_plan($p['id']);
                $v_plan_matricula[$cont]['ciclo'] = $this->Plan->Anio->ciclo_lectivo_matricula_del_plan($p['id']);
                $cont++;
            endforeach;

            $this->set('sumatoria_matriculas',$this->Plan->Instit->dameSumatoriaDeMatriculasPorOferta($id));
            $this->set('planes',$this->Plan->Instit->data);
            $this->set('v_plan_matricula',$v_plan_matricula);
            $this->rutaUrl_for_layout[] =array('name'=> 'Datos Institución','link'=>'/Instits/view/'.$id );
        }

        $ciclos = $this->Plan->dame_ciclos_por_oferta_instits($id);

        $ofertas  = $this->Plan->dameOfertaPorInstitucion($id,'');
        $sectores = $this->Plan->dameSectoresPorInstitucion($id,isset($url_conditions['Anio.ciclo_id'])?$url_conditions['Anio.ciclo_id']:'');
        $this->set(compact('ofertas','ciclos','sectores'));
        $this->set('ofertasControllers', $ofertasControllers);
    }

    /**
     * Listado de planes para una determinada institucion
     * @param $id ID de institucion
     */

    function index_clasico($id = null) {

        $v_plan_matricula = array();

        if (isset($this->passedArgs['Instit.id'])) {
            $id = $this->passedArgs['Instit.id'];
        }

        if (isset($this->data['Instit']['id'])) {
            $id = $this->data['Instit']['id'];
        }

        if (empty($id)) {
            $this->Session->setFlash(__('La institución pasada como parámetro es inválida.', true));
            $this->redirect('/pages/home');
        }


        /* *************************** */
        /*  Si tiene ticket pendiente  */

        $data_ticket = $this->Plan->Instit->Ticket->dameTicketPendiente($id);
        $ticket_id = isset($data_ticket['Ticket']['id'])?$data_ticket['Ticket']['id']:0;
        $this->set('ticket_id', $ticket_id);

        $action = ($this->Auth->user('role')=='admin' || $this->Auth->user('role')=='editor' || $this->Auth->user('role')=='desarrollo')?'edit':'view';
        $this->set('action', $action);

        /*  Fin Si tiene ticket pendiente * */
        /* ******************************** */

        //seteo el ID a la Instit
        $this->Plan->Instit->id = $id;
        $this->Plan->Instit->read();

        if(!empty($this->Plan->Instit->data)) {
            $cont = 0;
            foreach ($this->Plan->Instit->data['Plan'] as $p):
                $v_plan_matricula[$cont] = $this->Plan->Anio->matricula_del_plan($p['id']);
                $v_plan_matricula[$cont]['ciclo'] = $this->Plan->Anio->ciclo_lectivo_matricula_del_plan($p['id']);
                $cont++;
            endforeach;

            $this->set('sumatoria_matriculas',$this->Plan->Instit->dameSumatoriaDeMatriculasPorOferta($id));
            $this->set('planes',$this->Plan->Instit->data);
            $this->set('v_plan_matricula',$v_plan_matricula);
            $this->rutaUrl_for_layout[] =array('name'=> 'Datos Institución','link'=>'/Instits/view/'.$id );
        }

        $ciclos = $this->Plan->dame_ciclos_por_instits($id);

        if (!empty($ciclos)) {
            if (!(in_array(date("Y"),$ciclos))) {
                $ciclos = array_merge($ciclos,array(date('Y') => date('Y')));
                sort($ciclos);
            }
        } else {
            $ciclos = array(date('Y') => date('Y'));
        }

        /* ************************************ */
        /* * Filtros de la búsqueda de Planes * */

        if(isset($this->data['Plan']['oferta_id'])) {
            if((int)$this->data['Plan']['oferta_id'] != 0) {
                $this->paginate['conditions']['Plan.oferta_id'] = $this->data['Plan']['oferta_id'];
                $url_conditions['Plan.oferta_id'] = $this->data['Plan']['oferta_id'];
            }
        }
        if(isset($this->passedArgs['Plan.oferta_id'])) {
            if((int)$this->passedArgs['Plan.oferta_id'] != 0) {
                $this->paginate['conditions']['Plan.oferta_id'] = $this->passedArgs['Plan.oferta_id'];
                $url_conditions['Plan.oferta_id'] = $this->passedArgs['Plan.oferta_id'];
            }
        }

        if(isset($this->data['Plan']['nombre']) && $this->data['Plan']['nombre'] != "") {
            $this->paginate['conditions']['to_ascii(lower(Plan.nombre)) SIMILAR TO ?'] = array(convertir_para_busqueda_avanzada($this->data['Plan']['nombre']));
            $url_conditions['Plan.nombre'] = $this->data['Plan']['nombre'];
        }
        if(isset($this->passedArgs['Plan.nombre']) && $this->passedArgs['Plan.nombre'] != "") {
            $this->paginate['conditions']['to_ascii(lower(Plan.nombre)) SIMILAR TO ?'] = array(convertir_para_busqueda_avanzada(utf8_decode($this->passedArgs['Plan.nombre'])));
            $url_conditions['Plan.nombre'] = utf8_decode($this->passedArgs['Plan.nombre']);
        }

        if(isset($this->data['Plan']['sector_id'])) {
            if((int)$this->data['Plan']['sector_id'] != 0) {
                $this->paginate['conditions']['Plan.sector_id'] = $this->data['Plan']['sector_id'];
                $url_conditions['Plan.sector_id'] = $this->data['Plan']['sector_id'];
            }
        }
        if(isset($this->passedArgs['Plan.sector_id'])) {
            if((int)$this->passedArgs['Plan.sector_id'] != 0) {
                $this->paginate['conditions']['Plan.sector_id'] = $this->passedArgs['Plan.sector_id'];
                $url_conditions['Plan.sector_id'] = $this->passedArgs['Plan.sector_id'];
            }
        }

        if(isset($this->data['Anio']['ciclo_id'])) {
            if((int)$this->data['Anio']['ciclo_id'] != 0) {
                //$this->Plan->setMaxCiclo($this->data['Anio']['ciclo_id']);
                $this->paginate['conditions']['Anio.ciclo_id'] = $this->data['Anio']['ciclo_id'];
            } else {
                $this->Plan->setTraerUltimaAct(true);
            }
            $url_conditions['Anio.ciclo_id'] = $this->data['Anio']['ciclo_id'];
        }
        else {
            if(isset($this->passedArgs['Anio.ciclo_id'])) {
                if((int)$this->passedArgs['Anio.ciclo_id'] != 0) {
                    //$this->Plan->setMaxCiclo($this->passedArgs['Anio.ciclo_id']);
                    $this->paginate['conditions']['Anio.ciclo_id'] = $this->passedArgs['Anio.ciclo_id'];
                } else {
                    // si viene por aca es porque clickeo en la solapa Todos.
                    $this->Plan->setTraerUltimaAct(true);
                }
                $url_conditions['Anio.ciclo_id'] = $this->passedArgs['Anio.ciclo_id'];
            }
            else {
                if(isset($ciclos)) {
                    if((int)end($ciclos) != 0) {
                        //$this->Plan->setMaxCiclo(date("Y"));
                        $this->paginate['conditions']['Anio.ciclo_id'] = date("Y");
                        $url_conditions['Anio.ciclo_id'] = date("Y");
                    }
                }
            }
        }

        $ofertas  = $this->Plan->dameOfertaPorInstitucion($id,isset($url_conditions['Anio.ciclo_id'])?$url_conditions['Anio.ciclo_id']:'');
        $sectores = $this->Plan->dameSectoresPorInstitucion($id,isset($url_conditions['Anio.ciclo_id'])?$url_conditions['Anio.ciclo_id']:'');
        $this->set(compact('ofertas','ciclos','sectores'));



        /* ********************************* */
        /* * Paginador 					   * */

        if (!isset($this->passedArgs['sort'])) {
            if ($this->Plan->getTraerUltimaAct()) {
                $this->passedArgs['order'] = 'Plan.oferta_id desc, Sector.name asc, Anio__ciclo_id desc';
            } else {
                $this->passedArgs['order'] = 'Plan.oferta_id desc, Sector.name asc';
            }
        }

        $this->Plan->setAsociarAnio(true);
        $this->paginate['conditions']['Instit.id'] = $id;
        $url_conditions['Instit.id'] = $id; // para que no pierda el id de instit en los ordenamientos y la paginacion
        $data = $this->paginate();
        for($i=0; $i< count($data); $i++):
            $mat = $this->Plan->dameMatriculaDeCiclo($data[$i]['Plan']['id'],$data[$i]['Anio']['ciclo_id']);
            $data[$i]['calculado']['sum_matricula'] = $mat;
        endfor;


        $this->set('datoUltimoCiclo', $this->Plan->dameMatriculaUltimoCiclo($id));
        $this->set('planesRelacionados', $data);
        $this->set('url_conditions', $url_conditions);
    }

    function test() {

        $this->set('instit_id', $this->passedArgs['instit_id']);
        $this->set('oferta_id', $this->passedArgs['oferta_id']);
        $this->set('ciclo', $this->passedArgs['ciclo']);
    }

    function view($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('El Plan no es correcto.', true));
            $this->redirect(array('action'=>'index'));
        }

        $this->Plan->recursive = 2;
        $plan = $this->Plan->read(null, $id);

        //ordenos los años para ue puedan ser mostrados en la vista
        $anios = array();

        foreach($plan['Anio'] as $p) {
            $anios[$p['ciclo_id']][]= $p;
        }

        $this->set('anios',$anios);
        $this->set('plan',$plan);

        $this->Plan->Instit->recursive = 1;
        $instit = $this->Plan->Instit->read(null, $plan['Plan']['instit_id']);

        $this->set('instit',$instit['Instit']);
        $this->set('matricula', $this->Plan->Anio->matricula_del_plan($id));

        $this->rutaUrl_for_layout[] = array('name'=> 'Datos Institución','link'=>'/Instits/view/'.$instit['Instit']['id'] );
        $this->rutaUrl_for_layout[] = array('name'=> 'Oferta Educativa','link'=>'/Planes/index/'.$instit['Instit']['id'] );

        $planes_view_tabla['element'] = 'planes_view_tabla_normal';
        $planes_view_tabla['options'] = array();
        //	Si es FP mostrar la vista para FP, sino mostrar la vista por default (view)
        switch ($plan['Plan']['oferta_id']):
            case 1: // FP
                $planes_view_tabla['element'] = 'planes_view_tabla_fp';
                break;
            case 4: //SNU
            case 6: //SUP NO TECNICO
                $planes_view_tabla['element'] = 'planes_view_tabla_snu';
                break;
            case 2: //IT
            case 5: //SNU
                $planes_view_tabla['element'] = 'planes_view_tabla_normal';
                break;
            case 3: //MT, SEC
            // 'planes_view_tabla_st_old' es una solucion temporal,
            // vamos atener que usar el elemento $planes_view_tabla['element'] = 'planes_view_tabla_st' en un futuro
                $planes_view_tabla['element'] = 'planes_view_tabla_st_old';
                $this->set('plan_tiene_estructura_valida', $this->Plan->estructuraValida($id));
                break;
            default:
                $this->Session->setFlash('ID inválido para la oferta_id del Plan');
                $this->redirect('/');
            endswitch;

        $this->set('planes_view_tabla',$planes_view_tabla);
    }

    function add($instit_id = null) {
        if (!empty($this->data) && !$instit_id) {
            $this->Session->setFlash(__('Institución incorrecta', true));
            $this->redirect(array('controller'=>'pages', 'action'=>'home'));
        }
        if (!empty($this->data)) {
            $instit_id = $this->data['Plan']['instit_id'];
            $this->Plan->create();
            if ($this->Plan->save($this->data)) {
                $this->Session->setFlash(__('Se ha creado un nuevo Plan', true));
                $this->redirect(array('controller'=>'Planes','action'=>'view/'.$this->Plan->id));
            } else {
                $this->Session->setFlash(__('No se ha podido crear el Plan. Por favor, intente nuevamente.', true));
            }
        }

        $this->Plan->Instit->recursive = 1;
        $instit = $this->Plan->Instit->read(null, $instit_id);
        $this->set('instit',$instit['Instit']);

        $ofertas = $this->Plan->Oferta->find('list');
        $this->set(compact('ofertas'));

        $titulos = $this->Plan->Titulo->find('list');
        $sectores = $this->Plan->Sector->find('list',array('order'=>'Sector.name'));
        $subsectores = $this->Plan->Subsector->con_sector('list');
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

    function edit($id = null) {
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Plan Inválido', true));
            $this->redirect(array('controller'=>'Pages','action'=>'home'));
        }
        if (!empty($this->data)) {
            if ($this->Plan->save($this->data)) {
                $this->Session->setFlash(__('El Plan ha sido guardado', true));
                $this->redirect(array('action'=>'view/'.$this->data['Plan']['id']));
            } else {
                $this->Session->setFlash(__('El Plan no pudo ser guardado. Por favor, intente de nuevo.', true));
            }
        }
        if (empty($this->data)) {
            $this->data = $this->Plan->read(null, $id);
        }
        $this->Plan->Instit->recursive = 1;
        $instit = $this->Plan->Instit->read(null, $this->data['Plan']['instit_id']);
        $this->set('instit',$instit['Instit']);

        $titulos = $this->Plan->Titulo->find('list', array('conditions'=>array('oferta_id'=>$this->data['Plan']['oferta_id'])));
        $ofertas = $this->Plan->Oferta->find('list');

        $sectores = $this->Plan->Sector->find('list',array('order'=>'Sector.name'));

        if(!isset($this->data['Plan']['sector_id'])) {
            $this->data['Plan']['sector_id'] = 0;
        }
        $subsectores = $this->Plan->Subsector->con_sector('list',$this->data['Plan']['sector_id']);
        $ciclos = $this->Plan->Anio->Ciclo->find('list');

        $estructuraPlanesGrafico = $this->Plan->EstructuraPlan->JurisdiccionesEstructuraPlan->find('all',array(
                'contain'=>array(
                        'EstructuraPlan'=>array('Etapa','EstructuraPlanesAnio'=>array('order'=> array('EstructuraPlanesAnio.edad_teorica')))
                ),
                'conditions'=>array('jurisdiccion_id'=>$instit['Instit']['jurisdiccion_id'])
        ));

        foreach($estructuraPlanesGrafico as $estructura) {
            $estructura_planes[$estructura['EstructuraPlan']['id']] = $estructura['EstructuraPlan']['name'];

        }

        $estructuraSugeridaId = $this->Plan->getEstructuraSugerida();

        $this->set(compact('ofertas','subsectores','sectores','titulos','ciclos', 'estructura_planes','estructuraPlanesGrafico', 'estructuraSugeridaId'));

        $this->rutaUrl_for_layout[] = array('name'=> 'Datos Institución','link'=>'/Instits/view/'.$this->data['Plan']['instit_id'] );
        $this->rutaUrl_for_layout[] = array('name'=> 'Oferta Educativa','link'=>'/Planes/index/'.$this->data['Plan']['instit_id'] );
        $this->rutaUrl_for_layout[] = array('name'=> $this->data['Plan']['nombre'],'link'=>'/Planes/view/'.$this->data['Plan']['id'] );
    }

    function delete($id = null) {
        $this->Plan->recursive = -1;
        $this->data = $this->Plan->read(null,$id);
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for Plan', true));
        }
        if ($this->Plan->del($id)) {
            $this->Session->setFlash(__('Plan Eliminado', true));
            $this->redirect(array('controller'=>'planes','action'=>'index/'.$this->data['Plan']['instit_id']));
        }
    }

    function view_fp($instit_id, $oferta_id, $ciclo=0) {
        $conditionsAnio = array();

        if(!empty($ciclo)) {
            $this->paginate['conditions']['Anio.ciclo_id'] = $ciclo;
        }

        $this->Plan->setAsociarAnio(true);
        $this->paginate['conditions']['Plan.oferta_id'] = $oferta_id;
        $this->paginate['conditions']['Instit.id'] = $instit_id;
        $this->paginate['order'] = array("Anio.ciclo_id");

        $planes = $this->paginate();

        $sectores = $this->Plan->find("all",array(
                'fields'=>array(
                        'DISTINCT Sector.id', 'Sector.name'
                ),
                'conditions'=>array(
                        'Plan.instit_id'=>$instit_id,
                        'Plan.oferta_id'=>$oferta_id
                ),
                'contain'=>array(
                        'Sector'
                )
        ));

        $sectores_aux = array();

        foreach($sectores as $s){
            $sectores_aux[$s['Sector']['id']] = $s['Sector']['name'];
        }

        $ciclos_anios = $this->Plan->Anio->Ciclo->find("list");

        $this->set('sectores', $sectores_aux);
        $this->set('planes', $planes);
        $this->set('instit_id', $instit_id);
        $this->set('oferta_id', $oferta_id);
        $this->set('ciclo', $ciclo);
        $this->set('ciclos_anios', $ciclos_anios);
    }

    function view_it_sec($instit_id,$oferta_id,$ciclo=0) {
        if($ciclo == 0) {
            // el ultimo ciclo de cada plan

            $this->Plan->setTraerUltimaAct(true);
            $this->Plan->setAsociarAnio(true);
            $this->Plan->recursive = 0;
            //$this->paginate['fields'] = array('DISTINCT Plan.id');
            $this->paginate['conditions']['Plan.oferta_id'] = $oferta_id;
            $this->paginate['conditions']['Instit.id'] = $instit_id;
            $this->paginate['order'] = array('Anio__ciclo_id desc');

            $planes_encabezado = $this->paginate();

            $i = 0;
            if (!empty($planes_encabezado)) {
                foreach ($planes_encabezado as $plan) {
                    //debug($plan);
                    $planes[$i]['Plan'] = $plan['Plan'];
                    $planes[$i]['Sector'] = $plan['Sector'];

                    $anios = $this->Plan->Anio->find("all",array(
                            'conditions'=>array(
                                    'ciclo_id' => $plan['Anio']['ciclo_id'],
                                    'plan_id' => $plan['Plan']['id']
                            ),
                            'contain'=>array(
                                    'Etapa'
                            )
                        ));

                    if (!empty($anios)) {
                        $j = 0;
                        foreach ($anios as $anio) {
                            $planes[$i]['Anio'][$j] = $anio['Anio'];
                            $planes[$i]['Anio'][$j]['Etapa'] = $anio['Etapa'];

                            $j++;
                        }
                    }


                    $i++;
                }
            }


        }
        else {
            $planes = $this->Plan->find("all",array(
                    'conditions'=>array(
                            'instit_id'=>$instit_id,
                            'oferta_id'=>$oferta_id
                    ),
                    'contain'=>array(
                            'Anio' => array('Etapa', 'conditions' => array('ciclo_id' => $ciclo))
                    )
            ));
        }

        $this->set('planes', $planes);
        $this->set('instit_id', $instit_id);
        $this->set('oferta_id', $oferta_id);
        $this->set('ciclo', $ciclo);
    }

    function view_sectec($instit_id,$oferta_id,$ciclo=0) {

        $conditionsAnio = array();

        if ($ciclo == 0) {
            $this->Plan->setTraerUltimaAct(true);
        }

        $planes = $this->Plan->Instit->getUltimosPlanes($instit_id, $ciclo, $oferta_id);

        $this->set('planes', $planes);
        $this->set('instit_id', $instit_id);
        $this->set('oferta_id', $oferta_id);
        $this->set('ciclo', $ciclo);
    }


    function view_sup($instit_id,$oferta_id,$ciclo=0) {
        //Configure::write('debug', 2);
        $condition = '';
        if($ciclo == 0) {
            // el ultimo ciclo de cada plan
            
            $this->Plan->setTraerUltimaAct(true);
            $this->Plan->setAsociarAnio(true);
            $this->Plan->recursive = 0;
            $this->paginate['conditions']['Plan.oferta_id'] = $oferta_id;
            $this->paginate['conditions']['Instit.id'] = $instit_id;
            $this->paginate['order'] = array('Anio__ciclo_id desc');

            $planes_encabezado = $this->paginate();

            //$planes = $this->Plan->Instit->getUltimosPlanes($instit_id, $ciclo, $oferta_id);

            $i = 0;
            if (!empty($planes_encabezado)) {
                foreach ($planes_encabezado as $plan) {
                    //debug($plan);
                    $planes[$i]['Plan'] = $plan['Plan'];
                    $planes[$i]['Sector'] = $plan['Sector'];

                    $anios = $this->Plan->Anio->find("all",array(
                            'conditions'=>array(
                                    'ciclo_id' => $plan['Anio']['ciclo_id'],
                                    'plan_id' => $plan['Plan']['id']
                            ),
                            'contain'=>array(
                                    'Etapa'
                            )
                        ));

                    if (!empty($anios)) {
                        $j = 0;
                        foreach ($anios as $anio) {
                            $planes[$i]['Anio'][$j] = $anio['Anio'];
                            $planes[$i]['Anio'][$j]['Etapa'] = $anio['Etapa'];

                            $j++;
                        }
                    }


                    $i++;
                }
            }
            

        }
        else {
            $planes = $this->Plan->find("all",array(
                    'conditions'=>array(
                            'instit_id'=>$instit_id,
                            'oferta_id'=>$oferta_id
                    ),
                    'contain'=>array(
                            'Anio' => array('Etapa', 'conditions' => array('ciclo_id' => $ciclo))
                    )
            ));
        }
//debug($planes);

        $this->set('planes', $planes);
        $this->set('instit_id', $instit_id);
        $this->set('oferta_id', $oferta_id);
        $this->set('ciclo', $ciclo);
    }

    function edicionMasiva1Dot6Dot3() {
        set_time_limit(30000000);
        $this->Plan->recursive = 0;
        $planes = $this->Plan->find("all",array(
                'conditions'=>array(
                        'EstructuraPlan.etapa_id' => 102
                )
        ));

        foreach ($planes as &$plan) {
            $nombre = $plan['Plan']['nombre'];
            $pos=strpos($nombre, '(');
            if ($pos !== false) {
                $plan['Plan']['nombre'] = "PRIMER CICLO ".substr($nombre, $pos);
            }
            else {
                $plan['Plan']['nombre'] = "PRIMER CICLO";
            }
            $plan['Plan']['titulo_id'] = 997;

            $planes_to_save['Plan'][] = $plan['Plan'];
        }

        $this->Plan->saveAll($planes_to_save['Plan']);

        die('done');
    }

}
?>
