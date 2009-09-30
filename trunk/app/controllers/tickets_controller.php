<?php
class TicketsController extends AppController {

	var $name = 'Tickets';
	var $helpers = array('Html', 'Form', 'Ajax');
	var $component = array('Auth');
	//var $layout = 'popup';

	function index($jurisdiccion_id = null){

		//$this->passedArgs['sort'] = 'user.nombre, user.apellido';
		if(isset($this->passedArgs['Instit.jurisdiccion_id'])){
			$jurisdiccion_id = $this->passedArgs['Instit.jurisdiccion_id'];
        }
		
		if (!$jurisdiccion_id){
			$this->Session->setFlash(__('Jurisdicción Inválida.', true));
			$this->redirect(array('controller'=>'pages','action'=>'home'));
		}

		if (isset($this->passedArgs['sort']) && ($this->passedArgs['sort'] == 'user.nombre')){
			$aux = $this->passedArgs['sort'];
			unset($this->passedArgs['sort']);
			$this->passedArgs['order'] = array('User.apellido' => $this->passedArgs['direction'],'User.nombre' => $this->passedArgs['direction']);
		}
		
		$this->Ticket->Instit->Jurisdiccion->recursive = -1;
		$jurisdiccion = $this->Ticket->Instit->Jurisdiccion->findById($jurisdiccion_id);
		$this->paginate['conditions']['Instit.jurisdiccion_id'] = $jurisdiccion_id;
		$this->paginate['conditions']['Ticket.estado'] = '0';
		$url_conditions['Instit.jurisdiccion_id'] = $jurisdiccion_id; // para que no pierda el id de jurisdiccion en los ordenamientos y la paginacion

		$this->set('jurisdiccion_name', $jurisdiccion['Jurisdiccion']['name']);
		$this->set('url_conditions', $url_conditions);

		$data = $this->paginate();

		if (isset($this->passedArgs['sort']) && ($this->passedArgs['sort'] == 'user.nombre')){
			$this->passedArgs['sort'] = $aux;
		}			

		/* ************************************************************ */
		/* * Llamo el find de instit para que arme el nombre completo * */
		/* ************************************************************ */

		$totInstit = count($data);
		for ($i=0;$i<$totInstit;$i++){
			$nombre_completo = $this->Ticket->Instit->find(array('Instit.id'=>$data[$i]['Ticket']['instit_id']));
			$data[$i]['Instit']['nombre_completo'] = $nombre_completo['Instit']['nombre_completo'];
		}
		
		$this->set('tickets', $data);
	}

	function view($id = null) {
		$this->layout = 'popup';
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Ticket', true));
			$this->redirect(array('action'=>'index'));
		}
		
		$this->data = $this->Ticket->read(null, $id);

		$user = (isset($this->data['User']))?$this->data['User']:array('nombre'=>'', 'apellido'=>'');
		$this->set('user', $user);
	}

	function add() {
		$this->layout = 'popup';
		
		if (!empty($this->data))
		{
			$this->Ticket->create();
			$this->data['Ticket']['user_id']=$this->Auth->user('id');
			if ($this->Ticket->save($this->data)) {
				$this->Session->setFlash(__('El Ticket se guardo correctamente', true));
				$this->set('script','<script type="text/javascript">window.opener.location.reload();window.close();</script>">');
				
			} else {
				$this->Session->setFlash(__('El Ticket no se guardo. Intente nuevamente.', true));
			}
		}
		else
		{
			$this->Ticket->dameTicketPendiente($this->data['Ticket']['instit_id']);
			//$this->redirect();
		}
		
		$instit_id = (isset($this->passedArgs[0]))?$this->passedArgs[0]:0;
		$this->set('instit_id', $instit_id);	
	}

	function edit($id = null) {
		$this->layout = 'popup';
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Ticket', true));
			$this->redirect(array('action'=>'index'));
		}
		
		if (!empty($this->data)) {
			if ($this->Ticket->save($this->data)) {
				$this->Session->setFlash(__('The Ticket has been saved', true));
				$this->set('script','<script type="text/javascript">window.opener.location.reload();window.close();</script>">');
			} else {
				$this->Session->setFlash(__('The Ticket could not be saved. Please, try again.', true));
			}
		}
		
		if (empty($this->data)) {
			$this->data = $this->Ticket->read(null, $id);
		}
		$user = (isset($this->data['User']))?$this->data['User']:array('nombre'=>'', 'apellido'=>'');
		$this->set('user', $user);
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Ticket', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Ticket->del($id)) {
			$this->Session->setFlash(__('Ticket deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

	
	function provincias_pendientes()
	{
		$prov_pend = $this->Ticket->dameProvinciasConPendientes();		
		return $prov_pend;
	}
}
?>