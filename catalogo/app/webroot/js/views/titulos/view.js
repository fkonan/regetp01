(function($){
    // EVENTOS MANEJADOS
    $('.alerta-desactualizada').click(handleAlertaDesactualizada);
    
    
    
    function handleAlertaDesactualizada(e) {
        e.preventDefault();
        var mensaje = window.prompt('Escriba su mensaje', 'Institución desactualizada');
        
        $.post(e.target.href, {'mensaje': mensaje});
    }
})(jQuery);