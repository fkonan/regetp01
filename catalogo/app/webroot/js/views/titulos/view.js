(function($){
    // EVENTOS MANEJADOS
    $('.alerta-desactualizada').click(handleAlertaDesactualizada);
    
    
    // Handlers
    function handleAlertaDesactualizada(e) {
        e.preventDefault();
        
        var ventanitaDelAmor = document.createElement('div');     
        ventanitaDelAmor.title = 'Formulario de Envío';
        
        $(ventanitaDelAmor).load( urlDomain + '/correos/desactualizada', function(){
            $(ventanitaDelAmor).find('form').submit(function(e){                
                e.preventDefault();
                $.post(this.action, $(this).serialize(), function(e,t){
                    $(ventanitaDelAmor).dialog('close');
                })
            });
        });
        
        $(ventanitaDelAmor).dialog();
        
       
        
    }
})(jQuery);