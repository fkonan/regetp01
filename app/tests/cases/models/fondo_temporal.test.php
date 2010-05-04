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

    function testCompara_numeroInstit() {
        $this->assertTrue($this->FondoTemporal->compara_numeroInstit('BLA N° 63','63'));
        $this->assertTrue($this->FondoTemporal->compara_numeroInstit('BLA Nº 63','63'));
        $this->assertTrue($this->FondoTemporal->compara_numeroInstit('BLA N\' 63','63'));
        $this->assertTrue($this->FondoTemporal->compara_numeroInstit('BLA N°63','63'));
        $this->assertTrue($this->FondoTemporal->compara_numeroInstit('BLA Nº63','63'));
        $this->assertTrue($this->FondoTemporal->compara_numeroInstit('BLA N|63','63'));
        $this->assertTrue($this->FondoTemporal->compara_numeroInstit('ET- Agro - Snopek','63'));

        $this->assertFalse($this->FondoTemporal->compara_numeroInstit('BLA Nº 73','63'));
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
    
}
?>