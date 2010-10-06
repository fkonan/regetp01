<?php 
/* SVN FILE: $Id$ */
/* Plan Test cases generated on: 2010-04-22 12:01:13 : 1271948473*/
App::import('Model', 'Plan');

class PlanTestCase extends CakeTestCase {
    /**
     * @var Plan
     */
    var $Plan = null;

    /* @var $fixtures array */
    var $fixtures = array(
            'app.z_fondo_work', 'app.estructura_plan', 'app.estructura_planes_anio', 'app.jurisdicciones_estructura_plan',
            'app.jurisdiccion', 'app.instit', 'app.claseinstit',
            'app.orientacion',  'app.sector', 'app.plan', 'app.subsector',
            'app.lineas_de_accion', 'app.fondos_lineas_de_accion',
            'app.tipoinstit', 'app.dependencia', 'app.departamento', 'app.localidad',
            'app.etp_estado', 'app.oferta', 'app.titulo', 'app.anio', 'app.ciclo',
            'app.etapa', 'app.gestion', 'app.historial_cue', 'app.ticket', 'app.user',
            'app.user_login', 'app.fondo',
    );
//    var $fixtures = array(
//            'app.z_fondo_work', 'app.jurisdiccion', 'app.instit', 'app.claseinstit',
//            'app.lineas_de_accion', 'app.fondos_lineas_de_accion', 'app.orientacion',
//            'app.sector', 'app.plan', 'app.subsector');

    function startTest() {
        $this->Plan =& ClassRegistry::init('Plan');

    }

    function testPlanInstance() {
        $this->assertTrue(is_a($this->Plan, 'Plan'));
    }

    function testGetEstructuraSugerida() {
        // plan 1: 2009: mezclado - 2010: 2 de POLI
        // pero la jurisdiccion 2 tiene tambien el de 3 de POLI asignado
        $this->assertEqual($this->Plan->getEstructuraSugerida(1), 0);

        //$this->assertEqual($this->Plan->getEstructuraSugerida(1), 3);
        
        // con busqueda forzada, quiere sugerencia igual por mas que tenga el 
        // id de estructura ya asignado en Plan
        $this->assertEqual($this->Plan->getEstructuraSugerida(1, true), 0);

        $this->assertEqual($this->Plan->getEstructuraSugerida(3), 1);
        $this->assertEqual($this->Plan->getEstructuraSugerida(4), 0);
        $this->assertEqual($this->Plan->getEstructuraSugerida(7), 0);

        $this->assertNotEqual($this->Plan->getEstructuraSugerida(1), 1);
        $this->assertNotEqual($this->Plan->getEstructuraSugerida(2), 3);
        $this->assertNotEqual($this->Plan->getEstructuraSugerida(4), 2);
    }



    function testTieneEstructuraDefinida() {

        $this->assertFalse($this->Plan->tieneEstructuraDefinida(1));
        $this->assertTrue($this->Plan->tieneEstructuraDefinida(2));
        $this->assertFalse($this->Plan->tieneEstructuraDefinida(3));
    }


}
?>