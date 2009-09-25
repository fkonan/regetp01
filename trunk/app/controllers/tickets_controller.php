<?php
class TicketsController extends AppController {

	var $name = 'Tickets';
	var $helpers = array('Html', 'Form', 'Ajax');
	var $component = array('Auth');
	var $layout = 'popup';

	function index() {
		$this->Ticket->recursive = 0;
		$this->set('tickets', $this->paginate());
	}

	function view($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Ticket', true));
			$this->redirect(array('action'=>'index'));
		}
		
		$this->data = $this->Ticket->read(null, $id);

		$user = (isset($this->data['User']))?$this->data['User']:array('nombre'=>'', 'apellido'=>'');
		$this->set('user', $user);
	}

	function add() {
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
		$this->layout = 'ajax';
		Configure::write('debug',1);
		
		$this->Ticket->recursive = 0;
		$search = $this->Ticket->find('all', array(
										'fields'=>array('Instit.jurisdiccion_id'),
										'conditions'=>array('Ticket.estado'=>0),
										'group'=>'Instit.jurisdiccion_id'));
		$juris_id = array();
		foreach($search as $key=>$value)
		{
			$juris_id[]=$value['Instit']['jurisdiccion_id'];
		}
		
		$this->Ticket->Instit->Jurisdiccion->recursive = -1;
		$prov_pend = $this->Ticket->Instit->Jurisdiccion->find('all', array(
								'fields'=>array('Jurisdiccion.id', 'Jurisdiccion.name'),
								'conditions'=>array('Jurisdiccion.id'=>$juris_id)));
		
		$this->set('prov_pend', $prov_pend);
		
		//$this->render('provincias_pendientes','ajax');
		
		return $prov_pend;
	}
}
?>