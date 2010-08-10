<?php
class TrayectoAniosController extends AppController {

	var $name = 'TrayectoAnios';
	var $helpers = array('Html', 'Form');
        var $paginate = array('order'=>array('TrayectoAnio.anio_escolaridad'=>'asc'));

	function index() {
		$this->TrayectoAnio->recursive = 0;
		$this->set('trayectoAnios', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid TrayectoAnio.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('trayectoAnio', $this->TrayectoAnio->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->TrayectoAnio->create();
			if ($this->TrayectoAnio->save($this->data)) {
				$this->Session->setFlash(__('The TrayectoAnio has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The TrayectoAnio could not be saved. Please, try again.', true));
			}
		}
		$trayectos = $this->TrayectoAnio->Trayecto->find('list');
		$etapas = $this->TrayectoAnio->Etapa->find('list');
		$this->set(compact('trayectos', 'etapas'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid TrayectoAnio', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->TrayectoAnio->save($this->data)) {
				$this->Session->setFlash(__('The TrayectoAnio has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The TrayectoAnio could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->TrayectoAnio->read(null, $id);
		}
		$trayectos = $this->TrayectoAnio->Trayecto->find('list');
		$etapas = $this->TrayectoAnio->Etapa->find('list');
		$this->set(compact('trayectos','etapas'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for TrayectoAnio', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->TrayectoAnio->del($id)) {
			$this->Session->setFlash(__('TrayectoAnio deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>