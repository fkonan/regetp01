<?php

    echo $html->css('catalogo.instits.view', false);
    //echo $html->css('catalogo.titulos', false);
    ?>


<div class="">
    <div class="">
    
    <?
    $cue_instit = ($instit['Instit']['cue']*100)+$instit['Instit']['anexo'];
    ?>
    
   </div>
        
    <div class="grid_6 alpha">
        
        <div  class="box_grid_6  boxblanca detalles">
            <h3 class="">Datos de la Institución</h3>

            <div>
                <h2><?php __('CUE'); ?>:</h2>
                <p><?php echo $cue_instit ?></p>
            </div>

            <div>
                <h2><?php __('Nombre'); ?>:</h2>
                <p><?php echo $instit['Instit']['nombre_completo'] ?></p>
            </div>

            <?php
            if(!$con_programa_de_etp) {	?>
            <b>
                &nbsp;<?php echo $relacion_etp; ?>

            </b>
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

            <? if($instit['Instit']['nombre_dep']): ?>
                <div>
                    <h2><?php __('Nombre de la Dependencia'); ?>:</h2>
                    <p>
                            <?php
                            if(!empty($instit['Instit']['nombre_dep'])) {
                                echo $instit['Instit']['nombre_dep'];
                            }else {
                                echo "<i>No declarado</i>";
                            } ?>
                    </p>
                </div>
            <? endif; ?>

            <div>
                <h2><?php __('Jurisdicción'); ?>:</h2>
                <p>
                    <?php
                    if(!empty($instit['Jurisdiccion']['name'])) {
                        echo $instit['Jurisdiccion']['name'];
                    }else {
                        echo "<i>No declarado</i>";
                    } ?>
                </p>
            </div>

            <div>
                <h2><?php __('Departamento'); ?>:</h2>
                <p>
                    <?php
                    if(!empty($instit['Departamento']['name'])) {
                        echo $instit['Departamento']['name'];
                    }else {
                        echo "<i>No declarado</i>";
                    } ?>
                </p>
            </div>
            <div>
                <h2><?php __('Localidad'); ?>:</h2>
                <p>
                    <?php
                    if(!empty($instit['Localidad']['name'])) {
                        echo $instit['Localidad']['name'];
                    }else {
                        echo "<i>No declarado</i>";
                    } ?>
                </p>
            </div>

            <div>
                <h2><?php __('Barrio/Pueblo/Comuna'); ?>:</h2>
                <p>
                    <?php
                    if(!empty($instit['Instit']['lugar'])) {
                        echo $instit['Instit']['lugar'];
                    }else {
                        echo "<i>No declarado</i>";
                    } ?>
                </p>
            </div>
            <div>
                <h2><?php __('Domicilio'); ?>:</h2>
                <p>
                    <?php
                    if(!empty($instit['Instit']['direccion'])) {
                        echo $instit['Instit']['direccion'];
                    }else {
                        echo "<i>No declarado</i>";
                    } ?>
                </p>
            </div>

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
                    <h2><?php __('Teléfono'); ?>:</h2>
                    <p>
                            <?php
                            if(!empty($instit['Instit']['telefono'])) {
                                echo $instit['Instit']['telefono'];
                            }else {
                                echo "<i>No declarado</i>";
                            } ?>
                    </p>
                </div>
            <?php endif;?>

            <?php if($instit['Instit']['telefono_alternativo']): ?>
                <div>
                    <h2><?php __('Teléfono Alternativo'); ?>:</h2>
                    <p>
                            <?php
                            if(!empty($instit['Instit']['telefono_alternativo'])) {
                                echo $instit['Instit']['telefono_alternativo'];
                            }else {
                                echo "<i>No declarado</i>";
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
            <div>
                <h2><?php __('Año de Creación'); ?>:</h2>
                <p>
                    <?php echo ($instit['Instit']['anio_creacion']==0)?'<i>No declarado</i>':$instit['Instit']['anio_creacion']; ?>
                </p>
            </div>
        </div>

        <a class="box_grid_6 boxgris alerta-desactualizada" href ="<?php echo $html->url(array("controller" => "correos","action" => "desactualizada"));?>">
            <h2>Ayudenos a mantener los datos actualizados</h2>
            <p>Si ha notado algún dato desactualizado, haga click aquí</p>
            <span class="outdated"/>
        <?php
            echo $html->link(
                    '',
                    array('controller' => 'correos', 'action' => 'desactualizada')
                    );

            echo $form->create('Instit', array('id' => 'institForm'));
            echo $form->hidden('nombre_completo', array('id' => 'nombre_completo', 'value' => urlencode($instit['Instit']['nombre_completo'])));
            echo $form->hidden('cue_instit', array('id' => 'cue_instit', 'value' => urlencode($cue_instit)));
            ?>
        </a>
    </div>
    <div class="grid_6 omega">
        <h2 class="uppercase">Títulos o Certificados que brinda la Institución</h2>
   
        <?php
        foreach($instit['Plan'] as $plan){
        ?>
            <div class="titulo boxblanca box_grid_6">

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
        <div class="clear"></div>
            
        <?php
        }
        ?>
        
       </div>      
            
</div>
