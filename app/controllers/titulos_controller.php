<?php
class TitulosController extends AppController {

	var $name = 'Titulos';
	var $helpers = array('Html', 'Form');
        var $components = array('RequestHandler');

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


        function add_and_give_me_select_options() {
            if ($this->RequestHandler->isAjax()){
                $this->layout = false;
            }
            if (!empty($this->data)) {
                $this->Titulo->create();
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
				
				if($this->data['Titulo']['old_oferta_id'] != $this->data['Titulo']['oferta_id']) {
					$sql = "UPDATE planes SET oferta_id=".$this->data['Titulo']['oferta_id']. 
						   " WHERE oferta_id=".$this->data['Titulo']['old_oferta_id']." AND titulo_id=".$this->data['Titulo']['id'];

					$this->Titulo->query($sql);
				}
				
				
				//$this->flash(__('The Titulo has been saved.', true), array('action'=>'index'));
				$this->Session->setFlash(__('Titulo guardado.', true));
				$this->redirect(array('action'=>'index'));
			} else {
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Titulo->read(null, $id);
		}
				
		$this->data['Titulo']['old_oferta_id'] = $this->data['Titulo']['oferta_id'];
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