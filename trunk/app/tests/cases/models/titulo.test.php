<?php 
/* SVN FILE: $Id$ */
/* Titulo Test cases generated on: 2010-03-16 11:03:42 : 1268749422*/
App::import('Model', 'Titulo');

class TestTitulo extends Titulo {
	var $cacheSources = false;
	var $useDbConfig  = 'test_suite';
}

class TituloTestCase extends CakeTestCase {
	var $Titulo = null;
	var $fixtures = array('app.titulo', 'app.oferta');

	function start() {
		parent::start();
		$this->Titulo = new TestTitulo();
	}

	function testTituloInstance() {
		$this->assertTrue(is_a($this->Titulo, 'Titulo'));
	}

	function testTituloFind() {
		$this->Titulo->recursive = -1;
		$results = $this->Titulo->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Titulo' => array(
			'id'  		=> 1,
			'name'  	=> 'Lorem ipsum dolor sit amet',
			'marco_ref' => 1,
			'oferta_id' => 1
			));
		$this->assertEqual($results, $expected);
	}
}
?>