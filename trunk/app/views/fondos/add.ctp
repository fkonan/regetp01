<?
//echo $javascript->link('jquery-1.4.2.min');
echo $javascript->link('jquery.autocomplete');
echo $javascript->link('jquery.blockUI');
echo $html->css('jquery.autocomplete.css');
?>
<script type="text/javascript">
    jQuery(document).ready(function() {

        CambiaTipoFondo();

        jQuery(document).ajaxStart(function() {
            jQuery.blockUI({ message: '<h1>Buscando...</h1>',overlayCSS: { backgroundColor: '#00f' }, showOverlay: true });
        });

        jQuery(document).ajaxStop(jQuery.unblockUI);

        jQuery("#FondoTemporalPosibleInstit").autocomplete("<?echo $html->url(array('controller'=>'fondo_temporales','action'=>'search_instits'));?>", {
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
                jQuery("#FondoTemporalEditForm fieldset #institCueInfo").remove();
                jQuery("#FondoTemporalEditForm fieldset .institCueInfo").remove();

                jQuery("#FondoTemporalEditForm").append("<input id='hiddenInstitId' name='data[FondoTemporal][instit_id]' type='hidden' value='" + item.id + "' />");

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

                jQuery("#FondoTemporalEditForm fieldset").append(div);

        });

    });

    function format(instit) {
                return instit.nombre + " [" + instit.cue + "]";
    }

    function CambiaTipoFondo() {
        if (jQuery('#tipoFondo :selected').val() == 'i') {
            jQuery('#buscador_instit').show();
            jQuery('#jurisdiccional').hide();
        }
        else {
            jQuery('#jurisdiccional').show();
            jQuery('#buscador_instit').hide();
        }
    }
</script>
<div class="fondos form">

    <?php echo $form->create('FondoTemporal');?>
    <fieldset>
    <?php
        echo $form->input("Tipo de fondo: ", array(
                                            'id' => 'tipoFondo',
                                            'options' => array('i'=>'Institucional','j'=>'Jurisdiccional'),
                                            'default' => array('i'),
                                            'onchange'=> 'CambiaTipoFondo();'
             ));
    ?>

    <div id="buscador_instit">
    <?php
        echo $form->input('posible_instit', array('label'=>'Posible nombre o CUE de la institucion','value'=>($this->data['Instit']['cue'] * 100 + $this->data['Instit']['anexo'])));
    ?>
    </div>
    <div id="jurisdiccional">
    <?php
        echo $form->input('jurisdiccion_id', array('label'=>'Jurisdiccion','options'=>$jurisdicciones));
    ?>
    </div> 
    </fieldset>
    

<?php echo $form->create('Fondo');?>
	<fieldset>
 		<legend><?php __('Add Fondo');?></legend>
	<?php
		echo $form->input('instit_id');
		echo $form->input('jurisdiccion_id');
		echo $form->input('total');
		echo $form->input('anio');
		echo $form->input('trimestre');
		echo $form->input('memo');
		echo $form->input('resolucion');
		echo $form->input('description');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Fondos', true), array('action' => 'index'));?></li>
	</ul>
</div>
