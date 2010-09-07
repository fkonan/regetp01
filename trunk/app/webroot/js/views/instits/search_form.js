    // variables globales
    var enterButton = false;
    var timerid;

    function iniciarTooltip(){
        jQuery.tools.tooltip.conf.events.input = 'focus,blur';
        jQuery.tools.tooltip.conf.events.tooltip = '';
        jQuery.tools.tooltip.conf.events.widget = 'focus, blur';
        jQuery("#InstitSimpleSearchForm :input[title]").tooltip({ effect: 'slide', offset:[22,0]});
    }

    function blockResultConsole(formData, jqForm, options) {
        jQuery('#consoleResultWrapper').mask('Buscando');
        return true;
    }

    function autoSubmit(){
        if(jQuery("#InstitCue").val().length > 1){
              var form = this;
              clearTimeout(timerid);
              timerid = setTimeout(function() { jQuery('#InstitSimpleSearchForm').submit(); }, 1000);
          }
    }

    function unblockResultConsole(responseText, statusText, xhr, $form)  {
        var redirigiendo = false;
        if (jQuery('.listado li').size() == 1){
            redirigiendo = true;
            jQuery('#consoleResultWrapper').mask('Encontrada');
            jQuery('.listado li A').click();
            //location.replace(jQuery('.listado li').first().attr('href'));
        }
        if (!redirigiendo){
            jQuery('#consoleResultWrapper').unmask();
        }
    }

    jQuery(document).ready(function() {
        var options = {
            target:        '#consoleResult',   // target element(s) to be updated with server response
            beforeSubmit:  blockResultConsole,  // pre-submit callback
            success:       unblockResultConsole,  // post-submit callback
            url:   jQuery('#InstitSimpleSearchForm').attr('action')     // override for form's 'action' attribute
        };

        // bind form using 'ajaxForm'
        jQuery('#InstitSimpleSearchForm').ajaxForm(options);


        jQuery("#InstitCue").keyup(autoSubmit);

        jQuery("#InstitCue").keypress(function(e) {
            if (e.keyCode == 10 || e.keyCode == 13){
                return false;
            }
        });

        jQuery(document).bind('paste', autoSubmit);

        iniciarTooltip();
    });

