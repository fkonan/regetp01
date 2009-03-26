<?php
class AniosController extends AppController {

	var $name = 'Anios';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Anio->recursive = 0;
		$this->set('anios', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Anio.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('anio', $this->Anio->read(null, $id));
	}

	function add($plan_id = null) {
	
		$this->layout='popup';
		if (!empty($this->data)) {
			$this->Anio->create();
			if ($this->Anio->save($this->data)) {
				$this->Session->setFlash(__('Se ha guardado un nuevo año', true));
				$this->set('script','<script type="text/javascript">window.opener.location.reload();window.close();</script>">');
				return 0;
			} else {
				$this->Session->setFlash(__('EL año no ha podido ser guardado. Por favor, intente de nuevo.', true));
			}
		}
		
		$planes = $this->Anio->Plan->find('list');
		$ciclos = $this->Anio->Ciclo->find('list');
		$etapas = $this->Anio->Etapa->find('list');
		$this->set('plan_id',$plan_id);
		$this->set(compact('planes', 'ciclos', 'etapas'));
		
		/**
		 * esto es para generar una vista distinta 
		 * para los años que son de una oferta FP
		 */
		$this->Anio->Plan->recursive = -1;
		$plan   = $this->Anio->Plan->find('all',array('conditions'=>array('Plan.id'=>$plan_id)));
		//pr($plan);
		if($plan[0]['Plan']['oferta_id']==1){//es un FP, asique mostrar la vista de años para FP
			$this->render('/Anios/add_FP');
		}
	}

	function edit($id = null) {		
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Anio', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->layout='popup';
		if (!empty($this->data)) {
			if ($this->Anio->save($this->data)) {
				$this->Session->setFlash(__('El año ha sido guardado', true));
				$this->set('script','<script type="text/javascript">window.opener.location.reload();window.close();</script>">');
			} else {
				$this->Session->setFlash(__('El año no pudo ser guardado. Por favor, intente denuevo.', true));
			}
		}
		
		
		$planes = $this->Anio->Plan->find('list');
		$ciclos = $this->Anio->Ciclo->find('list');
		$etapas = $this->Anio->Etapa->find('list');
		$this->set(compact('planes','ciclos','etapas'));
	
		
		/**
		 * esto es para generar una vista distinta 
		 * para los años que son de una oferta FP
		 */
		if (empty($this->data)) {
			$this->data = $this->Anio->read(null, $id);
		}
		$this->Anio->Plan->recursive = -1;
		$plan   = $this->Anio->Plan->find('all',array('conditions'=>array('Plan.id'=>$this->data['Anio']['plan_id'])));
		//pr($plan);
		if($plan[0]['Plan']['oferta_id']==1){//es un FP, asique mostrar la vista de años para FP
			$this->render('/Anios/edit_FP');
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Id de Año inválido', true));
			$this->redirect(array('controller'=>'Pages','action'=>'default'));
		}
		
		$this->Anio->recursive = -1;
		$plan = $this->Anio->read('plan_id',$id);
		if ($this->Anio->del($id)) {
	
			$this->Session->setFlash(__('Año eliminado', true));
			$this->redirect(array('controller'=>'Planes' ,'action'=>'view/'.$plan['Anio']['plan_id']));
		}
	}

	/**
	 * Me devuelve un array con el total de matriculas del plan
	 *	retorna un array cuya 'key' es el id del plan y el valor, es la matricula
	 * @param $plan_id
	 * @return Array $aux_vec('plan_id'=>'matricula')
	 */
	function matricula_del_plan($plan_id){
		$aux_vec[$plan_id] = 0;
		$this->Anio->recursive = -1;
		$this->data = $this->Anio->find('all',array(
						'conditions'=>array('plan_id'=>$plan_id),
						'group'=>array('ciclo_id','plan_id'),
						'order'=>array('ciclo_id DESC'),					
						'fields'=>array('sum(matricula) as "matricula"','plan_id','ciclo_id')));	

	
		//esta linea es para que solo muestre los datos de matricula del 
		//ULTIMO ciclo (año lectivo) cargado
	if($this->data){	
		$ciclo_aux = $this->data[0]['Anio']['ciclo_id'];
	} 
		
		foreach($this->data as $v){
			
			//como el array vine ordenado por cicl_id descendiente, si leo otro ciclo y 
			//es distinto es porque estoy en un año anterir, por lo tanto 
			//debo cortar la ejecucion y entregar el array como quedó
			if ($ciclo_aux != $v['Anio']['ciclo_id']) break; 
			
			
			$aux_vec[$v['Anio']['plan_id']] = $v[0]['matricula'];
		}
		return $aux_vec;
	}
}
?>