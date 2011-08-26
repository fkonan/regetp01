(function($){
    $(document).ready(function(){
        $('#SectorId').change(function(){
            var url = urlDomain+'/subsectores/ajax_select_subsector_form_por_sector';
            $.post(url,{'data[sector_id]':$(this).val()},function(data){
                $('#SubsectorId').html(data);
            })
        });
        
        $('#jurisdiccion_id').change(function(){
            var url = urlDomain+'/departamentos/ajax_select_departamento_form_por_jurisdiccion';
            $.post(url,{'data[jurisdiccion_id]':$(this).val()},function(data){
                $('#departamento_id').html(data);
            })
        });
    });
    
    
})(jQuery);