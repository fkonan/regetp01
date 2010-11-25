<?php
class TitulosController extends AppController {

	var $name = 'Titulos';
	var $helpers = array('Html', 'Form');
        var $components = array('RequestHandler');

	function index() {
		$this->Titulo->recursive = 0;
		$this->set('titulos', $this->paginate());
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
            if ($this->RequestHandler->isAjax()){
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
		if (!empty($this->data)) {
                        $this->Titulo->create();

                        $sectores = $this->data['Titulo']['SectoresTitulos']['sector_id'];
                        $subsectores = $this->data['Titulo']['SectoresTitulos']['subsector_id'];

                        $this->data['Sector'] = array();

                        foreach($sectores as $key=>$sector){
                            $this->data['Sector'][$key]['sector_id'] = $sector ;
                            $this->data['Sector'][$key]['subsector_id'] = $subsectores[$key] ;
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
		$this->set(compact('ofertas','sectores'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->flash(__('Invalid Titulo', true), array('action'=>'index'));
		}
		if (!empty($this->data)) {
                        $this->Titulo->SectoresTitulo->deleteAll(array('SectoresTitulo.sector_id' => $id));

                        $sectores = $this->data['Titulo']['SectoresTitulos']['sector_id'];
                        $subsectores = $this->data['Titulo']['SectoresTitulos']['subsector_id'];

                        $this->data['Sector'] = array();

                        foreach($sectores as $key=>$sector){
                            $this->data['Sector'][$key]['sector_id'] = $sector ;
                            $this->data['Sector'][$key]['subsector_id'] = $subsectores[$key] ;
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


        function ajax_search($q = null){
            $this->autoRender = false;
            $result = array();
            $jur= 0;

            if (!empty($this->params['url']['oferta_id'])) {
                $oferta_id = utf8_decode(strtolower($this->params['url']['oferta_id']));
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

            if(@$oferta_id > 0){
                $conditions = array(
                                "to_ascii(lower(Titulo.name)) SIMILAR TO ?" => "%". $q ."%",
                                "Titulo.oferta_id" => $oferta_id
                              );
            }else{
                $conditions = array(
                                "to_ascii(lower(Titulo.name)) SIMILAR TO ?" => "%". $q ."%"
                              );
            }

            $this->Titulo->recursive = -1;
            $titulos = $this->Titulo->find("all", array(
                            'conditions'=> $conditions,
                            'order' => array('Titulo.name')
                            )
                    );

            foreach ($titulos as $item) {
                array_push($result, array(
                        "id" => $item['Titulo']['id'],
                        "type" => "Titulo",
                        "name" => utf8_encode($item['Titulo']['name'])
                ));
            }

            if(sizeof($result) == 0){
                array_push($result, array(
                            "id" => '',
                            "type" => "Vacio",
                            "name" => 'No se encontraron resultados'
                ));
            }

            echo json_encode($result);
        }




        function corrector_de_planes() {
            /********************** GUARDADO DE LOS PLANES SELECCIONADOS *******/
            if (!empty($this->data['Plan'])) {
                //$this->Plan->save();
                $planesGuardar = array();

                //@var $planes_sin_titulo   me indica si fueron seleccionado titulos para
                //guardar alos cuales no le introdujeron QUE titulo era
                $planes_sin_titulo = false;

                foreach ($this->data['Plan'] as $p=>$a) {
                    // para evitar que se guarde cuando solo fue
                    // seleccionado el select que era para indicar el titulo generico, pero no tenia fines de guardado
                    if ( "$p" != 'titulo_id') {
                        if ($a['selected']) {
                            if (!empty($a['titulo_id'])) {
                                unset($a['selected']);
                                $planesGuardar[] = $a;
                            } else {
                                $planes_sin_titulo = true;
                            }
                        }
                    }
                }

                if(count($planesGuardar)>0) {
                    if ($this->Plan->saveAll(
                    $planesGuardar,
                    array('fieldList'=>array('titulo_id'), 'validate'=>false)
                    )) {
                        $text = '';
                        if ($planes_sin_titulo) {
                            $text = 'Algunos planes seleccionados no tenían indicado el título';
                        }
                        $this->Session->setFlash(__( $text.'<br>Se han guardado '.count($planesGuardar).' planes', true));
                    } else {
                        $this->Session->setFlash('Fallo el guardado');
                    }
                }
                else {
                    $text = '';
                    if ($planes_sin_titulo) {
                        $text = 'Los planes seleccionados no tenían indicado el título';
                    }
                    $this->Session->setFlash(__($text, true));
                }
                $url_conditions['Plan.titulo_id'] = $this->data['Plan']['titulo_id'];
            }
            /***************************** FIN GUARDADO DE LOS PLANES ***************/




            /********************** BUSCADOR DE PLANES *******/

            // para el paginator que pueda armar la url
            $url_conditions = array();

            /**
             *    PLANES POR OFERTA
             */
            /**
             *     OFERTA
             */
            if(!empty($this->data['FPlan']['oferta_id'])) {
                $this->paginate['Plan']['conditions']['Plan.oferta_id'] = $this->data['FPlan']['oferta_id'];

                $this->Plan->Oferta->recursive = -1;
                $oferta = $this->Plan->Oferta->findById($this->data['FPlan']['oferta_id']);
                $url_conditions['Plan.oferta_id'] = $this->data['FPlan']['oferta_id'];
            }
            if(!empty($this->passedArgs['Plan.oferta_id'])) {
                $this->paginate['Plan']['conditions']['Plan.oferta_id'] = $this->passedArgs['Plan.oferta_id'];

                $this->Plan->Oferta->recursive = -1;
                $oferta = $this->Plan->Oferta->findById($this->passedArgs['Plan.oferta_id']);
                $url_conditions['Plan.oferta_id'] = $this->passedArgs['Plan.oferta_id'];

                $this->data['FPlan']['oferta_id'] = $this->passedArgs['Plan.oferta_id'];
            }

            /**
             *     SECTOR
             */
            if(!empty($this->data['FPlan']['sector_id'])) {
                $this->paginate['Plan']['conditions']['Titulo.sector_id'] = $this->data['FPlan']['sector_id'];
                $this->Plan->Titulo->Sector->recursive = -1;
                $sector = $this->Plan->Titulo->Sector->findById( $this->data['FPlan']['sector_id']);
                $url_conditions['Titulo.sector_id'] = $this->data['FPlan']['sector_id'];
            }
            if(!empty($this->passedArgs['Titulo.sector_id'])) {
                $this->paginate['Plan']['conditions']['Titulo.sector_id'] = $this->passedArgs['Titulo.sector_id'];
                $this->Plan->Titulo->Sector->recursive = -1;
                $sector = $this->Plan->Titulo->Sector->findById($this->passedArgs['Titulo.sector_id']);
                $url_conditions['Titulo.sector_id'] = $this->passedArgs['Titulo.sector_id'];

                $this->data['FPlan']['sector_id'] = $this->passedArgs['Titulo.sector_id'];
            }


            /**
             *     SUBSECTOR
             */
            if(!empty($this->data['FPlan']['subsector_id'])) {
                $this->paginate['Plan']['conditions']['Titulo.subsector_id'] = $this->data['FPlan']['subsector_id'];
                $this->Plan->Titulo->Subsector->recursive = -1;
                $subsector = $this->Plan->Titulo->Subsector->findById( $this->data['FPlan']['subsector_id']);
                $url_conditions['Titulo.subsector_id'] = $this->data['FPlan']['subsector_id'];
            }
            if(!empty($this->passedArgs['Titulo.subsector_id'])) {
                $this->paginate['Plan']['conditions']['Titulo.subsector_id'] = $this->passedArgs['Titulo.subsector_id'];
                $this->Plan->Titulo->Subsector->recursive = -1;
                $sector = $this->Plan->Titulo->Subsector->findById($this->passedArgs['Titulo.subsector_id']);
                $url_conditions['Titulo.subsector_id'] = $this->passedArgs['Titulo.subsector_id'];

                $this->data['FPlan']['subsector_id'] = $this->passedArgs['Titulo.subsector_id'];
            }

            /**
             *     JURISDICCION
             */
            if(!empty($this->data['FPlan']['jurisdiccion_id'])) {
                $this->paginate['Plan']['conditions']['Instit.jurisdiccion_id'] = $this->data['FPlan']['jurisdiccion_id'];
                $this->Plan->Instit->Jurisdiccion->recursive = -1;
                $jur =  $this->Plan->Instit->Jurisdiccion->findById( $this->data['FPlan']['jurisdiccion_id']);
                $url_conditions['Instit.jurisdiccion_id'] = $this->data['FPlan']['jurisdiccion_id'];
            }
            if(!empty($this->passedArgs['Instit.jurisdiccion_id'])) {
                $this->paginate['Plan']['conditions']['Instit.jurisdiccion_id'] = $this->passedArgs['Instit.jurisdiccion_id'];
                $this->Plan->Instit->Jurisdiccion->recursive = -1;
                $jur =  $this->Plan->Instit->Jurisdiccion->findById( $this->data['FPlan']['jurisdiccion_id']);
                $url_conditions['Instit.jurisdiccion_id'] = $this->passedArgs['Instit.jurisdiccion_id'];

                $this->data['FPlan']['jurisdiccion_id'] = $this->passedArgs['Instit.jurisdiccion_id'];
            }

            /**
             *  Por Plan
             */

            if(!empty($this->data['FPlan']['plan_nombre'])) {
                $this->paginate['Plan']['conditions']["to_ascii(lower(Plan.nombre)) SIMILAR TO ?"] = array(convertir_para_busqueda_avanzada($this->data['FPlan']['plan_nombre']));
                $array_condiciones['Nombre del Plan'] = $this->data['FPlan']['plan_nombre'];
                $url_conditions['Plan.plan_nombre'] = $this->data['FPlan']['plan_nombre'];
            }
            if(!empty($this->passedArgs['Plan.plan_nombre'])) {
                $this->paginate['Plan']['conditions']["to_ascii(lower(Plan.nombre)) SIMILAR TO ?"] = array(convertir_para_busqueda_avanzada(utf8_decode($this->passedArgs['Plan.plan_nombre'])));
                $array_condiciones['Nombre del Plan'] = utf8_decode($this->passedArgs['Plan.plan_nombre']);
                $url_conditions['Plan.plan_nombre'] = utf8_decode($this->passedArgs['Plan.plan_nombre']);

                $this->data['FPlan']['plan_nombre'] = $this->passedArgs['Plan.plan_nombre'];



            }

            /***********************************************************************/
            /*                               Busqueda                              */
            /***********************************************************************/

            $this->Plan->recursive = 1;//para alivianar la carga del server
            $this->Plan->order = array('Plan.nombre ASC');

            //datos de paginacion
            //$this->paginate['order'] = array('Plan.nombre ASC');

            if(!empty($this->data['FPlan']['last_page'])) {
                $this->paginate['Plan']['page'] = $this->data['FPlan']['last_page'];
            }

            $this->paginate['Plan']['limit'] = 10;
            if(!empty($this->data['FPlan']['limit'])) {
                $url_conditions['FPlan.limit'] = $this->data['FPlan']['limit'];
                $this->paginate['Plan']['limit'] = $this->data['FPlan']['limit'];
            }
            if(!empty($this->passedArgs['FPlan.limit'])) {
                $url_conditions['FPlan.limit'] = $this->passedArgs['FPlan.limit'];
                $this->data['FPlan']['limit'] = $this->passedArgs['FPlan.limit'];
                $this->paginate['Plan']['limit'] = $this->data['FPlan']['limit'];
            }

            // Condicion necesaria
            $titulo_id=0;
            if(!empty($this->data['Plan']['titulo_id'])) {
                $url_conditions['Plan.titulo_id'] = $this->data['Plan']['titulo_id'];
                $titulo_id=$this->data['Plan']['titulo_id'];
            }

            if(!empty($this->passedArgs['Plan.titulo_id'])) {
                $url_conditions['Plan.titulo_id'] = $this->passedArgs['Plan.titulo_id'];
                $titulo_id=$this->passedArgs['Plan.titulo_id'];
                ;

            }

            $this->paginate['Plan']['conditions']['Plan.titulo_id'] = 0;
            $this->paginate['Plan']['conditions']['Instit.activo'] = 1;

            $planes = $this->paginate('Plan');

            $this->set('url_conditions', $url_conditions);

            $ofertas = $this->Plan->Oferta->find('list');

            $this->Plan->Titulo->Sector->order ='Sector.name';
            $sectores = $this->Plan->Titulo->Sector->find('list');

            $subsecConditions = array();
            if (!empty($this->data['FPlan']['sector_id'])) {
                $subsecConditions = array('Subsector.sector_id'=>$this->data['FPlan']['sector_id']);
            }
            $this->Plan->Titulo->Subsector->order ='Subsector.name';
            $subsectores = $this->Plan->Titulo->Subsector->find('list', array('conditions'=>$subsecConditions));

            $this->Instit->Jurisdiccion->order = 'Jurisdiccion.name';
            $jurisdicciones = $this->Instit->Jurisdiccion->find('list');

            $condicion = array();
            if(!empty($this->data['FPlan']['oferta_id']))
                $condicion['conditions']['oferta_id'] = $this->data['FPlan']['oferta_id'];

            $titulos = $this->Plan->Titulo->find('list', $condicion);

            $this->set(compact('planes','titulos','ofertas',
                    'sectores','subsectores','jurisdicciones'));

            $this->set('titulo_id',$titulo_id);
        }

    

}
?>