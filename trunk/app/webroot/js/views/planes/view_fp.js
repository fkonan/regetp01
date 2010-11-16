
function buscarPlanes(formElement)
{
    var options = {
        target:        '.oferta-contanier',   // target element(s) to be updated with server response
        beforeSubmit:  blockResultConsole,  // pre-submit callback
        success:       unblockResultConsole,  // post-submit callback
        url:  formElement.action     // override for form's 'action' attribute
    };

    jQuery(formElement).ajaxSubmit(options);

    return false;
}

function blockResultConsole(formData, options) {
    jQuery('.oferta-contanier').mask('Buscando');
}

function unblockResultConsole(responseText, statusText, xhr, $form)  {
    jQuery('.oferta-contanier').unmask();
}
    