<?php 
/* SVN FILE: $Id$ */
/* Fondo Test cases generated on: 2010-04-22 10:25:00 : 1271942700*/
App::import('Model', 'FondoTemporal');

class FondotemporalTestCase extends CakeTestCase {
    var $FondoTemporal = null;
    var $tipoInstits = null;

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
        $this->Tipoinstit =& ClassRegistry::init('Tipoinstit');

        // trae todos los tipoInstits
        $this->Tipoinstit->recursive = 0;
        $this->tipoInstits = $this->Tipoinstit->find("all", array(
                'order'=> array('LENGTH(Tipoinstit.name)'=>'desc')
            ));
    }

    function testFondoInstance() {
        $this->assertTrue(is_a($this->FondoTemporal, 'FondoTemporal'));
    }

    function testOptimiza_cadena() {
        $this->assertEqual($this->FondoTemporal->optimizar_cadena('BLA N° 63'), 'bla nº63');
        $this->assertEqual($this->FondoTemporal->optimizar_cadena('E.E.T.N° 5'), 'eet nº5');
        $this->assertEqual($this->FondoTemporal->optimizar_cadena('E.E.T.N° 5-902'), 'eet nº5-902');
        $this->assertEqual($this->FondoTemporal->optimizar_cadena('BLA N°63-002'), 'bla nº63-002');
        $this->assertEqual($this->FondoTemporal->optimizar_cadena('BLA N° 63-002'), 'bla nº63-002');
        $this->assertEqual($this->FondoTemporal->optimizar_cadena('Misión Monotéc.N°72'), 'mision monotec nº72');
        $this->assertEqual($this->FondoTemporal->optimizar_cadena('ETAgro Nº1-Hued'), 'et agro nº1 -hued');
    }

    function testCompara_numeroInstit() {
        $this->assertTrue($this->FondoTemporal->compara_numeroInstit('BLA N° 63','63'));
        $this->assertTrue($this->FondoTemporal->compara_numeroInstit('BLA Nº 63','63'));
        $this->assertTrue($this->FondoTemporal->compara_numeroInstit('BLA N\' 63','63'));
        $this->assertTrue($this->FondoTemporal->compara_numeroInstit('BLA N°63','63'));
        $this->assertTrue($this->FondoTemporal->compara_numeroInstit('BLA Nº63','63'));
        $this->assertTrue($this->FondoTemporal->compara_numeroInstit('BLA N|63','63'));
        $this->assertTrue($this->FondoTemporal->compara_numeroInstit('ET- Agro - Snopek','63'));
        $this->assertTrue($this->FondoTemporal->compara_numeroInstit('BLA N° 6','06'));
        $this->assertTrue($this->FondoTemporal->compara_numeroInstit('BLA N° 06','6'));
        $this->assertTrue($this->FondoTemporal->compara_numeroInstit('Centro de Formación Profesional Nº 402-Pablo Podestá- Tres de Febrero','402'));
        $this->assertTrue($this->FondoTemporal->compara_numeroInstit('E.E.T.N° 5 - Mar del Plata','05'));
        $this->assertTrue($this->FondoTemporal->compara_numeroInstit('E.E.T.N° 1 _Dr. Conrado Etchebarne - Villaguay','01'));
        $this->assertTrue($this->FondoTemporal->compara_numeroInstit('ETAgro Nº1-Hueda','01'));
        //$this->assertTrue($this->FondoTemporal->compara_numeroInstit('Escuela Técnica Agropecuaria (Ex EMETA N° 1) Chamical','01'));
        $this->assertTrue($this->FondoTemporal->compara_numeroInstit('Misión Monotéc.N°72','72'));
        $this->assertTrue($this->FondoTemporal->compara_numeroInstit('I. Form. Prof.Nº6005','6005'));
        $this->assertTrue($this->FondoTemporal->compara_numeroInstit('I.P.E.M.Nº 291 - Gral Cabrera','291'));

        $this->assertFalse($this->FondoTemporal->compara_numeroInstit('BLA Nº 73','63'));
        $this->assertFalse($this->FondoTemporal->compara_numeroInstit('BLA Nº 163','63'));
        $this->assertFalse($this->FondoTemporal->compara_numeroInstit('BLA Nº 630','63'));
        $this->assertFalse($this->FondoTemporal->compara_numeroInstit('BLA Nº 63','630'));
        $this->assertFalse($this->FondoTemporal->compara_numeroInstit('CFP N° 11 (Ex 30)','30'));
        $this->assertFalse($this->FondoTemporal->compara_numeroInstit('E.E.T. N° Marco Silvio Ghiglione - América','01'));
    }

    function testCompara_tipoInstit() {
        $this->assertTrue($this->FondoTemporal->compara_tipoInstit('EET Nº 15 Maipú', $this->tipoInstits));
        $this->assertTrue($this->FondoTemporal->compara_tipoInstit('E.E.T. Nº 15 Maipú', $this->tipoInstits));
        $this->assertTrue($this->FondoTemporal->compara_tipoInstit('eet Nº 15 Maipú', $this->tipoInstits));
        $this->assertTrue($this->FondoTemporal->compara_tipoInstit('e.e.t. Nº 15 Maipú', $this->tipoInstits));
        $this->assertTrue($this->FondoTemporal->compara_tipoInstit('escuela Nº 15 Maipú', $this->tipoInstits));
        $this->assertTrue($this->FondoTemporal->compara_tipoInstit('centro fp Nº 15 Maipú', $this->tipoInstits));

        $this->assertFalse($this->FondoTemporal->compara_tipoInstit('Esc Ed T Nº 15 Maipú', $this->tipoInstits));
    }

    function testCompara_institNombres() {
        $this->assertTrue($this->FondoTemporal->compara_institNombres('EET Nº 15 Maipú', 'EET Nº 15 Maipú', $this->tipoInstits));
        $this->assertTrue($this->FondoTemporal->compara_institNombres('EET Nº 15 Maipú', 'eet Nº 15 Meipú', $this->tipoInstits));
        $this->assertTrue($this->FondoTemporal->compara_institNombres('EET Nº 15 Maipú', 'iet Nº 15 Meipú', $this->tipoInstits));
        $this->assertTrue($this->FondoTemporal->compara_institNombres('C.E.N.T. Nº 2 Clotilde Mercedes G. De Fernández', 'CENT Nº 2 Clotilde Mercedes G. De Fernández', $this->tipoInstits));
        $this->assertTrue($this->FondoTemporal->compara_institNombres('C.E.N.T. Nº 2 Clotilde Mercedes G. De Fernández', 'CENT Nº 2 Clotilde g De Fernández', $this->tipoInstits));
        $this->assertTrue($this->FondoTemporal->compara_institNombres('Esc Nº 15 Maipú', 'EET Nº 15 Maipú', $this->tipoInstits));
        $this->assertTrue($this->FondoTemporal->compara_institNombres('C.E.N.T. Nº 2 Clotilde Mercedes G. De Fernández - anexo', 'CENT Nº 2 Clotilde Mercedes G. De Fernández - anexo', $this->tipoInstits));

        $this->assertFalse($this->FondoTemporal->compara_institNombres('EET Nº 15 Maipú', 'eet Nº 15 Meeipú', $this->tipoInstits));
        $this->assertFalse($this->FondoTemporal->compara_institNombres('Esc Ed T Nº 15 Maipú', 'EET Nº 15 Maipú', $this->tipoInstits));
        $this->assertFalse($this->FondoTemporal->compara_institNombres('ET Nº 1 - Santa Lucía', 'ET Nº 1 - Anexo Santa Lucía', $this->tipoInstits));
        $this->assertFalse($this->FondoTemporal->compara_institNombres('C.E.N.T. Nº 2 Clotilde Mercedes G. De Fernández', 'CENT Nº 2 Clotilde Mercedes G. De Fernández anexo', $this->tipoInstits));
        $this->assertFalse($this->FondoTemporal->compara_institNombres('C.E.N.T. Nº 2 Clotilde Mercedes G. De Fernández - anexo', 'CENT Nº 2 Clotilde Mercedes G. De Fernández', $this->tipoInstits));
    }


    function testValidarInstit() {
        $this->assertEqual($this->FondoTemporal->validarInstit($fondo[0]), 1);
        $this->assertEqual($this->FondoTemporal->validarInstit($fondo[1]), 2);
        $this->assertEqual($this->FondoTemporal->validarInstit($fondo[2]), 0);
    }
}
?>