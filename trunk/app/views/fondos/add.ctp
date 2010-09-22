<?
//echo $javascript->link('jquery-1.4.2.min');
echo $javascript->link('jquery.autocomplete');
echo $javascript->link('jquery.blockUI');
echo $html->css('jquery.autocomplete.css');
?>
<script type="text/javascript">
    jQuery(document).ready(function() {

        <?php if (!empty($this->data['Fondo']) && empty($this->data['Fondo']['instit_id'])) {?>
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
                jQuery("#FondoJurisdiccionId").val(item.jurisdiccion_id);

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
            echo $form->input('total', array('type'=>'hidden'));
		
            echo $form->input('description', array('label'=>'Descripción'));
	?>

        <h2>Lineas de Accion</h2>
        <div class="lista_lineas">
            <dl class="item_lineas" style="cursor:pointer;padding:0px !important">
                <div id="detalle">

                    
                    
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

<script type="text/javascript">
    var i = 0;
    
    jQuery(document).ready(function() {
        jQuery("#agregar_nueva_linea").click(function(){
            html = "<span class='nueva_linea' style='display:none'>" +
                        "<span class='nueva_linea_in'>" +
                            "<dt onmouseout='jQuery(this).toggleClass(\"item_fondos_seleccionado\")' onmouseover='jQuery(this).toggleClass(\"item_fondos_seleccionado\")' class='' style='height: 30px;'>" +
                                "<span>" +
                                    '<?php echo $html->image('/img/check.gif', array('id'=>'check_linea','alt' => 'Confirmar', 'onclick'=>'agregarLinea(this);'))?>' +
                                    '<?php echo $html->image('/img/delete.png', array('alt' => 'Borrar','onclick'=>'jQuery(this).parent().parent().parent().remove();'))?>' +
                                "</span>" +
                                "<span>" +
                                    "<select class='linea_de_accion_id' style='width:400px'>" +
                                        <?
                                        foreach ($lineasDeAccion as $key=>$value) {
                                        ?>
                                        '<option value="<?=$key?>"><?=$value?></option>' +
                                        <?
                                        }
                                        ?>
                                    "</select>" +
                                "</span>" +
                            "</dt>" +
                            "<dd><input class='monto' style='margin-top:-14px;width:100px' type='text'/></dd>" +
                        "</span>" +
                    "</span>";
            jQuery(".lista_lineas dl #detalle").append(html);
            jQuery(".lista_lineas .nueva_linea").show();
        });
    });

    function agregarLinea(element){

        uniqid = jQuery(element).parent().parent().parent().parent().parent().attr("order");

        if(uniqid == undefined){
            uniqid = new Date().getTime();
            pre = "<div class='linea_confirmada' order='"+ uniqid  + "'>";
            post = "</div>";
            selector = "";
        }else{
            pre = '';
            post = '';
            selector = " .linea_confirmada[order="+uniqid+"]";
        }
        

        html = pre +
               "<dt onmouseout='jQuery(this).toggleClass(\"item_fondos_seleccionado\")' onmouseover='jQuery(this).toggleClass(\"item_fondos_seleccionado\")' class='' >" +
               "<span>" +
                    '<?php echo $html->image('/img/modify.png', array('alt' => 'Modificar', 'onclick'=>'modificarLinea(this)'))?>' +
                    '<?php echo $html->image('/img/delete.png', array('alt' => 'Borrar','onclick'=>'jQuery(this).parent().parent().parent().remove();'))?>' +
                "</span>" +
                "<span class='linea_nombre'>" +
                jQuery(element).parent().parent().parent().find(".linea_de_accion_id option:selected").text() +
                "</span>" +
                "</dt>" +
                "<dd>" +
                jQuery(element).parent().parent().parent().find(".monto").val() +
                "</dd>" +
                "<input class='linea_id' type='hidden' name='data[Fondo][FondosLineasDeAccion]["+i+"][lineas_de_accion_id]' value='"+ jQuery(element).parent().parent().parent().find(".linea_de_accion_id option:selected").val() +"'>" +
                "<input class='monto' type='hidden' name='data[Fondo][FondosLineasDeAccion]["+i+"][monto]' value='" + jQuery(element).parent().parent().parent().find(".monto").val() + "'>" +
                post;

        jQuery(".lista_lineas dl .nueva_linea_in").remove();
        
        jQuery(".lista_lineas dl #detalle" + selector).append(html);
        i++;
    }

    function modificarLinea(element){
        uniqid = jQuery(element).parent().parent().parent().attr("order");
        
        linea_id = jQuery(element).parent().parent().parent().find(".linea_id").val();
        monto = jQuery(element).parent().parent().parent().find(".monto").val();

        html = "<span class='nueva_linea'>" +
                        "<span class='nueva_linea_in'>" +
                            "<dt onmouseout='jQuery(this).toggleClass(\"item_fondos_seleccionado\")' onmouseover='jQuery(this).toggleClass(\"item_fondos_seleccionado\")' class='' style='height: 30px;'>" +
                                "<span>" +
                                    '<?php echo $html->image('/img/check.gif', array('id'=>'check_linea','alt' => 'Confirmar', 'onclick'=>'agregarLinea(this);'))?>' +
                                    '<?php echo $html->image('/img/delete.png', array('alt' => 'Borrar','onclick'=>'jQuery(this).parent().parent().parent().remove();'))?>' +
                                "</span>" +
                                "<span>" +
                                    "<select class='linea_de_accion_id' style='width:400px'>" +
                                        <?
                                        foreach ($lineasDeAccion as $key=>$value) {
                                        ?>
                                        '<option value="<?=$key?>"><?=$value?></option>' +
                                        <?
                                        }
                                        ?>
                                    "</select>" +
                                "</span>" +
                            "</dt>" +
                            "<dd><input class='monto' style='margin-top:-14px;width:100px' type='text' value='"+ monto +"'/></dd>" +
                            "<input class='linea_id' type='hidden' name='data[Fondo][FondosLineasDeAccion][][lineas_de_accion_id]' value='"+ linea_id +"'>" +
                            "<input class='monto' type='hidden' name='data[Fondo][FondosLineasDeAccion][][monto]' value='" + monto + "'>" +
                        "</span>" +
                    "</span>";

        jQuery(".lista_lineas dl #detalle .linea_confirmada[order=" + uniqid + "]").html('');
        jQuery(".lista_lineas dl #detalle .linea_confirmada[order=" + uniqid + "]").append(html);
        jQuery(".lista_lineas dl #detalle .linea_confirmada[order=" + uniqid + "] .linea_de_accion_id").val(linea_id);
    }
</script>

