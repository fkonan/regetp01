<?php
class FondosController extends AppController {

	var $name = 'Fondos';
	var $helpers = array('Html', 'Form');
        var $components = array('Filter');

        function beforeFilter() {
            parent::beforeFilter();
            $this->rutaUrl_for_layout[] =array('name'=> 'Buscador','link'=>'/Instits/search_form' );
        }
        
	function index_x_instit($id=null) {

            if ($id) {
                $instit = $this->Fondo->Instit->read(null, $id);

                // chequea que lo vea usuario de la jurisdiccion (condicion)
                if ($this->Session->read('User.group_alias') == strtolower(Configure::read('grupo_referentes'))) {
                    if ($this->Session->read('User.jurisdiccion_id') != $instit['Instit']['jurisdiccion_id']) {
                        $this->Session->setFlash(__($this->Auth->planesMejoraError, true));
                        $this->redirect(array('controller'=>'Instits', 'action'=>'view', $id));
                    }
                }
                // fin de chequeo

                $this->paginate = array('conditions'=>array('Fondo.instit_id'=>$id),'order' => array('Fondo.anio DESC','Fondo.trimestre DESC','Fondo.jurisdiccion_id DESC'));
            }
            else {
                $this->Session->setFlash(__('No especifica institución', true));
                $this->redirect(array('action'=>'index'));
                //$this->paginate = array('conditions'=>array('Fondo.instit_id !='=>0),'order' => array('Fondo.anio DESC','Fondo.trimestre DESC','Fondo.jurisdiccion_id DESC'));
            }

            $this->Fondo->recursive = 1;
            //$this->set('sumalineas',  $this->Fondo->FondosLineasDeAccion->find('sum',array('conditions'=>array('Fondo.instit_id'=>$id) ) ) );
            
            $condicion = array('Fondo.instit_id'=>$id);

            $this->set('sumalineas',  $this->Fondo->FondosLineasDeAccion->find('sum', array('conditions'=>$condicion)) );

            $this->set('instit', $instit);
            $this->set('fondos', $this->paginate());
	}

        function index_x_jurisdiccion($id=null) {
            $this->rutaUrl_for_layout[] =array('name'=> 'Listado de Jurisdicciones','link'=>'/Jurisdicciones/listado' );
            
            if ($id) {
                // chequea que lo vea usuario de la jurisdiccion (condicion)
                if ($this->Session->read('User.group_alias') == strtolower(Configure::read('grupo_referentes'))) {
                    if ($this->Session->read('User.jurisdiccion_id') != $id) {
                        $this->Session->setFlash(__($this->Auth->planesMejoraError, true));
                        $this->redirect(array('controller'=>'Jurisdicciones', 'action'=>'view', $id));
                    }
                }
                // fin de chequeo

                $this->paginate = array('conditions'=>array('Fondo.instit_id'=> 0,'Fondo.jurisdiccion_id'=>$id),'order' => array('Fondo.anio DESC','Fondo.trimestre DESC','Fondo.jurisdiccion_id DESC'));
            }
            else {
                $this->Session->setFlash(__('No especifica jurisdicción', true));
                $this->redirect(array('controller'=>'jurisdicciones','action'=>'listado'));
                //$this->paginate = array('conditions'=>array('Fondo.instit_id'=> 0), 'order' => array('Fondo.anio DESC','Fondo.trimestre DESC','Fondo.jurisdiccion_id DESC'));
            }

            $this->Fondo->recursive = 1;

            $condicion = array('Fondo.instit_id'=> 0, 'Fondo.jurisdiccion_id'=>$id);

            $this->set('sumalineas',  $this->Fondo->FondosLineasDeAccion->find('sum', array('conditions'=>$condicion)) );

            $this->set('jurisdiccion', $this->Fondo->Jurisdiccion->read(null, $id));
            $this->set('fondos', $this->paginate());
	}

        function index()
        {
            // guardo para despues tener los mismos datos seleccionados
            $dataTemp = $this->data;
            
            $this->Fondo->recursive = 0;
            $this->Fondo->order = array('Fondo.anio DESC', 'Fondo.trimestre','Fondo.jurisdiccion_id ASC');
            $condition = '';
            if ($this->data['Fondo']['tipo'] == 'i') {
                $condition = array('Fondo.instit_id >' => 0);
            }
            elseif ($this->data['Fondo']['tipo'] == 'j') {
                $condition = array('Fondo.instit_id' => 0);
            }

            $this->data['Fondo']['tipo'] = '';

            $filter = $this->Filter->process($this);
            if (is_array($condition))
                $filter = $filter + $condition;

            $todos = array('' => 'Todos');
            
            $jurisdicciones = $this->Fondo->Jurisdiccion->find('list', array('order'=>'name'));
            $jurisdicciones = $todos + $jurisdicciones;
            
            for($i=date('Y'); $i >= 2006; $i--) {
                $anios[$i] = $i;
            }
            $anios = $todos + $anios;

            $this->data = $dataTemp;
            $this->set(compact('jurisdicciones','anios'));
            $this->set('url',$this->Filter->url);
            $this->set('fondos', $this->paginate(null,$filter));
            $this->set('total', number_format($this->Fondo->FondosLineasDeAccion->find('sum',array('conditions'=>$filter)),2,",","."));
            
	}

