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


function init(autocomplete_url) {
    jQuery(document).ready(function () {
        // deshabilita ENTER
        jQuery('form').keypress(
            function stopRKey(evt) {
              var evt = (evt) ? evt : ((event) ? event : null);
              var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
              if (evt.keyCode == 13)  {return false;}
            });

        toggleTitulos();
        toggleEstructuraPlan();

        jQuery("#PlanEstructuraPlanId").change(function(){
            jQuery("div[estructura_plan_id]").hide();
            jQuery("div[estructura_plan_id=" + jQuery(this).val() + "]").show();
            jQuery("#PlanTituloName").val('');
            jQuery("#PlanTituloId").val('');
        });


        jQuery("#PlanTituloName").autocomplete(autocomplete_url, {
            dataType: "json",
            delay: 200,
            max:30,
            cacheLength:0,
            extraParams: {
                oferta_id: function() { return jQuery('#PlanOfertaId').val(); },
                sector_id: function() { return jQuery('#sector_id').val(); },
                subsector_id: function() { return jQuery('#PlanSubsectorId').val(); }
            } ,
            parse: function(data) {
                return jQuery.map(data, function(titulo) {
                    return {
                        data: titulo,
                        value: titulo.id,
                        result: formatResult(titulo)
                    }
                });
            },
            formatItem: function(item) {
                return formatResult(item);
            }
        }).result(function(e, item) {
            if(item.type == 'Vacio'){
                jQuery("#PlanTituloName").val('');
                jQuery("#PlanTituloId").val('');
            }
            else{
                jQuery("#PlanTituloId").val(item.id);
            }
        });

        jQuery("#PlanTituloName").attr('autocomplete','off');

        jQuery("#sector_id").change(function(){
            jQuery("#PlanTituloName").val('');
            jQuery("#PlanTituloId").val('');
        });

        jQuery("#PlanSubsectorId").change(function(){
            jQuery("#PlanTituloName").val('');
            jQuery("#PlanTituloId").val('');
        });

        jQuery("#PlanTituloName").change(function(){
            if (jQuery("#PlanTituloName").val() == '')
                jQuery("#PlanTituloId").val('');
        });

    });
}