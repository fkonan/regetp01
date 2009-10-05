<?php 

class InstitsControllerTest extends CakeTestCase { 
   
   
   
  function testIndexPostFixturized() 
  {
		$data = array('Instit' => array('cue'=>'200015'));
		$result = $this->testAction('/instits/index',
				array('fixturize' => true, 'data' => $data, 'method' => 'post'));
		debug($result);
	} 
} 
?>