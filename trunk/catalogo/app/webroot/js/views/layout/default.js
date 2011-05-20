jQuery.noConflict();
jQuery.fn.outer = function() {
    return jQuery( jQuery('<div></div>').html(this.clone()) ).html();
}
jQuery(document).ready(function () {
    
    
    
    jQuery(document).ajaxError(function(e, xhr, settings, exception) {
        jQuery.unblockUI;
        if (xhr.status == 401){
            alert('Su usuario no tiene permisos para acceder a esta página');
            if (!jQuery('#authMessageJs')){
        //                            var authMessage = '<div id="authMessageJs" class="message">Usted no tiene permisos para realizar esta operación</div>';
        //                            jQuery('#main-content').prepend(authMessage);
        }
        }

    });

function PopularCombo(comboSelector, actionJson,parameters, agregarEmpty, spinner){
    var options = [];
    if(spinner){
        spinner.show();
    }
    comboSelector.html('<option value="0">Cargando...</option>');
    comboSelector.attr('disabled', 'disabled');
    jQuery.getJSON(actionJson, parameters, function(result) {
        if(agregarEmpty){
            options.push('<option value="0">Ninguno</option>');
        }
        for (var i = 0; i < result.length; i++) {
            options.push('<option value="',
              result[i].id, '">',
              result[i].name, '</option>');
        }
        comboSelector.html(options.join(''));
        if(spinner){
            spinner.hide();
        }

        comboSelector.removeAttr('disabled');
    });
}
