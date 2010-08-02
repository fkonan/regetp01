<?php
class EtapasJurisdiccionesController extends AppController {

	var $name = 'EtapasJurisdicciones';
	var $helpers = array('Html', 'Form');

	function index($id = null) {

                if (!empty($this->data['EtapasJurisdiccion'])) {
                    $this->EtapasJurisdiccion->deleteAll(array('EtapasJurisdiccion.jurisdiccion_id ='. $this->data['EtapasJurisdiccion']['jurisdiccion_id']));
                    if(!empty($this->data['EtapasJurisdiccion']['etapas_selected'])){
                        foreach($this->data['EtapasJurisdiccion']['etapas_selected'] as $etapa){
                            $this->EtapasJurisdiccion->create();
                            $etapaJur = array("EtapasJurisdiccion"=>array("etapa_id"=>$etapa, 'edad_desde'=> $this->data['EtapasJurisdiccion'][$etapa]['edad_desde'], 'edad_hasta'=> $this->data['EtapasJurisdiccion'][$etapa]['edad_hasta'], "jurisdiccion_id"=>$this->data['EtapasJurisdiccion']['jurisdiccion_id']));
                            $this->EtapasJurisdiccion->save($etapaJur);
                        }
                    }
                    $this->redirect(array('action' => 'index',$this->data['EtapasJurisdiccion']['jurisdiccion_id']));
                }

                $notIn = array();
                $this->EtapasJurisdiccion->recursive = 0;

                $conditions = array('contain'=> array('Etapa'),
                                    'conditions'=> array("jurisdiccion_id" => $id),
                                    'fields' => array('DISTINCT Etapa.id', 'Etapa.name','edad_desde','edad_hasta'));
                
                $etapasSeleccionadas = $this->EtapasJurisdiccion->find('all',$conditions);


                if(!empty($etapasSeleccionadas)){
                    foreach($etapasSeleccionadas as $etapa){
                        array_push($notIn, $etapa['Etapa']['id']);
                    }

                    $conditions = array('contain'=> array('Etapa'),
                                        'conditions'=> array('NOT'=>array("Etapa.id" => $notIn)),
                                        'fields' => array('DISTINCT Etapa.id', 'Etapa.name','edad_desde','edad_hasta'));

                }
                else{
                    $conditions = array('contain'=> array('Etapa'),
                                    'fields' => array('DISTINCT Etapa.id', 'Etapa.name','edad_desde','edad_hasta'));
                }
                
                $etapasNoSeleccionadas = $this->EtapasJurisdiccion->find('all',$conditions);
                       
		$this->set('etapasSeleccionadas', $etapasSeleccionadas);
                $this->set('etapasNoSeleccionadas', $etapasNoSeleccionadas);
                $this->set('jurisdiccion_id', $id);
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid EtapasJurisdicciones', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('etapasJurisdicciones', $this->EtapasJurisdicciones->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->EtapasJurisdicciones->create();
			if ($this->EtapasJurisdicciones->save($this->data)) {
				$this->Session->setFlash(__('The EtapasJurisdicciones has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The EtapasJurisdicciones could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid EtapasJurisdicciones', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->EtapasJurisdicciones->save($this->data)) {
				$this->Session->setFlash(__('The EtapasJurisdicciones has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The EtapasJurisdicciones could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->EtapasJurisdicciones->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for EtapasJurisdicciones', true));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->EtapasJurisdicciones->del($id)) {
			$this->Session->setFlash(__('EtapasJurisdicciones deleted', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('The EtapasJurisdicciones could not be deleted. Please, try again.', true));
		$this->redirect(array('action' => 'index'));
	}

}
?>