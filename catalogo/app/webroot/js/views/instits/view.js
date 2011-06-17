(function($){
    // EVENTOS MANEJADOS on dom loaded
    $(function(){
        $('#alerta-desactualizada').click(handleAlertaDesactualizada);
        $('.js-masinfo-titulo').click(viewTitulo);
    });

    
    // Handlers
    function handleAlertaDesactualizada(e) {
        
        e.preventDefault();
        
        var ventanitaDelAmor = $("<div id='dialog'>");
        ventanitaDelAmor.title = 'Formulario de Envío';
        var params = "cue_instit:" + escape($("#instit-cue").val()) + "/nombre_completo:" + escape($("#instit-nombre").val());

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


function viewTitulo(url, title) {
    var dialog = jQuery('<div id="create_dialog"></div>')
    .html('... cargando información <span class="ajax-loader"></span>')
    .dialog({
        width: 500,
        position: 'top',
        zIndex: 3999,
        title: title,
        draggable: false,
        modal: true,
        resizable: false,
        beforeclose: function(event, ui) {
            jQuery(".ui-dialog").remove();
            jQuery("#create_dialog").remove();
        }
    });

    jQuery.ajax({
        url: url,
        cache: false,
        success: function(data) {
            dialog.html(data);
        }
    });

    return false;
}