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
	var $fixtures = array(
            'app.anio',
            'app.ciclo',
            'app.claseinstit',
            'app.departamento', 'app.localidad',
            'app.estructura_plan',
            'app.estructura_planes_anio',
            'app.etapa',
            'app.etp_estado',
            'app.fondo',
            'app.fondos_lineas_de_accion',
            'app.gestion',
            'app.historial_cue',
            'app.instit',
            'app.jurisdiccion',
            'app.jurisdicciones_estructura_plan',
            'app.lineas_de_accion',
            'app.oferta',
            'app.orientacion',
            'app.plan',
            'app.sector',
            'app.sectores_titulo',
            'app.subsector',
            'app.ticket',
            'app.tipoinstit', 'app.dependencia',
            'app.titulo',
            'app.user',
            'app.user_login',
            'app.z_fondo_work',
        );

	function start() {
		parent::start();
		$this->Titulo = new TestTitulo();
	}

	function testTituloInstance() {
		$this->assertTrue(is_a($this->Titulo, 'Titulo'));
	}

	function testTituloFind() {
		$this->Titulo->recursive = -1;
		$results = $this->Titulo->find('first', array('conditions'=> array('id'=>1)));
		$this->assertTrue(!empty($results));

		$expected = array('Titulo' => array(
			'id'  		=> 1,
			'name'  	=> 'Lorem ipsum dolor sit amet',
			'marco_ref' => 1,
			'oferta_id' => 1
			));
		$this->assertEqual($results, $expected);
	}


        function testTituloAdd() {
		$this->Titulo->recursive = -1;

                $titulo['Titulo'] = array(
                    'id'  => 9898,
                    'name' => 'Titulo Nuevo',
                    'marco_ref' => true,
                    'oferta_id' => 1,
                );
		$this->Titulo->save($titulo);
                $res = $this->Titulo->find('first', array('conditions'=>array('id'=> 9898)));
		$this->assertEqual($res,  $titulo);
	}
}
?>