<div class="titulos index"> 
<h2><?php __('Títulos');?></h2>
<?php
echo $javascript->link(array(
            'jquery.autocomplete',
            'jquery.loadmask.min',
            'jquery-ui-1.8.5.custom.min',
            'views/titulos/search_form'
        ));
echo $html->css(array('jquery.loadmask', 'smoothness/jquery-ui-1.8.5.custom'));
?>
<?php 
        echo $form->create('Titulo', array(
            'action' => 'ajax_index_search',
            'name'=>'TituloSearchForm',
            'id' =>'TituloSearchForm',
            )
        );

        echo $form->input(
        'oferta_id',
        array(
            'label'=> 'Oferta',
            'id' => 'ofertaId',
            'empty' => 'Todas'
            ));

        echo $form->input(
        'tituloName',
        array(
            'label'=> 'Nombre del Título de Referencia',
            'id' => 'TituloName',
            'style'=>'width: 450px; clear:none; float:left;',
            ));

        echo $form->button('Limpiar búsqueda', array(
                'class' => 'boton-buscar',
                'style' => 'clear:both; float:left; width:130px;',
                'onclick' => 'location.href="'.$html->url("index").'"',
         ));


        echo $form->button('Fusionar Títulos', array(
                'id' => 'fusion',
                'class' => 'boton-buscar',
                'style' => 'clear:none; float:right; width:130px;',
                'onclick' => 'this.href="'.$html->url("fusionar").'"; return (fusionarTitulos(this))',
                'disabled' => true
         ));

        echo $form->end();
?>

<!-- Aca se muestran los resultados de la busqueda-->
<div id='consoleResultWrapper'  style="clear:both; margin-top: 20px;">
    <div id='consoleResult' style="min-height: 200px; margin-bottom: 20px;">
        <?php
        echo $paginator->counter(array(
        'format' => __('Página %page% de %pages% (total %count%)', true)
        ));
        ?>
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
                    <td style="text-align: left; font-size: 9pt;">
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
        if ($paginator->numbers()) {
        ?>
        <div style="text-align:center; display:block;margin-bottom: 10px">
            <?php echo $paginator->prev('<< '.__('anterior', true), array(), null, array('class'=>'disabled'));?>
        |   <?php echo $paginator->numbers();?>
            <?php echo $paginator->next(__('siguiente', true).' >>', array(), null, array('class'=>'disabled'));?>
        </div>
        <?php } ?>
    </div>
</div>

</div>

<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Nuevo Título', true), array('action'=>'add')); ?></li>
                <li><?php echo $html->link(__('Corrector de Títulos de Planes', true), array('action'=>'corrector_de_planes')); ?></li>
	</ul>
</div>