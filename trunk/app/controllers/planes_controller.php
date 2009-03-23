<?php
class PlanesController extends AppController {

	var $name = 'Planes';
	var $helpers = array('Html', 'Form');
	
	function beforeFilter(){
		parent::beforeFilter();
		//preparo la rutaUrl_for_layout ver en appController para mas informacion
		$this->rutaUrl_for_layout[] = array('name'=> 'Inicio','link'=>'/Instits/search_form' );
		
	}

	function index() {
		$this->Plan->recursive = 0;
		$this->set('planes', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('El Plan no es correcto.', true));
			$this->redirect(array('action'=>'index'));
		}
		
		$plan = $this->Plan->read(null, $id);
		
		//ordenos los años para ue puedan ser mostrados en la vista
		$anios = array();
		foreach($plan['Anio'] as $p){
			$anios[$p['ciclo_id']][]= $p;
		}
		
		$this->set('anios',$anios);		
		$this->set('plan',$plan);	

		$instit =$this->requestAction('/Instits/dame_datos/'.$plan['Plan']['instit_id']);
		$this->set('instit',$instit);

		$this->rutaUrl_for_layout[] = array('name'=> $instit['nombre'],'link'=>'/Instits/view/'.$instit['id'] );
		$this->rutaUrl_for_layout[] = array('name'=> 'Oferta Educativa','link'=>'/Instits/planes_relacionados/'.$instit['id'] );		
	}

	function add($instit_id = null) {
		if (!empty($this->data)) {
			$this->Plan->create();
			if ($this->Plan->save($this->data)) {
				$this->Session->setFlash(__('Se ha creado un nuevo Plan', true));
				$this->redirect(array('controller'=>'Instits','action'=>'planes_relacionados/'.$this->data['Plan']['instit_id']));
			} else {
				$this->Session->setFlash(__('No se ha podido crear el Plan. Por favor, intente denuevo.', true));
			}
		}
		
		$this->set('instit_id',$instit_id);
		$instit =$this->requestAction('/Instits/dame_datos/'.$instit_id);
		$this->set('instit',$instit);
		
		$instits = $this->Plan->Instit->find('list');
		$ofertas = $this->Plan->Oferta->find('list');
		$this->set(compact('instits', 'ofertas'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Plan Inválido', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Plan->save($this->data)) {
				$this->Session->setFlash(__('El Plan ha sido guardado', true));
				$this->redirect(array('action'=>'view/'.$this->data['Plan']['id']));
			} else {
				$this->Session->setFlash(__('El Plan no pudo ser guardado. Por favor, intente de nuevo.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Plan->read(null, $id);
		}
			
		$instit =$this->requestAction('/Instits/dame_datos/'.$this->data['Instit']['id']);
		$this->set('instit',$instit);
		
		$instits = $this->Plan->Instit->find('list');
		$ofertas = $this->Plan->Oferta->find('list');
		$this->set(compact('instits','ofertas'));
		$this->rutaUrl_for_layout[] = array('name'=> $this->data['Instit']['nombre'],'link'=>'/Instits/view/'.$this->data['Instit']['id'] );
		$this->rutaUrl_for_layout[] = array('name'=> 'Oferta Educativa','link'=>'/Instits/planes_relacionados/'.$this->data['Instit']['id'] );
		$this->rutaUrl_for_layout[] = array('name'=> $this->data['Plan']['nombre'],'link'=>'/Planes/view/'.$this->data['Plan']['id'] );
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Plan', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Plan->del($id)) {
			$this->Session->setFlash(__('Plan deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>