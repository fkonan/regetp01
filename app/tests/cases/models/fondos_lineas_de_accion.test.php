<?php 
/* SVN FILE: $Id$ */
/* FondosLineasDeAccion Test cases generated on: 2010-04-22 10:39:45 : 1271943585*/
App::import('Model', 'FondosLineasDeAccion');

class FondosLineasDeAccionTestCase extends CakeTestCase {
	var $FondosLineasDeAccion = null;
	var $fixtures = array('app.fondos_lineas_de_accion', 'app.fondo', 'app.lineas_de_accion');

	function startTest() {
		$this->FondosLineasDeAccion =& ClassRegistry::init('FondosLineasDeAccion');
	}

	function testFondosLineasDeAccionInstance() {
		$this->assertTrue(is_a($this->FondosLineasDeAccion, 'FondosLineasDeAccion'));
	}

	function testFondosLineasDeAccionFind() {
		$this->FondosLineasDeAccion->recursive = -1;
		$results = $this->FondosLineasDeAccion->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('FondosLineasDeAccion' => array(
			'id' => 1,
			'fondo_id' => 1,
			'lineas_de_accion_id' => 1,
			'monto' => 1,
			'created' => '2010-04-22 10:39:45',
			'modified' => '2010-04-22 10:39:45'
		));
		$this->assertEqual($results, $expected);
	}
}
?>