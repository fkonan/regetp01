<?php 
/* SVN FILE: $Id$ */
/* Instit Test cases generated on: 2009-09-17 10:09:16 : 1253194756*/
App::import('Model', 'Instit');

class TestInstit extends Instit {

	var $cacheSources = false;
}

class InstitTestCase extends CakeTestCase {

	var $autoFixtures = false;
	var $fixtures = array('app.instit', 'app.plan', 'app.sector', 'app.subsector', 'app.orientacion');
	 
	function start() {
		parent::start();
		$this->Instit = new TestInstit();
	}
	
	
	function testGuardar()
	{
		//creo un plan mixto para la institucion 1
		$plan = array(
	    		//'id' 			=> 0,
				'instit_id'		=> 1,
				'oferta_id'		=> 1,
				'old_item'		=> 0,
				'norma'			=> "",
				'nombre'		=> "Titulo nuevo",
				'perfil'		=> "Algun Perfil",
				'sector'		=> "",
				'duracion_hs'	=> 3,
				'duracion_semanas'=>2,
				'duracion_anios'=> 4,
				'matricula'		=> 100,
				'observacion'	=> "Alguna observacion 1",
				'ciclo_alta'	=> 2007,
				'ciclo_mod'		=> 0,
				//'created' 		=> "2010-01-21 13:54:45",
				//'modified' 		=> "2010-01-21 13:54:45",
				'sector_id'		=> 3, // Sector = Agropecuaria -> Orientacion = Agropecuaria
				'subsector_id'	=> 2,
    	);
    	
    	$orien = array('name'=> "Agropecuaria 2");
    	$result = $this->Instit->Plan->Sector->Orientacion->save($orien);
    	$this->Instit->Plan->Sector->Orientacion->recursive = -1;
    	$this->assertTrue($result);
		$lastInsertId = $this->Instit->Plan->Sector->Orientacion->getLastInsertID();
		$this->assertTrue($lastInsertId != null);
		
		debug($lastInsertId);
    	/*
    	$this->Instit->Plan->recursive = -1;
    	debug($this->Instit->Plan->find('count'));
		$this->Instit->Plan->save($plan);
		debug($this->Instit->Plan->id);
		debug($this->Instit->Plan->find('count'));
		
		//debug($this->Instit->find('all',array('conditions'=>array('Instit.id'=>1))));
		$orientacion = $this->Instit->getOrientacionSegunSusPlanes(1);	
		$this->assertEqual($orientacion, 0); //orientacion otros
		*/
	}

	
	function testGetOrientacionSegunSusPlanes() 
	{    		
		$this->loadFixtures('Instit', 'Plan', 'Sector', 'Subsector', 'Orientacion');
		
		$orientacion = $this->Instit->getOrientacionSegunSusPlanes(1);
		$this->assertEqual($orientacion, 3); //orientacion otros
		
		$orientacion = $this->Instit->getOrientacionSegunSusPlanes(2);
		$this->assertEqual($orientacion, 3);
		
		$orientacion = $this->Instit->getOrientacionSegunSusPlanes(3);
		$this->assertEqual($orientacion, 2);
		
		$orientacion = $this->Instit->getOrientacionSegunSusPlanes(4);
		$this->assertEqual($orientacion, 1);
	}
	

	
	function testIsCUEValid(){
		// casos que deberian dar 1, porque todo paso bien
		$this->assertEqual($this->Instit->isCUEValid("601254"),1);
		$this->assertEqual($this->Instit->isCUEValid("201254"),1);
		$this->assertEqual($this->Instit->isCUEValid("0601254"),1);
		$this->assertEqual($this->Instit->isCUEValid("0201254"),1);
		$this->assertEqual($this->Instit->isCUEValid("2601254"),1);
		$this->assertEqual($this->Instit->isCUEValid("9401254"),1);
		
		// Estos son casos que fallan
		$this->assertEqual($this->Instit->isCUEValid("2ss54"),-1);		
		$this->assertEqual($this->Instit->isCUEValid("j.kjas"),-1);

		$this->assertEqual($this->Instit->isCUEValid("501254"),-6);
		$this->assertEqual($this->Instit->isCUEValid("9810125"),-7);
		$this->assertEqual($this->Instit->isCUEValid("05101255"),-8);
		$this->assertEqual($this->Instit->isCUEValid("051012555"),-9);
		
		// este es un numero intermedio entre 3 y 6 digitos
		$this->assertEqual($this->Instit->isCUEValid("6542"),2);
		
		//este es un numero menor a 3 digitos
		$this->assertEqual($this->Instit->isCUEValid("54"),-1);
	}

}
?>