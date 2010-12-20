<?php
class TitulosController extends AppController {

    var $name = 'Titulos';
    var $helpers = array('Html', 'Form');
    var $components = array('RequestHandler');

    function index() {
        $ofertas = $this->Titulo->Oferta->find('list');
        $sectores = $this->Titulo->Sector->find('list',array('order'=>'Sector.name'));
        $subsectores = $this->Titulo->Subsector->con_sector('list');

        $this->Titulo->recursive = 0;
        $this->set('titulos', $this->paginate());
        $this->set(compact('ofertas', 'sectores', 'subsectores'));
    }


    function list_por_oferta_id($oferta_id = 0) {
        $conditions = array();
        if (!empty($oferta_id)) {
            $conditions = array('Titulo.oferta_id'=>$oferta_id);
        }

        if (!empty($this->passedArgs['Plan.oferta_id'])) {
            $conditions = array('Titulo.oferta_id'=>$this->passedArgs['Plan.oferta_id']);
        }

        if (!empty($this->data['Plan']['oferta_id'])) {
            $conditions = array('Titulo.oferta_id'=>$this->data['Plan']['oferta_id']);
        }

        if ($this->RequestHandler->isAjax()) {
            $this->layout = false;
        }
        $this->set('titulos',$this->Titulo->find('list', array('conditions'=>$conditions)));
    }

    function view($id = null) {
        if (!$id) {
            $this->flash(__('Invalid Titulo', true), array('action'=>'index'));
        }
        $this->set('titulo', $this->Titulo->read(null, $id));
    }


    function add_and_give_me_select_options() {
        if ($this->RequestHandler->isAjax()) {
            $this->layout = false;
        }
        if (!empty($this->data)) {
            $this->Titulo->create();
            $this->data['Titulo']['name'] = utf8_decode($this->data['Titulo']['name']);
            if ($this->Titulo->save($this->data)) {
                $this->Session->setFlash(__('Titulo guardado.', true));
                $this->data['Titulo']['id'] = $this->Titulo->id;
            } else {
                $this->Session->setFlash(__('El Titulo no se pudo guardar. Por favor, intente de nuevo.', true));
            }
        }
        $this->set('titulos',$this->Titulo->find('list'));

    }

    function add() {
        $similares = array();
        $force_save = false;

        if (!empty($this->data)) {
            $this->Titulo->create();

            $sectores = $this->data['Titulo']['SectoresTitulos']['sector_id'];
            $subsectores = $this->data['Titulo']['SectoresTitulos']['subsector_id'];
            $prioridades = $this->data['Titulo']['SectoresTitulos']['prioridad'];

            $this->data['Sector'] = array();

            foreach($sectores as $key=>$sector) {
                $this->data['Sector'][$key]['sector_id'] = $sector ;
                $this->data['Sector'][$key]['subsector_id'] = $subsectores[$key] ;
                $this->data['Sector'][$key]['prioridad'] = $prioridades[$key] ;
            }

            if ($this->Titulo->save($this->data)) {
                $this->Session->setFlash(__('Titulo guardado.', true));
                $this->redirect(array('action'=>'index'));
            } else {
                $this->Session->setFlash(__('El Titulo no se pudo guardar. Por favor, intente de nuevo.', true));
            }
        }
        $ofertas = $this->Titulo->Oferta->find('list');
        $sectores = $this->Titulo->Sector->find('list');
        $this->set('force_save', $force_save);
        $this->set(compact('ofertas','sectores'));
    }

    function edit($id = null) {
        $similares = array();
        $force_save = false;
        
        if (!$id && empty($this->data)) {
            $this->flash(__('Invalid Titulo', true), array('action'=>'index'));
        }
        if (!empty($this->data)) {
            $this->Titulo->SectoresTitulo->deleteAll(array('SectoresTitulo.sector_id' => $id));

            $sectores = $this->data['Titulo']['SectoresTitulos']['sector_id'];
            $subsectores = $this->data['Titulo']['SectoresTitulos']['subsector_id'];
            $prioridades = $this->data['Titulo']['SectoresTitulos']['prioridad'];

            $this->data['Sector'] = array();

            foreach($sectores as $key=>$sector) {
                $this->data['Sector'][$key]['sector_id'] = $sector ;
                $this->data['Sector'][$key]['subsector_id'] = $subsectores[$key] ;
                $this->data['Sector'][$key]['prioridad'] = $prioridades[$key] ;
            }

            if ($this->Titulo->save($this->data)) {
                $this->Session->setFlash(__('Titulo guardado.', true));
                $this->redirect(array('action'=>'index'));
            }
        }
        if (empty($this->data)) {
            $this->data = $this->Titulo->read(null, $id);
        }



        $ofertas = $this->Titulo->Oferta->find('list');
        $sectores = $this->Titulo->Sector->find('all', array(
                'contain'=>array('Subsector')));

        $this->set(compact('ofertas','sectores'));
    }

