<?php 
/* SVN FILE: $Id$ */
/* Plan Test cases generated on: 2010-04-22 12:01:13 : 1271948473*/
App::import('Model', 'Plan');

require_once dirname(__FILE__) . DS . '..' . DS . 'extra_functions.php';


class TestPlan extends Plan {
    var $cacheSources = false;
    var $useDbConfig = 'test_suite';
}

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
        parent::start();
        $this->Plan = new TestPlan();
        //$this->Plan =& ClassRegistry::init('Plan');
    }

    function testPlanInstance() {
        $this->assertTrue(is_a($this->Plan, 'Plan'));
    }

    function testFindReLoco() {
        //$this->Plan->recursive = -1;
        $p = $this->Plan->find('count');
        debug($p);
        die("trajjo algun plan?");
    }


    function testFindFPAsociaAnio(){
        /*
        'conditions'=>array(
                        'Instit.id'=> $institId,
                        'Titulo.oferta_id' => $ofertaId,
                        'Anio.ciclo_id' => $ciclo,
                        )
                    )
         *
         */
debug($this->Plan->find('all'));die;
        $conds = array(
//            'limit' => 20,
//            'page' => 1,
            'conditions' => array(
                    //'Anio.ciclo_id' => 2010,
                    //'Plan.oferta_id' => 1,
                    'Instit.id' => 1,
                ),
            //'asociarAnio' => 1,
            'order' => Array('Plan.nombre'),
        );
        $planes = array();
        $planes = $this->Plan->__findCompleto('buscar', $conds);
debug($this->Plan->find('all'));
debug($planes);
        $this->assertTrue(false);
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

    function testFindComun(){
        $institId = 2;
        $this->Plan->recursive = 0;
        $is1 = $this->Plan->find('all', array(
                    'conditions'=>array(
                        'Plan.instit_id' => $institId,
                        )
                    )
                );
        
        $cantPlanesQueHayEnFixture = 2;
        $this->assertEqual(count($is1), $cantPlanesQueHayEnFixture, "me tenia que haber traido $cantPlanesQueHayEnFixture planes");
        $this->assertEqual($is1[0]['Instit']['id'], $institId);
    }


    function testFindCompleto(){
        $this->Plan->recursive = 1;

        // BUSCO POR INSTIT
        //
        // 
        $institId = 2;
        $is1 = $this->Plan->find('completo', array(
                    'conditions'=>array(
                        'Instit.id' => $institId,
                        )
                    )
                );
        
        // verifico que todas las condiciones de la busqueda sean cumplidas.
        // o sea, que la Instit.id retornada sea la misma que la buscada
        foreach ($is1 as $i){
            $this->assertEqual($i['Instit']['id'], $institId);
        }


        // BUSCO POR OFERTA
        //
        //
        $ofertaId = 1;
        $is2 = $this->Plan->find('completo', array(
                    'conditions'=>array(
                        'Instit.id'=> $institId,
                        'Titulo.oferta_id' => $ofertaId,
                        )
                    )
                );
        
        // verifico que todas las condiciones de la busqueda sean cumplidas.
        // o sea, que la Instit.id y el Titulo.id sean los buscados
        foreach ($is2 as $i){
            $this->assertEqual($i['Instit']['id'], $institId);
            $this->assertEqual($i['Titulo']['oferta_id'], $ofertaId);
        }



        // BUSCO POR CICLO
        //
        //
        $ciclo = 2009;
        $is2 = $this->Plan->find('completo', array(
                    'asociarAnio' => true,
                    'conditions'=>array(
                        'Instit.id'=> $institId,
                        'Titulo.oferta_id' => $ofertaId,
                        'Anio.ciclo_id' => $ciclo,
                        )
                    )
                );
        
        // verifico que todas las condiciones de la busqueda sean cumplidas.
        // o sea, que la Instit.id y el Titulo.id Anio.ciclo_id sean los buscados
        foreach ($is2 as $i){
            foreach ($i['Anio'] as $a){
                $this->assertEqual($a['ciclo_id'], $ciclo);
                $this->assertTrue(!empty($a['EstructuraPlanesAnio']),'No asoci� el modelo EstructuraPlanesAnio');
                $this->assertTrue(!empty($a['Etapa']),'No asoci� el modelo Etapa');
            }
            
            $this->assertEqual($i['Instit']['id'], $institId);
            $this->assertEqual($i['Titulo']['oferta_id'], $ofertaId);
            
        }

        // BUSCO POR CICLO Y NO ASOCIO A�OS
        //
        //
        $ciclo = 2009;
        $is2 = $this->Plan->find('completo', array(
                    'asociarAnio' => false,
                    'conditions'=>array(
                        'Instit.id'=> $institId,
                        'Titulo.oferta_id' => $ofertaId,
                        'Anio.ciclo_id' => $ciclo,
                        )
                    )
                );

        // verifico que todas las condiciones de la busqueda sean cumplidas.
        // o sea, que la Instit.id y el Titulo.id Anio.ciclo_id sean los buscados
        foreach ($is2 as $i){
            foreach ($i['Anio'] as $a){
                $this->assertEqual($a['ciclo_id'], $ciclo);
                
                // al no asociar no me deberia traer ni la Estructura ni la Etapa
                $this->assertTrue(empty($a['EstructuraPlanesAnio']));
                $this->assertTrue(empty($a['Etapa']));
            }

            $this->assertEqual($i['Instit']['id'], $institId);
            $this->assertEqual($i['Titulo']['oferta_id'], $ofertaId);
        }

    }


    function testDameMatriculaDeCiclo(){
        $planId = 1;
        $matricula = $this->Plan->dameMatriculaDeCiclo( $planId );
        
        $plan = $this->Plan->read(null, $planId);
        $contMatricula = 0;
        foreach ($plan['Anio'] as $a) {
            $contMatricula += $a['matricula'];
        }

        $this->assertEqual( $contMatricula, $matricula );

        $planId = 1;
        $matricula = $this->Plan->dameMatriculaDeCiclo( $planId , 2010);

        $this->assertEqual( 2, $matricula );
    }



//    function testPaginatorSimple(){
//        $fields = $order = $limit =  $page = $recursive = $extra = null;
//        $conditions = array(
//            'Instit.id' => 1,
//        );
//        $limit = 999;
//
//        $planes = $this->Plan->paginate($conditions, $fields, $order, $limit, $page, $recursive, $extra);
//
//        $planesFind = $this->Plan->find('all',array(
//            'conditions'=> $conditions,
//            ));
//
//        $this->assertEqual($planes, $planesFind);
//    }
//
//    function testPaginatorAsociaAnio(){
//        $fields = $order = $limit =  $page = $recursive = null;
//        $conditions = array(
//            'Orientacion.id' => 2,
//        );
//        $extra = array(
//            'asociarAnio' => true,
//            'asociarCompleto' => true,
//            'contain' => array(
//                'Titulo' => array('SectoresTitulo' => array('Sector.Orientacion')),
//            )
//            );
//
//        $cantPlanes = $this->Plan->paginateCount($conditions, $recursive);
//        $planes = $this->Plan->paginate($conditions, $fields, $order, $limit, $page, $recursive, $extra);
//
//        $this->assertEqual($cantPlanes, count($planes));
//
//
//    }


}
?>