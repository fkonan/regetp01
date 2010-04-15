<?php
class FondoTemporalesController extends AppController {

	var $name = 'FondoTemporales';
	var $helpers = array('Html', 'Form', 'Paginator');

	function index() {
		$this->FondoTemporal->recursive = 0;
                pr($this->paginate);
                $this->paginate['fields'][] = 'FondoTemporal.id';
                $this->paginate['fields'][] = 'FondoTemporal.*';
                $this->paginate['fields'][] = 'SUM(f01+f02_a+f02_b+f02_c+f03_a+f03_b+f04+f05+f06_a+f06_b+f06_c+f07_a+f07_b+f07_c+f08+f09+equip_inf+refaccion) as suma_fila';
		//$this->paginate['groupby'][]
                $this->set('fondos', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid FondoTemporal.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('fondo', $this->FondoTemporal->read(null, $id));
	}


	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid FondoTemporal', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->FondoTemporal->save($this->data)) {
				$this->Session->setFlash(__('The FondoTemporal has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The FondoTemporal could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->FondoTemporal->read(null, $id);
		}
		$instits = $this->FondoTemporal->Instit->find('list');
		$jurisdicciones = $this->FondoTemporal->Jurisdiccion->find('list');
		$lineasDeAcciones = $this->FondoTemporal->LineasDeAccion->find('list');
		$this->set(compact('instits','jurisdicciones','lineasDeAcciones'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for FondoTemporal', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->FondoTemporal->del($id)) {
			$this->Session->setFlash(__('FondoTemporal deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}


        function suma_filas() {
		$this->FondoTemporal->recursive = 0;
		$this->set('fondos', $this->paginate());
	}

}
?>