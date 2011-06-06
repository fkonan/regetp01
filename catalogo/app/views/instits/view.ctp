<?php

    echo $html->css('catalogo.instits', false);
    //echo $html->css('catalogo.titulos', false);
    $cue_instit = ($instit['Instit']['cue']*100)+$instit['Instit']['anexo'];
?>

<h2 class="grid_12"><?php echo $cue_instit ?> <?php echo $instit['Instit']['nombre_completo'] ?></h2>
<br />
<div class="grid_12">
    <div class="boxblanca">
        <dl class="grid_5 prefix_1 alpha">
            <?php if($instit['Instit']['claseinstit_id']) {?>
                    <dt><?php __('Tipo de Institución'); ?>:</dt>
                    <dd>
                        <?php
                        if(!empty($instit['Claseinstit']['name'])) {
                            echo $instit['Claseinstit']['name'];
                        }else {
                            echo "<i>No declarado</i>";
                        } ?>
                    </dd>
            <?php }?>


            <? if($instit['Orientacion']['name']) {?>
                    <dt ><?php __('Orientación'); ?>:</dt>
                    <dd>
                        <?php
                        if(!empty($instit['Orientacion']['name'])) {
                            echo $instit['Orientacion']['name'];
                        }else {
                            echo "<i>No declarado</i>";
                        } ?>
                    </dd>
            <? } ?>
                <dt ><?php __('Ámbito de Gestión'); ?>:</dt>
                <dd>
                    <?php
                    if(!empty($instit['Gestion']['name'])) {
                        echo $instit['Gestion']['name'];
                    }else {
                        echo "<i>No declarado</i>";
                    } ?>
                </dd>

                <dt><?php __('Tipo de Dependencia'); ?>:</dt>
                <dd>
                    <?php
                    if(!empty($instit['Dependencia']['name'])) {
                        echo $instit['Dependencia']['name'];
                    }else {
                        echo "<i>No declarado</i>";
                    } ?>
                </dd>
                <?php if(!$con_programa_de_etp){?>
                    <dt>
                        <?php echo $relacion_etp; ?>
                    </dt>
                    <dd>&nbsp;</dd>
                <?php }?>
        </dl>  
    
        <dl class="grid_5 omega">
            <dt><?php __('Dirección'); ?>:</dt>
            <dd>
            <?php
                echo joinNotNull(", ", array($instit['Instit']['direccion'],$instit['Instit']['lugar'],
                                             $instit['Localidad']['name'],
                                             $instit['Departamento']['name'] == $instit['Localidad']['name']?null:$instit['Departamento']['name'],
                                             $instit['Jurisdiccion']['name']));
            ?>
            </dd>

                <dt><?php __('Código Postal'); ?>:</dt>
                <dd>
                    <?php
                    if(!empty($instit['Instit']['cp'])) {
                        echo $instit['Instit']['cp'];
                    }else {
                        echo "<i>No declarado</i>";
                    } ?>
                </dd>

            <?php if($instit['Instit']['telefono']): ?>
                    <dt><?php __('Teléfono'); ?>:</dt>
                    <dd>
                            <?php
                            if(!empty($instit['Instit']['telefono'])) {
                                echo $instit['Instit']['telefono'];
                            }if(!empty($instit['Instit']['telefono_alternativo'])) {
                                echo ", ".$instit['Instit']['telefono_alternativo'];
                            } ?>
                    </dd>
            <?php endif;?>

            <?php if($instit['Instit']['mail']): ?>
                    <dt><?php __('E-Mail'); ?>:</dt>
                    <dd>
                            <?php
                            if(!empty($instit['Instit']['mail'])) {
                                echo $instit['Instit']['mail'];
                            }else {
                                echo "<i>No declarado</i>";
                            } ?>
                    </dd>
            <?php endif;?>
            <?php if($instit['Instit']['mail_alternativo']): ?>
                    <dt><?php __('E-Mail Alternativo'); ?>:</dt>
                    <dd>
                            <?php
                            if(!empty($instit['Instit']['mail_alternativo'])) {
                                echo $instit['Instit']['mail_alternativo'];
                            }else {
                                echo "<i>No declarado</i>";
                            } ?>
                    </dd>
            <?php endif;?>
            <?php if($instit['Instit']['web']): ?>
                    <dt><?php __('Web'); ?>:</dt>
                    <dd>
                            <?php
                            if(!empty($instit['Instit']['web'])) {
                                echo $instit['Instit']['web'];
                            }else {
                                echo "<i>No declarado</i>";
                            } ?>
                    </dd>
            <?php endif;?>
        </dl>
        <div class="clear"></div>
    </div>
