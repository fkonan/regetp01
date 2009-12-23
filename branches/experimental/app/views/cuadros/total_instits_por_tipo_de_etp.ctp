	<?php //debug($queries);?>
	
	<script type="text/javascript">
		function ver_tabla(tabla){
			switch(tabla){
				case "total":	
					$('gestion-titulo').update('Ámbito de Gestión: Total');				
					$("table_total").show();
					$("tab_total").removeClassName('tab-grande-inactiva');
					$("tab_total").addClassName('tab-grande-activa');
					$("table_privada").hide();
					$("tab_privada").removeClassName('tab-grande-activa');
					$("tab_privada").addClassName('tab-grande-inactiva');
					$("table_estatal").hide();
					$("tab_estatal").removeClassName('tab-grande-activa');
					$("tab_estatal").addClassName('tab-grande-inactiva');
					break;
				case "privada":
					$('gestion-titulo').update('Ámbito de Gestión: Privada');
					$("table_total").hide();
					$("tab_total").removeClassName('tab-grande-activa');
					$("tab_total").addClassName('tab-grande-inactiva');
					$("table_privada").show();
					$("tab_privada").removeClassName('tab-grande-inactiva');
					$("tab_privada").addClassName('tab-grande-activa');
					$("table_estatal").hide();
					$("tab_estatal").removeClassName('tab-grande-activa');
					$("tab_estatal").addClassName('tab-grande-inactiva');
					break;
				case "estatal":
					$('gestion-titulo').update('Ámbito de Gestión: Estatal');
					$("table_total").hide();
					$("tab_total").removeClassName('tab-grande-activa');
					$("tab_total").addClassName('tab-grande-inactiva');
					$("table_privada").hide();
					$("tab_privada").removeClassName('tab-grande-activa');
					$("tab_privada").addClassName('tab-grande-inactiva');
					$("table_estatal").show();
					$("tab_estatal").removeClassName('tab-grande-inactiva');
					$("tab_estatal").addClassName('tab-grande-activa');
					break;
				default:
					ver_tabla('total');
					break;				
			}
		}

		//Event.observe(window,'load', ver_tabla);
	</script>
	
	<style>
		/* ESTO ES PARA QUE NO ME IMPRIMA EL ENCABEZADO CUANDO MANDO A IMPRIMIR*/
		@media print
		  {
			  #header {
			   display: none;
			  }
		  }
	</style>
	
	
	<div class="ver-solo-para-imprimir logos-header">
		<?php echo $html->image('logo_me_09.JPG',array('style'=>'float:left; height:86px; width:212px;'));?>
		<?php echo $html->image('logoinet1.gif',array('style'=>'float:right; height:98px; width:167px;'));?>
	</div>
	

	<h2  align="center" style="clear:both;">
		Total de Instituciones de Educación Técnica Profesional ingresadas a la Base de Datos 
		del Registro Federal de Instituciones de Educación Técnica Profesional (RFIETP) 
		por ámbito de gestión y tipo de institución de ETP según división político-territorial.
		</h2>
	
	<div class="tabs-list no-imprimir">
		<span id="tab_estatal" 	class="tab-grande-inactiva"><a href="javascript:void(null);" onclick="ver_tabla('estatal');">Gestión Estatal</a></span>
		<span id="tab_privada" 	class="tab-grande-inactiva"><a href="javascript:void(null);" onclick="ver_tabla('privada');">Gestión Privada</a></span>
		<span id="tab_total" 	class="tab-grande-activa"><a href="javascript:void(null);" onclick="ver_tabla('total');">Total</a></span>
	</div>
	
	
	
	<!-- ******************* Desde aca JS ******************* -->
	<!-- ***************** las tres tablas ******************  -->	
	<!-- ******************* Div estatal ******************* -->
	<div>
		<div align="center" class="tabs-content">		
			<table width="90%" cellpadding = "0" cellspacing = "0" summary="" 
					style="
						border-style: solid; 
						border-width: 1px; 
						border-color: #DBEBF6; 
						border-top: none; font-size: 9pt;">
			
				<thead>					
					<tr>
						<th colspan="6" class="head_select" align="center"><br /><span id="gestion-titulo">Ámbito de Gestión: Total</span></th>
					</tr>
					
					<tr>
						<th rowspan="2" class="head_select" align="center">División <br />político-territorial</th>
						<th colspan="4" class="head_select" align="center">Tipo de Institución</th>
						<th rowspan="2" class="head_select" width="60px" align="center">Total</th>
					</tr>
					
					<tr>
						<th width="40" class="head_select" align="center">Secundario</th>
						<th width="40" class="head_select" align="center">Superior</th>
						<th width="40" class="head_select" align="center">Formación Profesional</th>
						<th class="head_select" align="center">Inst. con<br />Programa<br />de ETP</th>
					</tr>
				</thead>
				
				
				
				
				<!--      ESTATAL 					-->
				<!--      ESTATAL 					-->
				<!--      ESTATAL 					-->
				
				<tbody id="table_estatal" style="display: none;">
			
				<?php
				$i = 0;
				foreach ($queries as $query):
					$class = '';
					if ($i++ % 2 == 0) {
						$class = ' class="altrow"';
					}
				
					$style = ($query[0]['División político-territorial']== 'Total')?' style="background-color: #fff; color: #233e87; font-weight: bolder; border-top: 1px solid silver;':'style="';
				?>
					<tr<?php echo $class;?>>
					   <?php foreach($query[0] as $head=>$line): 
						    $style = $style." border-right: solid silver 1px; border-bottom: solid silver 1px;  ";
						   	if($head == 'División político-territorial') {
						   		$style1 = $style.'text-align:left;"';
						   ?>		
							<td <?php echo $style1?>>
								<?php echo (is_numeric($line))?number_format($line, 0, ',', '.'):$line; ?>
							</td>
							
							<?php 
						   	} else {
						   		$style1 = $style.'text-align:right;"';
						   		if(substr_count($head, 'estatal')>0) {
							   	?>
									<td <?php echo $style1?>>
										<?php echo (is_numeric($line))?number_format($line, 0, ',', '.'):$line; ?>
									</td>			
								<?php 
							   	} 
							}
							?>
						<?php endforeach; ?>
					</tr>
				<?php endforeach; ?>
			</tbody>
	
	
	
	
				<!--      PRIVADA 					-->
				<!--      PRIVADA 					-->
				<!--      PRIVADA 					-->
			<tbody id="table_privada" style="display: none">	
				<!-- 
				<tr class="altrow2">
					<?php foreach ($precols as $key=>$precol): 
						$colspan = ($key==1)? "colspan=2":"";	
						?>		
						<th <?php echo $colspan;?>><?php echo $precol;?></th>
					<?php endforeach; ?>
				</tr>
				<tr class="altrow2">
					<?php foreach ($cols as $col): ?>
					<th><?php echo $col;?></th>
					<?php endforeach; ?>
				</tr>
				 -->
				
				<?php
				$i = 0;
				foreach ($queries as $query):
					$class = '';
					if ($i++ % 2 == 0) {
						$class = ' class="altrow"';
					}
				?>
					<?php 
					$style = ($query[0]['División político-territorial']== 'Total')?' style="background-color: #fff; color: #233e87; font-weight: bolder; border-top: 1px solid silver;':'style="';
					?>
					<tr<?php echo $class;?>>
					   <?php foreach($query[0] as $head=>$line): 
						    $style = $style." border-right: solid silver 1px; border-bottom: solid silver 1px;  ";
						   	if($head == 'División político-territorial') {
						   		$style1 = $style.'text-align:left;"';
						   ?>		
						   		
							<td <?php echo $style1?>>
								<?php echo (is_numeric($line))?number_format($line, 0, ',', '.'):$line; ?>
							</td>
							
							<?php 
						   	} else {
						   		$style1 = $style.'text-align:right;"';
						   		if(substr_count($head, 'privada')>0) {
							   	?>
									<td <?php echo $style1?>>
										<?php echo (is_numeric($line))?number_format($line, 0, ',', '.'):$line; ?>
									</td>			
								<?php 
							   	} 
							}
							?>
						<?php endforeach; ?>
					</tr>
				<?php endforeach; ?>
			</tbody>
				
				
				
				
			<!--      TOTAL 					-->
			<!--      TOTAL 					-->
			<!--      TOTAL 					-->
			<tbody id="table_total">
				<!-- 
				<tr class="altrow2">
					<?php foreach ($precols as $key=>$precol): 
						$colspan = ($key==1)? "colspan=2":"";	
						?>		
						<th <?php echo $colspan;?>><?php echo $precol;?></th>
					<?php endforeach; ?>
				</tr>
				<tr class="altrow2">
					<?php foreach ($cols as $col): ?>
					<th><?php echo $col;?></th>
					<?php endforeach; ?>
				</tr>
				 -->
				
				<?php 
				$i = 0;
				foreach ($queries as $query):
					$class = '';
					if ($i++ % 2 == 0) {
						$class = ' class="altrow"';
					}
				
					$style = ($query[0]['División político-territorial']== 'Total')?' style="background-color: #fff; color: #233e87; font-weight: bolder; border-top: 1px solid silver;':'style="';
				?>
					<tr<?php echo $class;?>>
					   <?php foreach($query[0] as $head=>$line): 
						    $style = $style." border-right: solid silver 1px; border-bottom: solid silver 1px;  ";
						   	if($head == 'División político-territorial') {
						   		$style1 = $style.'text-align:left;"';
						   ?>		
						   		
							<td <?php echo $style1?>>
								<?php echo (is_numeric($line))?number_format($line, 0, ',', '.'):$line; ?>
							</td>
							
							<?php 
						   	} else {
						   		$style1 = $style.'text-align:right;"';
						   		if(substr_count($head, 'total')>0) {
							   	?>
									<td <?php echo $style1?>>
										<?php echo (is_numeric($line))?number_format($line, 0, ',', '.'):$line; ?>
									</td>			
								<?php 
							   	} 
							}
							?>
						<?php endforeach; ?>
					</tr>
				<?php endforeach; ?>
			</tbody>
			
	</table><!-- FIN TABLA DE DATOS -->
	
	
	
	<div style="float:left;" align="justify">
		<p style="font-size: 9pt;"><u>Fuente</u>: 
		INET-Ministerio de Educación. Unidad de información - 
		Área Registro Federal de Instituciones de Educación Profesional. 
		Información al <?php echo date("d-m-Y");?>
		</p>
		
		
		<p  style="font-size: 9pt;"><u>Nota</u>: 
		Existen instituciones que brindan más de una oferta educativa. En estos casos se casificaron según sus características institucionales.
		<!-- Se incluyeron de forma diferenciada a las instituciones de ETP dependientes de Universidad Nacionales. -->
		 </p>
		 
		<p align="center">
		<a href="javascript:print();" class="btn-imprimir no-ver-para-imprimir ">Imprimir</a>
		</p>
	</div>