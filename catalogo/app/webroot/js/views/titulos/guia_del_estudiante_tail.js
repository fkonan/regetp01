(function($){
    /////////////////////////////////////////////////////////////////
    // Parametros de configuracion
    // Elementos utilizados
    var titulosForm = $('#TituloSearchForm');
    
    
    var titulosContainer = $( "#li_titulos > UL.results" );
    var titulosSeleccionadosContainer = $( "#li_titulos > UL.seleccionados" );    
    var titulosPaginator = $( "#li_titulos > .paginator" );
    var titulosPaginatorCountTag = $( "#li_titulos > .paginator > .count" );
    
    var titulosTemplate = $("#tituloTemplate");
    
    
    
    var institsForm = $('#InstitSearchForm');
    
    var institsContainer = $( "#li_instits > UL.results" );
    var institsTemplate = $("#institTemplate");
    
    var institsPaginator = $( "#li_instits > .paginator" );
    var institsPaginatorCountTag = $( "#li_instits > .paginator > .count" );

    
    
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
    function getTitulos(href) {
        var url = '';
        
        if (typeof href == 'object') {
            url = urlDomain + 'titulos/ajax_search_results.json';
        } else {
            url = href; 
        }
        
        var params = titulosForm.serialize();
        var postvar = $.post( 
                url,
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
    function getInstits(href) {
        var url = '';
        
        if (typeof href == 'object') {
            url = urlDomain + 'instits/search.json';
        } else {
            url = href; 
        }
        
        var params = institsForm.serialize();
        $.post(
                url,
                params,
                __meterInstitsEnTemplate,
                'json'
            );
        return false;
    }
    
    // este serà llamado luego de hacver click en alguna pagina del paginator
    function getTitulosDelPaginator(e) {      
        e.preventDefault();

        var href = e.target.href;
        if (href) {
            getTitulos(href + '.json');
        }
        return false;        
    }
    
    
    
    // este serà llamado luego de hacver click en alguna pagina del paginator
    function getInstitsDelPaginator(e) {
        e.preventDefault();

        var href = e.target.href;
        if (href) {
            getInstits(href + '.json');
        }
        return false;        
    }
    
    
    
    /////////////////////////////////////////////////////////////////
    //
    // Funciones extra
    //

    var __meterTitulosEnTemplate = function (data) {
        // primero borro el contenido
        titulosContainer.html('');
        
        __updatePaginatorElement(data, titulosPaginator, titulosPaginatorCountTag, getTitulosDelPaginator);       
        
        // meto la nueva data
        titulosTemplate.tmpl( data.data ).appendTo( titulosContainer );
               
        //titulosContainer.delegate('li','click',onChangeHandlerTitulos );
        titulosContainer.find('li > input').change( onChangeHandlerTitulos );
    }
    
    
    
    var __updatePaginatorElement = function(data, paginatorContainer, paginatorCountContainer, callback) {
        paginatorContainer.show();
        paginatorCountContainer.children('b').html( data.cant );

        var pagNumbers = paginatorContainer.children('.numbers');
        pagNumbers.unbind('click');
        pagNumbers.html('').append( data.paginator );
        pagNumbers.bind('click', callback );
    }
    
    
    
    var onChangeHandlerTitulos = function( e ) {   
        e.preventDefault();
        
        var tgt = e.currentTarget;
        
        if (tgt.checked) {
            titulosSeleccionadosContainer.append(tgt.parentNode);
        } else {
            titulosContainer.append(tgt.parentNode);
        }
        
        institsForm.submit();
        return false;
    }
    
    
    var __meterInstitsEnTemplate = function ( data ) {
       institsContainer.html('');
       institsTemplate.tmpl( data.data ).appendTo( institsContainer );
       
       __updatePaginatorElement(data, institsPaginator, institsPaginatorCountTag, getInstitsDelPaginator);       

    }
    
    
})(jQuery);