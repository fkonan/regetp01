<?php
/* SVN FILE: $Id: app_controller.php 7945 2008-12-19 02:16:01Z gwoo $ */
/**
 * Short description for file.
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) :  Rapid Development Framework (http://www.cakephp.org)
 * Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright     Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 * @link          http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.app
 * @since         CakePHP(tm) v 0.2.9
 * @version       $Revision: 7945 $
 * @modifiedby    $LastChangedBy: gwoo $
 * @lastmodified  $Date: 2008-12-18 18:16:01 -0800 (Thu, 18 Dec 2008) $
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */
/**
 * Short description for class.
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       cake
 * @subpackage    cake.app
 */
class AppController extends Controller {
	var $helpers = array('Javascript','Html', 'Form');
	var $components = array('Auth');
	
	
	//esta es una variable que sera mostrada en el layout
	// se crea mediante un elemento que le inserta un listado de urls
	// indicando claramente en que lugar del sitio estoy navegando
	// es una serie de links PEj:
	// institucion -> ofertas -> plan -> año
	// Sencillamente, es un menu de navegacion
	var $rutaUrl_for_layout = array();	
	
	
	
	
	/**
	 * Before Render
	 * Antes de mostrar la vista
	 *
	 */
	function beforeRender(){
		$this->set('rutaUrl_for_layout', $this->rutaUrl_for_layout);		
	}
	
	
		
	function beforeFilter(){
		$this->Auth->loginError ='Usuario o Password Incorrectos';
		$this->Auth->authError = 'Debe registrarse para acceder a esta página';
		$this->Auth->logoutRedirect='/pages/home';
		$this->Auth->allow('display','login','logout');
		$this->Auth->authorize = 'controller'; 
	}	
	
	function isAuthorized() {
	switch ($this->Auth->user('role')) {
		case 'admin':
			$llAuth = true;
			break;
		case 'editor':
			$llAuth = false;
			if ($this->action == 'edit') {$llAuth = true;}
			if ($this->action == 'add') {$llAuth = true;}
			if ($this->action == 'view') {$llAuth = true;}
			if ($this->name == 'Instits' && $this->action == 'search') {$llAuth = true;}
			if ($this->name == 'Instits' && $this->action == 'search_form') {$llAuth = true;}
			if ($this->name == 'Tipoinstits' && $this->action == 'ajax_select_form_por_jurisdiccion') {$llAuth = true;}
			if ($this->name == 'Temas' && $this->action == 'verdetalle') {$llAuth = true;}
			if ($this->name == 'Ofertas' && $this->action == 'add') {$llAuth = true;}		
			if ($this->name == 'Instits' && $this->action == 'dame_datos') {$llAuth = true;}
			if ($this->name == 'Ciclos' && $this->action == 'dame_ciclos') {$llAuth = true;}
			if ($this->name == 'Etapas' && $this->action == 'dame_nombre') {$llAuth = true;}
			if ($this->name == 'Instits' && $this->action == 'view') {$llAuth = true;}
			if ($this->name == 'Anios' && $this->action == 'matricula_del_plan') {$llAuth = true;}
			if ($this->name == 'Jurisdicciones' && $this->action == 'get_name') {$llAuth = true;}		
			if ($this->name == 'Ofertas' && $this->action == 'dame_nombre') {$llAuth = true;}
			if ($this->name == 'Ofertas' && $this->action == 'dame_abrev') {$llAuth = true;}
			if ($this->name == 'Planes' && $this->action == 'planes_relacionados') {$llAuth = true;}			
			if ($this->name == 'Tipodocs' && $this->action == 'tipodoc_nombre') {$llAuth = true;}
			if ($this->name == 'Tipodocs' && $this->action == 'dame_tipodocs') {$llAuth = true;}
			if ($this->name == 'Tipoinstits' && $this->action == 'get_name') {$llAuth = true;}
			
			break;
		case 'invitado':
//			$llAuth = false;
			$llAuth = false;
			if ($this->action == 'view') {$llAuth = true;}
			if ($this->name == 'Instits' && $this->action == 'search') {$llAuth = true;}
			if ($this->name == 'Instits' && $this->action == 'search_form') {$llAuth = true;}
			if ($this->name == 'Tipoinstits' && $this->action == 'ajax_select_form_por_jurisdiccion') {$llAuth = true;}			
			if ($this->name == 'Temas' && $this->action == 'verdetalle') {$llAuth = true;}
			if ($this->name == 'Ofertas' && $this->action == 'add') {$llAuth = true;}			
			if ($this->name == 'Instits' && $this->action == 'dame_datos') {$llAuth = true;}
			if ($this->name == 'Ciclos' && $this->action == 'dame_ciclos') {$llAuth = true;}
			if ($this->name == 'Etapas' && $this->action == 'dame_nombre') {$llAuth = true;}
			if ($this->name == 'Instits' && $this->action == 'view') {$llAuth = true;}
			if ($this->name == 'Anios' && $this->action == 'matricula_del_plan') {$llAuth = true;}
			if ($this->name == 'Jurisdicciones' && $this->action == 'get_name') {$llAuth = true;}		
			if ($this->name == 'Ofertas' && $this->action == 'dame_nombre') {$llAuth = true;}
			if ($this->name == 'Ofertas' && $this->action == 'dame_abrev') {$llAuth = true;}
			if ($this->name == 'Planes' && $this->action == 'planes_relacionados') {$llAuth = true;}
			if ($this->name == 'Tipodocs' && $this->action == 'tipodoc_nombre') {$llAuth = true;}
			if ($this->name == 'Tipodocs' && $this->action == 'dame_tipodocs') {$llAuth = true;}
			if ($this->name == 'Tipoinstits' && $this->action == 'get_name') {$llAuth = true;}
			break;
		}
		if ($llAuth == true) {
			return true;
		} else {
			$this->Session->setFlash('No tiene permisos para acceder a esta opción.', true);
			$this->redirect('/pages/home');
			return false;
		}
	}
		
		
	
	
	
	
	
	
	
	
	
}
?>