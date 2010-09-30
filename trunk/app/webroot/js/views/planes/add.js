function toggleTitulos(){
     if (jQuery('#PlanOfertaId').val() != '') {
        jQuery('#divPlanTituloId').show();
    }
    else {
         jQuery('#divPlanTituloId').hide();
    }

    toggleEstructuraPlan();
}

function toggleEstructuraPlan() {
    if (jQuery('#PlanOfertaId :selected').val() != 2 && jQuery('#PlanOfertaId :selected').val() != 3) {
        jQuery('#PlanEstructura').hide();
    }
    else {
        jQuery('#PlanEstructura').show();
    }
}