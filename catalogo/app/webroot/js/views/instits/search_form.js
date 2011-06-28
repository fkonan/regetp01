function init__SearchFormJs(urlLocalidades){
    jQuery(document).ready(function() {
        iniciarTooltip();

        jQuery("#InstitJurDepLoc").autocomplete(urlLocalidades, {
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
                    jQuery("#InstitJurDepLoc").val('');
                }
                else{
                    jQuery("#hiddenLocDepId").attr('name', 'data[Instit]['+ item.type.toLowerCase() + '_id]');
                    jQuery("#hiddenLocDepId").val(item.id);
                    formElement.submit();
                }
        });

        jQuery("#InstitJurDepLoc").bind('paste', function(e){jQuery("#InstitJurDepLoc").change()});

        jQuery("#InstitJurDepLoc").attr('autocomplete','off');

        jQuery("#jurisdiccion_id").change(function () {
                jQuery("#ajax_indicator").hide();
                jQuery("#InstitJurDepLoc").val('');
                jQuery("#hiddenLocDepId").val('');
            });
    });
}
function iniciarTooltip(){
    jQuery.tools.tooltip.conf.events.input = 'focus,blur';
    jQuery.tools.tooltip.conf.events.tooltip = '';
    jQuery.tools.tooltip.conf.events.widget = 'focus, blur';
    jQuery("#InstitSearchForm :input[title]").tooltip({
        effect: 'slide',
        offset:[22,0]
    });
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

(function($){
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

    function iniciarTooltip(){
        $.tools.tooltip.conf.events.input = 'focus,blur';
        $.tools.tooltip.conf.events.tooltip = '';
        $.tools.tooltip.conf.events.widget = 'focus, blur';
        $("#"+formId+" :input[title]").tooltip({effect: 'slide', offset:[22,0]});
    }

    function blockResultConsole(formData, jqForm, options) {
        $('#consoleResult').mask('Buscando');
        $('#boxAyuda').hide();
        
        if($('.help_head').hasClass('menu_head')){
            $('.help_head').removeClass('menu_head').addClass('menu_head_open');
        }else if($('.help_head').hasClass('menu_head_open')){
            $('.help_head').removeClass('menu_head_open').addClass('menu_head');
        }
        return true;
    }

// es el que envia el formulario de busqueda ajax
    function autoSubmit(forzar){
        if ( typeof forzar != 'boolean' ) {
            forzar = false;
        }

        if($("#InstitCue").val().length > 1 || forzar){
              clearTimeout(timerid);
              timerid = setTimeout(function() {
                  formElement.submit();
              }, 1000);
          }
          return false;
    }

    function unblockResultConsole(responseText, statusText, xhr, $form)  {
        var redirigiendo = false;
        if ($('.listado li').size() == 1 && !isNaN($('#InstitCue').val())){
            redirigiendo = true;
            $('#consoleResult').mask('Encontrada');
            $('.listado li A').click();
            //location.replace($('.listado li').first().attr('href'));
        }
        if (!redirigiendo){
            $('#consoleResult').unmask();
        }
    }





    /*
     *
     *  DOCUMENT
     *  ON READY
     *  
     */

    $(document).ready(function() {
        
        // link de ayuda
        $('A[href="#boxAyuda"]').click(function(){
            //console.debug($('#boxAyuda'));
            $('#boxAyuda').toggle('fade');
            return false;
        });
        
        
        // observers para la busqueda
        formElement = $('#'+formId);
        
        
        var options = {
            target:        '#consoleResult',   // target element(s) to be updated with server response
            beforeSubmit:  blockResultConsole,  // pre-submit callback
            success:       unblockResultConsole,  // post-submit callback
            url:  formElement.attr('action')     // override for form's 'action' attribute
        };

        // bind form using 'ajaxForm'
        formElement.ajaxForm(options);

        $("#InstitCue").keyup(autoSubmit);

        $("#InstitCue").keypress(function(e) {
            if (e.keyCode == 10 || e.keyCode == 13){
                return false;
            }
        });

        $('#boxAyuda .menu_body').show();

        $("#InstitCue").bind('paste', function(e){autoSubmit(true)});

    });



    function abrirVentanaAyuda() {
        $('#boxAyuda .menu_body').slideToggle();
    }
    
    
    
    
    
    
    
    
    
    
    
    /*****************************************************
     *  HISTORY PLUGIN
     */
    var origContent = "";

    function loadContent(hash) {
        if(hash != "") {
            if(origContent == "") {
                origContent = $('#search_results').html();
            }
            $('#search_results').load(hash);
        } else if(origContent != "") {
            $('#search_results').html(origContent);
        }
    }

    $(document).ready(function() {
            $.history.init(loadContent);
            
            formElement.submit(function(){
                var url = this.action;
                url = url.replace(/^.*#/, '');
                $.history.load(url);
                return false;
            });
            $('#navigation a').not('.external-link').click(function(e) {
                    var url = $(this).attr('href');
                    //url = url.replace(/^.*#/, '');
                    $.history.load(url);
                    return false;
                });
        });
       /*
        * FIN HISTORY PLUGIN
        *********************************************************/

})(jQuery);
