<?php
/**
 *
 *  Este elemento genera una tabla toda hecha en CSS que muestra la estructura
 *  de un Ciclo, Oferta, o Plan.
 *
 *
 *  es necesario pasarle un array con la siguiente forma:
 *
 *  array $trayectosData['anios']
 *      Listado de años teoricos. Ej: array(12,13,14,15,16)
 *
 *  string $trayectosData['nombre_etapa']
 *      Nombre del ciclo a renderizar
 *
 *  array  $trayectosData['etapa_header'] listado de etapas distintas
 *  string $trayectosData['etapa_header'][x]['title'] nombre de la Etapa
 *  array  $trayectosData['etapa_header'][x]['anios'] listado de años. Ej: 1°, 2°, 3°
 *
 *  array $trayectosData['ciclo_lectivo'][x]['title'] nombre o numero de año. Ej: 2009,2010
 *
 *                                          ['ciclos_data'][x] listado de
 *                                                      ['matricula']
 *                                                      ['seccion']
 *                                                      ['hs_taller']
 *
 *
 *
 *
 *
 *
 *
 *    -----   Ejemplo de un array con informacion ------
$trayectosData['anios'] = array(12,13,14,15,16);
$trayectosData['etapa_header'] = array(
    array('title'=>'Ciclo Básico', 'anios'=>array(1,2,3)),
    array('title'=>'Ciclo Superior', 'anios'=>array(4,5)),
);
$trayectosData['ciclo_lectivo'] = array(
    array('title'=>2009,
        'ciclos_data'=> array(
            array(
                'matricula'=>12,
                'seccion'=>10,
                'hs_taller'=>1,
            ),
            array(
                'matricula'=>12,
                'seccion'=>10,
                'hs_taller'=>2,
            ),
            array(
                'matricula'=>12,
                'seccion'=>10,
                'hs_taller'=>3,
            ),
            array(
                'matricula'=>12,
                'seccion'=>10,
                'hs_taller'=>4,
            ),
             array(
                'matricula'=>12,
                'seccion'=>10,
                'hs_taller'=>5,
            ),
        ))
);

 *
 *
 *
 *
 *
 *
 *
 */



///////////////////////////////////////////////////////////////
//  Definicion de algunas funciones utilizadas
function  meter_anios($trayectosData){
    if (!empty($trayectosData['anios'])) {
        foreach($trayectosData['anios'] as $td) {
                ?>
                <span><?php echo $td ?></span>
                <?php
        }
    }
}


function limpiar_nombre($string){
    // replace accented chars
    $accents = '/&([A-Za-z]{1,2})(grave|acute|circ|cedil|uml|lig);/';
    $string_encoded = htmlentities($string,ENT_NOQUOTES,'UTF-8');
    
    //$string = preg_replace($accents,'$1',$string_encoded);

    // clean out the rest
    $replace = array('([\40])','(-{2,})');
    $with = array('-','-');
    $tofind = "ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ";
    $replac = "AAAAAAaaaaaaOOOOOOooooooEEEEeeeeCcIIIIiiiiUUUUuuuuyNn";
    $string = strtr($string,$tofind,$replac);
   
    $string = preg_replace($replace,$with,$string);
    
    return low($string);
}


////////////////////////////////////////////////////////////




// Inicio del HTML a mostrar
echo $html->css('element_sectec_trayectos','stylesheet', array('media'=>'screen'));

if (empty($trayectosData)) {
    debug("la variable trayectosData es necesaria para generar la maqueta de la estructura de éste elemento.");
}
?>

<div class="estructura-plan">

    <?php
    if (!empty($trayectosData['anios'])) :
    ?>
    <div class="edad-teorica">
        <h1>Año de Escolaridad</h1>
        <?php
        meter_anios($trayectosData);
        ?>
    </div>
    <?php
    endif
    ?>

    <div class="clear"></div>

    <div class="mover-0">
        <?php
        foreach($trayectosData['etapa_header'] as $ch) {
        ?>
        <div class="etapa <?php echo limpiar_nombre($ch['title'])?>">
            <h2><?php echo $ch['title'] ?></h2>
            <div class="etapa-anios">
                <?php
                foreach($ch['anios'] as $ca) {
                    ?>
                    <span><?php echo $ca?></span>
                    <?php
                }
                ?>
            </div>
        </div>

        <?php
        }

        if(!empty($trayectosData['ciclo_lectivo'])):
        ?>
        <div class="datos-anios">
            <?php
            foreach ($trayectosData['ciclo_lectivo'] as $cicloLectivo) {
                ?>
                <div class="anio-ciclo-dato izquierda-1"><?php echo $cicloLectivo['title']?></div>
                <div class="anio-ciclo">
                        <?php
                        foreach ($cicloLectivo['ciclos_data'] as $cd) {
                            ?>
                             <span>
                                <span class="anio-dato anio-matricula" title="Matrícula"><?php echo $cd['matricula']?></span>
                                <span class="anio-dato anio-matricula" title="Matrícula" style="font-size: 6pt !important;">Matrícula</span>
                                <span class="anio-dato anio-seccion" title="Secciones"  style="clear: left"><?php echo $cd['seccion']?></span>
                                <span class="anio-dato anio-seccion" title="Secciones" style="font-size: 6pt; clear: right">Secciónes</span>
                                <span class="anio-dato anio-hstaller" title="Hs. Taller" style="clear: left"><?php echo $cd['hs_taller']?></span>
                                <span class="anio-dato anio-hstaller" title="Hs. Taller" style="font-size: 6pt">Hs Taller</span>
                            </span>
                            <?php
                        }
                        ?>
                </div>
                <?php
            }
            ?>
        </div>
        <?php
        endif;
        ?>
    </div>
</div>




