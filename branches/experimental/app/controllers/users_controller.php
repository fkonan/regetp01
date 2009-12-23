<?php
class UsersController extends AppController {

	var $name = 'Users';
	
	
	function listadoUsuarios() {
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
					$this->Session->setFlash(__('Se ha agregado un nuevo usuario', true));
					$this->redirect('/users/add');
				} else {
					$this->Session->setFlash(__('No se ha podio registrar. Por favor intente nuevamente.', true));
				}
			}
			else{
				$this->Session->setFlash('Los passwords no coinciden');
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid User', true));
			$this->redirect(array('controller'=>'Users','action'=>'listadoUsuarios'));
		}
		if (!empty($this->data)) {
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('El usuario fue guardado correctamente', true));
				$this->redirect(array('controller'=>'Users','action'=>'listadoUsuarios'));
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
			$this->redirect(array('controller'=>'Users','action'=>'listadoUsuarios'));
		}
		if ($this->User->del($id)) {
			$this->Session->setFlash(__('User deleted', true));
			$this->redirect(array('controller'=>'Users','action'=>'listadoUsuarios'));;
		}
	}
	
	
	
	/**
	 * 
	 *   Cosas de Authentication
	 * 
	 */
	function login(){
		if($this->Auth->loginAction == '/Anio/view' || $this->Auth->loginAction == '/Anio/edit' || $this->Auth->loginAction == '/Anio/add' ){
			$this->layout = 'popup';
		}
		
		if ($this->Auth->login()){
			$this->log('Se logueó el usuario '.$this->Auth->data['User']['username'],LOG_INFO);
			//$this->log($this->Auth->redirect(),LOG_DEBUG);
			//die($this->Auth->redirect());
			$this->redirect($this->Auth->redirect());
			
		}
	}
	
	
	function logout(){
		$this->Session->setFlash('Ha salido de su cuenta');
		$this->redirect($this->Auth->logout());
	}
	
	
	/**
	 *  Este es para que un usuario se edite el perfil
	 *  
	 * @param id del usuario
	 */
	function self_user_edit($id){
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Usuario Incorrecto', true));
			$this->redirect('/pages/home');
		}
		if (!empty($this->data)) {
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('Se ha guardado la información correctamente', true));
				$this->data = $this->User->read(null, $id);
			} else {
				$this->Session->setFlash(__('El usuario no pudo ser guardado. Por favor, intente nuevamente.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
		}
	}
	
	
/**
	 *  Este es para que un usuario se edite el perfil
	 *  
	 * @param id del usuario
	 */
	function cambiar_password($id){
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Usuario Incorrecto', true));
			$this->redirect('/pages/home');
		}
		if (!empty($this->data)) {
			if($this->comparePasswords()){ //me fijo que los passwords coincidan
				if ($this->User->save($this->data)) {
					$this->Session->setFlash(__('Se ha guardado el nuevo password correctamente', true));
					$this->redirect('/pages/home');
				} else {
					$this->Session->setFlash(__('La contraseña no pudo ser guardada. Por favor, intente nuevamente.', true));
				}
			}
			else $this->Session->setFlash('La contraseña no coincide, por favor reintente.');
		}
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
		}
	}
	
	
	/**
	 *  Esta funcion me convierte los passwors para luego ser comparados
	 *  sirve cuando quiero generar un nuevio opassword y tengo 2 imputs por comparar
	 * @return unknown_type
	 */
	private function comparePasswords(){
		if(!empty( $this->data['User']['password'] ) ){
			$this->data['User']['password'] = $this->Auth->password($this->data['User']['password'] );
		}
		if(!empty( $this->data['User']['password_check'] ) ){
			$this->data['User']['password_check'] = $this->Auth->password( $this->data['User']['password_check'] );
		}
		
		if ($this->data['User']['password'] == $this->data['User']['password_check']){
			return true;
		} else return false;
	}
	
	
}
?>