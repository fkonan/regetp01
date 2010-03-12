<?php

class PlanFixture  extends CakeTestFixture {
	var $name = 'Plan';
    //var $import = 'Plan';
    //var $import = array('model' => 'Plan', 'records' => true); 

    
      var $fields = array( 
	        'id' 			=> array	('type' => 'integer', 'key' => 'primary', 'null' => false),
			'instit_id'		=> array	('type' => 'integer', 'null' => false),
			'oferta_id'		=> array	('type' => 'integer', 'null' => false),
			'old_item'		=> array	('type' => 'integer', 'null' => false, 'default' => 0),
			'norma'			=> array	('type' => 'string', 'length' => 300, 'null' => false),
			'nombre'		=> array	('type' => 'string', 'length' => 200, 'null' => false),
			'perfil'		=> array	('type' => 'string', 'length' => 200, 'null' => false),
			'sector'		=> array	('type' => 'string', 'length' => 200, 'null' => false),
			'duracion_hs'	=> array	('type' => 'integer', 'null' => false, 'default' => 0),
			'duracion_semanas'=>array	('type' => 'integer', 'null' => false, 'default' => 0),
			'duracion_anios'=> array	('type' => 'integer', 'null' => false, 'default' => 0),
			'matricula'		=> array	('type' => 'integer', 'null' => false, 'default' => 0),
			'observacion'	=> array	('type' => 'string', 'length' => 1000, 'null' => false),
			'ciclo_alta'	=> array	('type' => 'integer', 'null' => false, 'default' => 0),
			'ciclo_mod'		=> array	('type' => 'integer', 'null' => false, 'default' => 0),
			'created'       => array	('type' => 'timestamp'),
	      	'modified' 		=> array	('type' => 'timestamp'),
			'sector_id'		=> array	('type' => 'integer', 'null' => false, 'default' => 0),
			'subsector_id'	=> array	('type' => 'integer', 'null' => false, 'default' => 0),
      );
      	  
    
    var $records = array(
    	array(
    		'id' 			=> 1,
			'instit_id'		=> 1,
			'oferta_id'		=> 1,
			'old_item'		=> 0,
			'norma'			=> "",
			'nombre'		=> "Titulo en nada",
			'perfil'		=> "Algun Perfil",
			'sector'		=> "",
			'duracion_hs'	=> 3,
			'duracion_semanas'=>2,
			'duracion_anios'=> 4,
			'matricula'		=> 100,
			'observacion'	=> "Alguna observacion",
			'ciclo_alta'	=> 2007,
			'ciclo_mod'		=> 0,
			//'created' 		=> "2010-01-21 13:54:45",
			//'modified' 		=> "2010-01-21 13:54:45",
			'sector_id'		=> 1, // Sector = Informatica -> Orientacion = Otros
			'subsector_id'	=> 1,
    	),
    	
    	
    	array(
    		'id' 			=> 2,
			'instit_id'		=> 2,
			'oferta_id'		=> 1,
			'old_item'		=> 0,
			'norma'			=> "",
			'nombre'		=> "Titulo 1 de institucion 2",
			'perfil'		=> "Algun Perfil",
			'sector'		=> "",
			'duracion_hs'	=> 3,
			'duracion_semanas'=>2,
			'duracion_anios'=> 4,
			'matricula'		=> 100,
			'observacion'	=> "Alguna observacion 1",
			'ciclo_alta'	=> 2007,
			'ciclo_mod'		=> 0,
			//'created' 		=> "2010-01-21 13:54:45",
			//'modified' 		=> "2010-01-21 13:54:45",
			'sector_id'		=> 1, // Sector = Informatica -> Orientacion = Otros
			'subsector_id'	=> 1,
    	),
    	array(
    		'id' 			=> 3,
			'instit_id'		=> 2,
			'oferta_id'		=> 1,
			'old_item'		=> 0,
			'norma'			=> "",
			'nombre'		=> "Titulo 2 de institucion 2",
			'perfil'		=> "Algun Perfil",
			'sector'		=> "",
			'duracion_hs'	=> 3,
			'duracion_semanas'=>2,
			'duracion_anios'=> 4,
			'matricula'		=> 100,
			'observacion'	=> "Alguna observacion 2",
			'ciclo_alta'	=> 2007,
			'ciclo_mod'		=> 0,
			//'created' 		=> "2010-01-21 13:54:45",
			//'modified' 		=> "2010-01-21 13:54:45",
			'sector_id'		=> 2, // Sector = gastronomia -> Orientacion = Otros
			'subsector_id'	=> 1,
    	),
    	
    	
    	array(
    		'id' 			=> 4,
			'instit_id'		=> 3,
			'oferta_id'		=> 1,
			'old_item'		=> 0,
			'norma'			=> "",
			'nombre'		=> "Titulo 1 de institucion 3",
			'perfil'		=> "Algun Perfil",
			'sector'		=> "",
			'duracion_hs'	=> 3,
			'duracion_semanas'=>2,
			'duracion_anios'=> 4,
			'matricula'		=> 100,
			'observacion'	=> "Alguna observacion 1",
			'ciclo_alta'	=> 2007,
			'ciclo_mod'		=> 0,
			//'created' 		=> "2010-01-21 13:54:45",
			//'modified' 		=> "2010-01-21 13:54:45",
			'sector_id'		=> 4, // Sector = Automotriz -> Orientacion = industrial
			'subsector_id'	=> 1,
    	),
    	array(
    		'id' 			=> 5,
			'instit_id'		=> 3,
			'oferta_id'		=> 1,
			'old_item'		=> 0,
			'norma'			=> "",
			'nombre'		=> "Titulo 2 de institucion 3",
			'perfil'		=> "Algun Perfil",
			'sector'		=> "",
			'duracion_hs'	=> 3,
			'duracion_semanas'=>2,
			'duracion_anios'=> 4,
			'matricula'		=> 100,
			'observacion'	=> "Alguna observacion 2",
			'ciclo_alta'	=> 2007,
			'ciclo_mod'		=> 0,
			//'created' 		=> "2010-01-21 13:54:45",
			//'modified' 		=> "2010-01-21 13:54:45",
			'sector_id'		=> 5, // Sector = Electronica -> Orientacion = industrial
			'subsector_id'	=> 1,
    	),
    	
    	
    	array(
    		'id' 			=> 6,
			'instit_id'		=> 4,
			'oferta_id'		=> 1,
			'old_item'		=> 0,
			'norma'			=> "",
			'nombre'		=> "Titulo 1 de institucion 4",
			'perfil'		=> "Algun Perfil",
			'sector'		=> "",
			'duracion_hs'	=> 3,
			'duracion_semanas'=>2,
			'duracion_anios'=> 4,
			'matricula'		=> 100,
			'observacion'	=> "Alguna observacion 1",
			'ciclo_alta'	=> 2007,
			'ciclo_mod'		=> 0,
			//'created' 		=> "2010-01-21 13:54:45",
			//'modified' 		=> "2010-01-21 13:54:45",
			'sector_id'		=> 3, // Sector = Agropecuaria -> Orientacion = Agropecuaria
			'subsector_id'	=> 1,
    	),
    );
}
?>