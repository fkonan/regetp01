<?php

class DepuradorShell extends Shell
{
    var $uses = array('Instit','Plan','Sector','Jurisdiccion', 'Tipoinstit');

    function main()
    {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $limit = 100;
        define("OFERTA_SECTEC", 3 );

        /* @var $Plan Model */
        $Plan =& $this->Instit->Plan;
        /* @var $Anio Model */
        $Anio =& $this->Instit->Plan->Anio;
        /* @var $EstructPlan Model */
        $EstructPlan =& $this->Instit->Plan->EstructuraPlan;
        /* @var $EstructAnio Model */
        $EstructAnio =& $this->Instit->Plan->Anio->EstructuraPlanesAnio;

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
}

?>
