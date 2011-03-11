<?php 
/* SVN FILE: $Id$ */
/* Plan Test cases generated on: 2010-04-22 12:01:13 : 1271948473*/
App::import('Model', 'Plan');

require_once dirname(__FILE__) . DS . 'extra_functions.php';

class PlanTestCase extends CakeTestCase {
    /**
     * @var Plan
     */
    var $Plan = null;

     /* @var $fixtures array */
    var $fixtures = array();
//    var $fixtures = array(
//            'app.z_fondo_work', 'app.jurisdiccion', 'app.instit', 'app.claseinstit',
//            'app.lineas_de_accion', 'app.fondos_lineas_de_accion', 'app.orientacion',
//            'app.sector', 'app.plan', 'app.subsector');

    function  __construct() {
        $this->fixtures = getAllFixtures();
    }
    
    
    function startTest() {
        $this->Plan =& ClassRegistry::init('Plan');

    }

    function testPlanInstance() {
        $this->assertTrue(is_a($this->Plan, 'Plan'));
    }

    function testGetEstructuraSugerida() {
        // plan 1: 2009: mezclado - 2010: 2 de POLI
        // pero la jurisdiccion 2 tiene tambien el de 3 de POLI asignado
        $this->assertEqual($this->Plan->getEstructuraSugerida(5), 1);

        //$this->assertEqual($this->Plan->getEstructuraSugerida(1), 3);
        
        // con busqueda forzada, quiere sugerencia igual por mas que tenga el 
        // id de estructura ya asignado en Plan
        $this->assertEqual($this->Plan->getEstructuraSugerida(5, true), 0);

        $this->assertEqual($this->Plan->getEstructuraSugerida(8), 3);
        $this->assertEqual($this->Plan->getEstructuraSugerida(11), 2);
        $this->assertEqual($this->Plan->getEstructuraSugerida(7), -1);
        $this->Plan->id = 7;

        $this->Plan->recursive = -1;
   //     debug($this->Plan->read(null, 7));
        if(!$this->Plan->saveField('oferta_id', 3, false)) {
                $this->fail('No se pudo guardar un campo del plan');
        }
        if(!$this->Plan->saveField('estructura_plan_id', 3, false)) {
                $this->fail('No se pudo guardar la estructura sugerida');
        }
        $this->assertEqual($this->Plan->getEstructuraSugerida(7), 3);
    }



    function testTieneEstructuraDefinida() {
        $this->assertFalse($this->Plan->tieneEstructuraDefinida(1));
        $this->assertTrue($this->Plan->tieneEstructuraDefinida(2));
        $this->assertFalse($this->Plan->tieneEstructuraDefinida(3));
        $this->assertTrue($this->Plan->tieneEstructuraDefinida(8));
        $this->assertTrue($this->Plan->tieneEstructuraDefinida(11));

        $this->assertFalse($this->Plan->tieneEstructuraDefinida(7));
        $this->Plan->id = 7;
        $this->Plan->recursive = -1;
        if(!$this->Plan->saveField('oferta_id', 3, false)) {
                $this->fail('No se pudo guardar un campo del plan');
        }
        if(!$this->Plan->saveField('estructura_plan_id', 3, false)) {
                $this->fail('No se pudo guardar la estructura sugerida');
        }
        $this->assertTrue($this->Plan->tieneEstructuraDefinida(7));
    }


}
?>