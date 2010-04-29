<?php 
/* SVN FILE: $Id$ */
/* ZFondoWork Test cases generated on: 2010-04-22 12:01:13 : 1271948473*/
App::import('Model', 'ZFondoWork');

class ZFondoWorkTestCase extends CakeTestCase {
    /**
     * @var ZFondoWork
     */
    var $ZFondoWork = null;

    /* @var $fixtures array */
    var $fixtures = array(
         'app.z_fondo_work', 'app.jurisdiccion', 'app.instit', 'app.claseinstit',
         'app.orientacion',  'app.sector', 'app.plan', 'app.subsector',
         'app.lineas_de_accion', 'app.fondos_lineas_de_accion',
        );
//    var $fixtures = array(
//            'app.z_fondo_work', 'app.jurisdiccion', 'app.instit', 'app.claseinstit',
//            'app.lineas_de_accion', 'app.fondos_lineas_de_accion', 'app.orientacion',
//            'app.sector', 'app.plan', 'app.subsector');

    function startTest() {
        $this->ZFondoWork =& ClassRegistry::init('ZFondoWork');

    }

    function testZFondoWorkInstance() {
        $this->assertTrue(is_a($this->ZFondoWork, 'ZFondoWork'));
    }

    function testZFondoWorkFind() {
        $this->ZFondoWork->recursive = -1;
        $results = $this->ZFondoWork->find('first');
        $this->assertTrue(!empty($results));
        $expected['ZFondoWork'] = array(
                'id' => 1,
                'anio' => 2009,
                'trimestre' => 1,
                'jurisdiccion_id' => 2,
                'jurisdiccion_name' => 'CABA',
                'memo' => 'Lorem ipsum dolor sit amet',
                'cuecompleto' => '24567801',
                'instit' => 'Lorem ipsum dolor sit amet',
                'instit_name' => 'Lorem ipsum dolor sit amet',
                'departamento' => 'Lorem ipsum dolor sit amet',
                'localidad' => 'Lorem ipsum dolor sit amet',
                'f01' => 10,
                'f02a' => 0,
                'f02b' => 0,
                'f02c' => 0,
                'f03a' => 0,
                'f03b' => 0,
                'f04' => 0,
                'f05' => 15,
                'f06a' => 0,
                'f06b' => 0,
                'f06c' => 0,
                'f07a' => 0,
                'f07b' => 0,
                'f07c' => 0,
                'f08' => 0,
                'f09' => 0,
                'total' => 25,
                'f10' => 0,
                'equipinf' => 0,
                'refaccion' => 0,
                'instit_id' => 1,
                'observacion' => 'Lorem ipsum dolor sit amet',
                'totales_checked' => 1,
                'cue_checked' => 1,
                'tipo' => 'i',
        );
        $this->assertEqual($results, $expected);
    }


    function testTemporalesFiltradosX() {
        $t1 = $this->ZFondoWork->__temporalesFiltradosX('j');
        $this->assertEqual(0, count($t1));

        $t1 = $this->ZFondoWork->__temporalesFiltradosX('ij');
        $this->assertEqual(1, count($t1));

        $t1 = $this->ZFondoWork->__temporalesFiltradosX('ijt');
        $this->assertEqual(1, count($t1));

        $t1 = $this->ZFondoWork->__temporalesFiltradosX('tji');
        $this->assertEqual(1, count($t1));

        $t1 = $this->ZFondoWork->__temporalesFiltradosX('i');
        $this->assertEqual(1, count($t1));
    }


    function testLineasDeAccionesWithNameLowercaseAsId() {
        $lineas = $this->ZFondoWork->__getLineasDeAccionesWithNameLowercaseAsId();

        $this->assertTrue(is_array($lineas));

        $cont = 0;
        foreach ($lineas as $name=>$id) {
            $this->assertTrue(is_string($name));
            $this->assertTrue(is_numeric($id));
            $cont++;
        }
        $this->assertEqual($cont,count($lineas));
    }




