<?php 
App::import('Controller', 'Instits');

class TestInstits extends InstitsController {
	var $autoRender = false;
	
	function redirect($url, $status = null, $exit = true){
		$this->redirectUrl = $url;
	}
	
	function render($action){
		$this->renderedAction = $action;
	}
	
	function _stop($status = 0){
		$this->stooped = $status;
	}
}


class InstitsControllerTest extends CakeTestCase { 
   
	function startTest(){
		$this->Instit = new TestInstits();
		$this->Instit->constructClasses();
		$this->Instit->Component->initialize($this->Instit);
	}
   
   function testIndex() { 
   	$this->Instit->params['url'] = '';
     //$result = $this->Instit->testAction('/instits/index');
    	 $result = $this->Instit->index(); 
  		debug($result);
   	
   } 
} 
?>