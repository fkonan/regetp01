function SearchSimilars(url, name, id) {
    jQuery(document).ready(function() {
       jQuery('#divTituloName').mask('Buscando títulos similares...');
       
       var urlcompleta = '';
       if (escape(name) && id) {
           urlcompleta = url+escape(name)+'/'+id;
       }
       else if (escape(name)) {
           urlcompleta = url+escape(name);
       }

       if (urlcompleta) {
           jQuery('#similars').load(urlcompleta, function(){
               jQuery('#similars').attr('style', 'display:block');
               jQuery('#divTituloName').unmask();
           });
       }
    });
}

function Validate() {
   if (jQuery('.js-prioridad').is(':checked')) {
        return true;
    }
    else {
        alert('Debe especificar un Sector/Subsector prioritario');
        return false;
    }
}