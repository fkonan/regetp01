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
	var $components = array('Auth', 'Acl');
	
	
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
	
	
	
	/**
	 * 
	 * BeforeFilter
	 * Antes de procesar el action del controlados
	 *
	 */
	function beforeFilter(){
		  //Configure AuthComponent    
		$this->Auth->authorize = 'actions';    	 	
		
		$this->Auth->loginAction = array('controller' => 'users', 'action' => 'login');  
     	$this->Auth->loginRedirect = array('controller' => 'pages', 'action' => 'home');
     	$this->Auth->logoutRedirect= array('display');  
   	
     	$this->Auth->actionPath = 'controllers/';

     	//$this->Auth->loginError ='Usuario o Password Incorrectos';
     	//$this->Auth->authError = 'Debe registrarse para acceder a esta página';

	
     	/**
     	 * 
     	 *   PERMISOS QUE TIENEN    T O D O S
     	 * 
     	 */
     	$this->Auth->allow('display');
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
	 */	
	/**
	 * Rebuild the Acl based on the current controllers in the application 
	 * 
	 * Este codigo lo saque del blog de Mark Story
	 * http://mark-story.com/posts/view/auth-and-acl-an-end-to-end-tutorial-pt-2
	 * 
	 * @return void 
	 * 
	 */    
	function buildAcl() {        
		$log = array();         
		$aco =& $this->Acl->Aco;        
		$root = $aco->node('controllers');        
		if (!$root) {            
			$aco->create(array('parent_id' => null, 'model' => null, 'alias' => 'controllers'));            
			$root = $aco->save();            
			$root['Aco']['id'] = $aco->id;             
			$log[] = 'Created Aco node for controllers';        
		} else {            
			$root = $root[0];        
		}            
		
		App::import('Core', 'File');        
		$Controllers = Configure::listObjects('controller');        
		$appIndex = array_search('App', $Controllers);        
		if ($appIndex !== false ) {            
			unset($Controllers[$appIndex]);        
		}        
		
		$baseMethods = get_class_methods('Controller');        
		$baseMethods[] = 'buildAcl';         
		
		// look at each controller in app/controllers        
		foreach ($Controllers  as $ctrlName) {            
			App::import('Controller', $ctrlName);            
			$ctrlclass = $ctrlName . 'Controller';            
			$methods = get_class_methods($ctrlclass);             
			
			// find / make controller node            
			$controllerNode = $aco->node('controllers/'.$ctrlName);            
			if (!$controllerNode) {                
				$aco->create(array('parent_id' => $root['Aco']['id'], 'model' => null, 'alias' => $ctrlName));                
				$controllerNode = $aco->save();                
				$controllerNode['Aco']['id'] = $aco->id;                
				$log[] = 'Created Aco node for '.$ctrlName;            
			} else {                
				$controllerNode = $controllerNode[0];            
			}             
			
			//clean the methods. to remove those in Controller and private actions.            
			foreach ($methods as $k => $method) {                
				if (strpos($method, '_', 0) === 0) {                    
					unset($methods[$k]);                    
					continue;                
				}                
				if (in_array($method, $baseMethods)) {                    
					unset($methods[$k]);                    
					continue;                
				}                
				$methodNode = $aco->node('controllers/'.$ctrlName.'/'.$method);                
				if (!$methodNode) {                    
					$aco->create(array('parent_id' => $controllerNode['Aco']['id'], 'model' => null, 'alias' => $method));                    
					$methodNode = $aco->save();                    
					$log[] = 'Created Aco node for '. $method;                
				}            
			}        
		}        
		
		debug($log);    
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}
?>