<?php 
/* SVN FILE: $Id$ */
/* Instit Test cases generated on: 2009-09-17 10:09:16 : 1253194756*/
App::import('Model', 'Instit');


function arrays_are_similar($a, $b) {
  // if the indexes don't match, return immediately
  if (count(array_diff_assoc($a, $b))) {
    return false;
  }
  // we know that the indexes, but maybe not values, match.
  // compare the values between the two arrays
  foreach($a as $k => $v) {
    if ($v !== $b[$k]) {
      return false;
    }
  }
  // we have identical indexes, and no unequal values
  return true;
}

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
    }


     function testInstitSave() {
         $instit_id = rand(100000,95959595)+2;
            $expected['Instit'] =  array (
                'id' => $instit_id,
                'gestion_id'=>1,
                'dependencia_id'=>1,
                'nombre_dep'=>"''",
                'tipoinstit_id' => 33,
                'jurisdiccion_id' => 2,
                'cue' => 200192,
                'anexo' => 0 ,
                'esanexo' => 0,
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
                'vice_nombre' => "ELISA SUSANA BARRERA",
                'vice_tipodoc_id' => 1,
                'vice_nrodoc' => 5940865,
                'actualizacion' => "''",
                'observacion' => "''",
                'activo' => 1,
                'ciclo_alta' => 2007,
                'created' => '2007-03-18 10:43:23',
                //'modified' => "2009-08-13 12:17:33",
                'localidad_id' => 1,
                'departamento_id' => 1,
                'lugar' => "''",
                 'mail_alternativo' => '',
                'telefono_alternativo' => '',
                'etp_estado_id' => 0,
                'claseinstit_id' => 0,
                'orientacion_id' => 0,
            );
            
            //$this->Instit->create();
            $this->assertTrue($this->Instit->save($expected, false));
            $expected['Instit']['id'] = $this->Instit->id;
            //debug($this->Instit);
            $this->Instit->recursive = -1;
            $results = $this->Instit->read(null, $instit_id);
            unset ($results['Instit']['nombre_completo']);
            unset ($results['Instit']['modified']);
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
        // orientaciones posibles
        //  -1. Instit Sin planes
        //   0. Mixta
        //   1. Agropecuaria
        //   2. Industrial
        //   3. Otros
        
        $instit_id = 1;
        $this->Instit->recursive = 1;

        $orientacion = $this->Instit->getOrientacionSegunSusPlanes($instit_id); // del sector informatica, orientacion "Otros"
        $this->assertEqual($orientacion, 2); //orientacion agro

        /*************** Para la Instit ID= 2 ****************************/
        $plan2_id = rand(10000,8999999);
        $plan['Plan'] = array(
                'id'                => $plan2_id,
                'instit_id'         => $instit_id,
                'oferta_id'         => 1,
                'norma'             => "",
                'nombre'            => "Titulo en nada",
                'perfil'            => "Algun Perfil",
                'duracion_hs'       => 3,
                'duracion_semanas'  => 2,
                'duracion_anios'    => 4,
                'matricula'         => 100,
                'observacion'       => "Alguna observacion",
                'ciclo_alta'        => 2007,
                'titulo_id'         => 55, // de orientacion "otros"
        );
        $this->Instit->Plan->create();
        $this->assertTrue($this->Instit->Plan->save($plan, false),'No se pudo guardar un nuevo plan con id: '.$plan2_id.' o este: '.$this->Instit->Plan->id);
        $orientacion = $this->Instit->getOrientacionSegunSusPlanes($instit_id);
        $this->assertEqual($orientacion, 0); //orientacion mixta

        $this->Instit->Plan->del(1); // el que era de sector informatica, orientacion otros
        $orientacion = $this->Instit->getOrientacionSegunSusPlanes($instit_id);
        $this->assertEqual($orientacion, 3); // orientacion industrial
    }


    function testGetOrientacionSegunSusPlanes() {
       // $this->loadFixtures('Instit', 'Plan', 'Sector', 'Subsector', 'Orientacion');

        /*************** Para la Instit ID= 1 ****************************/
        $orientacion = $this->Instit->getOrientacionSegunSusPlanes(1);
        $this->assertEqual($orientacion, 2);

        /* ************** Para la Instit ID= 2 *************************** */
        $orientacion = $this->Instit->getOrientacionSegunSusPlanes(2);
        $this->assertEqual($orientacion, 2);

        $orientacion = $this->Instit->getOrientacionSegunSusPlanes(3);
        $this->assertEqual($orientacion, 2);

        $orientacion = $this->Instit->getOrientacionSegunSusPlanes(4);
        $this->assertEqual($orientacion, 2);
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
        $this->assertFalse($this->Instit->estructuraPlanes('depurados', 1,0));

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
        
        // busco para el año 2010 que se que hay
        $anioBusca = 2010;
        $ie = $this->Instit->getPlanes(array(
            'Instit.id' => 1,
            'Plan.oferta_id' => 1,
            'Ciclo.id'  => $anioBusca,
        ));
        $encontrado = false;
        foreach($ie as $plan){
            foreach ($plan['Anio'] as $anio){
                $encontrado = ($anio['ciclo_id'] == $anioBusca)?true:false;
                if ( $encontrado ) break;
            }
            if ( $encontrado ) break;
        }
        $this->assertTrue($encontrado);

        // busco para el año 2009 que se que hay
        $anioBusca = 2009;
        $ie = $this->Instit->getPlanes(array(
            'Instit.id' => 1,
            'Plan.oferta_id' => 1,
            'Ciclo.id'  => $anioBusca,
        ));
        $encontrado = false;
        foreach($ie as $plan){
            foreach ($plan['Anio'] as $anio){
                $encontrado = ($anio['ciclo_id'] == $anioBusca)?true:false;
                if ( $encontrado ) break;
            }
            if ( $encontrado ) break;
        }
        $this->assertTrue($encontrado);


        // busco para el año 2000 que se que NO hay
        $anioBusca = 2000;
        $ie = $this->Instit->getPlanes(array(
            'Instit.id' => 1,
            'Plan.oferta_id' => 1,
            'Ciclo.id'  => $anioBusca,
        ));
        $encontrado = false;
        foreach($ie as $plan){
            foreach ($plan['Anio'] as $anio){
                $encontrado = ($anio['ciclo_id'] == $anioBusca)?true:false;
                if ( $encontrado ) break;
            }
            if ( $encontrado ) break;
        }
        $this->assertFalse($encontrado);


        $ie = $this->Instit->getPlanes(array(
            'Instit.id' => 2,
        ));
        $this->assertEqual(count($ie),2); // hay 2 planes
        $this->assertEqual(count($ie[0]['Anio']),1); // hay el perimer plan tiene 3 años
        $this->assertEqual(count($ie[1]['Anio']),3); // hay el segundo plan tiene 3 años

    }



    function testFindConNombreCompleto(){
        $nombre = 'ESCUELA DE EDUCACIÓN TÉCNICA (E.E.T.) Nº 06  "FERNANDO FADER TEST"';
        $this->Instit->recursive = 0;
        $iii = $this->Instit->find('first', array('conditions'=>array('Instit.id'=>1)));

        $this->assertFalse($iii['Instit']['nombre_completo']=='Un nombre cualquiera');
        $this->assertTrue($iii['Instit']['nombre_completo']);
        $this->assertTrue($iii['Instit']['nombre_completo']==$nombre);

        $iii = $this->Instit->find('all', array('conditions'=>array('Instit.id'=>1)));
        $this->assertTrue($iii[0]['Instit']['nombre_completo'] == $nombre);
    }


    function testDameSumatoriaDeMatriculasPorOferta(){
        $this->Instit->id = 1;
        $rta = $this->Instit->dameSumatoriaDeMatriculasPorOferta();

        $expected = Array(
            'array_de_ofertas' => Array(
                0 => Array(
                        'id' => 1,
                        'abrev' => 'Lorem ip'
                    )
                ),
             'array_de_ciclos' => Array(
                0 => 2010,
                1 => 2009,
                 ),
            'totales' => Array(
                2010 => Array(
                    'Lorem ip' => Array(
                            'total_matricula' => 2
                        )
                ),
                2009 => Array(
                    'Lorem ip' => Array(
                            'total_matricula' => 5
                        )
                )
            )
        );

        $this->assertEqual($rta, $expected);
    }

    function testListSectoresConOferta(){
        $res = $this->Instit->listSectoresConOferta(1,1);
        $expected = array( 8 => 'Construcción');
        $this->assertEqual($res, $expected);
        
        $res = $this->Instit->listSectoresConOferta(5,1);
        $expected = array( 
            8 => 'Construcción',
            2 => 'Aeronáutica',
            );
        $this->assertEqual($res, $expected);
        
        $res = $this->Instit->listSectoresConOferta(5,3);
        $expected = array(
            24 => 'Seguridad, Ambiente e Higiene');
        $this->assertEqual($res, $expected);

        $res = $this->Instit->listSectoresConOferta(5,2);
        $this->assertTrue(empty($res));

        $res = $this->Instit->listSectoresConOferta(5);
        $expected = array(
            8 => 'Construcción',
            2 => 'Aeronáutica',
            24 => 'Seguridad, Ambiente e Higiene',
            );
         $this->assertEqual($res, $expected);
    }

}
?>