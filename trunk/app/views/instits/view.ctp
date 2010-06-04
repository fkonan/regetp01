<?php
    echo $javascript->link('zeroclipboard/ZeroClipboard.js');
?>
<div class="instits view">
    
    <div id="escuela_estado" class="<? echo $instit['Instit']['activo']? 'instit_activa':'instit_inactiva';?>"><? echo $instit['Instit']['activo']? 'Institución Ingresada al RFIETP':'Institución NO Ingresada al RFIETP';?></div>
    <?
    $cue_instit = ($instit['Instit']['cue']*100)+$instit['Instit']['anexo'];
    ?>
    <h2><?= $cue_instit ?>
         - <?= $instit['Instit']['nombre_completo']?>
    </h2>
    <div class="tabs">
            
            <div class="tabs-list">
                    <span class="tab-grande-activa"><?php echo $html->link('Datos',array('controller'=>'Instits','action'=>'view', $instit['Instit']['id']));?></span>
                    <span class="tab-grande-inactiva"><?php echo $html->link('Oferta Educativa',array('controller'=>'Planes','action'=>'index', $instit['Instit']['id']));?></span>
                    <span class="tab-grande-inactiva"><?php echo $html->link('Planes de Mejora',array('controller'=>'Fondos','action'=>'index_x_instit', $instit['Instit']['id']));?></span>
            </div>
            <div id="d_clip_button" class="my_clip_button2"></div>
            <input id="infoToCopy" type="hidden" value="<?= ($instit['Instit']['cue']*100)+$instit['Instit']['anexo'] . ' - ' . $instit['Instit']['nombre_completo'] . ' - ' . $instit['Instit']['direccion'] . ' - ' . $instit['Departamento']['name'] . ' - ' . $instit['Localidad']['name'] ?> "/>
            <script language="JavaScript">
                var clip = new ZeroClipboard.Client();

                ZeroClipboard.setMoviePath('<?php echo $html->url("/js/zeroclipboard/ZeroClipboard10.swf"); ?>');

                clip.setText( '' ); // will be set later on mouseDown
                clip.setHandCursor( true );
                clip.addEventListener( 'mouseDown', function(client) {
                   client.setText($("infoToCopy").value);
                } );

                clip.glue( 'd_clip_button' );
           </script>

            <div style="border-top:2px solid #9DA6C1" class="tabs-content">
                    
                    <?php
                    // por ahora no quiero que se muestre porque viene sucio este campo
                    //echo $this->element('div_observaciones', array("observacion" => $instit['Instit']['observacion']));
                    ?>


                    <?php
                    /*---********************************
                         *
                         * 			HISTORIAL DE CUES
                         *
                         ********************************----*/
                    ?><?php if(count($instit['HistorialCue'])>0):?>
                    <p class="cues-anteriores">
                            <?php echo $html->image('cambio_cue.gif')?>
                        <span class="cues-anteriores-title">
                                <?php if(count($instit['HistorialCue']) == 1):?>
                                                                  CUE anterior:
                                <?php else: echo "CUEs anteriores:";?>
                                <?php endif;?>
                        </span>
                        <span class="cues-anteriores-text">
                                <?php $primero = true;?>
                                <?php foreach($instit['HistorialCue'] as $cueant):?>
                                    <?php 	echo ($primero)?"<br>":",";
                                    $primero = false;?>
                                    <?php 	$fechamod = "<cite>(utilizado hasta el: ".date("d/m/y",strtotime($cueant['created'])).")</cite>";?>
                                    <?php   $observacion = $cueant['observaciones'];?>
                                    <?php 	echo "<b title='$observacion' class='msg-info'>".($cueant['cue']*100+$cueant['anexo'])." ".$fechamod."</b>";?>
                    <?php endforeach;?>
                        </span>
                    </p>
                <?php endif;?>





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
                    <?php echo $instit['Claseinstit']['name']; ?>
                            &nbsp;
                        </dd>
                    <?php }?>


                        <? if($instit['Orientacion']['name']) {?>
                          <dt ><?php __('Orientación'); ?></dt>
                        <dd>
                        <?php echo $instit['Orientacion']['name']; ?>
                            &nbsp;
                        </dd>
                        <? } ?>
                        <dt ><?php __('Ámbito de Gestión'); ?></dt>
                        <dd>
                <?php echo $instit['Gestion']['name']; ?>
                            &nbsp;
                        </dd>

                        <dt><?php __('Tipo de Dependencia'); ?></dt>
                        <dd>
                <?php echo $instit['Dependencia']['name']; ?>
                            &nbsp;
                        </dd>

                <? if($instit['Instit']['nombre_dep']): ?>
                        <dt><?php __('Nombre de la Dependencia'); ?></dt>
                        <dd>
                    <?php echo $instit['Instit']['nombre_dep']; ?>
                            &nbsp;
                        </dd>
                <? endif; ?>

                        <dt><?php __('Jurisdicción'); ?></dt>
                        <dd>
                <?php echo $instit['Jurisdiccion']['name']; ?>
                            &nbsp;
                        </dd>

                        <dt><?php __('Departamento'); ?></dt>
                        <dd>
                <?php echo $instit['Departamento']['name']; ?>
                            &nbsp;
                        </dd>

                        <dt><?php __('Localidad'); ?></dt>
                        <dd>
                <?php echo $instit['Localidad']['name']; ?>
                            &nbsp;
                        </dd>

                        <dt><?php __('Barrio/Pueblo/Comuna'); ?></dt>
                        <dd>
                <?php echo $instit['Instit']['lugar']; ?>
                            &nbsp;
                        </dd>

                        <dt><?php __('Domicilio'); ?></dt>
                        <dd>
                <?php echo $instit['Instit']['direccion']; ?>
                            &nbsp;
                        </dd>


                        <dt><?php __('Código Postal'); ?></dt>
                        <dd>
                <?php echo $instit['Instit']['cp']; ?>
                            &nbsp;
                        </dd>

                <?php if($instit['Instit']['telefono']): ?>
                        <dt><?php __('Teléfono'); ?></dt>
                        <dd>
                    <?php echo $instit['Instit']['telefono']; ?>
                            &nbsp;
                        </dd>
                <?php endif;?>


                <?php if($instit['Instit']['telefono_alternativo']): ?>
                        <dt><?php __('Teléfono Alternativo'); ?></dt>
                        <dd>
                    <?php echo $instit['Instit']['telefono_alternativo']; ?>
                            &nbsp;
                        </dd>
                <?php endif;?>

                <?php if($instit['Instit']['mail']): ?>
                        <dt><?php __('E-Mail'); ?></dt>
                        <dd>
                    <?php echo $instit['Instit']['mail']; ?>
                            &nbsp;
                        </dd>
                <?php endif;?>

                <?php if($instit['Instit']['mail_alternativo']): ?>
                        <dt><?php __('E-Mail Alternativo'); ?></dt>
                        <dd>
                    <?php echo $instit['Instit']['mail_alternativo']; ?>
                            &nbsp;
                        </dd>
                <?php endif;?>

                <?php if($instit['Instit']['web']): ?>
                        <dt><?php __('Web'); ?></dt>
                        <dd>
                    <?php echo $instit['Instit']['web']; ?>
                            &nbsp;
                        </dd>
                <?php endif;?>

                        <dt><?php __('Año de Creación'); ?></dt>
                        <dd>
                <?php echo ($instit['Instit']['anio_creacion']==0)?'':$instit['Instit']['anio_creacion']; ?>
                            &nbsp;
                        </dd>
                    </dl>

                    <H2>Datos Director</H2>
                    <dl>
                        <dt><?php __('Nombre y Apellido'); ?></dt>
                        <dd>
                <?php echo $instit['Instit']['dir_nombre']; ?>
                            &nbsp;
                        </dd>
                        <dt><?php __('Tipo y Nº de Documento'); ?></dt>
                        <dd>
                            <?php
                            if($instit['Instit']['dir_nrodoc']>0) {
                                echo $this->requestAction('/tipodocs/tipodoc_nombre/'.$instit['Instit']['dir_tipodoc_id']);
                                echo ' '.$instit['Instit']['dir_nrodoc'];
                            }
                ?>
                            &nbsp;
                        </dd>

                        <dt><?php __('Teléfono'); ?></dt>
                        <dd>
                <?php echo $instit['Instit']['dir_telefono']; ?>
                            &nbsp;
                        </dd>

                        <dt><?php __('E-Mail'); ?></dt>
                        <dd>
                <?php echo $instit['Instit']['dir_mail']; ?>
                            &nbsp;
                        </dd>

                    </dl>

                    <H2>Datos Vice Director</H2>
                    <dl>
                        <dt><?php __('Nombre y Apellido'); ?></dt>
                        <dd>
                <?php echo $instit['Instit']['vice_nombre']; ?>
                            &nbsp;
                        </dd>
                        <dt><?php __('Tipo y Nº de Documento'); ?></dt>
                        <dd>
                            <?
                            if($instit['Instit']['vice_nrodoc']>0) {
                                echo $this->requestAction('/tipodocs/tipodoc_nombre/'.$instit['Instit']['vice_tipodoc_id']);
                                echo ' '.$instit['Instit']['vice_nrodoc'];
                            }
                ?>
                            &nbsp;
                        </dd>
                    </dl>

                    <H2>Datos Adicionales</H2>
                    <dl>
                        <dt><?php __('Fecha Mod (<2009)'); ?></dt>
                        <dd>
                <?php echo ($instit['Instit']['fecha_mod']>0)?date("d/m/Y",strtotime($instit['Instit']['fecha_mod'])):''; ?>
                            &nbsp;
                        </dd>

                        <dt><?php __('Actualización o Ingreso'); ?></dt>
                        <dd>
                <?php echo $instit['Instit']['actualizacion']; ?>
                            &nbsp;
                        </dd>


                        <dt><?php __('Observación'); ?></dt>
                        <dd>
                <?php echo $instit['Instit']['observacion']; ?>
                            &nbsp;
                        </dd>

                        <dt><?php __('Alta'); ?></dt>
                        <dd>
                <?php echo ($instit['Instit']['ciclo_alta']>0)?$instit['Instit']['ciclo_alta']:''; ?>
                            &nbsp;
                        </dd>
                        <dt><?php __('Modificación'); ?></dt>
                        <dd>
                <?php //echo ($instit['Instit']['modified']>0)?$instit['Instit']['modified']:''; ?>

                <?php echo ($instit['Instit']['modified']>0)?date("d/m/Y",strtotime($instit['Instit']['modified'])):''; ?>
                            &nbsp;
                        </dd>
                    </dl>
                    <br />

                    <div class="actions">
                        <ul>
                            <li><?php echo $html->link(__('Editar Institución', true), array('action'=>'edit', $instit['Instit']['id'])); ?> </li>
                <?php if($session->read('Auth.User.role') == 'desarrollo') {?>
                            <li><?php echo $html->link(__('Eliminar Institución', true), array('action'=>'delete', $instit['Instit']['id']), null, sprintf(__('¿Seguro que desea eliminar la institución? CUE: "%s"', true), $instit['Instit']['cue']. "0".$instit['Instit']['anexo'])); ?></li>
                            <li><?php echo $html->link('ABM CUE Histórico', array('controller'=>'HistorialCues','action'=>'index', $instit['Instit']['id'])); ?></li>
                    <?php }?>
                        </ul>
                    </div>

            </div>
    </div>    
</div>


