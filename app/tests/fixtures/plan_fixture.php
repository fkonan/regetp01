<?php

class PlanFixture  extends CakeTestFixture {
    var $name = 'Plan';

    var $fields = array(
            'id' 		=> array('type' => 'integer', 'key' => 'primary', 'null' => false),
            'instit_id'		=> array('type' => 'integer', 'null' => false),
            'oferta_id'		=> array('type' => 'integer', 'null' => false),
            'norma'		=> array('type' => 'string' , 'length' => 300, 'null' => false),
            'nombre'		=> array('type' => 'string' , 'length' => 200, 'null' => false),
            'perfil'		=> array('type' => 'string' , 'length' => 200, 'null' => false),
            'duracion_hs'	=> array('type' => 'integer', 'null' => false, 'default' => 0),
            'duracion_semanas'  => array('type' => 'integer', 'null' => false, 'default' => 0),
            'duracion_anios'    => array('type' => 'integer', 'null' => false, 'default' => 0),
            'matricula'		=> array('type' => 'integer', 'null' => false, 'default' => 0),
            'observacion'	=> array('type' => 'string' , 'length' => 1000, 'null' => false),
            'ciclo_alta'	=> array('type' => 'integer', 'null' => false, 'default' => 0),
            'titulo_id'		=> array('type' => 'integer', 'null' => false, 'default' => 0),
            'estructura_plan_id'=> array('type' => 'integer', 'null' => false, 'default' => 0),
    );


