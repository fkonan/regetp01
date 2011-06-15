(function($){
    // EVENTOS MANEJADOS on dom loaded
    $(function(){
        $('#alerta-desactualizada').click(handleAlertaDesactualizada);
    });

    
    // Handlers
    function handleAlertaDesactualizada(e) {
        
        e.preventDefault();
        
        var ventanitaDelAmor = $("<div id='dialog'>");
        ventanitaDelAmor.title = 'Formulario de Envío';
        var params = "cue_instit:" + $("#instit-cue").val() + "/nombre_completo:" + $("#instit-nombre").val();

        $(ventanitaDelAmor).load($("#urlDesactualizada").val() + '/' + params, function(data){
            $(ventanitaDelAmor).html(data);
            $(ventanitaDelAmor).find('form').submit(function(e){
                if ($.trim($("#CorreoDescripcion").val()) == '') {
                    alert("Debe especificar una descripción sobre la desactualización");
                    return false;
                }
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
                        resizable: false,
                        title:"Notificación de información desactualizada",
                        beforeClose: function(event, ui) {
                            $("#dialog").remove();
                        }
                    });

        return false;
    }
})(jQuery);