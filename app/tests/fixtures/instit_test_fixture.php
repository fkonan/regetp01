<?php 
class InstitTestFixture extends CakeTestFixture {
    var $name = 'InstitTest';
    
  
    var $fields = array( 
          'id' => 			array	('type' => 'integer', 	'key' => 'primary', 'null' => false), 
          'gestion_id' => 	array	('type' => 'integer', 	'null' => false),
      	  'dependencia_id'=>array	('type' => 'integer', 	'null' => false), 
          'nombre_dep' => 	array	('type' => 'string', 	'length' => 100, 	'null' => false), 
      	  'tipoinstit_id' =>array	('type' => 'integer', 	'null' => false),
      	  'jurisdiccion_id'=> array	('type' => 'integer', 	'null' => false),
      	  'cue' => 	array			('type' => 'integer', 	'null' => false, 	'default' => '0'),
      	  'anexo' => array			('type' => 'integer', 	'null' => false, 	'default' => '0'),
      	  'esanexo' => array		('type' => 'integer', 	'null' => false, 	'default' => '0'),
      	  'nombre' => array			('type' => 'string', 	'length' => 150, 	'null' => false),
      	  'nroinstit' => array		('type' => 'string', 	'length' => 20, 	'null' => false),
      	  'anio_creacion' => array	('type' => 'integer', 	'null' => false, 	'default' => '0'),
      	  'direccion' => array		('type' => 'string', 	'length' => 100, 	'null' => false),
      	  'cp' => array				('type' => 'string', 	'length' => 8, 		'null' => false),
      	  'telefono' => array		('type' => 'string', 	'length' => 60, 	'null' => false),
      	  'mail' => array			('type' => 'string', 	'length' => 60, 	'null' => false),
      	  'web' => array			('type' => 'string', 	'length' => 60, 	'null' => false),
   		  'dir_nombre' => array		('type' => 'string', 	'length' => 60, 	'null' => false),
      	  'dir_tipodoc_id' => array	('type' => 'integer', 	'null' => false, 	'default' => '0'),
      	  'dir_nrodoc' => array		('type' => 'integer', 	'null' => false, 	'default' => '0'),
      	  'dir_telefono' => array	('type' => 'string', 	'length' => 60, 	'null' => false),
      	  'dir_mail' => array		('type' => 'string', 	'length' => 60, 	'null' => false),
      	  'vice_nombre' => array	('type' => 'string', 	'length' => 60, 	'null' => false),
      	  'vice_tipodoc_id' => array('type' => 'integer', 	'null' => false, 	'default' => '0'),
      	  'vice_nrodoc' => array	('type' => 'integer', 	'null' => false, 	'default' => '0'),
      	  'actualizacion' => array	('type' => 'string', 	'length' => 30, 	'null' => false),
      	  'observacion' => array	('type' => 'text', 		'null' => false),
      	  'fecha_mod' => array		('type' => 'date'),
      	  'activo' => array			('type' => 'integer', 	'null' => false, 	'default' => '0'),
      	  'ciclo_alta' => array		('type' => 'integer', 	'null' => false, 	'default' => '0'),
      	  'ciclo_mod' => array		('type' => 'integer', 	'null' => false, 	'default' => '0'),
      	  'created' => array		('type' => 'timestamp'),
      	  'modified' => array		('type' => 'timestamp'),
      	  'localidad_id' => array	('type' => 'integer', 	'default' => '0'),
      	  'departamento_id' => array('type' => 'integer', 	'default' => '0'),
		  'lugar' => array			('type' => 'string', 	'length' => 110, 	'null' => false, 	'default' => "''")
   );
    
    
    
    var $records = array(
        array ('id' => 1, 'gestion_id'=>1, 'dependencia_id'=>1, 'nombre_dep'=>"''",      
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
        'departamento_id' => 1,'lugar' => "''"),
       
        /*
        array ('id' => 2, ),
        array ('id' => 3,)*/
    );
 
}
?> 