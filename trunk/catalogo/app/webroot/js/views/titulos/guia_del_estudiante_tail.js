(function($){ 
    /////////////////////////////////////////////////////////////////
    // Parametros de configuracion
    // Elementos utilizados
    
    var paginatorTemplate = $('#paginatorTemplate');
    
    
    var titulosForm = $('#TituloSearchForm');
    var titulosContainer = $( "#li_titulos > UL.results" );
    var titulosSeleccionadosContainer = $( "#li_titulos > UL.seleccionados" );    
    var titulosPaginator = $("#li_titulos > .paginatorContainer")
    var titulosTemplate = $("#tituloTemplate");
    
    var institsForm = $('#InstitSearchForm');
    var institsContainer = $( "#li_instits > UL.results" );
    var institsTemplate = $("#institTemplate");
    var institsPaginator = $("#li_instits > .paginatorContainer")
  

    
    
    /////////////////////////////////////////////////////////////////
    // Inicializacion de los formularios
    titulosForm.submit(getTitulos);
    
    institsForm.submit(getInstits);
    
    
    
    /////////////////////////////////////////////////////////////////
    // functiones Principales
    //
    var __blockResultConsole = function () {
        jQuery('#resultados').mask('Buscando');
        return true;
    }

    var __unblockResultConsole = function () {
        jQuery('#resultados').unmask();
    }
    
    /**
     * Trae los titulos en JSON, usando ajax
     */
    function getTitulos(href) {
        var url = '';

        __blockResultConsole();
        
        if (typeof href == 'object') {
            url = urlDomain + 'titulos/ajax_search_results.json';
            
            // redifini la busquda de los filtros entonces limpiar los 
            // resultados previamente cargados
            __blanquearContainers();
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
    function getInstits(e) {
        var url = '';

        __blockResultConsole();

        console.debug(e);
        console.debug( e.target.action);
        if (typeof e == 'object') {
            url = e.target.action;
        } else {
            url = e;
        }

        //__crearHiddens();
        
        var params = titulosForm.serialize() + "&" + institsForm.serialize();
        $.post(
                url,
                params,
                __meterInstitsEnTemplate,
                'json'
            );

        __unblockResultConsole();
        
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
        
        __updatePaginatorElement(data, titulosPaginator, getTitulosDelPaginator);       
        
        // meto la nueva data
        titulosTemplate.tmpl( data.data ).appendTo( titulosContainer );
               
        //titulosContainer.delegate('li','click',onChangeHandlerTitulos );
        titulosContainer.find('li > input').change( onChangeHandlerTitulos );

        __unblockResultConsole();
    }
    
    
    
    var __updatePaginatorElement = function(data, paginatorContainer, callback) {
        paginatorContainer.html('');
        paginatorTemplate.tmpl( data.paginator ).appendTo( paginatorContainer );
        var pagNumbers = paginatorContainer.find('.numbers');
        pagNumbers.unbind('click');
        pagNumbers.bind('click', callback );
                
    }
    
    var __crearHiddens = function(){
        var form = titulosForm.find(":input");
        $.each(form, function(e, input) {
            $('<input>').attr({
                type: 'hidden',
                name: $(input).attr("name"),
                value: $(input).val()
            }).appendTo(institsForm);
        });
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
       
       __updatePaginatorElement(data, institsPaginator, getInstitsDelPaginator);

       __unblockResultConsole();
    }
    
    var __blanquearContainers = function() {
        titulosSeleccionadosContainer.html('');
        institsContainer.html('');
        institsPaginator.html('');
    }
    
    
})(jQuery);