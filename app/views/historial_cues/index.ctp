
<dl>

<?php foreach($cues as $c){?>
	<dt><?php echo $c['HistorialCue']['cue']*100+$c['HistorialCue']['anexo']." <span style='font-size:x-small'>(".$c['HistorialCue']['created'].")</span>"?></dt>
	<dd>
		<?php echo $html->link('Editar','/HistorialCues/edit/'.$c['HistorialCue']['id'])?>
		<?php echo $html->link('Eliminar','/HistorialCues/delete/'.$c['HistorialCue']['id'] , null, sprintf(__('Seguro que querés borrar el CUE # %s?', true), $c['HistorialCue']['cue']*100+$c['HistorialCue']['anexo'])); ?>
	</dd>
<?php }?>
<dl>


<hr>
<?php echo $html->link('Agregar Nuevo CUE','/HistorialCues/add/'.$instit_id);?>