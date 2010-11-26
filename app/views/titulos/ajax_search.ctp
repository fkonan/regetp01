<?php
    echo $paginator->counter(array(
    'format' => __('Página %page% de %pages% (%count% Títulos encontrados)', true)
    ));

    $paginator->options(array('update' => 'consoleResult', 'url' => $this->passedArgs,'indicator'=> 'ajax_indicator'));
?>
<div style="margin-top: 30px">
        <?
        if (sizeof($titulos) > 0) {?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                    <th></th>
                    <th><?php echo $paginator->sort('Nombre','name');?></th>
                    <th><?php echo $paginator->sort("Marco de referencia",'marco_ref');?></th>
                    <th><?php echo $paginator->sort("Oferta",'Oferta.name');?></th>
                    <th class="actions"><?php __('Acciones');?></th>
            </tr>
        <?php
        $i = 0;
        foreach ($titulos as $titulo):
        ?>
            <tr onmouseover="jQuery(this).addClass('alt2row')" onmouseout="jQuery(this).removeClass('alt2row')" >
                <td style="text-align: left;">
                            <input type="checkbox" id="<?php echo $titulo['Titulo']['id']; ?>" onclick="habilitarFusion();">
                </td>
                <td style="text-align:left; font-size: 9pt;">
                            <?php echo $titulo['Titulo']['name']; ?>
                </td>
                <td>
                        <?php
                        if ($titulo['Titulo']['marco_ref']==1) {
                            echo $html->image('check_blue.jpg');
                        }
                        ?>
                </td>
                <td>
                        <?php
                        echo (empty($titulo['Oferta']['abrev']))? "" : $titulo['Oferta']['abrev'];
                        echo $form->input('oferta_'.$titulo['Titulo']['id'], array('type' => 'hidden', 'value' => $titulo['Titulo']['oferta_id']));
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
        <?php
        }

   if ($paginator->numbers()) {
   ?>
    <div style="text-align:center; display:block;margin-bottom: 10px">
        <?php echo $paginator->prev('<< '.__('anterior', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('siguiente', true).' >>', array(), null, array('class'=>'disabled'));?>
    </div>
    <?php  } ?>
</div>