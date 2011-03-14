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
        $ofertasControllers[ITINERARIO_ID] = 'view_it_sec_sup';
        $ofertasControllers[SEC_TEC_ID] = 'view_it_sec_sup';
        $ofertasControllers[SUP_TEC_ID] = 'view_it_sec_sup';
        $ofertasControllers[SEC_ID] = 'view_it_sec_sup';
        $ofertasControllers[SUP_ID] = 'view_it_sec_sup';

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
        
        $ofertas  = $this->Plan->Instit->getOfertas($id,'');
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

        // los ciclos lectivos de la Instit cuya id fue setteada arriba
        $ciclos = $this->Plan->Instit->getCiclosLectivos();

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

        $ofertas  = $this->Plan->Instit->getOfertas($id,isset($url_conditions['Anio.ciclo_id'])?$url_conditions['Anio.ciclo_id']:'');
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

        
        $this->Plan->contain(array(
            'Anio' => array('EstructuraPlanesAnio'),
            'Oferta',
            'Titulo' => array(
                'SectoresTitulo' => array('Sector','Subsector','order'=>array('SectoresTitulo.prioridad DESC'))
                )
            )
        );

        $plan = $this->Plan->read(null, $id);

        //ordenos los años para ue puedan ser mostrados en la vista
        $anios = array();
        if(!empty($plan['Anio'])) {
            foreach($plan['Anio'] as $p) {
                $anios[$p['ciclo_id']][]= $p;
            }
        }

        $this->set('anios',$anios);
        $this->set('plan',$plan);

        $this->Plan->Instit->recursive = 1;
        $instit = $this->Plan->Instit->read(null, $plan['Plan']['instit_id']);

        $this->set('instit',$instit['Instit']);
        $this->set('matricula', $this->Plan->Anio->matricula_del_plan($id));

        /*$sectores = $this->Plan->Titulo->find('all', array(
                        'conditions'=>array('Titulo.id'=> $plan['Plan']['titulo_id']),
                        'contain'=>array('Sector','Subsector')
                    ));
        $this->set('sectores', $sectores);*/

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
        $sectores = $this->Plan->Titulo->Sector->find('list',array('order'=>'Sector.name'));
        $subsectores = $this->Plan->Titulo->Subsector->con_sector('list');
        $ciclos = $this->Plan->Anio->Ciclo->find('list');


        $estructuraPlanesGrafico = $this->Plan->EstructuraPlan->JurisdiccionesEstructuraPlan->find('all',array(
                'contain'=>array(
                        'EstructuraPlan'=>array('Etapa'=>array('order'=> array('Etapa.orden')),'EstructuraPlanesAnio'=>array('order'=> array('EstructuraPlanesAnio.edad_teorica')))
                ),
                'conditions'=>array('jurisdiccion_id'=>$instit['Instit']['jurisdiccion_id'])
        ));

        $estructura_planes = array();
        $estructuras_ordenadas = $estructuraPlanesGrafico;
        usort($estructuras_ordenadas, array( $this, 'comparar_planes_por_orden' ));
        
        foreach($estructuras_ordenadas as $estructura) {
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

        $sectores = $this->Plan->Titulo->Sector->find('list',array('order'=>'Sector.name'));

        if(!isset($this->data['Plan']['sector_id'])) {
            $this->data['Plan']['sector_id'] = 0;
        }
        $subsectores = $this->Plan->Titulo->Subsector->con_sector('list',$this->data['Plan']['sector_id']);
        $ciclos = $this->Plan->Anio->Ciclo->find('list');

        $estructuraPlanesGrafico = $this->Plan->EstructuraPlan->JurisdiccionesEstructuraPlan->find('all',array(
                'contain'=>array(
                        'EstructuraPlan'=>array('Etapa','EstructuraPlanesAnio'=>array('order'=> array('EstructuraPlanesAnio.edad_teorica')))
                ),
                'conditions'=>array('jurisdiccion_id'=>$instit['Instit']['jurisdiccion_id'])
        ));

        $estructuras_ordenadas = $estructuraPlanesGrafico;
        usort($estructuras_ordenadas, array( $this, 'comparar_planes_por_orden' ));

        foreach($estructuras_ordenadas as $estructura) {
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
        // solucion temporal para el paginador que no anda
        // $this->paginate['limit'] = 200;


        $es_una_busqueda = false;

        //debug($this->Session->read('Ciclo.id') . "-". $ciclo);
        $sesNames = array(
            'instit' => 'Instit.id',
            'plan'   => 'Plan.nombre'.$instit_id.$oferta_id.$ciclo,
            'sector' => 'Sector.id'.$instit_id.$oferta_id,
            'page' => 'page'.$instit_id.$oferta_id.$ciclo,
        );

        if (!empty($this->data)) {
            $es_una_busqueda = true;
            $this->Session->write($sesNames['instit'],$instit_id);
            $this->Session->write($sesNames['plan'], $this->data['Plan']['nombre']);
            $this->Session->write($sesNames['sector'], $this->data['Sector']['id']);
            $this->Session->write('page', '');
        }
        else {
            // busqueda en Session
            if ($this->Session->read($sesNames['instit']) == $instit_id) {
                if ($this->Session->read($sesNames['plan'])) {
                    $this->data['Plan']['nombre'] = $this->Session->read($sesNames['plan']);
                }

                if ($this->Session->read($sesNames['sector'])) {
                    $this->data['Sector']['id'] = $this->Session->read($sesNames['sector']);
                }
                $es_una_busqueda = true;
            }
        }
        
        $url_conditions = $this->passedArgs;
        
        if (!empty($this->passedArgs['page'])) {
            $this->Session->write($sesNames['page'], $this->passedArgs['page']);
        }
        elseif ($this->Session->read($sesNames['page'])) {
            $this->paginate['page'] = $this->Session->read($sesNames['page']);
        }

        $planNombre = null;
        if (!empty($this->data['Plan']['nombre'])) {
            $planNombre = $this->data['Plan']['nombre'];
        }
        if (!empty($this->passedArgs['Plan.nombre'])) {
            $planNombre = $this->passedArgs['Plan.nombre'];
        }
        if (!empty($planNombre)) {
            $this->paginate['conditions']['to_ascii(lower(Plan.nombre)) SIMILAR TO ?'] = array(convertir_para_busqueda_avanzada($planNombre));
            $url_conditions['Plan.nombre'] = $planNombre;
        }

        $sectorId = null;
        if (!empty($this->data['Sector']['id'])) {
            $sectorId = $this->data['Sector']['id'];
        }
        if (!empty($this->passedArgs['Sector.id'])) {
            $sectorId = $this->passedArgs['Sector.id'];
        }
        if (!empty($sectorId)) {
            $this->paginate['conditions']['SectoresTitulo.sector_id'] = $sectorId;
            $url_conditions['Sector.id'] = $sectorId;
        }


        if(!empty($ciclo)) {
            $this->paginate['conditions']['Anio.ciclo_id'] = $ciclo;
        } else {
            $this->Plan->setTraerUltimaAct(true);
        }
        
        $this->Plan->setAsociarAnio(true);
        
        $this->paginate['conditions']['Plan.oferta_id'] = $oferta_id;
        $this->paginate['conditions']['Instit.id'] = $instit_id;
        $this->paginate['order'] = array("Plan.nombre");

        $planes = $this->paginate();

        //$planes = $this->Plan->Instit->getPlanes($instit_id, $oferta_id, $ciclo);
        
        $newVecPlanes = array();
        $i = 0;
        foreach($planes as &$plan){
            if($ciclo == 0){
                $ultimo_ciclo = $this->Plan->getUltimoCiclo($plan['Plan']['id']);
                $plan['Plan']['matricula'] = $this->Plan->dameMatriculaDeCiclo($plan['Plan']['id'],$ultimo_ciclo);
            }
            else{
                $plan['Plan']['matricula'] = $this->Plan->dameMatriculaDeCiclo($plan['Plan']['id'],$ciclo);
            }
        }
        
        $sectores = $this->Plan->Instit->listSectoresConOferta($instit_id, $oferta_id);
        $ciclos_anios = $this->Plan->dame_ciclos_por_oferta_instits($instit_id, $agregar_anio_actual = false);
        $ciclos_anios = $ciclos_anios[FP_ID]['ciclo'];

        $this->set('es_una_busqueda',$es_una_busqueda);
        $this->set('sectores', $sectores);
        $this->set('planes', $planes);
        $this->set('instit_id', $instit_id);
        $this->set('oferta_id', $oferta_id);
        $this->set('ciclo', $ciclo);
        $this->set('ciclos_anios', $ciclos_anios);
        $this->set('url_conditions', $url_conditions);
    }

    function comparar_planes_por_orden($a, $b)
    {
        $a_order = $a['EstructuraPlan']['Etapa']['orden'];
        $b_order = $b['EstructuraPlan']['Etapa']['orden'];

        if ($a_order == $b_order) {
            return 0;
        }
        return ($a_order > $b_order) ? +1 : -1;
    }

    function view_it_sec_sup($instit_id,$oferta_id,$ciclo=null) {

        $this->Plan->asociarAnio = true;
        if (!$ciclo) {
            $this->paginate['order'] = array("Plan.nombre");
        }
        $planes = $this->paginate('Plan', array('Plan.instit_id'=> $instit_id, 'Plan.oferta_id' => $oferta_id, 'Anio.ciclo_id'=>$ciclo));
        //$planes = $this->Plan->Instit->getPlanes($instit_id, $oferta_id, $ciclo);
        // agrego el index "matricula" directamente que dependa de "Plan"

        if ($oferta_id == SEC_TEC_ID) {
            usort($planes, array( $this, 'comparar_planes_por_orden' ));
        }
        
        foreach($planes as &$plan){
            if ( !empty($plan['Plan']) ) {
                $plan['Plan']['matricula'] = 0;
        
                foreach($plan['Anio'] as $anio){
                    $plan['Plan']['matricula'] += $anio['Anio']['matricula'];
                }
            }
        }

        $this->set('planes', $planes);
        $this->set('instit_id', $instit_id);
        $this->set('oferta_id', $oferta_id);
        $this->set('ciclo', $ciclo);

        switch ($oferta_id) {
            case ITINERARIO_ID:
            case SEC_ID:
                $this->render('view_it_sec');
                break;
            case SUP_ID:
            case SUP_TEC_ID:
                $this->render('view_sup');
                break;
            case SEC_TEC_ID:
                $this->render('view_sectec');
                break;
        }
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