    function testVerificarQueLasLineasExistanEnFondo() {
        $l = array('f01'=>1);
        $m = array('g01'=>1);
        $t = array('ZFondoWork'=>array(
                        'id' => 1,
                        'anio' => 2009,
                        'trimestre' => 1,
                        'jurisdiccion_id' => 2,
                        'jurisdiccion_name' => 'CABA',
                        'memo' => 'Lorem ipsum dolor sit amet',
                        'cuecompleto' => 24567801,
                        'instit' => 'Lorem ipsum dolor sit amet',
                        'instit_name' => 'Lorem ipsum dolor sit amet',
                        'departamento' => 'Lorem ipsum dolor sit amet',
                        'localidad' => 'Lorem ipsum dolor sit amet',
                        'f01' => 10,
                        'f02a' => 0,
                        'f02b' => 0,
                        'f02c' => 0,
        ));

        $this->assertEqual ('',$this->ZFondoWork->__verificarQueLasLineasExistanEnFondo($l,$t['ZFondoWork']));
        $this->assertTrue($this->ZFondoWork->__verificarQueLasLineasExistanEnFondo($m,$t['ZFondoWork']));

    }



    function testDameTemporalFiltrandoLineasVacias() {
        $l = array('f01'=>1, 'f02a' => 2, 'f02b' => 3, 'f02c' => 4);
        
        $t[3]['ZFondoWork'] = array(
                'id' => 15,
                'anio' => 2009,
                'trimestre' => 1,
                'jurisdiccion_id' => 2,
                'jurisdiccion_name' => 'CABA',
                'memo' => 'Lorem ipsum dolor sit amet',
                'cuecompleto' => 24567801,
                'instit' => 'Lorem ipsum dolor sit amet',
                'instit_name' => 'Lorem ipsum dolor sit amet',
                'departamento' => 'Lorem ipsum dolor sit amet',
                'localidad' => 'Lorem ipsum dolor sit amet',
                'f01' => 10,
                'f02a' => 0,
                'f02b' => 0,
                'f02c' => 0,
                );

        $t[13]['ZFondoWork'] = array(
                'id' => 21,
                'anio' => 2009,
                'trimestre' => 1,
                'jurisdiccion_id' => 2,
                'jurisdiccion_name' => 'CABA',
                'memo' => 'Lorem ipsum dolor sit amet',
                'cuecompleto' => 24567801,
                'instit' => 'Lorem ipsum dolor sit amet',
                'instit_name' => 'Lorem ipsum dolor sit amet',
                'departamento' => 'Lorem ipsum dolor sit amet',
                'localidad' => 'Lorem ipsum dolor sit amet',
                'f01' => 0,
                'f02a' => 40,
                'f02b' => 0,
                'f02c' => 20,
        );


        $lin = $this->ZFondoWork->__dameTemporalFiltrandoLineasVacias($l, $t);
        $expected = array(
                3  => array( 'f01'  => 10 ),
                13 => array( 'f02a' => 40, 'f02c'=>20 ),
        );

        $this->assertEqual($expected, $lin);

        unset($t);
         $t[0]['ZFondoWork'] = array(
                'id' => 15,
                'anio' => 2009,
                'trimestre' => 1,
                'jurisdiccion_id' => 2,
                'jurisdiccion_name' => 'CABA',
                'memo' => 'Lorem ipsum dolor sit amet',
                'cuecompleto' => 24567801,
                'instit' => 'Lorem ipsum dolor sit amet',
                'instit_name' => 'Lorem ipsum dolor sit amet',
                'departamento' => 'Lorem ipsum dolor sit amet',
                'localidad' => 'Lorem ipsum dolor sit amet',
                'f01' =>  0,
                'f02a' => 0,
                'f02b' => 0,
                'f02c' => 0,
                );
         $lin = $this->ZFondoWork->__dameTemporalFiltrandoLineasVacias($l, $t);
         //veo que me devuelva un array
         $this->assertTrue(is_array($lin));
         if(is_array($lin)){
             //verifico que el array este vacio
            $this->assertEqual(0, count($lin[0]));
         }
    }



