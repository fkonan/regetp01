<?php

    echo $html->css('catalogo.instits', false);
    //echo $html->css('catalogo.titulos', false);
    $cue_instit = ($instit['Instit']['cue']*100)+$instit['Instit']['anexo'];
?>

<br />
<div class="grid_12 boxblanca">
    <h2 class="grid_12"><?php echo $cue_instit ?> <?php echo $instit['Instit']['nombre_completo'] ?></h2>
            
        <dl class="grid_6 alpha">
            <?php if(!$con_programa_de_etp){?>
                <dt>
                    <?php echo $relacion_etp; ?>
                </dt>
                <dd>&nbsp;</dd>
            <?php }?>

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
        </dl>  
    
        <dl class="grid_6 omega">
            <!-- Por cuestiones de diseño, para que coincidan las columnas -->
            <dt>&nbsp;</dt><dd>&nbsp;</dd>
            
            
            <dt><?php __('Dirección'); ?>:</dt>
            <dd>
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
    </div>


    <h2 class="grid_12 separador alpha omega">Títulos o Certificaciones que brinda la Institución</h2>
    <div class="clear"></div>
    
    <div class="grid_12 boxblanca">

    <?php 
        $ofertaAnt = '';
        foreach ($instit['Plan'] as $plan) { ?>
        
        <?
        if ($ofertaAnt != $plan['Titulo']['Oferta']['id'] ) {
            echo "<h4>". $plan['Titulo']['Oferta']['name'] ."</h4>";
            $ofertaAnt = $plan['Titulo']['Oferta']['id'];
        }
        ?>
        
        <div class="grid_4 alpha omega">
            <div class="titulo_name"><?php echo $plan['nombre']?></div>
        <dl class="titulo">
                <dt>Nombre que le da el INET:</dt>
                <dd><?php echo $plan['Titulo']['name']?></dd>
                
                <dt>Sector / Subsector:</dt>
                <dd>
                    <ul>
                    <?php foreach($plan['Titulo']['SectoresTitulo'] as $sector) {?>
                        <li><?php echo $sector['Sector']['name'] . ((!empty($sector['Subsector']))?('/' .  $sector['Subsector']['name']):'') ?></li>
                    <?php

                    }
                    ?>
                    </ul>
                </dd>
                
<!--                <dt>Oferta:</dt>
                <dd><?php echo $plan['Titulo']['Oferta']['name']?></dd>-->
                
                <?php if ($plan['Titulo']['Oferta']['id'] == FP_ID || $plan['duracion_hs'] || $plan['duracion_semanas']) { ?>
                <dt>Duración:</dt>
                <dd>
                    <?php  
                        if (!empty($plan['duracion_hs'])){
                            echo $plan['duracion_hs'] . ' hs.';
                        }
                        elseif (!empty($plan['duracion_semanas'])) {
                            echo $plan['duracion_semanas']. ' semanas';
                        }  ?>
                &nbsp;
                </dd>
                <?php } ?>
                
                
        </dl>
        </div>
    <?php }?>
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