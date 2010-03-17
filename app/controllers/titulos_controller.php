<?php
class TitulosController extends AppController {

	var $name = 'Titulos';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Titulo->recursive = 0;
		$this->set('titulos', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->flash(__('Invalid Titulo', true), array('action'=>'index'));
		}
		$this->set('titulo', $this->Titulo->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Titulo->create();
			if ($this->Titulo->save($this->data)) {
				$this->Session->setFlash(__('Titulo guardado.', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('El Titulo no se pudo guardar. Por favor, intente de nuevo.', true));
			}
		}
		$ofertas = $this->Titulo->Oferta->find('list');
		$this->set(compact('ofertas'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->flash(__('Invalid Titulo', true), array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Titulo->save($this->data)) {
				//$this->flash(__('The Titulo has been saved.', true), array('action'=>'index'));
				$this->Session->setFlash(__('Titulo guardado.', true));
				$this->redirect(array('action'=>'index'));
			} else {
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Titulo->read(null, $id);
		}
		$ofertas = $this->Titulo->Oferta->find('list');
		$this->set(compact('ofertas'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->flash(__('Invalid Titulo', true), array('action'=>'index'));
		}
		if ($this->Titulo->del($id)) {
			$this->flash(__('Titulo deleted', true), array('action'=>'index'));
		}
	}

}
?>