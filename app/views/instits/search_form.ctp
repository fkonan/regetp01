<?
echo $javascript->link('jquery.autocomplete');
echo $javascript->link('jquery.blockUI');
echo $html->css('jquery.autocomplete.css');
?>
<script type="text/javascript">
    var enterButton = false;

    function IsNumeric(expression)
    {
            return (String(expression).search(/^\d+$/) != -1);
    }
    
    jQuery(document).ajaxStart(function (event, request, settings)  {
            if(!enterButton){
                jQuery.blockUI({ message: '<h1>Buscando...</h1>',showOverlay: false });
            }
            else{
                return false;
            }
    });

    jQuery(document).ajaxStop(function(event, request, settings){
        jQuery.unblockUI();
    });
    
    
    jQuery(document).ready(function() {
        jQuery('#busca_cue').click(function(){
           if(!IsNumeric(jQuery('#InstitCue').val())){
                enterButton = true;
                jQuery('#InstitCue').attr("name","data[Instit][nombre_completo]" );

            }
            jQuery("#InstitSimpleSearchForm").attr("action","<?echo $html->url(array('controller'=>'instits','action'=>'search'));?>");
            jQuery("#InstitSimpleSearchForm").submit();
        });


        jQuery("#InstitSimpleSearchForm #institCueInfo").hide();

        jQuery('#InstitSimpleSearchForm input[type=submit]').attr('disabled', 'disabled');

        jQuery("#InstitCue").autocomplete("<?echo $html->url(array('controller'=>'instits','action'=>'search_instits'));?>", {
		dataType: "json",
                delay: 2000,
                max:30,
                minChars: 3,
                cacheLength:1,
		parse: function(data) {
			return jQuery.map(data, function(instit) {
				return {
					data: instit,
					value: instit.nombre,
					result: instit.tipo + ' Nº' + instit.nroinstit + ' ' + instit.nombre
				}
			});
		},
		formatItem: function(item) {
			return format(item);
		}
	}).result(function(e, item) {
                jQuery("#InstitCue").removeClass('submit_mode').addClass("ajax_mode");
                jQuery("#hiddenInstitId").remove();
                jQuery("#InstitSimpleSearchForm").append("<input id='hiddenInstitId' name='data[Instit][instit_id]' type='hidden' value='" + item.id + "' />");
                jQuery('#InstitSimpleSearchForm input[type=submit]').removeAttr("disabled")
                var div = "<h4> Informacion sobre la Institucion </h4>" +
                          "<div><strong>Nombre: </strong>" + item.tipo + ' Nº' + item.nroinstit + ' ' + item.nombre + "</div>" +
                          "<div><strong>CUE: </strong>" + item.cue + "</div>" +
                          "<div><strong>Direccion: </strong>" + item.direccion + "</div>" +
                          "<div><strong>Departamento: </strong>" + item.depto + "</div>" +
                          "<div><strong>Localidad: </strong>" + item.localidad + "</div>" +
                          "<div><strong>Jurisdiccion: </strong>" + item.jurisdiccion + "</div>" +
                          "<div><strong>Codigo Postal: </strong>" + item.cp + "</div>";

                jQuery("#InstitSimpleSearchForm #institCueInfo").hide('fast');
                jQuery("#InstitSimpleSearchForm #institCueInfoDetail").html('');
                jQuery("#InstitSimpleSearchForm #institCueInfoDetail").append(div);
                jQuery("#InstitCue").val('');
                jQuery("#InstitSimpleSearchForm #institCueInfo").show('slow');
        });

        jQuery('#InstitCue').keypress(function(event){
            var cKeyCode = event.keyCode;
            if (cKeyCode == 13 ){
                if(jQuery('#InstitCue').hasClass('submit_mode')){
                    jQuery("#hiddenInstitId").remove();
                    if(!IsNumeric(jQuery('#InstitCue').val())){
                        jQuery('#InstitCue').attr("name","data[Instit][nombre_completo]" );
                    }
                    jQuery("#InstitSimpleSearchForm").attr("action","<?echo $html->url(array('controller'=>'instits','action'=>'search'));?>");
                    
                    jQuery("#InstitSimpleSearchForm").submit();
                    enterButton = true;
                }
                else{
                    jQuery("#InstitCue").removeClass('ajax_mode').addClass("submit_mode");
                    return false;
                }
            }
        });
    });

    function format(instit) {
                return " [" + instit.cue + "]" + instit.tipo + ' Nº' + instit.nroinstit +  ' ' + instit.nombre;
    }
</script>

<h1><?= __('Buscar Institución')?></h1>

<div>
    <?= $form->create('Instit',array('action' => 'simpleSearch','name'=>'InstitSearchForm'));?>

    <div>
        <?php echo $form->input('cue', array('label'=> 'CUE ó Nombre de la Institución', 'after'=> '<cite>Ej: 600118 o 5000216. También puede buscar con el n° de anexo, Ej: 60011800 </cite>','div'=>false, 'class'=>'submit_mode'));?>
        <?php echo $html->image("search.png",array('id'=>'busca_cue','style'=>'float:right;display:block;margin-top:-30px;cursor:pointer'));?>
    </div>
    <div id='institCueInfo' class='institCueInfo'>
        <div id='institCueInfoDetail' class='institCueInfoDetail'></div>
        <?php echo $form->submit('Ver Institucion', array('style'=>' display: block; float:right; margin-top:-25px; width:200px'));?>
    </div>
    
    <?php echo $html->link('Busqueda Avanzada...','advanced_search_form',array('class'=>'link_right'));?>
</div>
