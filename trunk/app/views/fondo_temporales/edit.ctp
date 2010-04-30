<div class="fondo_temporales form">
<?php echo $form->create('FondoTemporal');?>
	<fieldset>
 		<legend><?php __('Edit Fondo Temporal');?></legend>
                <div style="float:left">La diferencia es de: <?php echo $difference?></div>
	<?php
                                
		echo $form->input('id');
		echo $form->input('f01');
                echo $form->input('f02a');
                echo $form->input('f02b');
                echo $form->input('f02c');
                echo $form->input('f03a');
                echo $form->input('f03b');
                echo $form->input('f04');
                echo $form->input('f05');
                echo $form->input('f06a');
                echo $form->input('f06b');
                echo $form->input('f07a');
                echo $form->input('f07b');
                echo $form->input('f07c');
                echo $form->input('f08');
                echo $form->input('f09');
                echo $form->input('f10');
                echo $form->input('equipinf');
                echo $form->input('refaccion');
                echo "<br/>-----------------------------------------------------------------------------------------------<br/>";
                echo $form->input('total');
                echo $form->hidden('totales_checked',array('value'=>0));
                
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Listar Fondos Temporales', true), array('controller'=>'fondo_temporales','action'=>'checked_instits'));?></li>
                <li><?php echo $html->link(__('Ejecutar Validacion de Totales', true), array('controller'=>'fondo_temporales','action'=>'validar_totales'));?></li>
	</ul>
</div>
