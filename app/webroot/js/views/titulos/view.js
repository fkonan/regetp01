jQuery(document).ready(function() {

    jQuery("#resumenplanes").hide();
    
    jQuery("#resumenlink").click(function() {
        jQuery("#resumenplanes").toggle('slow');

        if (jQuery("#arrowlink").attr("src") == "/regetp/img/arrow_down.png") {
            jQuery("#arrowlink").attr("src", "/regetp/img/arrow_up.png");
        }
        else {
            jQuery("#arrowlink").attr("src", "/regetp/img/arrow_down.png");
        }
    });
});