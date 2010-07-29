<?
echo $javascript->link(array('jquery.multiselect2side'));
echo $html->css(array('jquery.multiselect2side.css'));
?>
<style>
    .etapasJurisdicciones form div{
        clear:none;
    }

</style>
<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery('#etapas').multiselect2side({
				selectedPosition: 'left',
				moveOptions: false,
				labelsx: 'Seleccionadas',
				labeldx: 'Disponibles'
                            });
    })
</script>

<div class="etapasJurisdicciones index">

<h2><?php __('Etapas por Jurisdicciones');?></h2>

<?php echo $form->create('EtapasJurisdiccion',array('action' => 'index','name'=>'EtapasJurisdiccionForm'));?>
<div>
<select name="data[EtapasJurisdiccion][etapas_selected][]" id='etapas' multiple='multiple' size='10'>
        <?php
        foreach ($etapasSeleccionadas as $etapaSeleccionada){?>
            <option value="<?php echo $etapaSeleccionada['Etapa']['id']; ?>" SELECTED><?php echo $etapaSeleccionada['Etapa']['name']; ?></option>
        <?php 
        }
        ?>
        <?php
        foreach ($etapasNoSeleccionadas as $etapaNoSeleccionada):?>
            <option value="<?php echo $etapaNoSeleccionada['Etapa']['id'] ?>"><?php echo $etapaNoSeleccionada['Etapa']['name'] ?></option>
        <?php endforeach; ?>

</select>
<input name="data[EtapasJurisdiccion][jurisdiccion_id]" type="hidden" value="<?php echo $jurisdiccion_id?>" />
</div>
<?php echo $form->end("Guardar"); ?>
</div>




