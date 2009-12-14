	<?php //debug($queries);?>
	
	<script type="text/javascript">
		function ver_tabla(tabla){
			switch(tabla){
				case "total":
					$("table_total").style.display="block";
					$("table_privada").style.display="none";
					$("table_estatal").style.display="none";
					break;
				case "privada":
					$("table_total").style.display="none";
					$("table_privada").style.display="block";
					$("table_estatal").style.display="none";
					break;
				case "estatal":
					$("table_total").style.display="none";
					$("table_privada").style.display="none";
					$("table_estatal").style.display="block";
					break;
				default:
					break;				
			}
		}
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
		<?php echo $html->image('logo_me_09.JPG',array('style'=>'float:left; height: 80px;'));?>
		<?php echo $html->image('logoinet1.gif',array('style'=>'float: right; height: 70px;'));?>
	</div>
	
	<h2 style="clear:both;">Total de Instituciones de Educación Técnica Profesional ingresadas a la Base de Datos del Registro Federal de Instituciones de Educación Técnica Profesional (RFIETP) por ámbito de gestión según división político-territorial.</h2>
	
	
	<!-- ******************* Desde aca JS ******************* -->
	<!-- ***************** las tres tablas ******************  -->	
	<!-- ******************* Div estatal ******************* -->
	<div id="table_estatal" style="display:none;">
	<div class="tabs-list">
		<span class="tab-activa"><a href="javascript:#;" onclick="ver_tabla('estatal');">Gestión Estatal</a></span>
		<span class="tab-inactiva"><a href="javascript:#;" onclick="ver_tabla('privada');">Gestión Privada</a></span>
		<span class="tab-inactiva"><a href="javascript:#;" onclick="ver_tabla('total');">Total</a></span>
	</div>
	<div align="center" class="tabs-content">
	
	<table width="80%" cellpadding = "0" cellspacing = "0" summary="" style="border-style: solid; border-width: 1px; border-color: gray; border-top:none;">
	
	<tr>
		<th rowspan="2" class="head_select">División político-<br>territorial</th>
		<th colspan="4" class="head_select">Tipo de Establecimiento</th>
		<th rowspan="2" class="head_select" style="width:60px;">Total</th>
	</tr>
	<tr>
		<th class="head_select" style="width:95px;">Secundario</th>
		<th class="head_select" style="width:75px;">Superior</th>
		<th class="head_select" style="width:95px;">Formación Profesional</th>
		<th class="head_select" style="width:110px;">Inst con Programa de ETP</th>
	</tr>
	
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
	</table>
	</div>
	</div>
	
	<!-- ******************* Div privada ******************* -->
	<div id="table_privada" style="display:none;">
	<div class="tabs-list">
		<span class="tab-inactiva"><a href="javascript:#;" onclick="ver_tabla('estatal');">Gestión Estatal</a></span>
		<span class="tab-activa"><a href="javascript:#;" onclick="ver_tabla('privada');">Gestión Privada</a></span>
		<span class="tab-inactiva"><a href="javascript:#;" onclick="ver_tabla('total');">Total</a></span>
	</div>
	<div align="center" class="tabs-content">
	
	<table width="80%" cellpadding = "0" cellspacing = "0" summary="" style="border-style: solid; border-width: 1px; border-color: gray; border-top:none;">
	
	<tr>
		<th rowspan="2" class="head_select">División político-<br>territorial</th>
		<th colspan="4" class="head_select">Tipo de Establecimiento</th>
		<th rowspan="2" class="head_select" style="width:60px;">Total</th>
	</tr>
	<tr>
		<th class="head_select" style="width:95px;">Secundario</th>
		<th class="head_select" style="width:75px;">Superior</th>
		<th class="head_select" style="width:95px;">Formación Profesional</th>
		<th class="head_select" style="width:110px;">Inst con Programa de ETP</th>
	</tr>
	
	
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
	</table>
	</div>
	</div>
	
	<!-- ******************* Div total ******************* -->
	<div id="table_total" style="display:block;">
	<div class="tabs-list">
		<span class="tab-inactiva"><a href="javascript:#;" onclick="ver_tabla('estatal');">Gestión Estatal</a></span>
		<span class="tab-inactiva"><a href="javascript:#;" onclick="ver_tabla('privada');">Gestión Privada</a></span>
		<span class="tab-activa"><a href="javascript:#;" onclick="ver_tabla('total');">Total</a></span>
	</div>
	<div align="center" class="tabs-content">
	
	<table width="80%" cellpadding = "0" cellspacing = "0" summary="" style="border-style: solid; border-width: 1px; border-color: gray; border-top:none;">
	
	<tr>
		<th rowspan="2" class="head_select">División político-<br>territorial</th>
		<th colspan="4" class="head_select">Tipo de Establecimiento</th>
		<th rowspan="2" class="head_select" style="width:60px;">Total</th>
	</tr>
	<tr>
		<th class="head_select" style="width:95px;">Secundario</th>
		<th class="head_select" style="width:75px;">Superior</th>
		<th class="head_select" style="width:95px;">Formación Profesional</th>
		<th class="head_select" style="width:110px;">Inst con Programa de ETP</th>
	</tr>
	
	
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
	</table>
	</div>
	</div>
	<!-- ******************* Hasta aca JS ******************* -->
	
	
	
	<div style="float:left;">
		<p style="font-size: 10px;"><u>Fuente</u>: 
		INET-Ministerio de Educación. Unidad de información - 
		Área Registro Federal de Instituciones de Educación Profesional. 
		Información al <?php echo date("d-m-Y");?>
		</p>
		
		
		<p  style="font-size: 10px;"><u>Nota</u>: 
		<!--  
		/**** ESTO POR AHORA NO VA !!! porque el cuadro lo recortamos esperando a la normalizacion de clases de instits ***/
		Desde Diciembre de 2007 se adoptó un nuevo criterio de clasificación de las instituciones de ETP ingresadas al Registro 
		Federal de Instituciones de ETP. En los casos que la institución oferta más de un nivel de enseñanza se la categorizó de 
		acuerdo al mayor nivel que brinda, de forma de evitar contabilizar un mismo establecimiento más de una vez. De ahí las 
		diferencias que pueden observarse con los informes trimestrales previamente presentados.<br>
		 Se incluyeron por otra parte de forma diferenciada a las instituciones de ETP dependientes de Universidad Nacionales.
		 -->
		 Se incluyeron de forma diferenciada a las instituciones de ETP dependientes de Universidad Nacionales.
		 </p>
		 
		<p align="center">
		<a href="javascript:print();" class="btn-imprimir no-ver-para-imprimir ">Imprimir</a>
		</p>
	</div>