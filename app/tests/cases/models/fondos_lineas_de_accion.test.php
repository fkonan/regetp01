<?php 
/* SVN FILE: $Id$ */
/* FondosLineasDeAccion Test cases generated on: 2010-04-22 10:39:45 : 1271943585*/
App::import('Model', 'FondosLineasDeAccion');

class FondosLineasDeAccionTestCase extends CakeTestCase {
	var $FondosLineasDeAccion = null;
	var $fixtures = array(
            'app.z_fondo_work', 'app.jurisdiccion', 'app.instit', 'app.claseinstit',
            'app.orientacion',  'app.sector', 'app.plan', 'app.subsector',
            'app.lineas_de_accion', 'app.fondos_lineas_de_accion',
            'app.tipoinstit', 'app.dependencia', 'app.departamento', 'app.localidad',
            'app.etp_estado', 'app.oferta', 'app.titulo', 'app.anio', 'app.ciclo',
            'app.etapa', 'app.gestion', 'app.historial_cue', 'app.ticket', 'app.user',
            'app.user_login', 'app.fondo',
        );

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


        function testFind() {
            $montoSumar = 2.5;
            $other = array('FondosLineasDeAccion' => array(
			'id' => 2,
			'fondo_id' => 1,
			'lineas_de_accion_id' => 2,
			'monto' => $montoSumar,
			'created' => '2010-04-22 10:39:45',
			'modified' => '2010-04-22 10:39:45',
		));
            
            $suma = $this->FondosLineasDeAccion->find('sum');
            
            $this->FondosLineasDeAccion->save($other['FondosLineasDeAccion']);

            $suma2 = $this->FondosLineasDeAccion->find('sum');

            $this->assertEqual($suma+$montoSumar, $suma2);

            $condicion = array('FondosLineasDeAccion.lineas_de_accion_id'=>2);
            //$suma2 = $this->FondosLineasDeAccion->find('sum', array('conditions'));


        }
}
?>