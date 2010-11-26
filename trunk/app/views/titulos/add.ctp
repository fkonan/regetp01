<div class="titulos form"> 
<?php echo $form->create('Titulo');?>
	<fieldset>
 		<legend><?php __('Nuevo Título');?></legend>
	<?php
		echo $form->input('name', array('label'=>'Nombre del Título'));
		echo $form->input('marco_ref', array(//'label'=>'',
                                                    'legend'=>'Marco de Referencia',
                                                    //'div'=>'',
                                                   // 'style' => 'float: left',
                                                    'type'=>'radio',
                                                    'options'=>array(1=>'Con Marco de Referencia', 0=>'Sin marco de Referencia'))
		);
		echo $form->input('oferta_id');
	?>
        <h2>Sectores/Subsectores</h2>
        <cite>Agregue los Sectores/Subsectores correspondientes y seleccione el prioritario</cite>
        <div id="sectores">
            <div class="js-sector">
                <span>
                    <select class="js-sector-id" name="data[Titulo][SectoresTitulos][sector_id][]">
                        <?php foreach($sectores as $key=>$sector){?>
                            <option value="<?php echo $key?>"><?php echo $sector?></option>
                        <?php
                        }
                        ?>
                    </select>
                    <select class="js-subsector-id" name="data[Titulo][SectoresTitulos][subsector_id][]">
                        <option value="0">Ninguno</option>
                    </select>
                    <span class="spinner">
                    <?php
                    echo $html->image('loadercircle16x16.gif')
                    ?>
                    </span>
                    <span>
                        <input class="js-prioridad" type="radio" name="prioridades"/>
                        <input class="js-prioridad-hd" type="hidden" name="data[Titulo][SectoresTitulos][prioridad][]" value="0"/>
                    </span>
                </span>
                <span>
                    <?php echo $html->image('close.png',array('onclick'=>"if(jQuery('.js-sector').size() > 1)jQuery(this).closest('.js-sector').remove()")) ?>
                </span>
            </div>
        </div>
        <a style="cursor:pointer" onclick="jQuery('#sectores').append(jQuery('#sectores .js-sector').first().outer())">Agregar</a>
	</fieldset>
<?php echo $form->end('guardar');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Listar Títulos', true), array('action'=>'index'));?></li>
	</ul>
</div>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('.js-sector-id').live('change', function() {
            spinner = jQuery(this).parent().find('.spinner');
            PopularCombo(jQuery(this).parent().find('.js-subsector-id'),"<?= $html->url(array('controller'=> 'subsectores', 'action'=>'getSubSectoresBySector'))?>",{'sector' : jQuery(this).val()},true, spinner);
        });
        jQuery('.js-prioridad').live('change', function() {
            jQuery('#sectores input:checkbox').not(this).attr('checked', false);
            jQuery('#sectores input:hidden').val("0");
            jQuery(this).parent().find('.js-prioridad-hd').val("1");
        });
    });
</script>