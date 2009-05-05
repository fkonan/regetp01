<?php
class PlanesController extends AppController {

	var $name = 'Planes';
	var $helpers = array('Html', 'Form');
	
	function beforeFilter(){
		parent::beforeFilter();
		//preparo la rutaUrl_for_layout ver en appController para mas informacion
		$this->rutaUrl_for_layout[] = array('name'=> 'Buscador','link'=>'/Instits/search_form' );
		
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

		$this->Plan->Instit->recursive = 1;
		$instit = $this->Plan->Instit->read(null, $plan['Plan']['instit_id']);
	
		$this->set('instit',$instit['Instit']);
		$this->set('matricula', $this->Plan->Anio->matricula_del_plan($id));

		$this->rutaUrl_for_layout[] = array('name'=> 'Dato Institución','link'=>'/Instits/view/'.$instit['Instit']['id'] );
		$this->rutaUrl_for_layout[] = array('name'=> 'Oferta Educativa','link'=>'/Instits/planes_relacionados/'.$instit['Instit']['id'] );
		
		
		//	Si es FP mostrar la vista para FP, sino mostrar la vista por default (view)
        switch ($plan['Plan']['oferta_id']):
		case 1: // FP
            $this->set('planes_view_tabla','planes_view_tabla_fp');
            break;
		case 2: //IT
		case 3: //MT, SEC
			$this->set('planes_view_tabla','planes_view_tabla_normal');
			 break;
		case 4: //SNU
			 $this->set('planes_view_tabla','planes_view_tabla_snu');
			 break;
        endswitch;
       

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
		
		$this->Plan->Instit->recursive = 1;
		$instit = $this->Plan->Instit->read(null, $instit_id);

		$this->set('instit',$instit['Instit']);

		$ofertas = $this->Plan->Oferta->find('list');
		$this->set(compact('instits', 'ofertas'));
		

		$this->rutaUrl_for_layout[] =array('name'=> $instit['Instit']['nombre'],'link'=>'/Instits/view/'.$instit['Instit']['id'] );
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
		$this->Plan->Instit->recursive = 1;
		$instit = $this->Plan->Instit->read(null, $this->data['Plan']['instit_id']);
		$this->set('instit',$instit['Instit']);
		
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