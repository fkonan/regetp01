(function($){
    /////////////////////////////////////////////////////////////////
    // Parametros de configuracion
    // Elementos utilizados
    var titulosForm = $('#TituloSearchForm');
    
    
    var titulosContainer = $( "#li_titulos > UL" );
    var titulosPaginator = $( "#li_titulos > p" );
    
    var titulosTemplate = $("#tituloTemplate");
    var titulosPaginatorCountTag = "b";
    
    
    var institsForm = $('#InstitSearchForm');
    
    var institsContainer = $( "#li_instits > UL" );
    var institsTemplate = $("#institTemplate");
    
    var institsPaginator = $( "#li_instits > p" );
    var institsPaginatorCountTag = 'b';

    
    
    /////////////////////////////////////////////////////////////////
    // Inicializacion de los formularios
    titulosForm.submit(getTitulos);
    
    institsForm.submit(getInstits);
    
    
    
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
    
    
    // trae las instituciones de los titulos seleccionados
    function getInstits() {
        var params = institsForm.serialize();
        var postvar = $.post( 
                urlDomain + 'instits/search.json',
                params,
                __meterInstitsEnTemplate,
                'json'
            );
                
        postvar.error(function(e, t) {
            console.info('Llegó con error el json de instituciones: ' + t);
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
               
        titulosContainer.find('li > input').change(onclickHandlerTitulos );
    }
    
    
    var onclickHandlerTitulos = function( e ) {   
        e.preventDefault();
        
        institsForm.submit();
        return false;
    }
    
    
    var __meterInstitsEnTemplate = function ( data ) {
       institsContainer.html('');
       institsTemplate.tmpl( data.data ).appendTo( institsContainer );

       institsPaginator.show();
       institsPaginator.children( institsPaginatorCountTag ).html( data.cant );
    }
    
    
})(jQuery);