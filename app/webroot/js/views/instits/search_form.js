    /*
     *
     *      VARIABLES GLOBALES
     *
     *
     */
    
    var enterButton = false;
    var timerid;

    /**
     *  Indica el ID del elemento <form id="">
     * @var string
     */
    var formId = 'InstitSearchForm';

    /**
     *  es el elemento del formulario, se inicializa en en document.ready()
     * @var Dom Object
     */
    var formElement = null;



    



    /*
     *
     *      FUNCIONES
     *
     *
     */


    function iniciarTooltip(){
        jQuery.tools.tooltip.conf.events.input = 'focus,blur';
        jQuery.tools.tooltip.conf.events.tooltip = '';
        jQuery.tools.tooltip.conf.events.widget = 'focus, blur';
        jQuery("#"+formId+" :input[title]").tooltip({ effect: 'slide', offset:[22,0]});
    }

    function blockResultConsole(formData, jqForm, options) {
        jQuery('#consoleResultWrapper').mask('Buscando');
        return true;
    }

// es el que envia el formulario de busqueda ajax
    function autoSubmit(){
        if(jQuery("#InstitCue").val().length > 1){
              clearTimeout(timerid);
              timerid = setTimeout(function() {
                  formElement.submit();
              }, 1000);
          }
    }

    function unblockResultConsole(responseText, statusText, xhr, $form)  {
        var redirigiendo = false;
        if (jQuery('.listado li').size() == 1 && !isNaN(jQuery('#InstitCue').val())){
            redirigiendo = true;
            jQuery('#consoleResultWrapper').mask('Encontrada');
            jQuery('.listado li A').click();
            //location.replace(jQuery('.listado li').first().attr('href'));
        }
        if (!redirigiendo){
            jQuery('#consoleResultWrapper').unmask();
        }
    }





    /*
     *
     *  DOCUMENT
     *  ON READY
     *  
     */

    jQuery(document).ready(function() {
        formElement = jQuery('#'+formId);
        
        var options = {
            target:        '#consoleResult',   // target element(s) to be updated with server response
            beforeSubmit:  blockResultConsole,  // pre-submit callback
            success:       unblockResultConsole,  // post-submit callback
            url:  formElement.attr('action')     // override for form's 'action' attribute
        };

        // bind form using 'ajaxForm'
        formElement.ajaxForm(options);

        jQuery("#InstitCue").keyup(autoSubmit);

        jQuery("#InstitCue").keypress(function(e) {
            if (e.keyCode == 10 || e.keyCode == 13){
                return false;
            }
        });

        jQuery("#InstitJurisdiccionId").change(autoSubmit);

        jQuery(document).bind('paste', autoSubmit);

        iniciarTooltip();
    });

