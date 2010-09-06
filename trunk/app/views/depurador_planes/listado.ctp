

<div class="instits form">
<h1>Editar Planes</h1>


<?php 
	echo $form->create('Plan',array('url'=>'/depuradores/depurar_manual_estructura_planes',
					'id'=>'estructura_plan'));

        $z_anios = array('1'=>'No coinciden los numeros iniciales del año',
                         '2'=>'Cantidad de años incongruente',
                         '3'=>'Estructura Incorrecta'
                        );
        echo $form->input('jurisdiccion_id', array('empty'=>'Seleccione','value'=>$jurisdiccion_id,'div'=>false));
        echo $form->input('z_anios', array('empty'=>'Seleccione','options'=>$z_anios,'label'=>'Tipo de Error','div'=>false));
		
	echo $form->end('Buscar');
?> 


<h2>Planes</h2>


<?php foreach ($planes as $p):?>
<?php $div_id = "plan-id-".$p['Plan']['id']; ?>
	<dl style="font-size: 12px;">
		<dt>Nombre:</dt>				<dd style="margin-left: 10em;"><?php echo $html->link($p['Plan']['nombre'],'/Planes/view/'.$p['Plan']['id'])?>&nbsp;</dd>
		<dt>Sector:</dt>				<dd style="color: OrangeRed; font-size: 12px;"><?php echo $p['Sector']['name']?> &nbsp;( Orientación: <?php echo (!empty($p['Sector']['Orientacion']['name']))?$p['Sector']['Orientacion']['name']:"";?> )&nbsp;</dd>
	</dl>
	<a style="font-size: 10px;" href="javascript:" onclick="jQuery('#<? echo $div_id?>').toggle(); return false;">Más info del Plan</a>
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

        
</div>



