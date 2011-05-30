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
    var tituloOfertaCombo = $("#TituloOfertaId");
    var tituloSectorCombo = $("#TituloSectorId");
    var tituloName = $("#TituloTituloName");


    
    var institsForm = $('#InstitSearchForm');
    var institsContainer = $( "#li_instits > UL.results" );
    var institsTemplate = $("#institTemplate");
    var institsPaginator = $("#li_instits > .paginatorContainer");
    var institJurisdiccionCombo = $("#InstitJurisdiccionId");
    var institDepartamentoCombo = $("#InstitDepartamentoId");
    var institLocalidadCombo = $("#InstitLocalidadId");
    var institGestionCombo = $("#InstitGestionId");
    var institName = $("#InstitNombre");

    var filtrosForm = $("#FiltrosAplicadosForm");
    var filtrosContainer = $("#filtrosContainer");

    var __parentFilters = new Array();
    __parentFilters["data[Instit][jurisdiccion_id]"] = ["data[Instit][departamento_id]"];
    __parentFilters["data[Instit][departamento_id]"] = ["data[Instit][localidad_id]"];
  

    
    
    /////////////////////////////////////////////////////////////////
    // Inicializacion de los formularios
    titulosForm.submit(getTitulos);
    
    institsForm.submit(getInstits);

    __hideWithLabel(institDepartamentoCombo);
    __hideWithLabel(institLocalidadCombo);
    /////////////////////////////////////////////////////////////////
    //Eventos
    //
    $(".deleteable").live("click",function(event){
        var idToDelete = jQuery(event.currentTarget).siblings("input").attr('id');
        deleteFilter(idToDelete);
        titulosForm.submit();
        return false;
    });
    
    function deleteFilter(id){
        var escapedId = id.replace(/\[/g, "\\[");
        escapedId = escapedId.replace(/\]/g, "\\]");
        jQuery("#" + escapedId).parent().remove();
        if(__parentFilters[id]){
            for(var childId in __parentFilters[id]) {
                deleteFilter(__parentFilters[id][childId]);
            }
        }
    }

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

    function __hideWithLabel(input){
        var label = titulosForm.find("label[for=" + input.attr("id") + "]");
        label.hide();
        input.hide();
        input.attr('disabled','disabled');
    }

     function __showWithLabel(input){
         var label = titulosForm.find("label[for=" + input.attr("id") + "]");
         label.show();
         input.show();
         input.removeAttr('disabled');
    }
    
    /**
     * Trae los titulos en JSON, usando ajax
     */
    function getTitulos(href) {
        var validates = true;
        titulosForm.find(".mandatory").each(function(index, obj){
            var field = jQuery(obj);
            if(!field.val()){
                validates = false;
                field.effect("highlight", {color:"red"}, 1000);
            }
        });
        
        if(validates){

            var url = '';

            __blockResultConsole();

            if (typeof href == 'object') {
                url = urlDomain + '/titulos/ajax_search_results.json';
                __blanquearContainers();
            } else {
                url = href;
            }
            __recargarFiltrosAplicados(titulosForm.serializeArray());

            var postvar = $.post(
                    url,
                    filtrosForm.serialize(),
                    __actualizarTitulos,
                    'json'
                );


            postvar.error(function (XMLHttpRequest, textStatus, errorThrown) {
            console.debug(XMLHttpRequest);
            console.debug(textStatus);
            console.debug(errorThrown);
            });
        }
        return false;
    }
    
    
    // trae las instituciones de los titulos seleccionados
    function getInstits(e) {
        var url = '';

        __blockResultConsole();

        if (typeof e == 'object') {
            url = e.target.action;
        } else {
            url = e;
        }

        var params = filtrosForm.serialize() + "&" + institsForm.serialize();
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
    /////////////////////////////////////////////////////////////////
    
    var __actualizarTitulos = function (data) {
        __recargarFiltros(data.filtros);
        __meterTitulosEnTemplate(data);
    }

    var __recargarFiltrosAplicados = function (params) {
        for(var i in params)
        {
            if(params[i].name != '_method' && params[i].value != ''){
                input = titulosForm.find("[name='" + params[i].name + "']");
                nombre = titulosForm.find("label[for=" + input.attr("id") + "]").html();
                if(input.is('select')){
                    valor = titulosForm.find("[name='" + params[i].name + "']").find("option[value='"+params[i].value+"']").html();
                }
                else if(input.is('input')){
                    valor = titulosForm.find("[name='" + params[i].name + "']").val();
                }
                
                $('<span class="filtro"/>').html("<strong>" + nombre + "</strong> " + valor + "<a href='#' class='deleteable'> X </a>")
                .append(
                    $('<input>').attr({
                        type: 'hidden',
                        id: params[i].name,
                        name: params[i].name,
                        value: params[i].value
                    })
                ).appendTo('#FiltrosAplicadosForm');
            }
        }
        if(i > 0){
            $("#sin_filtros").hide();
        }
        else{
            $("#sin_filtros").show();
        }
    }

    var __recargarFiltros = function (data) {
        if(typeof data.TituloName === 'undefined' || data.TituloName == ''){
            __showWithLabel(tituloName);
        }
        else{
            tituloName.val('');
            __hideWithLabel(tituloName);
        }

        if(typeof data.InstitName === 'undefined' || data.InstitName == ''){
            __showWithLabel(institName);
        }
        else{
            institName.val('');
            __hideWithLabel(institName);
        }
        __recargaCombo(tituloOfertaCombo,data.Oferta);
        __recargaCombo(tituloSectorCombo,data.Sector);
        
        __recargaCombo(institJurisdiccionCombo,data.Jurisdiccion);
        __recargaCombo(institDepartamentoCombo,data.Departamento);
        __recargaCombo(institLocalidadCombo,data.Localidad);
        __recargaCombo(institGestionCombo,data.Gestion);

        $(".seccion").each(function() {
            var size = 0;

            size += $(this).find("input:visible").size();
            size += $(this).find("select:visible").size();

            if(size == 0 ){
                $(this).find('.msj-vacio').show();
            }
            else{
                $(this).find('.msj-vacio').hide();
            }
        });
    }

    var __recargaCombo = function (combo,data){
        var options = [];
        var i = 0;
        var label = titulosForm.find("label[for=" + combo.attr("id") + "]");

        for (key in data) {
            i++;
            if(i == 1){
                options.push('<option value="">Seleccione...</option>');
            }
            options.push('<option value="',
              key, '">',
              data[key], '</option>');
        }

        if(i > 1){
            combo.html(options.join(''));
            __showWithLabel(combo);
        }
        else{
            __hideWithLabel(combo);
        }
        
    }

    var __meterTitulosEnTemplate = function (data) {
        // primero borro el contenido
        titulosContainer.html('');
        
        __updatePaginatorElement(data, titulosPaginator, getTitulosDelPaginator);       
        
        // meto la nueva data
        titulosTemplate.tmpl( data.data ).appendTo( titulosContainer );
        
        $('.styled_checkbox').checkbox().parent().click(__checkParentClick);


        //titulosContainer.delegate('li','click',onChangeHandlerTitulos );
        titulosContainer.find('li > input').change( onChangeHandlerTitulos );

        __unblockResultConsole();
    }

    var __checkParentClick = function(eventObject){
        jQuery(eventObject.currentTarget).find('.styled_checkbox').click();
    }
    
    
    
    var __updatePaginatorElement = function(data, paginatorContainer, callback) {
        paginatorContainer.html('');
        paginatorTemplate.tmpl( data.paginator ).appendTo( paginatorContainer );
        var pagNumbers = paginatorContainer.find('.numbers');
        pagNumbers.unbind('click');
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
       
       __updatePaginatorElement(data, institsPaginator, getInstitsDelPaginator);

       __unblockResultConsole();
    }
    
    var __blanquearContainers = function() {
        titulosSeleccionadosContainer.html('');
        institsContainer.html('');
        institsPaginator.html('');
    }
    
})(jQuery);