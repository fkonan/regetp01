<?php 
/* SVN FILE: $Id$ */
/* Fondo Test cases generated on: 2010-04-22 10:25:00 : 1271942700*/
App::import('Model', 'FondoTemporal');

class FondotemporalTestCase extends CakeTestCase {
    var $FondoTemporal = null;

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
        /*
        * @var FondoTemporal
        */
        $this->FondoTemporal =& ClassRegistry::init('FondoTemporal');
    }

    function testFondoInstance() {
        $this->assertTrue(is_a($this->FondoTemporal, 'FondoTemporal'));
    }

    function testCompara_numeroInstit() {
        $t1 = $this->FondoTemporal->compara_numeroInstit('BLA N° 63','63');
        $this->assertTrue($t1);

        $t1 = $this->FondoTemporal->compara_numeroInstit('BLA N\' 63','63');
        $this->assertTrue($t1);

        $t1 = $this->FondoTemporal->compara_numeroInstit('BLA N°63','63');
        $this->assertTrue($t1);

        $t1 = $this->FondoTemporal->compara_numeroInstit('BLA N|63','63');
        $this->assertTrue($t1);

        $t1 = $this->FondoTemporal->compara_numeroInstit('BLA N° 73','63');
        $this->assertFalse($t1);

        $t1 = $this->FondoTemporal->compara_numeroInstit('ET- Agro - Snopek','63');
        $this->assertTrue($t1);
    }

    function testCompara_tipoInstit() {
        $tiposInstit = array('Tipoinstit'=>array(
                    'id' => 33,
                    'jurisdiccion_id' => 2,
                    'name' => 'ESCUELA DE EDUCACIÓN TÉCNICA (E.E.T.)'
                ),
            array(
                    'id' => 9,
                    'jurisdiccion_id' => 2,
                    'name' => 'CENTRO EDUCATIVO DE NIVEL TERCIARIO (C.E.N.T.)'
                ),
            array(
                    'id' => 3,
                    'jurisdiccion_id' => 2,
                    'name' => 'ESCUELA POLITÉCNICA'
                ),
            array(
                    'id' => 8,
                    'jurisdiccion_id' => 2,
                    'name' => 'ESCUELA'
                )
        );
        $instit = array('FondoTemporal'=>array(
		'id' => 2,
		'anio' => 2009,
		'trimestre' => 1,
		'jurisdiccion_id' => 2,
		'jurisdiccion_name' => 'CABA',
		'memo' => 'xx',
		'cuecompleto' => '24567801',
		'instit' => 'I.P.E.M. Nº 63 REPÚBLICA DE ITALIA',
		'instit_name' => '',
		'departamento' => 'Lorem ipsum dolor sit amet',
		'localidad' => 'Lorem ipsum dolor sit amet'
        ));

        $t1 = $this->FondoTemporal->testCompara_tipoInstit('BLA N° 63','63');
        $this->assertTrue($t1);

        $t1 = $this->FondoTemporal->compara_numeroInstit('BLA N\' 63','63');
        $this->assertTrue($t1);

        $t1 = $this->FondoTemporal->compara_numeroInstit('BLA N°63','63');
        $this->assertTrue($t1);

        $t1 = $this->FondoTemporal->compara_numeroInstit('BLA N|63','63');
        $this->assertTrue($t1);

        $t1 = $this->FondoTemporal->compara_numeroInstit('BLA N° 73','63');
        $this->assertFalse($t1);

        $t1 = $this->FondoTemporal->compara_numeroInstit('ET- Agro - Snopek','63');
        $this->assertTrue($t1);
    }
    
}
?>