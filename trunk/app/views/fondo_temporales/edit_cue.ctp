<?
echo $javascript->link('jquery-1.4.2.min');
echo $javascript->link('jquery.autocomplete');
echo $javascript->link('jquery.blockUI');
echo $html->css('jquery.autocomplete.css');
?>
<!--<script language="javascript">
    jQuery(document).ready(function() {
        jQuery.noConflict();

        jQuery("#FondoTemporalSearchPosibleInstit").autocomplete("<?echo $html->url(array('controller'=>'fondo_temporales','action'=>'search_instits'));?>", {
            width: 260,
            selectFirst: true,
            matchContains: true
        });
    });

</script>-->
<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery.noConflict();

        jQuery(document).ajaxStart(function() {
            jQuery.blockUI({ message: '<h1>Loading...</h1>' });
        });
        
        jQuery(document).ajaxStop(jQuery.unblockUI);

        jQuery("#FondoTemporalSearchPosibleInstit").autocomplete("<?echo $html->url(array('controller'=>'fondo_temporales','action'=>'search_instits'));?>", {
		dataType: "json",
		parse: function(data) {
			return jQuery.map(data, function(instit) {
				return {
					data: instit,
					value: instit.nombre,
					result: instit.nombre
				}
			});
		},
		formatItem: function(item) {
			return format(item);
		}
	}).result(function(e, item) {
                jQuery("#hiddenInstitId").remove();
                jQuery("#FondoTemporalSearchAddForm fieldset #institCueInfo").remove();
                jQuery("#FondoTemporalSearchAddForm fieldset .institCueInfo").remove();

                jQuery("#FondoTemporalSearchAddForm").append("<input id='hiddenInstitId' name='data[FondoTemporalSearch][instit_id]' type='hidden' value='" + item.id + "' />");

                var div = "<div id='institCueInfo' class='institCueInfo'>" +
                              "<h4> Informacion sobre la Institucion </h4>" +
                              "<div><strong>CUE: </strong>" + item.cue + "</div>" +
                              "<div><strong>Nro.Instit: </strong>" + item.nroinstit + "</div>" +
                              "<div><strong>Tipo de Institucion: </strong>" + item.tipo + "</div>" +
                              "<div><strong>Año de Creacion: </strong>" + item.anio_creacion + "</div>" +
                              "<div><strong>Direccion: </strong>" + item.direccion + "</div>" +
                              "<div><strong>Departamento: </strong>" + item.depto + "</div>" +
                              "<div><strong>Localidad: </strong>" + item.localidad + "</div>" +
                              "<div><strong>Jurisdiccion: </strong>" + item.jurisdiccion + "</div>" +
                              "<div><strong>Codigo Postal: </strong>" + item.cp + "</div>" +
                              "<div><strong>CUE anterior: </strong>" + item.cue_anterior + "</div>" +
                          "</div>";

                jQuery("#FondoTemporalSearchAddForm fieldset").append(div);

        });
    });
    
    function format(instit) {
                return instit.nombre + " [" + instit.cue + "]";
    }    
</script>

<div class="fondo_temporales form">
        <?php echo $form->create('FondoTemporal');?>
	<fieldset>
 		<legend><?php __('Editar CUEs Temporal');?></legend>
                

	<?php
                echo '<h2>' . (($this->data['FondoTemporal']['cue_checked'] == 0)?'Institucion No Imputada':'Institucion en Duda') . '</h2>';
		echo $form->input('cuecompleto');
                echo $form->input('instit');
                echo $form->input('instit_name');
                echo $form->input('jurisdiccion_name');

                echo $form->input('observacion');

	?>
	</fieldset>
        <?php echo $form->end();?>

        <?php echo $form->create('FondoTemporalSearch');?>
	<fieldset>
 		<h2><?php __('Buscador de Instituciones');?></h2>


	<?php
                echo $form->input('posible_instit');
                //echo $form->input('jurisdiccion_id');
	?>
	</fieldset>
        <?php echo $form->end("Imputar Institucion");?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Listar Fondos Temporales', true), array('controller'=>'fondo_temporales','action'=>'checked_instits'));?></li>
                <li><?php echo $html->link(__('Ejecutar Validacion de Totales', true), array('controller'=>'fondo_temporales','action'=>'validar_totales'));?></li>
	</ul>
</div>
