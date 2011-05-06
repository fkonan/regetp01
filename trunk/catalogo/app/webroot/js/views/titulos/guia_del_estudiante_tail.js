
(function($){
    /////////////////////////////////////////////////////////////////
    // Parametros de configuracion
    // Elementos utilizados
    var titulosForm = $('#TituloSearchForm');
    
    var titulosContainer = $( "#li_titulos > UL" );
    var titulosPaginator = $( "#li_titulos > p" );
    
    var titulosTemplate = $("#tituloTemplate");
    var titulosPaginatorCountTag = "b";
    
    var institsContainer = $( "#li_instits > UL" );
    var institsTemplate = $("#institTemplate");
    
    
    /////////////////////////////////////////////////////////////////
    // Inicializacion
    titulosForm.submit(getTitulos);
    
    
    
    /////////////////////////////////////////////////////////////////
    // functiones Principales
    //    
    
    /**
     * Trae los titulos en JSON, usando ajax
     */
    function getTitulos() {
        var params = titulosForm.serialize();
        var postvar = $.post( 
                urlDomain + 'titulos/ajax_search_results.json',
                params,
                __meterTitulosEnTemplate,
                'json'
            );
                
        postvar.error(function(e, t) {
            console.info('Llegó con error el json de titulos: ' + t);
            console.debug(e);
        });
        return false;
    }
    
    
    // esta funcion recien es llamada luego de getTitulos, al seleccionar alguno
    // de esos titulos encontrados
    function getInstits(tituloId) {
       
        var params = titulosForm.serialize();
        console.info("get institssss - - - - - - ");
        console.debug(params);
        if ( tituloId ) {
            params = params+"&data[Titulo][id]="+tituloId;
        }
        console.debug(params);
        var postvar = $.post( 
                urlDomain + 'titulos/ajax_search_results.json',
                params,
                __meterTitulosEnTemplate,
                'json'
            );
                
        postvar.error(function(e, t) {
            console.info('Llegó con error el json de titulos: ' + t);
            console.debug(e);
        });
        return false;
    }
    
    
    
    /////////////////////////////////////////////////////////////////
    //
    // Funciones extra
    //

    var __meterTitulosEnTemplate = function (data) {
        // primero borro el contenido
        titulosContainer.html('');
        
        titulosPaginator.show();
        titulosPaginator.children(titulosPaginatorCountTag).html( data.cant );
        
        // meto la nueva data
        titulosTemplate.tmpl( data.data ).appendTo( titulosContainer );
        
        titulosContainer.click( onclickHandlerInstits );
    }
    
    
    var onclickHandlerInstits = function( e ) {        
        var tgt = $(e.currentTarget);
        console.debug(tgt);return false;
        if ( tgt.attr('titulo') ) {
            console.debug( tgt );
            getInstits( tgt.attr('titulo') );
        }
        return false;
    }
    
    
    var __meterInstitsEnTemplate = function ( data ) {
        institsTemplate.tmpl( data ).appendTo( institsContainer );
    }
    
    
})(jQuery);