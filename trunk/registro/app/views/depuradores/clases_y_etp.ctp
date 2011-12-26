
<h1>Depurador de Tipo de Institución de ETP <a href="#mostrar-help" class="help" style="float: right" onclick="jQuery('#mostrar-help').toggle(); return false;">(Ayuda?)</a></h1>

<div id="mostrar-help" class="help-text" style="display: none;">
    <h2>Ayuda del depurador</h2>
    
    <p>
        El Depurador de Tipo de Institución de ETP sirve para visualizar rápidamente
        aquellas instituciones que pueden haber cambiado su <cite>"tipo de institución"</cite>.
    </p>
    <p>
        Llámese <cite>tipo de institución de ETP</cite> a la clase de institución relacionado con los planes
        que la misma dicta. Por ejemplo: si una institución dicta sólo cursos de Formación Profesional,
        entonces el tipo de ETP es: <b>"Formación Profesional"</b>.
        Si dicta, 1 curso de FP y otro de Secundario Técnico, entonces la institución es 
        del tipo: <b>"Secundario"</b>.        
    </p>
    <p>
        Aqui se visualizarán las instituciones cuyos planes hayan cambiado (ya sea porque se modificó 
        uno que tenia, o se agregó un nuevo plan). Pero sólo aparecería en el depurador cuando haya
        modificado el tipo de oferta del plan. Esto quiere decir que, si una institución tenía
        solamente cursos de FP, y se le agregó uno de Secundario técnico, o Superior, entonces, dicha
        institución pasará a formar parte del depurador.<br />
        También sucederá lo mismo, si la institución tenía planes de Secundario técnico, y se le agrega uno de FP.
    </p>
</div>


<div class="instits form">
<h3>Editando Institución de <?php echo $this->data['Jurisdiccion']['name']?>
    <span style="float: right; color: red">Faltan depurar: <?php echo $falta_depurar?></span>
</h3>
<h4>
    <br />
    Nombre: <?= $html->link($this->data['Instit']['nombre_completo'],'/instits/view/'.$this->data['Instit']['id']);?> <br> CUE: <?= $this->data['Instit']['cue']*100+$this->data['Instit']['anexo'] ?> (id:<?php echo $this->data['Instit']['id']?>)
</h4>


<h2>Planes</h2>
<?php foreach ($planes as $p):?>
<?php $div_id = "plan-id-".$p['Plan']['id']; ?>

	<dl style="font-size: 12px;">
		<dt>Nombre:</dt>				<dd style="margin-left: 10em;"><?php echo $html->link($p['Plan']['nombre'],'/Planes/view/'.$p['Plan']['id'])?>&nbsp;</dd>
		<dt>Oferta:</dt>				<dd style="color: OrangeRed; font-size: 12px;"><?php echo $p['Oferta']['name']?>&nbsp;</dd>
	</dl>

	<a style="font-size: 10px;" href="#<? echo $div_id?>" onclick="jQuery('#<? echo $div_id?>').toggle(); return false;">Más info del Plan</a>
        
	<div style="display: none; background-color: beige;" id="<? echo $div_id?>">
		<dl>
                        
			<dt>Sectores:</dt>				
                            <dd>
                                <?php 
                                    $primero = true;
                                    
                                    foreach ($p['Titulo']['SectoresTitulo'] as $sec) { 
                                        if ( !$primero ) {
                                            echo ", ";
                                        }
                                        $primero = false;
                                        echo $sec['Sector']['name'];
                                        if (!empty($sec['Subsector']['name'])) {
                                            echo ' / '.$sec['Subsector']['name'];
                                        }
                                    } ?>
                                &nbsp;</dd>
			<dt>Duracion:</dt>				
                            <dd><?php echo " - ";?>&nbsp;</dd>
			<dt>&nbsp;&nbsp;-- Horas:</dt>	
                            <dd><?php echo $p['Plan']['duracion_hs'];?>&nbsp;</dd>
			<dt>&nbsp;&nbsp;-- Semanas:</dt>
                            <dd><?php echo $p['Plan']['duracion_semanas'];?>&nbsp;</dd>
			<dt>&nbsp;&nbsp;-- Años:</dt>       
                            <dd><?php echo $p['Plan']['duracion_anios'];?>&nbsp;</dd>
			<dt>matricula:</dt>				
                            <dd><?php echo $p['Plan']['matricula']?>&nbsp;</dd>
			<dt>Observación:</dt>			
                            <dd><?php echo $p['Plan']['observacion']?>&nbsp;</dd>
			<dt>Alta:</dt>					
                            <dd><?php echo date('d/m/Y',strtotime($p['Plan']['created']))?>&nbsp;</dd>
			<dt>Modificación:</dt>			
                            <dd><?php echo date('d/m/Y',strtotime($p['Plan']['modified']))?>&nbsp;</dd>
			
			<?php
				foreach ($p['Anio'] as $anio):
					$ciclos[$anio['ciclo_id']] = $anio['ciclo_id'];
				endforeach;
				
				$texto = '';
				foreach ($ciclos as $c):
					$texto .= " - ".$c;
				endforeach;
			?>
			<dt>Ciclos con información</dt>
                            <dd><?php echo $texto?>&nbsp;</dd>
			
		</dl> 
	</div>
	<hr>

<?php endforeach;?>

<?php echo $form->create('Instit',array('url'=>'/depuradores/clases_y_etp','id'=>'InstitDepurarForm'));?>
	<?php
		echo $form->input('id');	
				
		echo $form->input('claseinstit_id',array('label'=>'Seleccione tipo de Institución'));
		
		echo $form->input('etp_estado_id',array('label'=>'Seleccione Relación de ETP'));
		
		
        
		echo $form->button('Guardar',array('onclick'=>'jQuery("#InstitDepurarForm").submit()'));

		echo $form->input('tipoinstit_id',array('label'=>'Seleccione Tipo de Establecimiento',
												'after'=>'<br>Este combo lo incorporamos porque Ramiro dijo que aún faltaban depurar alguos tipos de establecimientos',
												  'type'=>'select',
												  'options'=>$tipoinstit
		));
     	
         /********************************************************************************/
                                   
		/**
		 *    Campos extra para que al guardar sea validado el formulario
		 */	
		echo $form->hidden('nombre');
		echo $form->hidden('nroinstit');		
		echo $form->hidden('anio_creacion');
		echo $form->hidden('direccion');
		echo $form->hidden('cp');
		echo $form->hidden('actualizacion');
		echo $form->hidden('observacion');
                
		echo $form->hidden('ciclo_alta');
		
	?>
	<?php echo $form->submit('Guardar', array(
                                     'style'=>' display: block;
                                                width: 100px;
                                                vertical-align: bottom;
                                                margin-top: 7px;
                                                margin-left: 4px;
                                                border-color: #CEE3F6;
                                                background-color: #DBEBF6;
                                                color: #045FB4;
                                                font-weight: bold;'
                                    ));
        ?>
<?php echo $form->end();?>

</div>