    function delete($id = null) {
        if (!$id) {
            $this->flash(__('Invalid Titulo', true), array('action'=>'index'));
        }
        if ($this->Titulo->del($id)) {
            $this->flash(__('Titulo deleted', true), array('action'=>'index'));
        }
    }


    function ajax_similars($name=null, $id=null) {
        $similars = array();
        if (strlen($name)) {
            $this->Titulo->recursive = 0;
            $similars = $this->Titulo->getSimilars($name, $id);
        }

        $this->set('name', $name);
        $this->set('similars', $similars);
    }


    function ajax_search($q = null) {
        $this->autoRender = false;
        $result = array();
        $jur= 0;

        if (!empty($this->params['url']['oferta_id'])) {
            $oferta_id = utf8_decode(strtolower($this->params['url']['oferta_id']));
        }
        if (!empty($this->params['url']['sector_id'])) {
            $sector_id = utf8_decode(strtolower($this->params['url']['sector_id']));
        }
        if (!empty($this->params['url']['subsector_id'])) {
            $subsector_id = utf8_decode(strtolower($this->params['url']['subsector_id']));
        }

        if(empty($q)) {
            if (!empty($this->params['url']['q'])) {
                $q = utf8_decode(strtolower($this->params['url']['q']));
            } else {
                return utf8_encode("parámetro vacio");
            }
        }

        if ( $this->RequestHandler->isAjax() ) {
            Configure::write ( 'debug', 0 );
        }

        $response = '';

        $conditions = array();
        $subconditions = array();

        $conditions["to_ascii(lower(Titulo.name)) SIMILAR TO ?"] = "%". $q ."%";
        $subconditions = array('Titulo.id = SectoresTitulos.titulo_id');

        if(@$oferta_id > 0) {
            $conditions["Titulo.oferta_id"] = $oferta_id;
        }

        if(@$sector_id > 0) {
            $subconditions["SectoresTitulos.sector_id ="] = $sector_id;
        }

        if(@$subsector_id > 0) {
            $subconditions["SectoresTitulos.subsector_id ="] = $subsector_id;
        }

        $this->Titulo->recursive = -1;
        $titulos = $this->Titulo->find("all", array(
                'fields' =>array('DISTINCT Titulo.id','Titulo.name'),
                'conditions'=> $conditions,
                'order' => array('Titulo.name'),
                'joins'=>array(
                        array('table' => 'sectores_titulos',
                                'alias' => 'SectoresTitulos',
                                'type' => 'INNER',
                                'conditions' => $subconditions
                        )
                )
                )
        );


        foreach ($titulos as $item) {
            array_push($result, array(
                    "id" => $item['Titulo']['id'],
                    "type" => "Titulo",
                    "name" => utf8_encode($item['Titulo']['name'])
            ));
        }

        if(sizeof($result) == 0) {
            array_push($result, array(
                    "id" => '',
                    "type" => "Vacio",
                    "name" => 'No se encontraron resultados'
            ));
        }

        echo json_encode($result);
    }


