<?php

    echo $html->css('catalogo.instits', false);
    //echo $html->css('catalogo.titulos', false);
    $cue_instit = ($instit['Instit']['cue']*100)+$instit['Instit']['anexo'];
?>


<div class="grid_12">
    <div class="grid_12 alpha omega boxblanca detalles">
        <h3><?php echo $cue_instit ?> <?php echo $instit['Instit']['nombre_completo'] ?></h3>
        <div class="grid_6 alpha">
            <?php if(!$con_programa_de_etp){?>
                <h2>
                    <?php echo $relacion_etp; ?>
                </h2>
            <?php }?>

            <?php if($instit['Instit']['claseinstit_id']) {?>
                <div>
                    <h2><?php __('Tipo de Institución'); ?>:</h2>
                    <p>
                        <?php
                        if(!empty($instit['Claseinstit']['name'])) {
                            echo $instit['Claseinstit']['name'];
                        }else {
                            echo "<i>No declarado</i>";
                        } ?>
                    </p>
                </div>
            <?php }?>


            <? if($instit['Orientacion']['name']) {?>
                <div>
                    <h2 ><?php __('Orientación'); ?>:</h2>
                    <p>
                        <?php
                        if(!empty($instit['Orientacion']['name'])) {
                            echo $instit['Orientacion']['name'];
                        }else {
                            echo "<i>No declarado</i>";
                        } ?>
                    </p>
                </div>
            <? } ?>
            <div>
                <h2 ><?php __('Ámbito de Gestión'); ?>:</h2>
                <p>
                    <?php
                    if(!empty($instit['Gestion']['name'])) {
                        echo $instit['Gestion']['name'];
                    }else {
                        echo "<i>No declarado</i>";
                    } ?>
                </p>
            </div>
            <div>
                <h2><?php __('Tipo de Dependencia'); ?>:</h2>
                <p>
                    <?php
                    if(!empty($instit['Dependencia']['name'])) {
                        echo $instit['Dependencia']['name'];
                    }else {
                        echo "<i>No declarado</i>";
                    } ?>
                </p>
            </div>
        </div>
        <div  class="box_grid_6 grid_6 omega">
            <div>
                <h2><?php __('Direccion'); ?>:</h2>
                <p>
                <?php
                    if(!empty($instit['Instit']['direccion'])) {
                        echo $instit['Instit']['direccion'].", ";
                    }
                    if(!empty($instit['Instit']['lugar'])) {
                        echo $instit['Instit']['lugar'].", ";
                    }
                    if(!empty($instit['Localidad']['name'])) {
                        echo $instit['Localidad']['name'].", ";
                    }
                    if(!empty($instit['Departamento']['name'])) {
                        echo $instit['Departamento']['name'].", ";
                    }
                    if(!empty($instit['Jurisdiccion']['name'])) {
                        echo $instit['Jurisdiccion']['name'];
                    }
                ?>

            <div>
                <h2><?php __('Código Postal'); ?>:</h2>
                <p>
                    <?php
                    if(!empty($instit['Instit']['cp'])) {
                        echo $instit['Instit']['cp'];
                    }else {
                        echo "<i>No declarado</i>";
                    } ?>
                </p>
            </div>

            <?php if($instit['Instit']['telefono']): ?>
                <div>
                    <h2><?php __('Teléfonos'); ?>:</h2>
                    <p>
                            <?php
                            if(!empty($instit['Instit']['telefono'])) {
                                echo $instit['Instit']['telefono'];
                            }if(!empty($instit['Instit']['telefono_alternativo'])) {
                                echo ", ".$instit['Instit']['telefono_alternativo'];
                            } ?>
                    </p>
                </div>
            <?php endif;?>

            <?php if($instit['Instit']['mail']): ?>
                <div>
                    <h2><?php __('E-Mail'); ?>:</h2>
                    <p>
                            <?php
                            if(!empty($instit['Instit']['mail'])) {
                                echo $instit['Instit']['mail'];
                            }else {
                                echo "<i>No declarado</i>";
                            } ?>
                    </p>
                </div>
            <?php endif;?>
            <?php if($instit['Instit']['mail_alternativo']): ?>
                <div>
                    <h2><?php __('E-Mail Alternativo'); ?>:</h2>
                    <p>
                            <?php
                            if(!empty($instit['Instit']['mail_alternativo'])) {
                                echo $instit['Instit']['mail_alternativo'];
                            }else {
                                echo "<i>No declarado</i>";
                            } ?>
                    </p>
                </div>
            <?php endif;?>
            <?php if($instit['Instit']['web']): ?>
                <div>
                    <h2><?php __('Web'); ?>:</h2>
                    <p>
                            <?php
                            if(!empty($instit['Instit']['web'])) {
                                echo $instit['Instit']['web'];
                            }else {
                                echo "<i>No declarado</i>";
                            } ?>
                    </p>
                </div>
            <?php endif;?>
        </div>
    </div>
    </div>

    <h2 class="grid_12 separador alpha omega">Títulos o Certificaciones que brinda la Institución</h2>
    <?php $len = count($instit['Plan'])?>
    <div class="grid_6 alpha">
    <?php for ($index = 0; $index < $len; $index++): ?>
    <?php $plan = $instit['Plan'][$index];?>
        <?php if($index == round($len/2)){?>
            </div><div class="grid_6 omega">
        <?php }?>
        <div class="boxblanca titulo">

            <h3><?php echo $plan['Titulo']['name']?></h3>
            <div>
                <h2>Oferta:</h2>
                <p><?php echo $plan['Titulo']['Oferta']['name']?></p>
            </div>
            <div>
                <h2>Sectores:</h2>
                <ul>
                <?php foreach($plan['Titulo']['SectoresTitulo'] as $sector){?>
                    <li><?php echo $sector['Sector']['name'] . ((!empty($sector['Subsector']))?('/' .  $sector['Subsector']['name']):'') ?></li>
                <?php

                }
                ?>
                </ul>
            </div>
        </div>
    <?php endfor?>
    </div>
    <div class="clear separador"></div>
    <div class="grid_12 alpha omega boxgris alerta-desactualizada">
        <h2>Ayudenos a mantener los datos actualizados</h2>
        <p>Si ha notado algún dato desactualizado, haga click aquí</p>
        <span class="outdated"></span>
        <?php
        echo $form->create('Instit', array('id' => 'institForm'));
        echo $form->hidden('nombre_completo', array('id' => 'nombre_completo', 'value' => urlencode($instit['Instit']['nombre_completo'])));
        echo $form->hidden('cue_instit', array('id' => 'cue_instit', 'value' => urlencode($cue_instit)));
        echo $form->end();
        ?>
    </div>
</div>