(function($){
    // EVENTOS MANEJADOS on dom loaded
    $(function(){
        $('.alerta-desactualizada').click(handleAlertaDesactualizada);
    });

    
    // Handlers
    function handleAlertaDesactualizada(e) {
        
        e.preventDefault();
        
        var ventanitaDelAmor = document.createElement('div');     
        ventanitaDelAmor.title = 'Formulario de Envío';

        var params = "cue_instit:" + $("#cue_instit").val() + "/nombre_completo:" + $("#nombre_completo").val();
        
        $(ventanitaDelAmor).load( urlDomain+'/correos/desactualizada/'+params, function(){
            $(ventanitaDelAmor).find('form').submit(function(e){                
                e.preventDefault();
                $.post(this.action, $(this).serialize(), function(e,t){
                    $(ventanitaDelAmor).dialog('close');
                })
            });
        });
        
        $(ventanitaDelAmor).dialog({
                        width: 500,
                        position: 'top',
                        zIndex: 3999,
                        draggable: false,
                        modal: true,
                        resizable: false
                    });
    }
})(jQuery);