<?php 
/* SVN FILE: $Id$ */
/* Fondo Fixture generated on: 2010-04-22 10:25:00 : 1271942700*/

class FondoFixture extends CakeTestFixture {
    var $name = 'Fondotemporal';
    var $table = 'z_fondo_work';
    
    var $fields = array(
    'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'length' => 11, 'key' => 'primary'),
    'linea' => array('type'=>'integer', 'default' => 0),
    'tipo' => array('type'=>'string', 'default' => ''),
    'anio' => array('type'=>'integer', 'default' => 0),
    'trimestre' => array('type'=>'integer', 'default' => 0),
    'jurisdiccion_id' => array('type'=>'integer', 'default' => 0),
    'jurisdiccion_name' => array('type'=>'string', 'default' => ''),
    'memo' => array('type'=>'string', 'default' => ''),
    'cuecompleto' => array('type'=>'string', 'default' => ''),
    'instit' => array('type'=>'string', 'default' => ''),
    'instit_name' => array('type'=>'string', 'default' => ''),
    'departamento' => array('type'=>'string', 'default' => ''),
    'localidad' => array('type'=>'string', 'default' => ''),
    'trimestre' => array('type'=>'integer', 'default' => 0),
    'f01' => array('type'=>'float', 'null' => false, 'default' => '0'),
    'f02a' => array('type'=>'float', 'null' => false, 'default' => '0'),
    'f02b' => array('type'=>'float', 'null' => false, 'default' => '0'),
    'f02c' => array('type'=>'float', 'null' => false, 'default' => '0'),
    'f03a' => array('type'=>'float', 'null' => false, 'default' => '0'),
    'f03b' => array('type'=>'float', 'null' => false, 'default' => '0'),
    'f04' => array('type'=>'float', 'null' => false, 'default' => '0'),
    'f05' => array('type'=>'float', 'null' => false, 'default' => '0'),
    'f06a' => array('type'=>'float', 'null' => false, 'default' => '0'),
    'f06b' => array('type'=>'float', 'null' => false, 'default' => '0'),
    'f06c' => array('type'=>'float', 'null' => false, 'default' => '0'),
    'f07a' => array('type'=>'float', 'null' => false, 'default' => '0'),
    'f07b' => array('type'=>'float', 'null' => false, 'default' => '0'),
    'f07c' => array('type'=>'float', 'null' => false, 'default' => '0'),
    'f08' => array('type'=>'float', 'null' => false, 'default' => '0'),
    'f09' => array('type'=>'float', 'null' => false, 'default' => '0'),
    'f10' => array('type'=>'float', 'null' => false, 'default' => '0'),
    'total' => array('type'=>'float', 'null' => false, 'default' => '0'),
    'equipinf' => array('type'=>'float', 'null' => false, 'default' => '0'),
    'observacion' => array('type'=>'float', 'null' => false, 'default' => '0'),
    'resolucion' => array('type'=>'integer', 'length' => 20'default'=>0),
    'description' => array('type'=>'text', 'null' => false, 'length' => 1073741824),
    'totales_checked' => array('type'=>'integer', 'length' => 20'default'=>0),
    'cue_checked' => array('type'=>'integer', 'length' => 20'default'=>0),
    );
    
    var $records = array(array(
        'id' => 1,
        'linea' => 1,
        'tipo' => 'i',
        'anio' => 2009,
        'trimestre' => 1,
        'jurisdiccion_id' => 2,
        'jurisdiccion_name' => array('type'=>'string', 'default' => 'CABA'),
        'memo' => '5644',
        'cuecompleto' => '2456801',
        'instit' => 1,
        'instit_name' => ,
        'departamento' => array('type'=>'string', 'default' => ''),
        'localidad' => array('type'=>'string', 'default' => ''),
        'trimestre' => array('type'=>'integer', 'default' => 0),
        'f01' => array('type'=>'float', 'null' => false, 'default' => '0'),
        'f02a' => array('type'=>'float', 'null' => false, 'default' => '0'),
        'f02b' => array('type'=>'float', 'null' => false, 'default' => '0'),
        'f02c' => array('type'=>'float', 'null' => false, 'default' => '0'),
        'f03a' => array('type'=>'float', 'null' => false, 'default' => '0'),
        'f03b' => array('type'=>'float', 'null' => false, 'default' => '0'),
        'f04' => array('type'=>'float', 'null' => false, 'default' => '0'),
        'f05' => array('type'=>'float', 'null' => false, 'default' => '0'),
        'f06a' => array('type'=>'float', 'null' => false, 'default' => '0'),
        'f06b' => array('type'=>'float', 'null' => false, 'default' => '0'),
        'f06c' => array('type'=>'float', 'null' => false, 'default' => '0'),
        'f07a' => array('type'=>'float', 'null' => false, 'default' => '0'),
        'f07b' => array('type'=>'float', 'null' => false, 'default' => '0'),
        'f07c' => array('type'=>'float', 'null' => false, 'default' => '0'),
        'f08' => array('type'=>'float', 'null' => false, 'default' => '0'),
        'f09' => array('type'=>'float', 'null' => false, 'default' => '0'),
        'f10' => array('type'=>'float', 'null' => false, 'default' => '0'),
        'total' => array('type'=>'float', 'null' => false, 'default' => '0'),
        'equipinf' => array('type'=>'float', 'null' => false, 'default' => '0'),
        'observacion' => array('type'=>'float', 'null' => false, 'default' => '0'),
        'resolucion' => array('type'=>'integer', 'length' => 20'default'=>0),
        'description' => array('type'=>'text', 'null' => false, 'length' => 1073741824),
        'totales_checked' => array('type'=>'integer', 'length' => 20'default'=>0),
        'cue_checked' => array('type'=>'integer', 'length' => 20'default'=>0),
       /*
    'id' => 1,
    'instit_id' => 1,
    'jurisdiccion_id' => 1,
    'total' => 1,
    'anio' => 1,
    'trimestre' => 1,
    'memo' => 'Lorem ipsum dolor ',
    'resolucion' => 'Lorem ipsum dolor ',
    'description' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida,phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam,vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit,feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
    'created' => '2010-04-22 10:25:00',
    'modified' => '2010-04-22 10:25:00'
        */
    ));
}
?>