<?php
class TitulosController extends AppController {

    var $name = 'Titulos';
    var $helpers = array('Html', 'Form');
    var $components = array('RequestHandler');

    var $sesNames = array(
            'nombre' => 'Titulo.tituloName',
            'oferta'   => 'Titulo.oferta_id',
            'sector' => 'Titulo.sector_id',
            'subsector' => 'Titulo.subsector_id',
            'jurisdiccion' => 'Titulo.jurisdiccion_id',
            'departamento' => 'Titulo.departamento_id',
            'localidad' => 'Titulo.localidad_id',
            'tituloJurDepLoc' => 'Titulo.tituloJurDepLoc',
            'page' => 'Titulo.page',
        );

    function search() {
        $ofertas = $this->Titulo->Oferta->find('list');
        $sectores = $this->Titulo->Sector->find('list',array('order'=>'Sector.name'));

        if (!empty($this->passedArgs['limpiar'])) {
            // limpia session
            foreach ($this->sesNames as $sesName) {
                $this->Session->write($sesName, '');
            }
        }

        $bySession = false;
        // si existe búsqueda en Session, realiza búsqueda
        if ($this->Session->read($this->sesNames['nombre'])) {
            $this->data['Titulo']['tituloName'] = $this->passedArgs['tituloName'] = $this->Session->read($this->sesNames['nombre']);
            $bySession = true;
        }
        if ($this->Session->read($this->sesNames['oferta'])) {
            $this->data['Titulo']['oferta_id'] = $this->passedArgs['ofertaId'] = $this->Session->read($this->sesNames['oferta']);
            $bySession = true;
        }
        if ($this->Session->read($this->sesNames['sector'])) {
            $this->data['Titulo']['sector_id'] = $this->passedArgs['sectorId'] = $this->Session->read($this->sesNames['sector']);
            $bySession = true;

            $subsectores = $this->Titulo->Subsector->con_sector('list', $this->Session->read($this->sesNames['sector']));
        }
        if ($this->Session->read($this->sesNames['subsector'])) {
            $this->data['Titulo']['subsector_id'] = $this->passedArgs['subsectorId'] = $this->Session->read($this->sesNames['subsector']);
            $bySession = true;
        }
        if ($this->Session->read($this->sesNames['jurisdiccion'])) {
            $this->data['Titulo']['jurisdiccion_id'] = $this->passedArgs['jurisdiccionId'] = $this->Session->read($this->sesNames['jurisdiccion']);
            $bySession = true;
        }
        if ($this->Session->read($this->sesNames['departamento'])) {
            $this->data['Titulo']['departamento_id'] = $this->passedArgs['departamentoId'] = $this->Session->read($this->sesNames['departamento']);
            $bySession = true;
        }
        if ($this->Session->read($this->sesNames['localidad'])) {
            $this->data['Titulo']['localidad_id'] = $this->passedArgs['localidadId'] = $this->Session->read($this->sesNames['localidad']);
            $bySession = true;
        }
        if ($this->Session->read($this->sesNames['tituloJurDepLoc'])) {
            $this->data['Titulo']['jur_dep_loc'] = $this->passedArgs['tituloJurDepLoc'] = $this->Session->read($this->sesNames['tituloJurDepLoc']);
            $bySession = true;
        }
        if ($this->Session->read($this->sesNames['page'])) {
            $bySession = true;
        }

        if (empty($subsectores)) {
            $subsectores = $this->Titulo->Subsector->con_sector('list');
        }

        $this->Titulo->Plan->Instit->Jurisdiccion->recursive = -1;
        $this->Titulo->Plan->Instit->Jurisdiccion->order = 'Jurisdiccion.name';
        $jurisdicciones = $this->Titulo->Plan->Instit->Jurisdiccion->find('list');

        // que me liste todos los detarpamentos
        $this->Titulo->Plan->Instit->Departamento->recursive = -1;
        $departamentos = $this->Titulo->Plan->Instit->Departamento->con_jurisdiccion('list');
        //$departamentos = array();


        // con CERO me trae TODAS las jurisdicciones
        $this->Titulo->Plan->Instit->Localidad->recursive = -1;
        $localidades = $this->Titulo->Plan->Instit->Localidad->con_depto_y_jurisdiccion('list');

        $this->Titulo->recursive = 0;
        $this->set('titulos', $this->paginate());
        $this->set(compact('ofertas', 'sectores', 'subsectores', 'jurisdicciones',
                    'localidades', 'departamentos', 'bySession'));
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
        $this->layout = false;
        if (!$id) {
            $this->flash(__('Invalid Titulo', true), array('action'=>'search'));
        }

        $this->Titulo->recursive = -1;
        $conditions = '';
        $conditions['conditions'] = array('Titulo.id' => $id);
        $conditions['contain'] = array(
                            'Oferta',
                            'SectoresTitulo' => array('Sector', 'Subsector')
        );
        $titulo = $this->Titulo->find('first', $conditions);

        // Planes del Titulo
        $this->Titulo->Plan->recursive = -1;
        $this->paginate = array(
                'limit'    => 20,
                'page'    => 1,
                'conditions' => array('Plan.titulo_id' => $id),
                'contain' => array('Instit' => array('Tipoinstit', 'Jurisdiccion(name)')),
                'order'    => array('Plan.nombre' => 'asc')
        );
        $planes = $this->paginate('Plan');

        $this->set(compact('titulo','planes','planesResumen'));
    }


