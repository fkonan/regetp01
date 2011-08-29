(function($){
    $(document).ready(function(){
        $('#jurisdiccion_id').change(function(){
            var url = urlDomain+'/departamentos/ajax_select_departamento_form_por_jurisdiccion';
            $.post(url,{'data[jurisdiccion_id]':$(this).val()},function(data){
                $('#departamento_id').html(data);
            })
        });
    });
    
    
})(jQuery);