    /**
     * Esta accion es el procesamiento del formulario de busqueda
     * maneja las condiciones de la busqueda y el paginador
     *
     */
    function ajax_index_search() {

        //para mostrar en vista los patrones de busqueda seleccionados
        $array_condiciones = array();

        // para el paginator que pueda armar la url
        $url_conditions = array();

        /*******************************************************************
         *    INICIALIZACION DE FILTROS
         *
         *   Los filtros pueden provenir del formulario o de las variables de paginacion.
         *
         * 	Para el primer caso se esta leyendo informacion de $this->data
         * 	en el segundo caso de this->passedArgs
         *
         *
         */

        /*
         *          BUSQUEDA LIBRE
        */
        if(!empty($this->data['Titulo']['tituloName'])) {
            $this->passedArgs = array('tituloName' => $this->data['Titulo']['tituloName']);
        }
        if(!empty($this->passedArgs['tituloName'])) {
            $q = utf8_decode(strtolower($this->passedArgs['tituloName']));
            $this->paginate['conditions']['to_ascii(lower(Titulo.name)) SIMILAR TO ?'] = convertir_texto_plano($q);
        }

        // caso de parametros para filtrar
        if(!empty($this->data['Titulo']['oferta_id'])) {
            $this->passedArgs['ofertaId'] = $this->data['Titulo']['oferta_id'];
        }
        if(!empty($this->passedArgs['ofertaId'])) {
            $q = utf8_decode($this->passedArgs['ofertaId']);
            $this->paginate['conditions']['Titulo.oferta_id'] = $q;
        }

        if(!empty($this->data['Titulo']['sector_id'])) {
            $this->passedArgs['sectorId'] = $this->data['Titulo']['sector_id'];
        }

        if(!empty($this->data['Titulo']['subsector_id'])) {
            $this->passedArgs['subsectorId'] = $this->data['Titulo']['subsector_id'];
        }
        
        if(!empty($this->passedArgs['sectorId']) || !empty($this->passedArgs['subsectorId']) ) {
            
            $conditions_sector = array();
            if(!empty($this->passedArgs['sectorId'])){
                $q = utf8_decode($this->passedArgs['sectorId']);
                $this->paginate['conditions']['SectoresTitulo.sector_id'] = $q;
            }
            if(!empty($this->passedArgs['subsectorId'])){
                $q = utf8_decode($this->passedArgs['subsectorId']);
                $this->paginate['conditions']['SectoresTitulo.subsector_id'] = $q;
            }

            $this->paginate['joins'] = array(
                array('table'=>'sectores_titulos',
                      'type' => 'LEFT',
                      'alias' => 'SectoresTitulo',
                      'conditions'=> array('SectoresTitulo.titulo_id = Titulo.id')
                    )
                );
        }

        /*********************************************************************/
        /*          FIN -*-CONDITIONS-*- de busqueda                         */
        /*********************************************************************/


        //$this->Titulo->recursive = 0;//para alivianar la carga del server
        //
        //datos de paginacion
        $this->paginate['fields'] = array('DISTINCT ("Titulo"."id")', 'Titulo.name','Titulo.marco_ref', 'Titulo.oferta_id');
        //$this->paginate['group'] = array('Titulo.id', 'Titulo.name','Titulo.marco_ref', 'Titulo.oferta_id');;
        $this->paginate['order'] = array('Titulo.name ASC, Titulo.oferta_id ASC');

        $titulos = $this->paginate();

        $this->set('titulos', $titulos);
        $this->set('url_conditions', $url_conditions);
        //devuelve un array para mostrar los criterios de busqueda
        $this->set('conditions', $array_condiciones);

        $this->render('ajax_index_search');
    }


    function fusionar() {
        if (empty($this->passedArgs) && empty($this->data['Titulo'])) {
            $this->Session->setFlash(__('No es posible fusionar', true));
            $this->redirect('/titulos/index');
        }

        if (!empty($this->data['Titulo'])) {
            $titulos = explode(',', $this->data['Titulo']['titulos']);
            $titulos_a_tratar = array();
            foreach($titulos as $titulo) {
                if ($titulo != $this->data['Titulo']['titulo_definitivo'])
                    $titulos_a_tratar[] = $titulo;
            }

            // asigna el titulo definitivo a los planes de los otros titulos que se fusionan
            $this->Titulo->Plan->updateAll(
                    array('Plan.titulo_id' => $this->data['Titulo']['titulo_definitivo']),
                    array('Plan.titulo_id' => $titulos_a_tratar)
            );

            // se eliminan los titulos que no se fusionaron
            $this->Titulo->deleteAll(array('Titulo.id' => $titulos_a_tratar), false);

            $this->Session->setFlash(__('Los Títulos se han fusionado correctamente', true));
            $this->redirect('/titulos/index');
        }

        if (!empty($this->passedArgs)) {
            $this->Titulo->recursive = -1;
            $titulos = $this->Titulo->find('list', array(
                    'conditions' => array('Titulo.id' => $this->passedArgs)
            ));

            $this->set('titulos', $titulos);
        }
    }



