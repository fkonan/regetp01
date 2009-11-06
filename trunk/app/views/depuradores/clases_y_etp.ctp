
<div class="instits form">
<h1>Editar Institución de <?php echo $this->data['Jurisdiccion']['name']?><br> CUE: <?= $this->data['Instit']['cue']*100+$this->data['Instit']['anexo'] ?> (id:<?php echo $this->data['Instit']['id']?>) <br>  ¡¡ vamos que faltan solo <?php echo $falta_depurar?>!!</h1>



<h2>Planes</h2>
<?php foreach ($planes as $p):?>
<?php $div_id = "plan-id-".$p['Plan']['id']; ?>
	<dl>
		<dt>Nombre:</dt>				<dd><?php echo $html->link($p['Plan']['nombre'],'/Planes/view/'.$p['Plan']['id'])?>&nbsp;</dd>
		<dt>Oferta:</dt>				<dd><?php echo $p['Oferta']['name']?>&nbsp;</dd>
	<dl>
	<a style="font-size: 10px;" href="javascript:" onclick="$('<? echo $div_id?>').toggle(); return false;">Más info del Plan</a>
	<div style="display: none; background-color: beige;" id="<? echo $div_id?>">
	<dl>
		<dt>Sector:</dt>				<dd><?php echo $p['Plan']['sector']?>&nbsp;</dd>
		<dt>Duracion:</dt>				<dd><?php echo " - ";?>&nbsp;</dd>
		<dt>&nbsp;&nbsp;-- Horas:</dt>	<dd><?php echo $p['Plan']['duracion_hs'];?>&nbsp;</dd>
		<dt>&nbsp;&nbsp;-- Semanas:</dt><dd><?php echo $p['Plan']['duracion_semanas'];?>&nbsp;</dd>
		<dt>&nbsp;&nbsp;-- Años:</dt>	<dd><?php echo $p['Plan']['duracion_anios'];?>&nbsp;</dd>
		<dt>matricula:</dt>				<dd><?php echo $p['Plan']['matricula']?>&nbsp;</dd>
		<dt>Observación:</dt>			<dd><?php echo $p['Plan']['observacion']?>&nbsp;</dd>
		<dt>Alta:</dt>					<dd><?php echo date('d/m/Y',strtotime($p['Plan']['created']))?>&nbsp;</dd>
		<dt>Modificación:</dt>			<dd><?php echo date('d/m/Y',strtotime($p['Plan']['modified']))?>&nbsp;</dd>
		
		<?php
			foreach ($p['Anio'] as $anio):
				$ciclos[$anio['ciclo_id']] = $anio['ciclo_id'];
			endforeach;
			
			$texto = '';
			foreach ($ciclos as $c):
				$texto .= " - ".$c;
			endforeach;
		?>
		<dt>Ciclos con información</dt><dd><?php echo $texto?>&nbsp;</dd>
		
	</dl> 
	</div>
	<hr>

<?php endforeach;?>

<?php echo $form->create('Instit',array('url'=>'/depuradores/clases_y_etp','id'=>'InstitDepurarForm'));?>
	<?php
		echo $form->input('id');	
				
		echo $form->input('claseinstit_id',array('label'=>'Seleccione tipo de Institución'));	
		echo $form->input('etp_estado_id',array('label'=>'Seleccione Relación de ETP'));
		
		
        
		echo $form->button('Guardar',array('onclick'=>'$("InstitDepurarForm").submit()'));                          
     	
         
                                   
		/**
		 *    NOMBRE
		 */	
		echo $form->input('nombre');
		
		
		/**
		 *    Nro Instit
		 */	
		echo $form->input('nroinstit',array('label'=>array(	'text'=>'Nº de Institución',
															'class'=>'input_label'),
											'class'=> 'input_text_peque'
		));		
			
		echo $form->input('anio_creacion');
		
		
		/**
		 *    DIRECCION
		 */	
		echo $form->input('direccion',array('label'=>array(	'text'=> 'Domicilio',
															'class'=>'input_label'),
											'class' => 'input_text_peque'
		));
			                          
                                   
		/**
		 *    CODIGO POSTAL
		 */							
		echo $form->input('cp',array('label'=>array('text'=>'Código Postal', 'class'=>'input_label'),
									 'class' => 'input_text_peque'
		));
		
		
		
	/****************************************************************************
	 *    
	 * 
	 * 
	 * 				DATOS ADICIONALES
	 * 
	 * 
	 */	
		?><H2>Datos Adicionales</H2><?
		/**
		 *    INGRESO/ACTUALIZACION
		 */	
		echo $form->input('actualizacion',array('label'=>array(	'text'=> 'Ingreso/Actualización',
																'class'=>'input_label'),
											    'class'=>'input_text_peque'
		));
		
		/**
		 *    OBSERVACION
		 */	
		echo $form->input('observacion');
			//agrego esto para que no se puedan imprimir mas de 100 caracteres en el textarea
			?>
			

		<?
		/**
		 *    CICLOS ALTA Y MODIFICACION
		 */	
		$ciclos = $this->requestAction('/Ciclos/dame_ciclos');
		echo $form->input('ciclo_alta', array("type" => "select", 
											  "options" => $ciclos,'label'=>'Alta',
											  "selected" => $this->data['Instit']['ciclo_alta']			
		));
		
	?>
<?php echo $form->end('Guardar');?>

</div>

