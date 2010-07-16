
<?
echo $javascript->link(array(
    'jquery.autocomplete',
    'jquery.loadmask.min',
        ));

echo $html->css(array('jquery.loadmask'));
?>

<script type="text/javascript">
    var enterButton = false;

    function iniciarTooltip(){
        jQuery.tools.tooltip.conf.events.input = 'focus,blur';
        jQuery.tools.tooltip.conf.events.tooltip = '';
        jQuery.tools.tooltip.conf.events.widget = 'focus, blur';
        jQuery("#InstitSimpleSearchForm :input[title]").tooltip({ effect: 'slide', offset:[22,0]});
    }

    function blockResultConsole(formData, jqForm, options) {
        jQuery('#consoleResultWrapper').mask('Buscando');
        return true;
    }

    

    function unblockResultConsole(responseText, statusText, xhr, $form)  {
        jQuery('#consoleResultWrapper').unmask();
        
    }
        
    jQuery(document).ready(function() {
        var options = {
            target:        '#consoleResult',   // target element(s) to be updated with server response
            beforeSubmit:  blockResultConsole,  // pre-submit callback
            success:       unblockResultConsole,  // post-submit callback
            url: '<?echo $html->url(array('controller'=>'instits','action'=>'ajax_search'));?>'        // override for form's 'action' attribute
        };

        // bind form using 'ajaxForm'
        jQuery('#InstitSimpleSearchForm').ajaxForm(options);

        var timerid;
        jQuery("#InstitCue").keyup(function() {
          if(jQuery("#InstitCue").val().length > 3){
              var form = this;
              clearTimeout(timerid);
              timerid = setTimeout(function() { jQuery('#InstitSimpleSearchForm').submit(); }, 1000);
          }
        });
        iniciarTooltip();
    });
</script>


<h1><?= __('Búsqueda Rápida de Instituciones')?></h1>

<?php echo $html->link('realizar una búsqueda avanzada...','advanced_search_form',array(
    'class'=>'link_right small',
    'style'=>'margin-bottom: -18px; padding:0px; margin-right: 4px;'
    ));?>
<div>
    <?php
    echo $form->create('Instit',array('action' => 'simpleSearch','name'=>'InstitSearchForm'));
    echo $form->input('cue', array(
            'style'=>'border:1px solid #BBBBBB; width: 99%; font-size: 22px; height: 29px; color: rgb(117, 117, 117);',
            'label'=> 'CUE ó Nombre de la Institución',
            'title'=> 'Ingrese CUE ó Nombre de la institución en forma completa ó parcial. Ej: 600118, 5000216 ó Manuel Belgrano.',
            ));      
    echo $form->end();
    ?>


    <!-- Aca se muestran los resultados de la busqueda-->
    <div id='consoleResultWrapper'  style="margin-top: 20px;">
        <div id='consoleResult' style="min-height: 200px; margin-bottom: 20px;"></div>
    </div>
    
</div>
