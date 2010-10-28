<?php
class TitulosController extends AppController {

	var $name = 'Titulos';
	var $helpers = array('Html', 'Form');
        var $components = array('RequestHandler');

	function index() {
		$this->Titulo->recursive = 0;
		$this->set('titulos', $this->paginate());
	}


        function list_por_oferta_id($oferta_id = 0){
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

}
?>