    var $records = array(
            array(
                'id' 			=> 1,
                'instit_id'		=> 1,
                'oferta_id'		=> 1,
                'norma'			=> "",
                'nombre'		=> "Titulo en nada",
                'perfil'		=> "Algun Perfil",
                'duracion_hs'	=> 3,
                'duracion_semanas'=>2,
                'duracion_anios'=> 4,
                'matricula'		=> 100,
                'observacion'	=> "Alguna observacion",
                'ciclo_alta'	=> 2007,
                'titulo_id'	=> 1,
                'estructura_plan_id'=> 0,
            ),
        
            array(
                'id' 			=> 2,
                'instit_id'		=> 2,
                'oferta_id'		=> 1,
                'norma'			=> "",
                'nombre'		=> "Titulo 1 de institucion 2",
                'perfil'		=> "Algun Perfil",
                'duracion_hs'	=> 3,
                'duracion_semanas'=>2,
                'duracion_anios'=> 4,
                'matricula'		=> 100,
                'observacion'	=> "Alguna observacion 1",
                'ciclo_alta'	=> 2007,
                'titulo_id'	=> 1,
                'estructura_plan_id'=> 2,
            ),
            array(
                'id' 			=> 3,
                'instit_id'		=> 2,
                'oferta_id'		=> 1,
                'norma'			=> "",
                'nombre'		=> "Titulo 2 de institucion 2",
                'perfil'		=> "Algun Perfil",
                'duracion_hs'	=> 3,
                'duracion_semanas'=>2,
                'duracion_anios'=> 4,
                'matricula'		=> 100,
                'observacion'	=> "Alguna observacion 2",
                'ciclo_alta'	=> 2007,
                'titulo_id'	=> 1,
                'estructura_plan_id'=> 0,
            ),


            array(
                'id' 			=> 4,
                'instit_id'		=> 3,
                'oferta_id'		=> 1,
                'norma'			=> "",
                'nombre'		=> "Titulo 1 de institucion 3",
                'perfil'		=> "Algun Perfil",
                'duracion_hs'	=> 3,
                'duracion_semanas'=>2,
                'duracion_anios'=> 4,
                'matricula'		=> 100,
                'observacion'	=> "Alguna observacion 1",
                'ciclo_alta'	=> 2007,
                'titulo_id'	=> 1,
                'estructura_plan_id'=> 0,
            ),
            array(
                'id' 			=> 5,
                'instit_id'		=> 3,
                'oferta_id'		=> 1,
                'norma'			=> "",
                'nombre'		=> "Titulo 2 de institucion 3",
                'perfil'		=> "Algun Perfil",
                'duracion_hs'	=> 3,
                'duracion_semanas'=>2,
                'duracion_anios'=> 4,
                'matricula'		=> 100,
                'observacion'	=> "Alguna observacion 2",
                'ciclo_alta'	=> 2007,
                'titulo_id'	=> 1,
                'estructura_plan_id'=> 0,
            ),
            array(
                'id' 			=> 6,
                'instit_id'		=> 4,
                'oferta_id'		=> 1,
                'norma'			=> "",
                'nombre'		=> "Titulo 1 de institucion 4",
                'perfil'		=> "Algun Perfil",
                'duracion_hs'	=> 3,
                'duracion_semanas'=>2,
                'duracion_anios'=> 4,
                'matricula'		=> 100,
                'observacion'	=> "Alguna observacion 1",
                'ciclo_alta'	=> 2007,
                'titulo_id'	=> 1,
                'estructura_plan_id'=> 0,
            ),
         array(
                'id' 			=> 7,
                'instit_id'		=> 4,
                'oferta_id'		=> 1,
                'norma'			=> "",
                'nombre'		=> "Titulo 1 de institucion 4",
                'perfil'		=> "Algun Perfil",
                'duracion_hs'	=> 3,
                'duracion_semanas'=>2,
                'duracion_anios'=> 4,
                'matricula'		=> 100,
                'observacion'	=> "Alguna observacion 1",
                'ciclo_alta'	=> 2007,
                'titulo_id'	=> 1,
                'estructura_plan_id'=> 0,
            ),
        array(
                'id' 			=> 8,
                'instit_id'		=> 4,
                'oferta_id'		=> 1,
                'norma'			=> "",
                'nombre'		=> "Titulo 1 de institucion 4",
                'perfil'		=> "Algun Perfil",
                'duracion_hs'	=> 3,
                'duracion_semanas'=>2,
                'duracion_anios'=> 4,
                'matricula'		=> 100,
                'observacion'	=> "Alguna observacion 1",
                'ciclo_alta'	=> 2007,
                'titulo_id'	=> 1,
                'estructura_plan_id'=> 1,
            ),



         array(
                'id' 			=> 9,
                'instit_id'		=> 5,
                'oferta_id'		=> 1,
                'norma'			=> "",
                'nombre'		=> "Titulo 1 de institucion 5",
                'perfil'		=> "Algun Perfil",
                'duracion_hs'	=> 5,
                'duracion_semanas'=>5,
                'duracion_anios'=> 5,
                'matricula'		=> 40,
                'observacion'	=> "Alguna observacion 1",
                'ciclo_alta'	=> 2004,
                'titulo_id'	=> 1,
                'estructura_plan_id'=> 1,
            ),
         array(
                'id' 			=> 10,
                'instit_id'		=> 5,
                'oferta_id'		=> 1,
                'norma'			=> "una norma",
                'nombre'		=> "Titulo 2 de institucion 5",
                'perfil'		=> "Algun Perfil 2",
                'duracion_hs'           => 4,
                'duracion_semanas'      => 3,
                'duracion_anios'        => 5,
                'matricula'		=> 200,
                'observacion'           => "Alguna observacion 2",
                'ciclo_alta'            => 2005,
                'titulo_id'             => 2,
                'estructura_plan_id'    => 1,
            ),
        array(
                'id' 			=> 11,
                'instit_id'		=> 5,
                'oferta_id'		=> 3,
                'norma'			=> "",
                'nombre'		=> "Titulo 3 de institucion 5",
                'perfil'		=> "Algun Perfil 3",
                'duracion_hs'           => 3,
                'duracion_semanas'      => 2,
                'duracion_anios'        => 4,
                'matricula'		=> 100,
                'observacion'           => "Alguna observacion 3",
                'ciclo_alta'            => 2008,
                'titulo_id'             => 55,
                'estructura_plan_id'    => 2,
            ),


        
    );
}
?>