    function ajax_view_planes_asociados($id) {
        // Planes del Titulo
        $this->Titulo->Plan->recursive = -1;
        $this->paginate = array(
                'limit'    => 6,
                'page'    => 1,
                'conditions' => array('Plan.titulo_id' => $id),
                'contain' => array('Instit' => array(
                                                'Tipoinstit',
                                                'Localidad(name)',
                                                'Departamento(name)',
                                                'Jurisdiccion(name)')),
                'order'    => array('Plan.nombre' => 'asc'),
        );

        if ($this->Session->read($this->sesNames['jurisdiccion'])) {
            $this->paginate['conditions']['Instit.jurisdiccion_id'] = $this->Session->read($this->sesNames['jurisdiccion']);
        }
        if ($this->Session->read($this->sesNames['departamento'])) {
            $this->paginate['conditions']['Instit.departamento_id'] = $this->Session->read($this->sesNames['departamento']);
        }
        if ($this->Session->read($this->sesNames['localidad'])) {
            $this->paginate['conditions']['Instit.localidad_id'] = $this->Session->read($this->sesNames['localidad']);
        }

        $planes = $this->paginate('Plan');
        $this->set('planes', $planes);
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

        $conditions["lower(Titulo.name) SIMILAR TO ?"] = convertir_para_busqueda_avanzada($q);
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
    function ajax_search_results() {
        Configure::write('debug',0);
        //debug($this->RequestHandler);
        //para mostrar en vista los patrones de busqueda seleccionados
        $array_condiciones = array();
        // para el paginator que pueda armar la url
        $url_conditions = array();

        if (!empty($this->data)) {
            // si se realizó una búsqueda se limpia la session
            foreach ($this->sesNames as $sesName) {
                if ($sesName != $this->sesNames['page']) {
                    $this->Session->write($sesName, '');
                }
            }

            if (!empty($this->data['Titulo']['busquedanueva']) && !$this->data['Titulo']['bysession']) {
                $this->Session->write($this->sesNames['page'], '');
            }

            if(!empty($this->data['Titulo']['tituloName'])) {
                $this->passedArgs['tituloName'] = $this->data['Titulo']['tituloName'];
                $this->Session->write($this->sesNames['nombre'], $this->data['Titulo']['tituloName']);
            }
            if(!empty($this->data['Titulo']['oferta_id'])) {
                $this->passedArgs['ofertaId'] = $this->data['Titulo']['oferta_id'];
                $this->Session->write($this->sesNames['oferta'], $this->data['Titulo']['oferta_id']);
            }
            if(!empty($this->data['Titulo']['sector_id'])) {
                $this->passedArgs['sectorId'] = $this->data['Titulo']['sector_id'];
                $this->Session->write($this->sesNames['sector'], $this->data['Titulo']['sector_id']);
            }
            if(!empty($this->data['Titulo']['subsector_id'])) {
                $this->passedArgs['subsectorId'] = $this->data['Titulo']['subsector_id'];
                $this->Session->write($this->sesNames['subsector'], $this->data['Titulo']['subsector_id']);
            }
            if(!empty($this->data['Titulo']['jurisdiccion_id'])) {
                $this->passedArgs['jurisdiccionId'] = $this->data['Titulo']['jurisdiccion_id'];
                $this->Session->write($this->sesNames['jurisdiccion'], $this->data['Titulo']['jurisdiccion_id']);
            }
            if(!empty($this->data['Titulo']['departamento_id'])) {
                $this->passedArgs['departamentoId'] = $this->data['Titulo']['departamento_id'];
                $this->Session->write($this->sesNames['departamento'], $this->data['Titulo']['departamento_id']);
                $this->Session->write($this->sesNames['tituloJurDepLoc'], $this->data['Titulo']['jur_dep_loc']);
            }
            if(!empty($this->data['Titulo']['localidad_id'])) {
                $this->passedArgs['localidadId'] = $this->data['Titulo']['localidad_id'];
                $this->Session->write($this->sesNames['localidad'], $this->data['Titulo']['localidad_id']);
                $this->Session->write($this->sesNames['tituloJurDepLoc'], $this->data['Titulo']['jur_dep_loc']);
            }
        }

        if(!empty($this->passedArgs['tituloName'])) {
            $q = utf8_decode(strtolower($this->passedArgs['tituloName']));
            $this->paginate['conditions']['lower(Titulo.name) SIMILAR TO ?'] = convertir_texto_plano($q);
        }
        if(!empty($this->passedArgs['ofertaId'])) {
            $q = ($this->passedArgs['ofertaId']);
            $this->paginate['conditions']['Titulo.oferta_id'] = $q;
        }
        if(!empty($this->passedArgs['sectorId']) || !empty($this->passedArgs['subsectorId']) ) {

            $conditions_sector = array();
            if(!empty($this->passedArgs['sectorId'])){
                $q = $this->passedArgs['sectorId'];
                $this->paginate['conditions']['SectoresTitulo.sector_id'] = $q;
            }
            if(!empty($this->passedArgs['subsectorId'])){
                $q = $this->passedArgs['subsectorId'];
                $this->paginate['conditions']['SectoresTitulo.subsector_id'] = $q;
            }

            /*$this->paginate['joins'] = array(
                array('table'=>'sectores_titulos',
                      'type' => 'LEFT',
                      'alias' => 'SectoresTitulo',
                      'conditions'=> array('SectoresTitulo.titulo_id = Titulo.id')
                    )
                );*/
        }
        if(!empty($this->passedArgs['jurisdiccionId'])) {
            $q = ($this->passedArgs['jurisdiccionId']);
            $this->paginate['conditions']['Instit.jurisdiccion_id'] = $q;
        }
        if(!empty($this->passedArgs['departamentoId'])) {
            $q = ($this->passedArgs['departamentoId']);
            $this->paginate['conditions']['Instit.departamento_id'] = $q;
        }
        if(!empty($this->passedArgs['localidadId'])) {
            $q = ($this->passedArgs['localidadId']);
            $this->paginate['conditions']['Instit.localidad_id'] = $q;
        }

        if (!empty($this->passedArgs['page'])) {
            //$this->paginate['page'] = $this->passedArgs['page'];
            $this->Session->write($this->sesNames['page'], $this->passedArgs['page']);
        }
        elseif ($this->Session->read($this->sesNames['page'])) {
            $this->paginate['page'] = $this->Session->read($this->sesNames['page']);
        }
        
        //datos de paginacion
        $this->paginate['fields'] = array('Titulo.id', 'Titulo.name','Titulo.marco_ref', 'Titulo.oferta_id', 'Oferta.abrev');
        $this->paginate['group'] = $this->paginate['fields'];
        $this->paginate['order'] = array('Titulo.name ASC, Titulo.oferta_id ASC');
        $this->paginate['recursive'] = 3;   // find completo
        $titulos = $this->paginate();

        $this->set('titulos', $titulos);
        $this->set('url_conditions', $url_conditions);
        //devuelve un array para mostrar los criterios de busqueda
        $this->set('conditions', $array_condiciones);
             
    }
    
    
    function guia_del_estudiante(){
        $this->set('sectores', $this->Titulo->Sector->find('list'));
        $this->set('ofertas', $this->Titulo->Oferta->find('list'));
    }
}
?>