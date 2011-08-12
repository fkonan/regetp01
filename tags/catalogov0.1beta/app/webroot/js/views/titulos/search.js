    var enterButton = false;
    var timerid;

    /**
     *  Indica el ID del elemento <form id="">
     * @var string
     */
    var formId = 'TituloSearchForm';

    /**
     *  es el elemento del formulario, se inicializa en en document.ready()
     * @var Dom Object
     */
    var formElement = $('#InstitSearchForm');


    function iniciarTooltip(){
        jQuery.tools.tooltip.conf.events.input = 'focus,blur';
        jQuery.tools.tooltip.conf.events.tooltip = '';
        jQuery.tools.tooltip.conf.events.widget = 'focus, blur';
        jQuery("#"+formId+" :input[title]").tooltip({ effect: 'slide', offset:[22,0]});
    }

    function blockResultConsole(formData, jqForm, options) {
        jQuery('#consoleResult').mask('Buscando');
        return true;
    }

    // es el que envia el formulario de busqueda ajax
    function autoSubmit(forzar){
        if ( typeof forzar != 'boolean' ) {
            forzar = false;
        }

        if(jQuery("#TituloName").val().length > 1 || forzar){
              clearTimeout(timerid);
              timerid = setTimeout(function() {
                  formElement.submit();
              }, 1000);
          }
    }

    function unblockResultConsole(responseText, statusText, xhr, $form)  {
        jQuery('#consoleResult').unmask();
    }

    function formatResult(loc_dep) {
        if(loc_dep.type == 'Localidad'){
            return loc_dep.localidad + ', ' + loc_dep.departamento + ' (' + loc_dep.jurisdiccion + ')';
        }
        else if(loc_dep.type == 'Departamento'){
            return loc_dep.departamento + ' (' + loc_dep.jurisdiccion + ')';
        }
        else{
            return loc_dep.localidad;
        }
    }
    
    function borrarDatos(nombreElemento){
        jQuery(nombreElemento).css({
            backgroundColor:"#FFFFE0"
        }).animate(

        {
            //width:'544px'
        },
        200,
        'linear',
        function(){
            jQuery(nombreElemento).delay(100).animate(
            {
                //width:'544px'
            },
            200,
            function(){
                jQuery(nombreElemento).css({
                    background:"#FFF"
                });
            });
        });
    }


    function init(locDepUrl) {
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

            //jQuery("#TituloName").keyup(autoSubmit);

            jQuery("#TituloName").keypress(function(e) {
                if (e.keyCode == 10 || e.keyCode == 13){
                    return false;
                }
            });


            jQuery("#TituloJurDepLoc").autocomplete(locDepUrl, {
                dataType: "json",
                delay: 200,
                max:30,
                cacheLength:1,
                extraParams: {
                    jur: function() { return jQuery('#jurisdiccion_id').val(); }
                } ,
                parse: function(data) {
                    return jQuery.map(data, function(loc_dep) {
                        return {
                            data: loc_dep,
                            value: loc_dep.id,
                            result: formatResult(loc_dep)
                        }
                    });
                },
                formatItem: function(item) {
                    return formatResult(item);
                }
            }).result(function(e, item) {
                if(item.type == 'Vacio'){
                    jQuery("#TituloJurDepLoc").val('');
                }
                else{
                    jQuery("#hiddenLocDepId").attr('name', 'data[Instit]['+ item.type.toLowerCase() + '_id]');
                    jQuery("#hiddenLocDepId").val(item.id);
                    formElement.submit();
                }
            });

            //jQuery(".autosubmit").change(function() { formElement.submit(); });

            //jQuery("#TituloName").bind('paste', function(e){autoSubmit(true)});

            jQuery("#jurisdiccion_id").change(function () {
                jQuery("#ajax_indicator").hide();
                borrarDatos('#TituloJurDepLoc');
                jQuery("#TituloJurDepLoc").val('');
                jQuery("#hiddenLocDepId").val('');
            });

            //formElement.submit();
        });
    }




    function viewTitulo(url, titulo) {
        var dialog = jQuery('<div id="create_dialog"></div>')
                .html('... cargando información <span class="ajax-loader"></span>')
                .dialog({
                        width: 500,
                        position: 'top',
                        zIndex: 3999,
                        title: titulo,
                        draggable: false,
                        modal: true,
                        resizable: false,
                        beforeclose: function(event, ui) { jQuery(".ui-dialog").remove(); jQuery("#create_dialog").remove(); }
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