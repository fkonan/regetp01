<?php 
/* SVN FILE: $Id$ */
/* Instit Test cases generated on: 2009-09-17 10:09:16 : 1253194756*/
App::import('Model', 'Instit');


class InstitTestCase extends CakeTestCase {

	//var $autoFixtures = false;
	 /* @var $fixtures array */
    var $fixtures = array(
            'app.z_fondo_work', 'app.jurisdiccion', 'app.instit', 'app.claseinstit',
            'app.orientacion',  'app.sector', 'app.plan', 'app.subsector',
            'app.lineas_de_accion', 'app.fondos_lineas_de_accion',
            'app.tipoinstit', 'app.dependencia', 'app.departamento', 'app.localidad',
            'app.etp_estado', 'app.oferta', 'app.titulo', 'app.anio', 'app.ciclo',
            'app.etapa', 'app.gestion', 'app.historial_cue', 'app.ticket', 'app.user',
            'app.user_login', 'app.fondo', 'app.estructura_plan', 'app.estructura_planes_anio',
            'app.jurisdicciones_estructura_plan'
    );

    var $Instit = null;
	 
    function startTest() {
        //parent::start();
        $this->Instit =& ClassRegistry::init('Instit');
    }


//    function startTest() {
//        $this->Instit =& ClassRegistry::init('Instit');
//
//    }

    function testPlanInstance() {
        $this->assertTrue(is_a($this->Instit, 'Instit'));
    }


    function testInstitSinPlanGetOrientacionSegunSusPlanes() {
        //$this->loadFixtures('Instit', 'Plan', 'Sector', 'Subsector', 'Orientacion');

        $instit_id = 1;
        $conditions = array('Plan.instit_id'=>$instit_id);
        $planes = $this->Instit->Plan->find('all',array(
                'conditions'=>$conditions));

        // le borro todos los planes
        foreach ($planes as $p) {
            $this->Instit->Plan->del($p['Plan']['id']);
        }

        $cant = $this->Instit->Plan->find('count',array('conditions'=>$conditions));

        if ($cant == 0) {
            $orientacion = $this->Instit->getOrientacionSegunSusPlanes($instit_id);
            $this->assertEqual($orientacion, -1); //sin orientacion
        } else {
            $this->fail("Se tenian que borrar los planes pero no se borraron");
        }

        //prueba una institucion que no existe
        $orientacion = $this->Instit->getOrientacionSegunSusPlanes(56456);
        $this->assertEqual($orientacion, -1); //sin orientacion
    }

    function testGetOrientacionMixtaSegunSusPlanes() {
       // $this->loadFixtures('Instit', 'Plan', 'Sector', 'Subsector', 'Orientacion');

        /*************** Para la Instit ID= 1 ****************************/
        $plan['Plan'] = array(
                'id'                => 7,
                'instit_id'         => 1,
                'oferta_id'         => 1,
                'old_item'          => 0,
                'norma'             => "",
                'nombre'            => "Titulo en nada",
                'perfil'            => "Algun Perfil",
                'sector'            => "",
                'duracion_hs'       => 3,
                'duracion_semanas'  => 2,
                'duracion_anios'    => 4,
                'matricula'         => 100,
                'observacion'       => "Alguna observacion",
                'ciclo_alta'        => 2007,
                'ciclo_mod'         => 0,
                //'created' 		=> "2010-01-21 13:54:45",
                //'modified' 		=> "2010-01-21 13:54:45",
                'sector_id'         => 3, // Sector = Agropecuaria -> Orientacion = Agropecuaria
                'subsector_id'      => 1,
        );
        $this->Instit->Plan->create();
        $this->Instit->Plan->save($plan, false);
        $orientacion = $this->Instit->getOrientacionSegunSusPlanes(1);
        $this->assertEqual($orientacion, 0); //orientacion mixta


        /*************** Para la Instit ID= 2 ****************************/
        $plan['Plan'] = array(
                'id'                => 8,
                'instit_id'         => 2,
                'oferta_id'         => 1,
                'old_item'          => 0,
                'norma'             => "",
                'nombre'            => "Titulo en nada",
                'perfil'            => "Algun Perfil",
                'sector'            => "",
                'duracion_hs'       => 3,
                'duracion_semanas'  => 2,
                'duracion_anios'    => 4,
                'matricula'         => 100,
                'observacion'       => "Alguna observacion",
                'ciclo_alta'        => 2007,
                'ciclo_mod'         => 0,
                'sector_id'         => 4, //Sector Automotriz -- Orientacion = Industrial
                'subsector_id'      => 1,
        );
        $this->Instit->Plan->create();
        $this->Instit->Plan->save($plan, false);
        $orientacion = $this->Instit->getOrientacionSegunSusPlanes(2);
        $this->assertEqual($orientacion, 0); //orientacion mixta

        $this->Instit->Plan->del(8);
        $orientacion = $this->Instit->getOrientacionSegunSusPlanes(2);
        $this->assertEqual($orientacion, 3);
    }


    function testGetOrientacionSegunSusPlanes() {
       // $this->loadFixtures('Instit', 'Plan', 'Sector', 'Subsector', 'Orientacion');

        /*************** Para la Instit ID= 1 ****************************/
        $orientacion = $this->Instit->getOrientacionSegunSusPlanes(1);
        $this->assertEqual($orientacion, 3); //orientacion otros

        /* ************** Para la Instit ID= 2 *************************** */
        $orientacion = $this->Instit->getOrientacionSegunSusPlanes(2);
        $this->assertEqual($orientacion, 3);

        $orientacion = $this->Instit->getOrientacionSegunSusPlanes(3);
        $this->assertEqual($orientacion, 2);

        $orientacion = $this->Instit->getOrientacionSegunSusPlanes(4);
        $this->assertEqual($orientacion, 1);
    }

    function testIsCUEValid() {
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



    function testEstructuraPlanes(){
      //  $this->assertFalse($this->Instit->estructuraPlanes('depurados', 1,0));

        $ie = $this->Instit->estructuraPlanes('no-depurados', 2,0);
        $canti = count($ie['Plan']);
        $this->assertTrue(1 == $canti);

        $ie = $this->Instit->estructuraPlanes('depurados', 2,0);
        $canti = count($ie['Plan']);
        $this->assertTrue(1 == $canti);

        $ie = $this->Instit->estructuraPlanes('depurados', 4,0);
        $canti = count($ie['Plan']);
        $this->assertEqual(1 ,$canti);

        $ie = $this->Instit->estructuraPlanes('no-depurados', 4,0);
        $canti = count($ie['Plan']);
        $this->assertTrue(2 == $canti);
    }


    function testGetPlanesUltimos(){
        $ie = $this->Instit->getPlanes($instit_id=2, $oferta_id = 0, $ciclo_id = 2009);
       // debug($ie);

         $ie = $this->Instit->getPlanes($instit_id=4);

    
        $this->assertTrue(false);
    }

}
?>