    function testConvertirLineasYTempsEnAlgoLindoParaGuardar() {
        $aLineasDeAcciones = $this->ZFondoWork->__getLineasDeAccionesWithNameLowercaseAsId();
        //$aLineasDeAcciones = array('f01' => 1, 'f02a' => 2);
        // traerme los registros de z_fondo_work
        $temps = array(array(
                        'ZFondoWork' => array
                        (
                                'id' => 1,
                                'anio' => 2009,
                                'trimestre' => 1,
                                'jurisdiccion_id' => 2,
                                'jurisdiccion_name' => 'CABA',
                                'memo' => 'Lorem ipsum dolor sit amet',
                                'cuecompleto' => 24567801,
                                'instit' => 'Lorem ipsum dolor sit amet',
                                'instit_name' => 'Lorem ipsum dolor sit amet',
                                'departamento' => 'Lorem ipsum dolor sit amet',
                                'localidad' => 'Lorem ipsum dolor sit amet',
                                'f01' => 10,
                                'f02a' => 0,
                                'f02b' => 0,
                                'f02c' => 0,
                                'f03a' => 0,
                                'f03b' => 0,
                                'f04' => 0,
                                'f05' => 15,
                                'f06a' => 0,
                                'f06b' => 0,
                                'f06c' => 0,
                                'f07a' => 0,
                                'f07b' => 0,
                                'f07c' => 0,
                                'f08' => 0,
                                'f09' => 0,
                                'f10' => 0,
                                'equipinf' => 0,
                                'refaccion' => 0,
                                'total' => 25,                                
                                'instit_id' => 1,
                                'observacion' => 'Lorem ipsum dolor sit amet',
                                'totales_checked' => 1,
                                'cue_checked' => 1,
                                'tipo' => 'i',                                
                        )
                )
        );

        //$verificado = $this->ZFondoWork->__verificarQueLasLineasExistanEnFondo($aLineasDeAcciones, $temps[0]['ZFondoWork']);

        /** @var array  */
        $lineasFiltradas = $this->ZFondoWork->__dameTemporalFiltrandoLineasVacias($aLineasDeAcciones, $temps);


        $expected[0]['Fondo'] = array (
                            'instit_id' => 1,
                            'jurisdiccion_id' => 2,
                            'memo' => 'Lorem ipsum dolor sit amet',
                            'anio' => 2009,
                            'trimestre' => 1,
                            'total' => 25,
                        );
        
        $expected[0]['Fondo']['FondosLineasDeAccion'] = array(
                    array(
                            'monto' => 10,
                            'lineas_de_accion_id' => 1,
                        ),
                    array(
                            'monto' => 15,
                            'lineas_de_accion_id' => 7,
                        )
                );


        $data = $this->ZFondoWork->__convertirLineasYTempsEnAlgoLindoParaGuardar($temps, $lineasFiltradas);

        $this->assertEqual($expected, $data);
    }



    function testGuardarFondos(){
        // $this->assertTrue($this->ZFondoWork->guardarFondos($data));
         $data[0]['Fondo'] = array (
                            'instit_id' => 2,
                            'jurisdiccion_id' => 2,
                            'memo' => 'Lorem ipsum',
                            'anio' => 2009,
                            'trimestre' => 1,
                            'total' => 25,
                        );
        $data[0]['FondosLineasDeAccion'] = array(
                    array(
                            'monto' => 10,
                            'lineas_de_accion_id' => 1,
                        ),
                    array(
                            'monto' => 15,
                            'lineas_de_accion_id' => 7,
                        )
                );

        $this->assertTrue($this->ZFondoWork->guardarFondos($data));

       // debug($this->ZFondoWork);

        /* @var $fondo Fondo */
        $fondo =& ClassRegistry::init('Fondo');
        $fondo->recursive = 1;
         /* @var $lineas LineasDeAccion */
        $lineas =& ClassRegistry::init('FondosLineasDeAccion');
        $lineas->recursive = -1;
        debug($fondo->find('all'));
    }


}
?>