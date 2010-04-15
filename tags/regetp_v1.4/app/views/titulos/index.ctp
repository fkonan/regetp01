<div class="titulos index"> 
<h2><?php __('Títulos');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Página %page% de %pages%, desde %start% hasta %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('Nombre','name');?></th>
	<th><?php echo $paginator->sort("Marco de referencia",'marco_ref');?></th>
	<th><?php echo $paginator->sort("Oferta",'Oferta.name');?></th>
	<th class="actions"><?php __('Acciones');?></th>
</tr>
<?php
$i = 0;
foreach ($titulos as $titulo):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
<script>

</script>
<tr onmouseover="$(this).addClassName('altrow')" onmouseout="$(this).removeClassName('altrow')" >
            <td style="text-align: left;">
			<?php echo $titulo['Titulo']['name']; ?>
		</td>
		<td>
			<?php 
                        //echo ($titulo['Titulo']['marco_ref']==1)? "X":"";
                        if ($titulo['Titulo']['marco_ref']==1) {
                            echo $html->image('check_blue.jpg');
                        }
                        ?>
		</td>
		<td>
			<?php 
			$show = (empty($titulo['Oferta']['abrev']))? "" : $titulo['Oferta']['abrev'];
			echo $show; 
			?>
		</td>
		<td class="actions">
			<?php //echo $html->link(__('Ver','View', true), array('action'=>'view', $titulo['Titulo']['id'])); ?>
			<?php echo $html->link(__('Editar','Edit', true), array('action'=>'edit', $titulo['Titulo']['id'])); ?>
			<?php echo $html->link(__('Borrar','Delete', true), array('action'=>'delete', $titulo['Titulo']['id']), null, sprintf(__('Borrar %s?', true), $titulo['Titulo']['name'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('anterior', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('siguiente', true).' >>', array(), null, array('class'=>'disabled'));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Nuevo Título', true), array('action'=>'add')); ?></li>
	</ul>
</div>