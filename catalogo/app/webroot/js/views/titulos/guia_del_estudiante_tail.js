(function($){ 
    /////////////////////////////////////////////////////////////////
    // Parametros de configuracion
    // Elementos utilizados

    var paginatorTemplate = $('#paginatorTemplate');
    
    
    var titulosForm = $('#TituloSearchForm');
    var titulosContainer = $( "#li_titulos ul.results" );
    var titulosPaginator = $("#li_titulos .paginatorContainer")
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

    $(".add_filter").live("click",function(event){
        titulosForm.submit();
    });
    
    $('input[type=text]').live("keypress", function(e){
        if(e.which == 13){
            titulosForm.submit();   
        }
    });

    $(".autosubmit").live("change",function(event){
        titulosForm.submit();
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
        jQuery(institsContainer).html('');
        jQuery('#li_titulos').mask('Buscando');
        return true;
    }

    var __unblockResultConsole = function () {
        jQuery('#li_titulos').unmask();
    }

    function __hideWithLabel(input){
        var label = titulosForm.find("label[for=" + input.attr("id") + "]");
        var plus = $(input).next('.add_filter');
        label.hide();
        input.hide();
        input.attr('disabled','disabled');
        plus.hide();
    }

     function __showWithLabel(input){
         var label = titulosForm.find("label[for=" + input.attr("id") + "]");
         var plus = $(input).next('.add_filter');
         label.show();
         input.show();
         input.removeAttr('disabled');
         plus.show();
         $(input).effect("highlight", {}, 1000);
    }
    
    /**
     * Trae los titulos en JSON, usando ajax
     */
    function getTitulos(href) {

        var url = '';

        $('#filtro,.filtros-aplicados').block({ message: null,
                                                css: { backgroundColor: 'transparent'}
        });

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
        return false;
    }
    
    
    // trae las instituciones de los titulos seleccionados
    function getInstits(e) {
        var url = '';

        $('#li_instits').mask('Buscando');

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
        __ajustarAlturas('#li_instits', '#li_titulos');
    }

    var __recargarFiltrosAplicados = function (params) {
        
        for(var i in params)
        {
            if(params[i].name != '_method' && params[i].value != ''){
                cont++;
                input = titulosForm.find("[name='" + params[i].name + "']");
                nombre = titulosForm.find("label[for=" + input.attr("id") + "]").html().replace("<br>", "");
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
        var cont = $(".filtros-aplicados .filtro").length;
        if(cont > 0){
            $("#sin_filtros").hide();
        }
        else{
            $("#sin_filtros").show();
        }
        __ajustarAlturas('#filtro', '.filtros-aplicados');
        
        $(".filtros-aplicados").effect("highlight", {}, 3000);
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

        __ajustarAlturas('#filtro', '.filtros-aplicados');
    }

    var __ajustarAlturas = function (selector1, selector2) {
        $(selector1+','+ selector2).attr('style', '');
        hFiltro = $(selector1).outerHeight(); // Get height
        hAplicados = $(selector2).outerHeight(); // Get height
        mHeight = hFiltro > hAplicados ? hFiltro : hAplicados;  // Set mHeight to the larger of the two heights
        $(selector1+','+ selector2).outerHeight(mHeight);  // Set both to equal heights
    }

    var __recargaCombo = function (combo,data){
        var options = [];
        var label = titulosForm.find("label[for=" + combo.attr("id") + "]");
        options.push('<option value="">Seleccione...</option>');
        var n = 0;
        for (key in data) {
          if(key != "" && data[key] != ""){
            options.push('<option value="',
                         key, '">',
                         data[key], '</option>');
            n++;
          }
        }
        

        if(n > 2){
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

        //titulosContainer.delegate('li','click',onChangeHandlerTitulos );
        titulosContainer.find('li > input').change( onChangeHandlerTitulos );

        __unblockResultConsole();
        $('#filtro,.filtros-aplicados').unblock();
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
       //if(titulosSeleccionadosContainer.children().length > 0){
            institsForm.submit();
        //}else{
        //    institsContainer.text("Sin Resultados");
        //    institsPaginator.html("");
        //}
    }
    
    
    var __meterInstitsEnTemplate = function ( data ) {
       institsContainer.html('');
       institsTemplate.tmpl( data.data ).appendTo( institsContainer );
       
       __updatePaginatorElement(data, institsPaginator, getInstitsDelPaginator);

       $('#li_instits').unmask();
       __ajustarAlturas('#li_instits', '#li_titulos');
    }
    
    var __blanquearContainers = function() {
        institsContainer.html('');
        institsPaginator.html('');
    }

    $(function(){
       __ajustarAlturas('#filtro', '.filtros-aplicados');
    });

})(jQuery);
