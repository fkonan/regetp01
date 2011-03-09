<?php 
/* SVN FILE: $Id$ */
/* Instit Test cases generated on: 2009-09-17 10:09:16 : 1253194756*/
App::import('Model', 'Instit');

class TestInstit extends Instit {
    var $cacheSources = false;
    var $useDbConfig = 'test_suite';
}

class InstitTestCase extends CakeTestCase {

    var $autoFixtures = true;
	 /* @var $fixtures array */
    var $fixtures = array(
            'app.anio',
            'app.ciclo',
            'app.claseinstit',
            'app.departamento',
            'app.dependencia',
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
            'app.localidad',
            'app.oferta',
            'app.orientacion',
            'app.plan',
            'app.sector',
            'app.sectores_titulo',
            'app.subsector',
            'app.ticket',
            'app.tipoinstit', 
            'app.titulo',
            'app.user',
            'app.user_login',
            'app.z_fondo_work',
        );

    var $Instit = null;
	 
    function start() {
        parent::start();
	$this->Instit = new TestInstit();
    }

    function testInstitInstance() {
		$this->assertTrue(is_a($this->Instit, 'Instit'));
    }

    function testInstitFind() {
            $instit_id = rand(100000,95959595);
            $this->Instit->recursive = -1;
            $results = $this->Instit->find('first', array('conditions'=> array('id'=>1)));
            $this->assertTrue(!empty($results));

            $expected['Instit'] = array(
            'id' => 1,
            'gestion_id'=>1,
            'dependencia_id'=>1,
            'nombre_dep'=>"''",
            'tipoinstit_id' => 33,
            'jurisdiccion_id' => 2,
            'cue' => 200192, 'anexo' => 0 , 'esanexo' => 0,
            'nombre' => "FERNANDO FADER",
            'nroinstit' => "06",
            'anio_creacion' => 1934,
            'direccion' => "SALTA 1226",
            'cp' => "1137",
            'telefono' => "4305-1244",
            'mail' => "''",
            'web' => "''",
            'dir_nombre' => "MÓNICA LILIANA UGARTE",
            'dir_tipodoc_id' => 1,
            'dir_nrodoc' => 13285880,
            'dir_telefono' => "''", 'dir_mail' => "''",
            'vice_nombre' => "ELISA SUSANA BARRERA", 'vice_tipodoc_id' => 1,
            'vice_nrodoc' => 5940865, 'actualizacion' => "''",
            'observacion' => "''", 'activo' => 1,
            'ciclo_alta' => 2007,
            'created' => '2007-03-18 10:43:23',
            //'modified' => "'2009-08-13 12:17:33'",
            'localidad_id' => 1,
            'departamento_id' => 1,'lugar' => "''",
            
            );
            debug($expected);
            $this->assertEqual($results, $expected);
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

        $instit_id = rand(10000,999999999);
        $instit['Instit'] = array(
                'id'                => $instit_id,
        );
        $this->Instit->create();
        $this->Instit->save($instit);

        /*************** Para la Instit ID= 1 ****************************/
        $plan1_id = rand(10000,999999999);
        $plan['Plan'] = array(
                'id'                => $plan1_id,
                'instit_id'         => $instit_id ,
                'oferta_id'         => 1,
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
                //'created' 		=> "2010-01-21 13:54:45",
                //'modified' 		=> "2010-01-21 13:54:45",
                'sector_id'         => 3, // Sector = Agropecuaria -> Orientacion = Agropecuaria
                'subsector_id'      => 1,
        );
        $this->Instit->Plan->create();
        $this->Instit->Plan->save($plan, false);
        $orientacion = $this->Instit->getOrientacionSegunSusPlanes($instit_id);
        $this->Instit->id = $instit_id;
        debug($this->Instit->find('list'));
        debug($this->Instit->read());
        $this->assertEqual($orientacion, 1); //orientacion agro


        /*************** Para la Instit ID= 2 ****************************/
        $plan2_id = $plan1_id++;
        $plan['Plan'] = array(
                'id'                => $plan2_id,
                'instit_id'         => $instit_id,
                'oferta_id'         => 1,
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
                'sector_id'         => 4, //Sector Automotriz -- Orientacion = Industrial
                'subsector_id'      => 1,
        );
        $this->Instit->Plan->create();
        $this->Instit->Plan->save($plan, false);
        $orientacion = $this->Instit->getOrientacionSegunSusPlanes($instit_id);
        $this->assertEqual($orientacion, 0); //orientacion mixta

        $this->Instit->Plan->del($plan1_id);
        $orientacion = $this->Instit->getOrientacionSegunSusPlanes($instit_id);
        $this->assertEqual($orientacion, 2); // orientacion industrial
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



    function testFindConNombreCompleto(){
        $this->assertTrue(false);
    }

}
?>