	/*function search($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Fondo', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('fondo', $this->Fondo->read(null, $id));
	}*/

	function add($id=null) {
            $this->rutaUrl_for_layout[0] =array('name'=> 'Listado de Fondos','link'=>'/fondos' );
            $instit = '';
            
            if (!empty($this->data)) {
                //debug($this->data); die();
                $this->Fondo->create();

                if ($this->data['Fondo']['tipo'] == 'j') {
                    $this->data['Fondo']['instit_id'] = 0;
                }

                if ($id != null) {
                    // incluye id para editar
                    $this->data['Fondo']['id'] = $id;

                    //Borrar los registros borrados
                    $fondo_antes_actualizar = $this->Fondo->read(null, $id);
                    //debug($fondo_antes_actualizar);
                    //debug($this->data['Fondo']['FondosLineasDeAccion']);

                    foreach ($fondo_antes_actualizar['FondosLineasDeAccion'] as $linea_anterior) {
                        $existe = false;
                        foreach ($this->data['FondosLineasDeAccion'] as $linea_actual) {
                            if($linea_anterior["lineas_de_accion_id"] == $linea_actual["lineas_de_accion_id"]){
                                $existe = true;
                            }
                        }
                        if(!$existe){
                            $this->Fondo->FondosLineasDeAccion->Delete($linea_anterior["id"]);
                        }
                    }
                }

               
                 
                if ($this->Fondo->saveAll($this->data)) {
                    $this->Session->setFlash(__('Se ha guardado el Fondo', true));

                    if (!empty($this->data['Fondo']['redirect'])) {
                        $this->redirect($this->data['Fondo']['redirect']);
                    }
                    else {
                        $this->redirect(array('action' => 'index'));
                    }
                }
                else {
                    $this->Session->setFlash(__('El Fondo no pudo guardarse. Por favor, intente nuevamente.', true));
                }
            }
            elseif ($id != null) {
                $this->data = $this->Fondo->read(null, $id);

                if (!empty($this->data['Fondo']['instit_id'])) {
                    $this->Fondo->Instit->recursive = 0;
                    $instit = $this->Fondo->Instit->find('first', array('conditions'=>array('Instit.id'=>$this->data['Fondo']['instit_id'])));
                }

                $Title = "Editar Fondo";
            }
            elseif (!empty($this->passedArgs['instit_id']) && is_numeric($this->passedArgs['instit_id'])) {
                $this->Fondo->Instit->recursive = 0;
                $instit = $this->Fondo->Instit->find('first', array('conditions'=>array('Instit.id'=>$this->passedArgs['instit_id'])));

                $this->data['Fondo']['instit_id'] = $this->passedArgs['instit_id'];
                $this->data['Fondo']['tipo'] = 'i';
                $this->data['Fondo']['jurisdiccion_id'] = $instit['Instit']['jurisdiccion_id'];
                $this->data['Instit'] = $instit['Instit'];

                $Title = "Crear Fondo para Institución";
            }
            elseif (!empty($this->passedArgs['jurisdiccion_id']) && is_numeric($this->passedArgs['jurisdiccion_id'])) {
                $this->data['Fondo']['instit_id'] = 0;
                $this->data['Fondo']['tipo'] = 'j';
                $this->data['Fondo']['jurisdiccion_id'] = $this->passedArgs['jurisdiccion_id'];

                $Title = "Crear Fondo para Jurisdicción";
            }

            if (empty($Title)) {
                $Title = "Crear Fondo";
            }

            $jurisdicciones = $this->Fondo->Jurisdiccion->find('list', array('order'=>'name'));
            $lineasDeAccion = $this->Fondo->LineasDeAccion->find('list', array('fields' => array('LineasDeAccion.id','LineasDeAccion.description'), 'order'=> array('orden','name')));

            for($i=date('Y'); $i >= 2006; $i--) {
                $anios[$i] = $i;
            }

            $mes = date('n');
            if ($mes < 4)
                $trimestre = 1;
            elseif ($mes < 7)
                $trimestre = 2;
            elseif ($mes < 10)
                $trimestre = 3;
            else
                $trimestre = 4;

            $this->set('jurisdicciones', $jurisdicciones);
            $this->set('anios', $anios);
            $this->set('trimestre', $trimestre);
            $this->set('lineasDeAccion', $lineasDeAccion);
            $this->set('instit', $instit);
            $this->set('Title', $Title);
	}

	function edit($id = null) {
                //$this->redirect(array('action' => 'index'));
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Fondo', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Fondo->save($this->data)) {
				$this->Session->setFlash(__('Se ha guardado el Fondo', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Fondo could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Fondo->read(null, $id);
		}
	}

	function delete($id = null) {
                $this->redirect(array('action' => 'index'));
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Fondo', true));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->Fondo->del($id)) {
			$this->Session->setFlash(__('Fondo deleted', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('The Fondo could not be deleted. Please, try again.', true));
		$this->redirect(array('action' => 'index'));
	}

}
?>