</div>

<h4 class="grid_12">Títulos o Certificaciones que ofrece la Institución</h4>

<div class="grid_9">
    <div class="boxblanca">
    <?php
    if (!empty($instit['Plan'])) {
    ?>
        <ul id="titulos-list">
        <?php
            $ofertaAnt = '';
            foreach ($instit['Plan'] as $plan) 
            {
                if ($ofertaAnt != $plan['Oferta']['id'] ) {
                    echo "<h4>". $plan['Oferta']['name'] ."</h4>";
                    $ofertaAnt = $plan['Oferta']['id'];
                }

                // inicializo el nombre del titulo que voy a escribir
                $planTituloNombre = '';
                $planNombre = '';
                // le agrego un link hacia el titulo de referencias
                if(!empty($plan['Titulo'])){
                $link = $html->link('Ver Más' , array(
                    'controller' => 'titulos',
                    'action' => 'view',
                    $plan['Titulo']['id']
                    ), array(
                        'title' => 'Ver más información del título',
                        'class' => 'mas_info_gris_small',
                    ));
                    $planNombre .= $link;
                }
                $planNombre .= $plan['nombre'];


                // si el titulo de referencia es distinto que el nombre del
                // plan se lo tengo que agregar entre parentesis
                // entonces quedaria: Asistente de Peluquero (Titulo: Peluquero)
                if (!empty($plan['Titulo']) && trim(strtolower($planNombre)) != trim(strtolower($plan['Titulo']['name'])) ){

                    $planNombre .= ' (' .  $plan['Titulo']['name'] . ')';
                }

                // si es FP le agrego la duracion
                $duracion = '';
                if (!empty($plan['duracion_hs'])){
                    $duracion = '. <cite>Duración: ' . $plan['duracion_hs'] . ' hs.</cite>';
                }
                elseif (!empty($plan['duracion_semanas'])) {
                    $duracion = '. <cite>Duración: ' . $plan['duracion_semanas']. ' semanas</cite>';
                }

                $planNombre .= $duracion;
            ?>

            <li><?php echo $planNombre?></li>
        <?php }?>
        </ul>
    <?php
    }
    else {
    ?>
        <i>La institución no presenta Títulos ni Certificaciones</i>
    <?php
    }
    ?>
    </div>
</div>
<?php
// se utilizan para pop-up de alerta desactualizada
echo $form->hidden('instit-nombre', array('id' => 'instit-nombre', 'value' => $instit['Instit']['nombre_completo']));
echo $form->hidden('instit-cue', array('id' => 'instit-cue', 'value' => $cue_instit));
echo $form->hidden('urlDesactualizada', array('id' => 'urlDesactualizada', 'value' => $html->url('/correos/desactualizada')));
?>
<div id="alerta-desactualizada" class="grid_3">
    <div class="boxgris alerta-desactualizada">
    Si ha notado algún dato desactualizado, haga click aquí
    </div>
</div>
<? /*echo $html->link(
        '<div id="alerta-desactualizada" class="grid_3 boxgris alerta-desactualizada">
Si ha notado algún dato desactualizado, haga click aquí</div>',
        '#',
        array(
           'escape' => false
        ));*/
?>