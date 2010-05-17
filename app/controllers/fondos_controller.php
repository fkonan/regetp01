<?php
class FondosController extends AppController {

	var $name = 'Fondos';
	var $helpers = array('Html', 'Form');

        function beforeFilter() {
            parent::beforeFilter();
            $this->rutaUrl_for_layout[] =array('name'=> 'Buscador','link'=>'/Instits/search_form' );
        }
	function index($id=null) {

            if($id){
                $this->paginate = array('conditions'=>array('instit_id'=>$id));
            }

            $this->Fondo->recursive = 1;

            
            $this->set('instit', $this->Fondo->Instit->read(null, $id));
            $this->set('fondos', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Fondo', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('fondo', $this->Fondo->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Fondo->create();
			if ($this->Fondo->save($this->data)) {
				$this->Session->setFlash(__('The Fondo has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Fondo could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
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