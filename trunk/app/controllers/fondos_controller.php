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
            $this->Fondo->recursive = 0;
            $this->Fondo->order = array('Fondo.anio DESC', 'Fondo.trimestre','Fondo.jurisdiccion_id ASC');
            $filter = $this->Filter->process($this);

            $todos = array('' => 'Todos');
            
            $jurisdicciones = $this->Fondo->Jurisdiccion->find('list', array('order'=>'name'));
            $jurisdicciones = $todos + $jurisdicciones;

            $anios = $this->Fondo->Instit->Plan->Anio->Ciclo->find('list');//, array('fields'=>array('anio','anio')));
            $anios = $todos + $anios;

            
            $this->set(compact('jurisdicciones','anios'));
            $this->set('url',$this->Filter->url);
            $this->set('fondos', $this->paginate(null,$filter));
            
	}

	/*function search($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Fondo', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('fondo', $this->Fondo->read(null, $id));
	}*/

	function add() {
                //$this->redirect(array('action' => 'index'));
		if (!empty($this->data)) {
			$this->Fondo->create();
			if ($this->Fondo->save($this->data)) {
				$this->Session->setFlash(__('The Fondo has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Fondo could not be saved. Please, try again.', true));
			}
		}

                $jurisdicciones = $this->Fondo->Jurisdiccion->find('list', array('order'=>'name'));
                
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
	}

	function edit($id = null) {
                //$this->redirect(array('action' => 'index'));
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Fondo', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Fondo->save($this->data)) {
				$this->Session->setFlash(__('The Fondo has been saved', true));
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