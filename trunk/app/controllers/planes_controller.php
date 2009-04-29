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

	
		
	/**
	 * Action para mostrar los planes relacionados
	 * En realidad es una copa de los planes relacionados realizados con
	 * bake, y que suelen aparecen en la view
	 *
	 * @param $instit_id
	 */
	function planes_relacionados($id = null){
		if (!$id) {
			$this->Session->setFlash(__('Institución Inválida.', true));
			$this->redirect(array('controller'=>'Istits','action'=>'view/'.$id));
		}
		
		$this->data = $this->Plan->planes_relacionados($id);
		if($this->data){
			foreach ($this->data as $p){
				$planes[] = $p['Plan'];	
				$v_plan_matricula[] = $this->Plan->Anio->matricula_del_plan($p['Plan']['id']);
			}
			$instit['Instit'] = $this->data[0]['Instit'];
			$this->set('instit',$instit);
			$this->set('planes',$planes );
			
			$this->set('v_plan_matricula',$v_plan_matricula);
			$this->rutaUrl_for_layout[] =array('name'=> $this->data[0]['Instit']['nombre'],'link'=>'/Instits/view/'.$this->data[0]['Instit']['id'] );
		}
		else{ //cuando la institucion no tiene planes relacionados mostrar esto
			$ins_aux = $this->Plan->Instit->read(null,$id);
			
			$this->set('instit',$ins_aux);
			$this->set('planes',array() );
		}
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

		$instit =$this->Plan->Instit->read(null,$id);
		$this->set('instit',$instit['Instit']);
		$this->set('matricula', $this->Plan->Anio->matricula_del_plan($id));

		$this->rutaUrl_for_layout[] = array('name'=> 'Datos Instit.','link'=>'/Instits/view/'.$instit['Instit']['id'] );
		$this->rutaUrl_for_layout[] = array('name'=> 'Oferta Educativa','link'=>'/Planes/planes_relacionados/'.$instit['Instit']['id'] );

		}

	function add($instit_id = null) {
		if (!empty($this->data)) {
			$instit_id = $this->data['Plan']['instit_id'];
			$this->Plan->create();
			if ($this->Plan->save($this->data)) {
				$this->Session->setFlash(__('Se ha creado un nuevo Plan', true));
				$this->redirect(array('action'=>'planes_relacionados/'.$this->data['Plan']['instit_id']));
			} else {
				$this->Session->setFlash(__('No se ha podido crear el Plan. Por favor, intente denuevo.', true));
			}
		}
		
		$this->set('instit_id',$instit_id);
		$instit =$this->requestAction('/Instits/dame_datos/'.$instit_id);
		$this->set('instit',$instit);

		$ofertas = $this->Plan->Oferta->find('list');
		$this->set(compact('instits', 'ofertas'));
		

		$this->rutaUrl_for_layout[] =array('name'=> $instit['nombre'],'link'=>'/Instits/view/'.$instit['id'] );
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
		$this->rutaUrl_for_layout[] = array('name'=> 'Oferta Educativa','link'=>'/Planes/planes_relacionados/'.$this->data['Instit']['id'] );
		$this->rutaUrl_for_layout[] = array('name'=> $this->data['Plan']['nombre'],'link'=>'/Planes/view/'.$this->data['Plan']['id'] );
	}

	function delete($id = null) {
		$this->Plan->recursive = -1;
		$this->data = $this->Plan->read(null,$id);
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Plan', true));
		}
		if ($this->Plan->del($id)) {
			$this->Session->setFlash(__('Plan Eliminado', true));			
			$this->redirect(array('action'=>'planes_relacionados/'.$this->data['Plan']['instit_id']));
		}
	}
	
	
	


}
?>