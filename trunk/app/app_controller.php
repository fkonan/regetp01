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
		/**
		 * 
		 *  REGETP VERSION
		 * 
		 */
		Configure::write('regetpVersion', 'v1.3');

		$this->Auth->autoRedirect = false; 
		$this->Auth->loginError ='Usuario o Contraseña Incorrectos';
		$this->Auth->authError = 'Debe registrarse para acceder a esta página';
		$this->Auth->logoutRedirect='/pages/home';
		//$this->Auth->allow('*');
		$this->Auth->allow('display','login','logout');
		$this->Auth->authorize = 'controller'; 
	}	
	
	
	function isAuthorized() 
	{
	  switch ($this->Auth->user('role')):
	  
	    // usuarios con mas privilegios en el sistema
	    // por lo general éstos usuarios puden ver botones ocultos que solo ellos ven, por ejemplo 
	    // el boton para eliminar instituciones
	    case 'desarrollo':
	    	$llAuth = true;
			break;
		case 'admin':
			$llAuth = true;			
			break;
		case 'editor':
			//hago que la sesion expire en mas tiempo
			$llAuth = false;
		
			if ($this->name == 'Instits' && $this->action == 'search') {$llAuth = true;}
			if ($this->name == 'Instits' && $this->action == 'add') {$llAuth = true;}
			if ($this->name == 'Instits' && $this->action == 'search_form') {$llAuth = true;}
			if ($this->name == 'Instits' && $this->action == 'view') {$llAuth = true;}
			if ($this->name == 'Instits' && $this->action == 'edit') {$llAuth = true;}
			if ($this->name == 'Instits' && $this->action == 'planes_relacionados') {$llAuth = true;}
			if ($this->name == 'Instits' && $this->action == 'depurar') {$llAuth = true;}
			
			if ($this->name == 'Planes' && $this->action == 'add') {$llAuth = true;}
			if ($this->name == 'Planes' && $this->action == 'view') {$llAuth = true;}
			if ($this->name == 'Planes' && $this->action == 'edit') {$llAuth = true;}
			if ($this->name == 'Planes' && $this->action == 'delete') {$llAuth = true;}
			if ($this->name == 'Planes' && $this->action == 'index') {$llAuth = true;}
			
			if ($this->name == 'Anios' && $this->action == 'add') {$llAuth = true;}
			if ($this->name == 'Anios' && $this->action == 'edit') {$llAuth = true;}
			if ($this->name == 'Anios' && $this->action == 'delete') {$llAuth = true;}
			
			//if ($this->name == 'Departamentos') {$llAuth = true;}
			//if ($this->name == 'Localidades') {$llAuth = true;}
			
			if ($this->name == 'Queries' && $this->action == 'descargar_queries') {$llAuth = true;}
			if ($this->name == 'Queries' && $this->action == 'contruye_excel') {$llAuth = true;}
			if ($this->name == 'Queries' && $this->action == 'list_view') {$llAuth = true;}
			
			if ($this->name == 'Depuradores') {$llAuth = true;}
			if ($this->name == 'Sectores') {$llAuth = true;}
			
			if ($this->name == 'Tickets' && $this->action == 'index') {$llAuth = true;}
			if ($this->name == 'Tickets' && $this->action == 'add') {$llAuth = true;}
			if ($this->name == 'Tickets' && $this->action == 'edit') {$llAuth = true;}
			if ($this->name == 'Tickets' && $this->action == 'view') {$llAuth = true;}
			if ($this->name == 'Tickets' && $this->action == 'provincias_pendientes') {$llAuth = true;}

			if ($this->name == 'HistorialCues' && $this->action == 'search_form') {$llAuth = true;}
			if ($this->name == 'HistorialCues' && $this->action == 'search') {$llAuth = true;}
			
			break;
		  case 'invitado':	
			$llAuth = false;
			
			if ($this->name == 'Instits' && $this->action == 'search') {$llAuth = true;}
			if ($this->name == 'Instits' && $this->action == 'search_form') {$llAuth = true;}
			if ($this->name == 'Instits' && $this->action == 'view') {$llAuth = true;}
			
			if ($this->name == 'Planes' && $this->action == 'index') {$llAuth = true;}
			
			if ($this->name == 'Planes' && $this->action == 'view') {$llAuth = true;}

			if ($this->name == 'Tickets' && $this->action == 'view') {$llAuth = true;}
			
			if ($this->name == 'HistorialCues' && $this->action == 'search_form') {$llAuth = true;}
			if ($this->name == 'HistorialCues' && $this->action == 'search') {$llAuth = true;}
			break;
		  default: die('El tipo de usuario no concuerda con ninguno setteado en el sistema y se abortará la operación');
		endswitch;
		
		
		
		
		/*****
		 * 			COSAS DISPONIBLES PARA ToDOS LOS USUARIOS
		 ****-----------------------------------------------------******/
		if ($this->name == 'Cuadros') {$llAuth = true;}
		
		//Queries/contruye_excel/27 = InstitucionesPorTipoETP.xls
		if ($this->name == 'Queries' &&
			$this->action == 'contruye_excel' && 
			$this->passedArgs[0] == 27
		) {
			$llAuth = true;
		}
		
		//Queries/contruye_excel/25 = IntitsXAmbGestionSgnJurisdiccion.xls 
		if ($this->name == 'Queries' &&
			$this->action == 'contruye_excel' && 
			$this->passedArgs[0] == 25
		) {
			$llAuth = true;
		}		
		
		
		
		
		/**
	 	* Estos son requestedActions, por lo tanto estan disponibles para todos los usuarios
		*/
		if ($this->name == 'Instits' && $this->action == 'dame_datos') {$llAuth = true;}
		if ($this->name == 'Ciclos' && $this->action == 'dame_ciclos') {$llAuth = true;}
		if ($this->name == 'Etapas' && $this->action == 'dame_nombre') {$llAuth = true;}
		if ($this->name == 'Anios' && $this->action == 'matricula_del_plan') {$llAuth = true;}			
		if ($this->name == 'Jurisdicciones' && $this->action == 'get_name') {$llAuth = true;}		
		if ($this->name == 'Ofertas' && $this->action == 'dame_nombre') {$llAuth = true;}
		if ($this->name == 'Ofertas' && $this->action == 'dame_abrev') {$llAuth = true;}					
		if ($this->name == 'Tipodocs' && $this->action == 'tipodoc_nombre') {$llAuth = true;}
		if ($this->name == 'Tipodocs' && $this->action == 'dame_tipodocs') {$llAuth = true;}
		if ($this->name == 'Tipoinstits' && $this->action == 'get_name') {$llAuth = true;}
		if ($this->name == 'Tipoinstits' && $this->action == 'ajax_select_form_por_jurisdiccion') {$llAuth = true;}
		if ($this->name == 'Departamentos' && $this->action == 'ajax_select_departamento_form_por_jurisdiccion') {$llAuth = true;}
		if ($this->name == 'Localidades' && $this->action == 'ajax_select_localidades_form_por_departamento') {$llAuth = true;}	
		if ($this->name == 'Localidades' && $this->action == 'ajax_select_localidades_form_por_jurisdiccion') {$llAuth = true;}
		if ($this->name == 'Subsectores' && $this->action == 'ajax_select_subsector_form_por_sector') {$llAuth = true;}
		
		
		
		/**
		 * Hacer que solo puedan modificar sus datos y contraseña el usuario que es dueño de esos datos
		 */
	    if ($this->name == 'Users' && $this->action == 'cambiar_password' && $this->passedArgs[0] == $this->Auth->user('id')) {$llAuth = true;}
	    if ($this->name == 'Users' && $this->action == 'self_user_edit'   && $this->passedArgs[0] == $this->Auth->user('id')) {$llAuth = true;}
	
	
		if ($llAuth == true) {
			return true;
		} else {			
			$this->Session->setFlash('No tiene permisos para acceder a esta opción.', true);
			
			if ($this->name == 'Anios' && ($this->action == 'edit' || $this->action == 'add')){
				$this->redirect('/pages/forbidden');
			}
			$this->redirect('/pages/home');
			return false;
		}
	}
		
			
	
	
}
?>