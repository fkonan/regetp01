var etapas = new Array();

function EtapaAdd() {
    var i = etapas.length;
    // guarda la etapa
    //etapas[i] = new Array('etapa_id','edad_teorica','nro_anio','anio_escolaridad');
    etapas[i] = { etapa_id: jQuery("#etapa_id").val(),
                  etapa_nombre: escape(jQuery('#etapa_id :selected').text()),
                  edad_teorica: jQuery("#edad_teorica").val(),
                  nro_anio: jQuery("#nro_anio").val(),
                  anio_escolaridad: jQuery("#anio_escolaridad").val() };

    etapas.sort(sortfcn);

    // refresca el arbol de etapas
    jQuery("#etapas-tree").html("");
    for (var j=0; j < etapas.length; j++) {
        jQuery("#etapas-tree").append("<li>"+unescape(etapas[j]['etapa_nombre'])+" "+etapas[j]['nro_anio']+"</li>");
    }

    // resetea el form
    jQuery("#edad_teorica").val('');
    jQuery("#nro_anio").val('');
    jQuery("#anio_escolaridad").val('');

    // traba etapa
    jQuery('#etapa_id').attr('disabled', true);
}

function EtapaAddObject(etapa) {
    var i = etapas.length;
    // guarda la etapa
    //etapas[i] = new Array('etapa_id','edad_teorica','nro_anio','anio_escolaridad');
    etapas[i] = { etapa_id: etapa.etapa_id,
                  etapa_nombre: etapa.etapa_nombre,
                  edad_teorica: etapa.edad_teorica,
                  nro_anio: etapa.nro_anio,
                  anio_escolaridad: etapa.anio_escolaridad };

    etapas.sort(sortfcn);

    // refresca el arbol de etapas
    jQuery("#etapas-tree").html("");
    for (var j=0; j < etapas.length; j++) {
        jQuery("#etapas-tree").append("<li>"+unescape(etapas[j]['etapa_nombre'])+" "+etapas[j]['nro_anio']+"</li>");
    }
}

function sortfcn(a,b){
     if(parseInt(a['edad_teorica'])<parseInt(b['edad_teorica'])){
        return -1;
     }
     else if(parseInt(a['edad_teorica'])>parseInt(b['edad_teorica'])){
        return 1;
     }
     else{
        return 0;
     }
}

function EtapasASubmit() {
    // pasa vector etapas para submitear
    jQuery("#etapas").val(array2dToJson(etapas, 'object'));

    // rehabilita el select para mandar value por submit
    jQuery('#etapa_id').attr('disabled', false);

    return true;
}