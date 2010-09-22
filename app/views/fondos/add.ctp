<?
//echo $javascript->link('jquery-1.4.2.min');
echo $javascript->link('jquery.autocomplete');
echo $javascript->link('jquery.blockUI');
echo $html->css('jquery.autocomplete.css');
?>
<script type="text/javascript">
    jQuery(document).ready(function() {

        <?php if (empty($this->data['Fondo']['instit_id'])) {?>
            jQuery('#FondoTipo').val('j');
        <? }?>

        CambiaTipoFondo();

        jQuery(document).ajaxStart(function() {
            jQuery.blockUI({ message: '<h1>Buscando...</h1>',overlayCSS: { backgroundColor: '#00f' }, showOverlay: true });
        });

        jQuery(document).ajaxStop(jQuery.unblockUI);

        jQuery("#FondoPosibleInstit").autocomplete("<?echo $html->url(array('controller'=>'fondo_temporales','action'=>'search_instits'));?>", {
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
                jQuery("#FondoEditForm fieldset #institCueInfo").remove();
                jQuery("#FondoEditForm fieldset .institCueInfo").remove();

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

                jQuery("#FondoEditForm fieldset").append(div);

                jQuery("#FondoInstitId").val(item.id);

        });

    });

    function format(instit) {
                return instit.nombre + " [" + instit.cue + "]";
    }

    function CambiaTipoFondo() {
        if (jQuery('#FondoTipo :selected').val() == 'i') {
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

    <?php echo $form->create('Fondo');?>
    <fieldset>
        <?php
            echo $form->input("tipo", array(
                                                'label' => 'Tipo de Fondo',
                                                'options' => array('i'=>'Institucional','j'=>'Jurisdiccional'),
                                                'default' => array('i'),
                                                'onchange'=> 'CambiaTipoFondo();'
                 ));
        ?>

        <div id="buscador_instit">
        <?php
            echo $form->input('posible_instit', array('label'=>'Posible nombre o CUE de la institucion','value'=>($this->data['Instit']['cue'] * 100 + $this->data['Instit']['anexo'])));
            echo $form->input('instit_id', array('type'=>'hidden'));
        ?>
        </div>
        <div id="jurisdiccional">
        <?php
            echo $form->input('jurisdiccion_id', array('label'=>'Jurisdiccion','options'=>$jurisdicciones));
        ?>
        </div>
        <br />
        <label style="display:inline; width:100px; text-align: right;">Año:</label>
        <?=$form->input('anio', array('options'=>$anios, 'default'=>date('Y'), 'style'=>'width: 70px; display:inline;', 'div' => false, 'label' => false))?>
        <label style="display:inline; width:100px; text-align: right;">Trimestre:</label>
        <?=$form->input('trimestre', array('options'=>array('1'=>'1','2'=>'2','3'=>'3','4'=>'4'), 'default'=>$trimestre, 'style'=>'width: 40px; display:inline;', 'div' => false, 'label' => false))?>
        <label style="display:inline; width:100px; text-align: right;">Memo:</label>
        <?=$form->input('memo', array('maxlength'=>30, 'size'=>10, 'style'=>'width: 40px; display:inline;', 'div' => false, 'label' => false))?>
        <label style="display:inline; width:100px; text-align: right;">Resolución:</label>
        <?=$form->input('resolucion', array('maxlength'=>30, 'size'=>10, 'style'=>'width: 70px; display:inline;', 'div' => false, 'label' => false))?>

	<?php
            echo $form->input('total');
		
            echo $form->input('description', array('label'=>'Descripción'));
	?>

        <h2>Lineas de Accion</h2>
        <div title="Lineas de Accion" class="lista_lineas">
            <dl class="item_lineas" style="cursor:pointer;padding:0px !important">
                <div id="detalle">
                <dt onmouseout="jQuery(this).toggleClass('item_fondos_seleccionado')" onmouseover="jQuery(this).toggleClass('item_fondos_seleccionado')" class="" >
                    <span>
                        <?php echo $html->image('/img/modify.png', array('alt' => 'Modificar'))?>
                        <?php echo $html->image('/img/delete.png', array('alt' => 'Borrar'))?>
                    </span>
                    <span>
                        F05 - Equipamiento de talleres, laboratorios y espacios productivos
                    </span>
                </dt>
                <dd>$ 84.025,00</dd>
                <dt onmouseout="jQuery(this).toggleClass('item_fondos_seleccionado')" onmouseover="jQuery(this).toggleClass('item_fondos_seleccionado')" class="" >
                    <span>
                        <?php echo $html->image('/img/modify.png', array('alt' => 'Modificar'))?>
                        <?php echo $html->image('/img/delete.png', array('alt' => 'Borrar'))?>
                    </span>
                    <span>
                        F05 - Equipamiento de talleres, laboratorios y espacios productivos
                    </span>
                </dt>
                <dd>$ 84.025,00</dd>
                <dt onmouseout="jQuery(this).toggleClass('item_fondos_seleccionado')" onmouseover="jQuery(this).toggleClass('item_fondos_seleccionado')" class="" >
                    <span>
                        <?php echo $html->image('/img/modify.png', array('alt' => 'Modificar'))?>
                        <?php echo $html->image('/img/delete.png', array('alt' => 'Borrar'))?>
                    </span>
                    <span>
                        F05 - Equipamiento de talleres, laboratorios y espacios productivos
                    </span>
                </dt>
                <dd>$ 84.025,00</dd>
                </div>
                <div id="totales">
                <dt onmouseout="jQuery(this).toggleClass('item_fondos_seleccionado')" onmouseover="jQuery(this).toggleClass('item_fondos_seleccionado')" class="" >
                    <span style="padding-left:15px">
                        >><strong> Total</strong>
                    </span>
                </dt>
                <dd><strong>$ 184.025,00</strong></dd>
                </div>
            </dl>

        </div>
        <span style="float:right">
            <?php echo $html->image('/img/add.gif', array('id'=>'agregar_nueva_linea','alt' => 'Agregar'))?>
        </span>
    </fieldset>
    <?php echo $form->end('Guardar');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Volver a Fondos', true), array('action' => 'index'));?></li>
	</ul>
</div>

<span class="nueva_linea" style="display:none">
<dt  onmouseout="jQuery(this).toggleClass('item_fondos_seleccionado')" onmouseover="jQuery(this).toggleClass('item_fondos_seleccionado')" class="" style="height: 30px;">
    <span>
        <?php echo $html->image('/img/check.gif', array('alt' => 'Confirmar'))?>
        <?php echo $html->image('/img/delete.png', array('alt' => 'Borrar'))?>
    </span>
    <span>
        <select>
            <?
            foreach ($lineasDeAccion as $key=>$value) {
            ?>
            <option value="<?=$key?>"><?=$value?></option>
            <?
            }
            ?>
        </select>
    </span>
</dt>
<dd><input style="margin-top:-14px;width:100px"type="text"/></dd>
</span>

<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery("#agregar_nueva_linea").click(function(){
            jQuery(".lista_lineas dl #detalle").append(jQuery(".nueva_linea").html());
            jQuery(".lista_lineas .nueva_linea").show();
        });

    });

</script>
