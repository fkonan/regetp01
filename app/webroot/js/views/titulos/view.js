    /**
     *  Indica el ID del elemento <form id="">
     * @var string
     */
    var formId = 'TituloSearchForm';

    /**
     *  es el elemento del formulario, se inicializa en en document.ready()
     * @var Dom Object
     */
    var formElement = null;

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

        jQuery("#TituloName").keyup(autoSubmit);

        jQuery("#TituloName").keypress(function(e) {
            if (e.keyCode == 10 || e.keyCode == 13){
                return false;
            }
        });

        jQuery(".autosubmit").change(function() { formElement.submit(); });

        jQuery("#TituloName").bind('paste', function(e){autoSubmit(true)});

        formElement.submit();

        //iniciarTooltip();
    });

