function toggleTitulos(){
     if (jQuery('#PlanOfertaId').val() != '') {
        jQuery('#divPlanTituloName').show();
    }
    else {
         jQuery('#divPlanTituloName').hide();
    }

    toggleEstructuraPlan();
}

function toggleEstructuraPlan() {
    if (jQuery('#PlanOfertaId :selected').val() != 3 && jQuery('#PlanOfertaId').val() != 3) {
        jQuery('#PlanEstructura').hide();
    }
    else {
        jQuery('#PlanEstructura').show();
    }
}


function formatResult(titulo) {
        return titulo.name;
}