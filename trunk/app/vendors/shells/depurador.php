<?php

define("OFERTA_SECTEC", 3 );
define("SS_LIMIT", 200 );

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
                    $this->out('2) "anios_sgn_estructura": me indica cuales son los años, dentro de los correctos, que no coinciden con una estructura válida.');
                    $this->out('3) "arreglar_anios"');
                    $this->out('');
                    break;

                case 1:
                case 'anios_correlativos':
                    $this->anios_correlativos();
                    break;

                case 2:
                case 'anios_sgn_estructura':
                    $this->anios_sgn_estructura();
                    break;

                case 3:
                case 'arreglar_anios':
                    $this->anios_anios();
                    break;


                case 'q':
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
        $this->out("comienza la milonga....");
        
        $this->layout = 'ajax';
        $this->autoRender = false;
        $limit = SS_LIMIT;
        

        /* @var $Plan Model */
        $Plan =& $this->Instit->Plan;
        /* @var $Anio Model */
        $Anio =& $this->Instit->Plan->Anio;

        $offset = (-1)*$limit;

        //$this->out($Plan->query('update planes set z_anios_correlativos = 0;'));

        $cantPlanes = 0;
        $cantBien = 0;
        $cantMal = 0;
        $contadorpp = 0;        
        
        
        do {
            $offset += $limit;
            $planes = $Plan->find('all', array(
                    'limit'=>$limit,
                    'offset'=> $offset,
                    'contain' => array(
                            'Anio'=> array('order'=>array(
                                            'Anio.ciclo_id',
                                            'Anio.etapa_id',
                                            'Anio.anio')),
                    ),
                    'conditions' => array(
                            'Plan.oferta_id'=>OFERTA_SECTEC,
                            //'Plan.z_anios_correlativos' => 0,
                    ),
                    'order'=>array('Plan.id'),
            ));
            $contadorpp += $Plan->find('count', array(
                    'limit'=>$limit,
                    'offset'=> $offset,
                    'contain' => array(
                            'Anio'=> array('order'=>array(
                                            'Anio.ciclo_id',
                                            'Anio.etapa_id',
                                            'Anio.anio')),
                    ),
                    'conditions' => array(
                            'Plan.oferta_id'=>OFERTA_SECTEC,
                            //'Plan.z_anios_correlativos' => 0,
                    ),
                    'order'=>array('Plan.id'),
            ));

            // terminar la ejecucion cuando ya no haya planes que recorrer
            if (empty($planes)){
                $this->out("´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´ BYE ! Off: $offset");
                break;
            }
    
//            if ($offset > 10){
//                $this->out("termino por el offset");
//                return -1;
//            }

            foreach ($planes as $p) {
                $cantPlanes++;
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
                        $this->out("    ---- A actual es: ".$aaa." y el anio que recorro: ".$a['anio']." para el ciclo: ".$a['ciclo_id']);
                        $todosLosAniosCorrectos = false;
                        break;
                    }
                    $aaa++;
                }
                if ($todosLosAniosCorrectos) {
                    $Plan->id = $p['Plan']['id'];
                    $Plan->saveField('z_anios_correlativos', -1 );
                    $cantBien++;
                } else {
                    $this->out("****** encontró plan malo ID: ".$p['Plan']['id'] ." *****");
                    $Plan->id = $p['Plan']['id'];
                    $Plan->saveField('z_anios_correlativos', 2);
                    $cantMal++;
                }
            }
        } while(1);
        
        $this->out("¡¡¡ TERMINO !!!!");
        $this->out(" ");
        $this->out("Total de planes: $cantPlanes y en el count: $contadorpp");
        $this->out("Bien: $cantBien");
        $this->out("Mal: $cantMal");
    }



    function anios_sgn_estructura() {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $limit = SS_LIMIT;

        $Plan =& $this->Instit->Plan;
         /* @var $EstructPlan Model */
        $EstructPlan =& $this->Instit->Plan->EstructuraPlan;
        /* @var $EstructAnio Model */
        $EstructAnio =& $this->Instit->Plan->Anio->EstructuraPlanesAnio;

        $offset = (-1)*$limit;

        //$this->out($Plan->query('update planes set z_anios_correctos_sgn_estruct = 0;'));

        do {
            $this->out("comienza la milonga....");
            $offset += $limit;
            $planes = $Plan->find('all', array(
                    'limit'=>$limit,
                    'offset'=> $offset,
                    'recursive' => 1,
                    'contain' => array(
                            'Instit(jurisdiccion_id)',
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

            if (empty($planes)){
                $this->out("´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´ BYE ! Off: $offset");
                break;
            }

//            if ($offset > 10){
//                $this->out("termino por el offset");
//                return -1;
//            }

            $this->out("Recorriendo ".count($planes)." planes");

            foreach ($planes as $p) {
                $cantAnios = count($p['Anio']);

                //saco el primer año dato del plan
                $primerAnio = array_shift($p['Anio']);

                $estruc = $EstructPlan->JurisdiccionesEstructuraPlan->find('all', array(
                        'contain' => array(
                            'EstructuraPlan' => array(
                                'EstructuraPlanesAnio'=> array(
                                    'order'=>'EstructuraPlanesAnio.nro_anio'),
                                )),
                        'conditions' => array(
                            'EstructuraPlan.etapa_id'=>$primerAnio['etapa_id'],
                            'JurisdiccionesEstructuraPlan.jurisdiccion_id'=>$p['Instit']['jurisdiccion_id'],
                            ),
                    ));

                

                $primerAnioEstruct = array();
                $this->out("++++++ Se encontraron ".count($estruc)." estructuras posibles, recorrientolas");
                foreach ($estruc as $e) {
                    // si la jurisdiccion no tiene ese tipo de estructura sigo leyendo el proximo
                    if (empty($e['JurisdiccionesEstructuraPlan'])){
                        $this->out(array_keys($e));
                        $this->out('finish HIM:::: plan: '.$p['Plan']['id']. ' para jurisdiccion: '.$p['Instit']['jurisdiccion_id']);
                        return -18;
                        break;
                    }
                    if (count($e['EstructuraPlan']['EstructuraPlanesAnio']) == $cantAnios){
                        $this->out("----    joya, tiene la misma cant de años para el plan ".$p['Plan']['id']);
                       //saco el primer año de la estructura
                       $primerAnioEstruct = array_shift($e['EstructuraPlan']['EstructuraPlanesAnio']);
                       $primerAnioEstruct['name'] = $e['EstructuraPlan']['name'];
                       break;
                    }
                }

                if (!empty($primerAnioEstruct)){
                    if ($primerAnioEstruct['nro_anio'] == $primerAnio['anio']) {
                        //$this->out(array_keys($primerAnioEstruct));
                        $Plan->id =  $primerAnio['plan_id'];
                        $Plan->saveField('z_anios_correctos_sgn_estruct', -1 );
                        $this->out("    ++++    Anio correcto con estructura: ".$primerAnioEstruct['name']. " del plan ID: ".$primerAnio['plan_id']);
                    } else {
                        $Plan->id =  $primerAnio['plan_id'];
                        $Plan->saveField('z_anios_correctos_sgn_estruct', 1 );
                        $this->out("    ****    Los años iniciales no coinciden nro_anio: ".$primerAnioEstruct['nro_anio']." primer anio segun datoa actual: ".$primerAnio['anio']);
                    }
                } else {
                     $Plan->id =  $primerAnio['plan_id'];
                     $Plan->saveField('z_anios_correctos_sgn_estruct', 2 );
                     $this->out("****** NO fué encontrada ninguna estructura por culpa de la cantidad de años para el plan ID: ".$primerAnio['plan_id'] ."*****");
                }
            }
        } while (1);
        $this->out("TEEERRRMMMIINÓÓÓÓ !!!!");

    }



    function arreglar_anios() {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $limit = SS_LIMIT;
        
        $Plan =& $this->Instit->Plan;
         /* @var $EstructPlan Model */
        $EstructPlan =& $this->Instit->Plan->EstructuraPlan;

        $offset = (-1)*$limit;

    }


}



?>