    function corrector_de_planes() {
        /********************** GUARDADO DE LOS PLANES SELECCIONADOS *******/
        if (!empty($this->data['Plan'])) {
            $planesGuardar = array();

            foreach ($this->data['Plan'] as $checkbox) {
                if ($checkbox['selected'] == 1) {
                    $planesGuardar[] = $checkbox['id'];
                }
            }

            if (empty($this->data['Plan']['titulo_id'])) {
                $this->Session->setFlash(__('Debe seleccionar un Título'));
            }
            if (empty($planesGuardar)) {
                $this->Session->setFlash(__('Debe seleccionar uno o más Planes'));
            }

            if (!empty($planesGuardar) && $this->data['Plan']['titulo_id'] > 0) {
                $this->Titulo->Plan->updateAll(
                        array('Plan.titulo_id' => $this->data['Plan']['titulo_id']),
                        array('Plan.id' => $planesGuardar)
                );
                
                $this->Session->setFlash(__('Se ha asignado el Título '.$this->data['Plan']['tituloName'].' a '.count($planesGuardar).' Planes', true));
            }

            $url_conditions['Plan.titulo_id'] = $this->data['Plan']['titulo_id'];
        }
        /***************************** FIN GUARDADO DE LOS PLANES ***************/

        /********************** BUSCADOR DE PLANES *******/

        // para el paginator que pueda armar la url
        $url_conditions = array();

        /**
         *     OFERTA
         */
        $oferta_id = '';
        if(!empty($this->data['FPlan']['oferta_id'])) {
            $oferta_id = $this->data['FPlan']['oferta_id'];
        }
        elseif(!empty($this->passedArgs['Plan.oferta_id'])) {
            $oferta_id = $this->passedArgs['Plan.oferta_id'];
            $this->data['FPlan']['oferta_id'] = $oferta_id;
        }

        if (!empty($oferta_id)) {
            $this->paginate['Plan']['conditions']['Plan.oferta_id'] = $oferta_id;
            $url_conditions['Plan.oferta_id'] = $oferta_id;
        }

        /**
         *     SECTOR
         */
        $sector_id = '';
        if(!empty($this->data['FPlan']['sector_id'])) {
            $sector_id = $this->data['FPlan']['sector_id'];
        }
        elseif(!empty($this->passedArgs['Titulo.sector_id'])) {
            $sector_id = $this->passedArgs['Titulo.sector_id'];
            $this->data['FPlan']['sector_id'] = $sector_id;
        }

        if(!empty($sector_id)) {
            $this->paginate['Plan']['conditions']['SectoresTitulo.sector_id'] = $sector_id;

            $url_conditions['Titulo.sector_id'] = $sector_id;
        }

        /**
         *     SUBSECTOR
         */
        $subsector_id = '';
        if(!empty($this->data['FPlan']['subsector_id'])) {
            $subsector_id = $this->data['FPlan']['subsector_id'];
        }
        elseif(!empty($this->passedArgs['Titulo.subsector_id'])) {
            $subsector_id = $this->passedArgs['Titulo.subsector_id'];
            $this->data['FPlan']['subsector_id'] = $subsector_id;
        }

        if(!empty($subsector_id)) {
            $this->paginate['Plan']['conditions']['SectoresTitulo.subsector_id'] = $subsector_id;
            $url_conditions['Titulo.sector_id'] = $subsector_id;
        }

        /**
         *     JURISDICCION
         */
        $jurisdiccion_id = '';
        if(!empty($this->data['FPlan']['jurisdiccion_id'])) {
            $jurisdiccion_id = $this->data['FPlan']['jurisdiccion_id'];
        }
        elseif(!empty($this->passedArgs['Instit.jurisdiccion_id'])) {
            $jurisdiccion_id = $this->passedArgs['Instit.jurisdiccion_id'];
            $this->data['FPlan']['jurisdiccion_id'] = $subsector_id;
        }

        if(!empty($jurisdiccion_id)) {
            $this->paginate['Plan']['conditions']['Instit.jurisdiccion_id'] = $jurisdiccion_id;
            $url_conditions['Instit.jurisdiccion_id'] = $jurisdiccion_id;
        }

        /**
         *  Por Plan
         */

        $plan_nombre = '';
        if(!empty($this->data['FPlan']['plan_nombre'])) {
            $plan_nombre = $this->data['FPlan']['plan_nombre'];
        }
        elseif(!empty($this->passedArgs['Plan.plan_nombre'])) {
            $plan_nombre = $this->passedArgs['Plan.plan_nombre'];
            $this->data['FPlan']['plan_nombre'] = $plan_nombre;
        }

        if(!empty($plan_nombre)) {
            $this->paginate['Plan']['conditions']["to_ascii(lower(Plan.nombre)) SIMILAR TO ?"] = array(convertir_para_busqueda_avanzada($plan_nombre));
            $array_condiciones['Nombre del Plan'] = $plan_nombre;
            $url_conditions['Plan.plan_nombre'] = $plan_nombre;
        }

        /*
         *  Por Título
         *
         */

        $titulo_id = '';
        if(!empty($this->data['FPlan']['titulo_id'])) {
            $titulo_id = $this->data['FPlan']['titulo_id'];
        }
        elseif(!empty($this->passedArgs['Plan.titulo_id'])) {
            $titulo_id = $this->passedArgs['Plan.titulo_id'];
            $this->data['FPlan']['titulo_id'] = $titulo_id;
        }

        if(!empty($titulo_id)) {
            $this->paginate['Plan']['conditions']["Plan.titulo_id"] = $titulo_id;
            $url_conditions['Plan.titulo_id'] = $titulo_id;
        }

        /***********************************************************************/
        /*                               Busqueda                              */
        /***********************************************************************/

        $this->Titulo->Plan->recursive = 1;//para alivianar la carga del server
        $this->Titulo->Plan->order = array('Plan.nombre ASC');

        //datos de paginacion
        //$this->paginate['Plan']['order'] = array('Plan.nombre ASC');
        if(!empty($this->data['FPlan']['last_page'])) {
            $this->paginate['Plan']['page'] = $this->data['FPlan']['last_page'];
        }

        // limit
        $this->paginate['Plan']['limit'] = 10;
        if(!empty($this->data['FPlan']['limit'])) {
            $limit = $this->data['FPlan']['limit'];
        }
        elseif(!empty($this->passedArgs['FPlan.limit'])) {
            $limit = $this->passedArgs['FPlan.limit'];
            $this->data['FPlan']['limit'] = $limit;
        }

        if(!empty($limit)) {
            $url_conditions['FPlan.limit'] = $limit;
            $this->paginate['Plan']['limit'] = $limit;
        }

        // Condicion necesaria
        $titulo_id=0;
        if(!empty($this->data['Plan']['titulo_id'])) {
            $url_conditions['Plan.titulo_id'] = $this->data['Plan']['titulo_id'];
            $titulo_id = $this->data['Plan']['titulo_id'];
        }

        if(!empty($this->passedArgs['Plan.titulo_id'])) {
            $url_conditions['Plan.titulo_id'] = $this->passedArgs['Plan.titulo_id'];
            $titulo_id = $this->passedArgs['Plan.titulo_id'];
        }

        if (!empty($this->data['FPlan']['con_titulo'])) {
            if ($this->data['FPlan']['con_titulo'] == 'con') {
                $this->paginate['Plan']['conditions']['Plan.titulo_id >'] = 0;
            }
            else {
                $this->paginate['Plan']['conditions']['Plan.titulo_id ='] = 0;
            }
        }
        
        $this->paginate['Plan']['conditions']['Instit.activo'] = 1;

        $this->Titulo->Plan->setAsociarCompleto(true);
        
        $this->paginate['Plan']['contain'] = array(
                'Instit',
                'Oferta',
                'Titulo' => array('SectoresTitulo' => array('Sector','Subsector.Sector')),
                'EstructuraPlan.Etapa',
                'Anio'
        );
        
        $planes = $this->paginate('Plan');

        $this->set('url_conditions', $url_conditions);

        $this->Titulo->Oferta->recursive = -1;
        $ofertas = $this->Titulo->Oferta->find('list');

        $this->Titulo->SectoresTitulo->Sector->recursive = -1;
        $this->Titulo->SectoresTitulo->Sector->order ='Sector.name';
        $sectores = $this->Titulo->SectoresTitulo->Sector->find('list');

        $subsecConditions = array();
        if (!empty($this->data['FPlan']['sector_id'])) {
            $subsecConditions = array('Subsector.sector_id'=>$this->data['FPlan']['sector_id']);
        }
        $this->Titulo->SectoresTitulo->Subsector->recursive = -1;
        $this->Titulo->SectoresTitulo->Subsector->order ='Subsector.name';
        $subsectores = $this->Titulo->SectoresTitulo->Subsector->find('list', array('conditions'=>$subsecConditions));

        $this->Titulo->Plan->Instit->Jurisdiccion->recursive = -1;
        $this->Titulo->Plan->Instit->Jurisdiccion->order = 'Jurisdiccion.name';
        $jurisdicciones = $this->Titulo->Plan->Instit->Jurisdiccion->find('list');

        $condicion = array();
        if(!empty($this->data['FPlan']['oferta_id']))
            $condicion['conditions']['oferta_id'] = $this->data['FPlan']['oferta_id'];
        $this->Titulo->recursive = -1;
        $titulos = $this->Titulo->find('list', $condicion);

        $this->set('titulo_id', $titulo_id);
        $this->set(compact('planes','titulos','ofertas',
                'sectores','subsectores','jurisdicciones'));
    }
}
?>