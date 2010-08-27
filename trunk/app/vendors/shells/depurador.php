<?php

class DepuradorShell extends Shell {
    var $uses = array('Instit','Plan','Sector','Jurisdiccion', 'Tipoinstit');

    function main($command = null) {
        while (true) {
            if (empty($command)) {
                $command = trim($this->in(''));
            }

            switch ($command) {
                case '':
                case 'help':
                    $this->out('Ayuda del Depurador:');
                    $this->out('-------------');
                    $this->out('debe escribir alguna opción');
                    $this->out('Las opciones son:');
                    $this->out('');
                    $this->out('1) "anios_correlativos"');
                    $this->out('2) "arreglar_anios_sgn_estructura": me indica cuales son los años, dentro de los correctos, que no coinciden con una estructura válida.');
                    $this->out('');
                    break;

                case 1:
                case 'anios_correlativos':
                    $this->anios_correlativos();
                    break;

                case 2:
                case 'arreglar_anios_sgn_estructura':
                    $this->arreglar_anios_sgn_estructura();
                    break;

                case 'quit':
                case 'exit':
                    return true;
                    break;

                default:
                    $this->out("Invalid command\n");
                    break;
            }
            $command = '';
        }
    }




    function anios_correlativos() {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $limit = 100;
        define("OFERTA_SECTEC", 3 );

        /* @var $Plan Model */
        $Plan =& $this->Instit->Plan;
        /* @var $Anio Model */
        $Anio =& $this->Instit->Plan->Anio;

        $offset = (-1)*$limit;

        $this->out($Plan->query('update planes set z_anios_correlativos = 0;'));

        do {
            $this->out("comienza la milonga....");
            $offset += $limit;
            $planes = $Plan->find('all', array(
                    'limit'=>$limit,
                    'offset'=> $offset,
                    'recursive' => 1,
                    'contain' => array(
                            'Anio'=> array('order'=>array(
                                            'Anio.ciclo_id',
                                            'Anio.etapa_id',
                                            'Anio.anio')),
                    ),
                    'conditions' => array(
                            'Plan.oferta_id'=>OFERTA_SECTEC,
                            'Plan.z_anios_correlativos' => 0,
                    ),
            ));

//            if ($offset > 10){
//                $this->out("termino por el offset");
//            }

            $this->out("Recorriendo ".count($planes)." planes");

            foreach ($planes as $p) {
                /* @var integer $aaa es para indicar el número de año y compararlo*/
                $aaa = 0;
                $cicloAnt = 0;
                $todosLosAniosCorrectos = true;
                foreach ($p['Anio'] as $a) {
                    $aaa = ($aaa == 0) ? $a['anio']   :   $aaa;
                    $aaa = ($cicloAnt == $a['ciclo_id']) ? $aaa : $a['anio'];
                    $cicloAnt = ($cicloAnt != $a['ciclo_id']) ? $a['ciclo_id'] : $cicloAnt;

                    if ($aaa == $a['anio']) {
//                        $Anio->id = $a['id'];
//                        $Anio->saveField('z_anio_correcto', 1);
                    } else {
                        $this->out("a actual es: ".$aaa." y el anio que recorro: ".$a['anio']." para el ciclo: ".$a['ciclo_id']);
                        $todosLosAniosCorrectos = false;
                        break;
                    }
                    $aaa++;
                }
                if ($todosLosAniosCorrectos) {
                    $Plan->id = $p['Plan']['id'];
                    $Plan->saveField('z_anios_correlativos', -1 );
                    $this->out("encontró plan BUENO");
                } else {
                    $this->out("****** encontró plan malo ID: ".$p['Plan']['id'] ." *****");
                    $Plan->id = $p['Plan']['id'];
                    $Plan->saveField('z_anios_correlativos', 2);
                }
            }
        } while (count($planes)>0);
        $this->out("TEEERRRMMMIINÓÓÓÓ !!!!");
        //die("TEEERRRMMMIINÓÓÓÓ !!!!");
    }



    function arreglar_anios_sgn_estructura() {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $limit = 100;
        define("OFERTA_SECTEC", 3 );

        $Plan =& $this->Instit->Plan;
         /* @var $EstructPlan Model */
        $EstructPlan =& $this->Instit->Plan->EstructuraPlan;
        /* @var $EstructAnio Model */
        $EstructAnio =& $this->Instit->Plan->Anio->EstructuraPlanesAnio;


         $offset = (-1)*$limit;

         $this->out($Plan->query('update planes set z_anios_correctos_sgn_estruct = 0;'));

        do {
            $this->out("comienza la milonga....");
            $offset += $limit;
            $planes = $Plan->find('all', array(
                    'limit'=>$limit,
                    'offset'=> $offset,
                    'recursive' => 1,
                    'contain' => array(
                            'Anio'=> array('order'=>array(
                                            'Anio.ciclo_id',
                                            'Anio.etapa_id',
                                            'Anio.anio')),
                    ),
                    'conditions' => array(
                            'Plan.oferta_id'=>OFERTA_SECTEC,
                            'Plan.z_anios_correlativos <' => 0, // los que estan bien
                    ),
            ));

//            if ($offset > 10){
//                $this->out("termino por el offset");
//                return -1;
//            }

            $this->out("Recorriendo ".count($planes)." planes");

            foreach ($planes as $p) {
                $cantAnios = count($p['Anio']);

                //saco el primer año dato del plan
                $primerAnio = array_shift($p['Anio']);
                $estruc = $EstructPlan->find('all', array(
                        'contain' => array('EstructuraPlanesAnio'=> array('order'=>'EstructuraPlanesAnio.nro_anio')),
                        'conditions' => array('EstructuraPlan.etapa_id'=>$primerAnio['etapa_id']),
                    ));

                $primerAnioEstruct = array();
                $this->out("Se encontraron ".count($estruc)." estructuras posibles");
                foreach ($estruc as $e) {
                    if (count($e['EstructuraPlanesAnio']) == $cantAnios){
                        $this->out("joya, tiene la misma cant de años");
                       //saco el primer año de la estructura
                       $primerAnioEstruct = array_shift($e['EstructuraPlanesAnio']);
                       $primerAnioEstruct['name'] = $e['EstructuraPlan']['name'];
                    }
                }

                if (!empty($primerAnioEstruct)){
                    if ($primerAnioEstruct['nro_anio'] == $primerAnio['anio']) {
                        //$this->out(array_keys($primerAnioEstruct));
                        $Plan->id =  $primerAnio['plan_id'];
                        $Plan->saveField('z_anios_correctos_sgn_estruct', -1 );
                        $this->out("Anio correcto con estructura: ".$primerAnioEstruct['name']. " del plan ID: ".$primerAnio['plan_id']);
                    } else {
                        $Plan->id =  $primerAnio['plan_id'];
                        $Plan->saveField('z_anios_correctos_sgn_estruct', 1 );
                        $this->out("Los años iniciales no coinciden nro_anio: ".$primerAnioEstruct['nro_anio']." primer anio segun datoa actual: ".$primerAnio['anio']);
                    }
                } else {
                     $this->out(" ***** NO fué encontrada ninguna estructura por culpa de la cantidad de años para el plan ID: ".$primerAnio['plan_id'] ."*****");
                }
            }
        } while (count($planes)>0);
        $this->out("TEEERRRMMMIINÓÓÓÓ !!!!");

    }


}



?>
