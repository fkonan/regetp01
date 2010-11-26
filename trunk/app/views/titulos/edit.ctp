<div class="titulos form">
<?php echo $form->create('Titulo');?>
	<fieldset>
 		<legend><?php __('Nuevo Título');?></legend>
                <h2>Datos</h2>
	<?php
                echo $form->input('id');
		echo $form->input('name', array('label'=>'Nombre del Título'));
		echo $form->input('marco_ref', array(//'label'=>'',
                                                    'legend'=>'Marco de Referencia',
                                                    //'div'=>'',
                                                   // 'style' => 'float: left',
                                                    'type'=>'radio',
                                                    'options'=>array(1=>'Con Marco de Referencia', 0=>'Sin marco de Referencia'))
		);
		echo $form->hidden('old_oferta_id');
		echo $form->input('oferta_id');
	?>
        <h2>Sectores/Subsectores</h2>
        <cite>Agregue los Sectores/Subsectores correspondientes y seleccione el prioritario</cite>
        <div id="sectores">
            <?php
            foreach($this->data['SectoresTitulo'] as $sector_subsector){
                $subsectores = array();
            ?>
            <div class="js-sector">
                <span>
                    <select class="js-sector-id" name="data[Titulo][SectoresTitulos][sector_id][]">
                        <?php
                        foreach($sectores as $sector){
                            if($sector['Sector']['id'] == $sector_subsector['sector_id']){
                                $subsectores = $sector['Subsector'];
                            }
                        ?>
                            <option value="<?php echo $sector['Sector']['id']?>" <?php echo ($sector['Sector']['id'] == $sector_subsector['sector_id'])? "selected":"" ?>><?php echo $sector['Sector']['name']?></option>
                        <?php
                        }
                        ?>
                    </select>
                    <select class="js-subsector-id" name="data[Titulo][SectoresTitulos][subsector_id][]">
                        <option value="0">Ninguno</option>
                        <?php foreach($subsectores as $subsector){?>
                            <option value="<?php echo $subsector['id']?>" <?php echo ($subsector['id'] == $sector_subsector['subsector_id'])? "selected":"" ?>><?php echo $subsector['name']?></option>
                        <?php
                        }
                        ?>
                    </select>
                    <span class="spinner">
                    <?php
                    echo $html->image('loadercircle16x16.gif')
                    ?>
                    </span>
                    <span>
                        <input class="js-prioridad" type="radio" name="prioridades" <?php echo ($sector_subsector['prioridad'] != 0 )?"checked":""?>/>
                        <input class="js-prioridad-hd" type="hidden" name="data[Titulo][SectoresTitulos][prioridad][]" value="<?php echo $sector_subsector['prioridad']?>"/>
                    </span>
                </span>
                <span>
                    <a style="cursor:pointer" onclick="if(jQuery('.js-sector').size() > 1)jQuery(this).closest('.js-sector').remove()">X</a>
                </span>
            </div>
            <?php
            }
            ?>
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