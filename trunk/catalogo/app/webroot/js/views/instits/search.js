(function($){
    $(document).ready(function(){

        if($('#jurisdiccion_id').val() != 0){
            $depto_aux = $('#departamento_id').val();
            reloadCombo($('#jurisdiccion_id').val(), $depto_aux);

        }
        
        $('#jurisdiccion_id').change(function(){
            reloadCombo($(this).val());
            $("#ajax_indicator").hide();
            $('#LocalidadName').val('');
            $("#hiddenLocId").val('');
        });
        
        $('#departamento_id').change(function(){
            $("#ajax_indicator").hide();
            $('#LocalidadName').val('');
            $("#hiddenLocId").val('');
        });
        
        $("#LocalidadName").change(function(){
            if($("#LocalidadName").val().length == 0){
                $("#hiddenLocId").val('');
            }
        });       

    });
    
})(jQuery);

function reloadCombo(jur, depto){
    var url = urlDomain+'/departamentos/ajax_select_departamento_form_por_jurisdiccion';
    $.post(url,{'data[jurisdiccion_id]':jur},function(data){
        $('#departamento_id').html(data);
        $('#departamento_id').val(depto);
    })
}
function formatResult(loc_dep) {
    return loc_dep.localidad;
}

function init__SearchFormJs(locDepUrl) {
    jQuery("#LocalidadName").autocomplete(locDepUrl, {
                dataType: "json",
                delay: 200,
                max:30,
                cacheLength:1,
                extraParams: {
                    jur: function() { return jQuery('#jurisdiccion_id').val(); },
                    depto: function() { return jQuery('#departamento_id').val(); }
                } ,
                parse: function(data) {
                    return jQuery.map(data, function(loc) {
                        return {
                            data: loc,
                            value: loc.id,
                            result: formatResult(loc)
                        }
                    });
                },
                formatItem: function(item) {
                    if(item.type == 'Vacio' )
                        return item.localidad;
                    return item.localidad + ', ' + item.departamento + ' (' + item.jurisdiccion + ')';
                }
            }).result(function(e, item) {
                if(item.type == 'Vacio'){
                    $("#LocalidadName").val('');
                }
                else{
                    $("#hiddenLocId").val(item.localidad_id);                    
                    $("#jurisdiccion_id").val(item.jurisdiccion_id);
                    $("#departamento_id").val(item.departamento_id);
                }
            });
}
