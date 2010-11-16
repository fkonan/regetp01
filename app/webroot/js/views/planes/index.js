
/**
 *
 * inicializar las tabs de JqueryUI
 *
 * los posibles options son:
 *      spinnerImg: '<?php echo $html->image('spinner.gif') ?>'
 *                  es la imagen que quiero mostrar en el spinner
 *                  
 */
function inicializarTabs(options)
{
    imgUrl = options.spinnerImg;

    jQuery('.js-tabs-ofertas').tabs();

    jQuery('.js-tabs-ciclos').tabs({
        spinner: imgUrl//,
        //selected: function(){
        //    jQuery("#ciclos-tabs ul li a").each(function(index, value) {
        //        if(jQuery(value).attr("id") == jQuery('#'+Get_Cookie('tab_ciclo')).attr("id")){
        //            return index;
        //        }
        //    });
        //}
    });
}


function agregarTabsAUserSession()
{
    selectTabsInSession();
    PreparaTabsParaSession();
}


function PreparaTabsParaSession() {
    jQuery('#ofertas-tabs a').each(function(index, value) {
        jQuery(value).click(function() {
            Set_Cookie( 'tab_oferta', value.id, '', '/', '', '' );
        });
    });

    jQuery('#ciclos-tabs a').each(function(index, value) {
        jQuery(value).click(function() {
            Set_Cookie( 'tab_ciclo', value.id, '', '/', '', '' );
        });
    });
}


function selectTabsInSession () {
    if (Get_Cookie('tab_oferta')) {
        jQuery('#'+Get_Cookie('tab_oferta')).click();
    }

    if (Get_Cookie('tab_ciclo')) {
        jQuery('#'+Get_Cookie('tab_ciclo')).click();
    }
}



