<?php 
/* SVN FILE: $Id$ */
/* Instit Test cases generated on: 2009-09-17 10:09:16 : 1253194756*/
App::import('Model', 'Instit');
class TestInstit extends Instit {

	var $cacheSources = false;
}

class InstitTest extends CakeTestCase {

	function start() {
		parent::start();
		$this->Instit = new TestInstit();
	}

	
	function testGetSimilarEncuentraSimilar() {
		$data['Instit'] = array ('gestion_id'=>1, 'dependencia_id'=>1, 'nombre_dep'=>"''",      
        'tipoinstit_id' => 1, 'jurisdiccion_id' => 2, 'cue' => 200015, 'anexo' => 0 ,
        'esanexo' => 0, 'nombre' => "EUSTAQUIO CÁRDENAS", 
        'nroinstit' => "16 D.E. 03º", 'anio_creacion' => 1934, 
        'direccion' => "SALTA 1226", 'cp' => "1137", 'telefono' => "4305-1244", 
        'mail' => "''", 'web' => "''", 
        'dir_nombre' => "MÓNICA LILIANA UGARTE", 
        'dir_tipodoc_id' => 1, 'dir_nrodoc' => 13285880, 
        'dir_telefono' => "''", 'dir_mail' => "''", 
        'vice_nombre' => "ELISA SUSANA BARRERA", 'vice_tipodoc_id' => 1, 
        'vice_nrodoc' => 5940865, 'actualizacion' => "''",
        'observacion' => "''", 'fecha_mod' => "2007-03-26", 'activo' => 1, 
        'ciclo_alta' => 2007, 'ciclo_mod' => 0, 'created' => "", 
        'modified' => "2009-08-13 12:17:33", 'localidad_id' => 1493, 
        'departamento_id' => 1,'lugar' => "''");
		
		$similares = $this->Instit->getSimilars($data);		
		
		$this->assertEqual(count($similares),1,'estas instituciones son similares'); 
	}
	
	function testGetSimilarnoEncuentraInstitDistinta() {
		$data['Instit'] = array ('id' => 1, 'gestion_id'=>1, 'dependencia_id'=>1, 'nombre_dep'=>"''",      
        'tipoinstit_id' => 1, 'jurisdiccion_id' => 2, 'cue' => 200013, 'anexo' => 0 ,
        'esanexo' => 0, 'nombre' => "aaaaaaaaaaaaaaaaaaaa	", 
        'nroinstit' => "16 D.E. 03º", 'anio_creacion' => 1934, 
        'direccion' => "SALTA 1226", 'cp' => "1137", 'telefono' => "4305-1244", 
        'mail' => "''", 'web' => "''", 
        'dir_nombre' => "MÓNICA LILIANA UGARTE", 
        'dir_tipodoc_id' => 1, 'dir_nrodoc' => 13285880, 
        'dir_telefono' => "''", 'dir_mail' => "''", 
        'vice_nombre' => "ELISA SUSANA BARRERA", 'vice_tipodoc_id' => 1, 
        'vice_nrodoc' => 5940865, 'actualizacion' => "''",
        'observacion' => "''", 'fecha_mod' => "2007-03-26", 'activo' => 1, 
        'ciclo_alta' => 2007, 'ciclo_mod' => 0, 'created' => "", 
        'modified' => "2009-08-13 12:17:33", 'localidad_id' => 22222, 
        'departamento_id' => 1,'lugar' => "''");
		
		$similares = $this->Instit->getSimilars($data);
		
		$this->assertEqual(count($similares),0,'estas instituciones son distintas'); 
	}
}
?>