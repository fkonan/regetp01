<?php
class PlanesController extends AppController {

	var $name = 'Planes';
	var $helpers = array('Html','Form','Ajax');
	
	function beforeFilter(){
		parent::beforeFilter();
		//preparo la rutaUrl_for_layout ver en appController para mas informacion
		$this->rutaUrl_for_layout[] = array('name'=> 'Buscador','link'=>'/Instits/search_form' );
		
	}

	
	/**
	 * Listado de planes para una determinada institucion
	 * @param $id ID de institucion
	 */
	function index($id = null){

		$v_plan_matricula = array();
		
		if (isset($this->passedArgs['Instit.id']))
		{
			$id = $this->passedArgs['Instit.id'];
		}

		if (isset($this->data['Instit']['id']))
		{
			$id = $this->data['Instit']['id'];
		}

		if (!$id)
		{
			$this->Session->setFlash(__('Institución Inválida.', true));
			$this->redirect(array('controller'=>'Instits','action'=>'view/'.$id));
		}
		
		/* *************************** */
		/*  Si tiene ticket pendiente  */
		/* *************************** */

		$data_ticket = $this->Plan->Instit->Ticket->dameTicketPendiente($id);
		$ticket_id = isset($data_ticket['Ticket']['id'])?$data_ticket['Ticket']['id']:0;
		$this->set('ticket_id', $ticket_id);

		$action = ($this->Auth->user('role')=='admin' || $this->Auth->user('role')=='editor' || $this->Auth->user('role')=='desarrollo')?'edit':'view';
		$this->set('action', $action);

		/* *************************** */
		/*  Fin Si tiene ticket pendiente  */
		/* *************************** */
		
		$this->institData = $this->Plan->Instit->read(null,$id);
		if($this->institData)
		{
			$cont = 0;
			foreach ($this->institData['Plan'] as $p):
				$v_plan_matricula[$cont] = $this->Plan->Anio->matricula_del_plan($p['id']);
				$v_plan_matricula[$cont]['ciclo'] = $this->Plan->Anio->ciclo_lectivo_matricula_del_plan($p['id']);
				$cont++;
			endforeach;
			
			$this->set('sumatoria_matriculas',$this->Plan->Instit->dameSumatoriaDeMatriculasPorOferta($id));
			$this->set('planes',$this->institData);	
			$this->set('v_plan_matricula',$v_plan_matricula);
			$this->rutaUrl_for_layout[] =array('name'=> 'Datos Institución','link'=>'/Instits/view/'.$this->institData['Instit']['id'] );
		}		

		$ofertas = $this->Plan->Oferta->find('list',array('fields' => array('id','abrev')));
		
		/* TODO parece que esto hay que borrarlo
		$planes = $this->Plan->find('list', array(  'fields' => array('Plan.id'),
													'conditions'=>array('instit_id'=>$id)));
		//$ciclos = $this->Plan->Anio->find('list',array('fields' => array('Anio.ciclo_id','Anio.ciclo_id'),
		//												'conditions'=>array('Anio.plan_id'=>$planes),
		//												'group'=>'Anio.ciclo_id',
		//												'order'=>'Anio.ciclo_id ASC'
		//												));
		//debug($ciclos);														
		*/
		
		$ciclos = $this->Plan->dame_max_ciclos_por_instits($id);
														
		$this->set(compact('ofertas','ciclos'));
		$this->Plan->recursive = 0;

		/* ************************************ */
		/* * Filtros de la búsqueda de Planes * */
		/* ************************************ */

		if(isset($this->data['Plan']['oferta_id'])){
			if((int)$this->data['Plan']['oferta_id'] != 0){
				$this->paginate['conditions']['Plan.oferta_id'] = $this->data['Plan']['oferta_id'];
				$url_conditions['Plan.oferta_id'] = $this->data['Plan']['oferta_id'];					
			}
        }
		if(isset($this->passedArgs['Plan.oferta_id'])){
			if((int)$this->passedArgs['Plan.oferta_id'] != 0){
				$this->paginate['conditions']['Plan.oferta_id'] = $this->passedArgs['Plan.oferta_id'];
				$url_conditions['Plan.oferta_id'] = $this->passedArgs['Plan.oferta_id'];					
			}
        }

		if(isset($this->data['Plan']['nombre']) && $this->data['Plan']['nombre'] != ""){
			$this->paginate['conditions']['to_ascii(lower(Plan.nombre)) SIMILAR TO ?'] = array($this->Plan->convertir_para_busqueda_avanzada($this->data['Plan']['nombre']));
			$url_conditions['Plan.nombre'] = $this->data['Plan']['nombre'];					
        }
		if(isset($this->passedArgs['Plan.nombre']) && $this->passedArgs['Plan.nombre'] != ""){
			$this->paginate['conditions']['to_ascii(lower(Plan.nombre)) SIMILAR TO ?'] = array($this->Plan->convertir_para_busqueda_avanzada(utf8_decode($this->passedArgs['Plan.nombre'])));
			$url_conditions['Plan.nombre'] = utf8_decode($this->passedArgs['Plan.nombre']);					
        }
        
		if(isset($this->data['Plan']['sector']) && $this->data['Plan']['sector'] != ""){
			$this->paginate['conditions']['to_ascii(lower(Plan.sector)) SIMILAR TO ?'] = array($this->Plan->convertir_para_busqueda_avanzada($this->data['Plan']['sector']));
			$url_conditions['Plan.sector'] = $this->data['Plan']['sector'];					
        }
        if(isset($this->passedArgs['Plan.sector']) && $this->passedArgs['Plan.sector'] != ""){
			$this->paginate['conditions']['to_ascii(lower(Plan.sector)) SIMILAR TO ?'] = array($this->Plan->convertir_para_busqueda_avanzada(utf8_decode($this->passedArgs['Plan.sector'])));
			$url_conditions['Plan.sector'] = utf8_decode($this->passedArgs['Plan.sector']);					
        }
        
        if(isset($this->data['Anio']['ciclo_id'])){
			if((int)$this->data['Anio']['ciclo_id'] != 0){
				$this->Plan->setMaxCiclo($this->data['Anio']['ciclo_id']); 
			}
			$url_conditions['Anio.ciclo_id'] = $this->data['Anio']['ciclo_id'];
        }
		else
		{        

			if(isset($this->passedArgs['Anio.ciclo_id'])){
				if((int)$this->passedArgs['Anio.ciclo_id'] != 0){
					$this->Plan->setMaxCiclo($this->passedArgs['Anio.ciclo_id']);
				}
				$url_conditions['Anio.ciclo_id'] = $this->passedArgs['Anio.ciclo_id'];
			}
        	else 
        	{
        		if(isset($ciclos)){
        			if((int)end($ciclos) != 0){
						$this->Plan->setMaxCiclo(end($ciclos));
						$url_conditions['Anio.ciclo_id'] = end($ciclos);
					}	
        		}
        	}
		}	

		/* ********************************* */
        /* * Paginador y seteos a la vista * */
        /* ********************************* */

		if (!isset($this->passedArgs['sort'])){
			$this->passedArgs['sort'] = 'Plan.oferta_id';
			$this->passedArgs['direction'] = 'asc';
		}
		
		$this->Plan->setAsociarAnio(true);
        $this->paginate['conditions']['Instit.id'] = $id;
        $url_conditions['Instit.id'] = $id; // para que no pierda el id de instit en los ordenamientos y la paginacion
		$data = $this->paginate();
		
		for($i=0; $i< count($data); $i++):
			$mat = $this->Plan->dameMatriculaDeCiclo($data[$i]['Plan']['id'],$data[$i]['calculado']['max_ciclo']);
			$data[$i]['calculado']['sum_matricula'] = $mat;
		endfor;
		$this->set('planesRelacionados', $data);
		$this->set('url_conditions', $url_conditions);
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

		$this->rutaUrl_for_layout[] = array('name'=> 'Datos Institución','link'=>'/Instits/view/'.$instit['Instit']['id'] );
		$this->rutaUrl_for_layout[] = array('name'=> 'Oferta Educativa','link'=>'/Planes/index/'.$instit['Instit']['id'] );
		
		
		//	Si es FP mostrar la vista para FP, sino mostrar la vista por default (view)
        switch ($plan['Plan']['oferta_id']):
		case 1: // FP
		case 7: // CL Capacitacion Laboral
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
		if (!empty($this->data) && !$instit_id) {
			$this->Session->setFlash(__('Institución incorrecta', true));
			$this->redirect(array('controller'=>'pages', 'action'=>'home'));
		}
		if (!empty($this->data)) {
			$instit_id = $this->data['Plan']['instit_id'];
			$this->Plan->create();
			if ($this->Plan->save($this->data)) {
				$this->Session->setFlash(__('Se ha creado un nuevo Plan', true));
				$this->redirect(array('controller'=>'Planes','action'=>'view/'.$this->Plan->id));
			} else {
				$this->Session->setFlash(__('No se ha podido crear el Plan. Por favor, intente denuevo.', true));
			}
		}
		
		$this->Plan->Instit->recursive = 1;
		$instit = $this->Plan->Instit->read(null, $instit_id);
		$this->set('instit',$instit['Instit']);

		$ofertas = $this->Plan->Oferta->find('list');
		$this->set(compact('ofertas'));
		
		
		$sectores = $this->Plan->Sector->find('list',array('order'=>'Sector.name'));
		$this->set('sectores',$sectores);
		
		$subsectores = $this->Plan->Subsector->con_sector('list');
		$this->set('subsectores',$subsectores);
		
		
		$this->rutaUrl_for_layout[] =array('name'=> 'Datos Institución','link'=>'/Instits/view/'.$instit['Instit']['id'] );
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Plan Inválido', true));
			$this->redirect(array('controller'=>'Pages','action'=>'home'));
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

		$ofertas = $this->Plan->Oferta->find('list');
		
		$sectores = $this->Plan->Sector->find('list',array('order'=>'Sector.name'));		
		
		if(!isset($this->data['Plan']['sector_id'])){
			$this->data['Plan']['sector_id'] = 0;
		}		
		$subsectores = $this->Plan->Subsector->con_sector('list',$this->data['Plan']['sector_id']);
		
		$this->set(compact('ofertas','subsectores','sectores'));
		
		$this->rutaUrl_for_layout[] = array('name'=> 'Datos Institución','link'=>'/Instits/view/'.$this->data['Plan']['instit_id'] );
		$this->rutaUrl_for_layout[] = array('name'=> 'Oferta Educativa','link'=>'/Planes/index/'.$this->data['Plan']['instit_id'] );
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
			$this->redirect(array('controller'=>'planes','action'=>'index/'.$this->data['Plan']['instit_id']));
		}
	}
	
}
?>