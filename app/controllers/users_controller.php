<?php
class UsersController extends AppController {

	var $name = 'Users';

	
	function beforeFilter() {    
		parent::beforeFilter();     
		$this->Auth->allowedActions = array('*');
	}
	
	
	function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid User.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('user', $this->User->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			if($this->Auth->password($this->data['User']['password_check'])==$this->data['User']['password']){
				$this->User->create();
				if ($this->User->save($this->data)) {
					$this->Session->setFlash(__('Su usuario ha sido registrado', true));
					$this->redirect(array('controller'=>'pages','action'=>'home'));
				} else {
					$this->Session->setFlash(__('No se ha podio registrar. Por favor intente nuevamente.', true));
				}
			}
			else{
				$this->Session->setFlash('Los passwords no coinciden');
			}
		}
		$this->set('grupos',$this->User->Group->find('list'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid User', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The User has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The User could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for User', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->User->del($id)) {
			$this->Session->setFlash(__('User deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}
	
	
	
	/**
	 * 
	 *   Cosas de Authentication
	 * 
	 */
	function login(){
	}
	
	
	function logout(){
		$this->Session->setFlash('Ha salido de su cuenta');
		$this->redirect($this->Auth->logout());
	}
	
	
	
	/**
	 * *
	 * 
	 *  ELIMINAR EN PRODUCCION
	 *  ELIMINAR EN PRODUCCION	 *  ELIMINAR EN PRODUCCION
	 *  ELIMINAR EN PRODUCCION	 *  ELIMINAR EN PRODUCCION
	 *  ELIMINAR EN PRODUCCION	 *  ELIMINAR EN PRODUCCION
	 *  ELIMINAR EN PRODUCCION	 *  ELIMINAR EN PRODUCCION
	 *  ELIMINAR EN PRODUCCION	 *  ELIMINAR EN PRODUCCION
	 *  ELIMINAR EN PRODUCCION
	 *
	 * 
	 *  Esta funcion se la copie a Mark Story en su blog
	 * http://mark-story.com/posts/view/auth-and-acl-an-end-to-end-tutorial-pt-2
	 * 
	 * Es simplemente para dar permisos a los usuarios
	 * 
	 */
	function initDB() {    
		$group =& $this->User->Group;    
		
		
		//allow editor para hacer todo    
		$group->id = 4;         
		$this->Acl->allow($group, 'controllers');     
		
		//allow editor para hacer todo 
		$group->id = 1;    
		$this->Acl->deny($group, 'controllers');    
		$this->Acl->allow($group, 'controllers/Instits/search_form');    
		
		$this->Acl->allow($group, 'controllers/Instits/search'); 

		$this->Acl->allow($group,'controllers/Instits/dame_datos');
		
		$this->Acl->allow($group,'controllers/Ciclos/dame_ciclos');
		$this->Acl->allow($group,'controllers/Etapas/dame_nombre');
		
		$this->Acl->allow($group,'controllers/Instits/view');
		
		$this->Acl->allow($group,'controllers/Jurisdicciones/get_name');
		$this->Acl->allow($group,'controllers/Ofertas/dame_nombre');
		$this->Acl->allow($group,'controllers/Ofertas/dame_abrev');
		
		$this->Acl->allow($group,'controllers/Planes/planes_relacionados');
		
		$this->Acl->allow($group,'controllers/Tipodocs/tipodoc_nombre');
		$this->Acl->allow($group,'controllers/Tipodocs/dame_tipodocs');
		
		$this->Acl->allow($group, 'controllers/Tipoinstits/ajax_select_form_por_jurisdiccion');
		$this->Acl->allow($group, 'controllers/Tipoinstits/get_name');
		
		debug("LISSTO");
		//die();
	}

}
?>