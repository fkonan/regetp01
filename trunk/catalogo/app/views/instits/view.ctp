<div class="instits view">
    <div id="escuela_estado" class="<? echo $instit['Instit']['activo']? 'instit_activa':'instit_inactiva';?>"><? echo $instit['Instit']['activo']? 'Institución Ingresada al RFIETP':'Institución NO Ingresada al RFIETP';?></div>
    <?
    $cue_instit = ($instit['Instit']['cue']*100)+$instit['Instit']['anexo'];
    ?>
    <h2><?= $cue_instit ?>
        - <?= $instit['Instit']['nombre_completo']?>
    </h2>
    <div class="tabs">

        <div class="tabs-content">
            <h2>Datos de Institución</h2>
            <?php if($con_programa_de_etp) {
                echo "<p class='msg-atencion'>$relacion_etp</p>";
            }?>
            <dl>

                <?php
                if(!$con_programa_de_etp) {	?>
                <b>
                    &nbsp;<?php echo $relacion_etp; ?>

                </b>
                    <?php }?>

                <?php
                if($instit['Instit']['claseinstit_id']) {	?>
                <dt><?php __('Tipo de Institución'); ?></dt>
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
                <dt ><?php __('Orientación'); ?></dt>
                <dd>
                        <?php
                        if(!empty($instit['Orientacion']['name'])) {
                            echo $instit['Orientacion']['name'];
                        }else {
                            echo "<i>No declarado</i>";
                        } ?>
                </dd>
                    <? } ?>
                <dt ><?php __('Ámbito de Gestión'); ?></dt>
                <dd>
                    <?php
                    if(!empty($instit['Gestion']['name'])) {
                        echo $instit['Gestion']['name'];
                    }else {
                        echo "<i>No declarado</i>";
                    } ?>
                </dd>
                <dt><?php __('Tipo de Dependencia'); ?></dt>
                <dd>
                    <?php
                    if(!empty($instit['Dependencia']['name'])) {
                        echo $instit['Dependencia']['name'];
                    }else {
                        echo "<i>No declarado</i>";
                    } ?>
                </dd>
                <? if($instit['Instit']['nombre_dep']): ?>
                <dt><?php __('Nombre de la Dependencia'); ?></dt>
                <dd>
                        <?php
                        if(!empty($instit['Instit']['nombre_dep'])) {
                            echo $instit['Instit']['nombre_dep'];
                        }else {
                            echo "<i>No declarado</i>";
                        } ?>
                </dd>
                <? endif; ?>
                <dt><?php __('Jurisdicción'); ?></dt>
                <dd>
                    <?php
                    if(!empty($instit['Jurisdiccion']['name'])) {
                        echo $instit['Jurisdiccion']['name'];
                    }else {
                        echo "<i>No declarado</i>";
                    } ?>
                </dd>
                <dt><?php __('Departamento'); ?></dt>
                <dd>
                    <?php
                    if(!empty($instit['Departamento']['name'])) {
                        echo $instit['Departamento']['name'];
                    }else {
                        echo "<i>No declarado</i>";
                    } ?>
                </dd>
                <dt><?php __('Localidad'); ?></dt>
                <dd>
                    <?php
                    if(!empty($instit['Localidad']['name'])) {
                        echo $instit['Localidad']['name'];
                    }else {
                        echo "<i>No declarado</i>";
                    } ?>
                </dd>
                <dt><?php __('Barrio/Pueblo/Comuna'); ?></dt>
                <dd>
                    <?php
                    if(!empty($instit['Instit']['lugar'])) {
                        echo $instit['Instit']['lugar'];
                    }else {
                        echo "<i>No declarado</i>";
                    } ?>
                </dd>
                <dt><?php __('Domicilio'); ?></dt>
                <dd>
                    <?php
                    if(!empty($instit['Instit']['direccion'])) {
                        echo $instit['Instit']['direccion'];
                    }else {
                        echo "<i>No declarado</i>";
                    } ?>
                </dd>
                <dt><?php __('Código Postal'); ?></dt>
                <dd>
                    <?php
                    if(!empty($instit['Instit']['cp'])) {
                        echo $instit['Instit']['cp'];
                    }else {
                        echo "<i>No declarado</i>";
                    } ?>
                </dd>
                <?php if($instit['Instit']['telefono']): ?>
                <dt><?php __('Teléfono'); ?></dt>
                <dd>
                        <?php
                        if(!empty($instit['Instit']['telefono'])) {
                            echo $instit['Instit']['telefono'];
                        }else {
                            echo "<i>No declarado</i>";
                        } ?>
                </dd>
                <?php endif;?>
                <?php if($instit['Instit']['telefono_alternativo']): ?>
                <dt><?php __('Teléfono Alternativo'); ?></dt>
                <dd>
                        <?php
                        if(!empty($instit['Instit']['telefono_alternativo'])) {
                            echo $instit['Instit']['telefono_alternativo'];
                        }else {
                            echo "<i>No declarado</i>";
                        } ?>
                </dd>
                <?php endif;?>
                <?php if($instit['Instit']['mail']): ?>
                <dt><?php __('E-Mail'); ?></dt>
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
                <dt><?php __('E-Mail Alternativo'); ?></dt>
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
                <dt><?php __('Web'); ?></dt>
                <dd>
                        <?php
                        if(!empty($instit['Instit']['web'])) {
                            echo $instit['Instit']['web'];
                        }else {
                            echo "<i>No declarado</i>";
                        } ?>
                </dd>
                <?php endif;?>
                <dt><?php __('Año de Creación'); ?></dt>
                <dd>
                    <?php echo ($instit['Instit']['anio_creacion']==0)?'<i>No declarado</i>':$instit['Instit']['anio_creacion']; ?>
                </dd>
            </dl>
        </div>
    </div>    
</div>

