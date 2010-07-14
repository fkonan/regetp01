<style>
    INPUT, TEXTAREA, SELECT, option{
        font-size: 10pt;
        letter-spacing: normal;
        line-height: normal;
        margin: 0em;
        text-indent: 0px;
        text-shadow: none;
        text-transform: none;
        word-spacing: normal;
    }


    input[type="text"], input.text, input.title, textarea, select{
        background-color: white;
        border: 1px solid #BBB;
    }

    label{
        font-family: Arial,Helvetica,sans-serif; 
        font-size: 15px;
        color: rgb(0, 102, 204);
    }

</style>
<?
echo $javascript->link('jquery.autocomplete');
echo $javascript->link('jquery.blockUI');
echo $html->css('jquery.autocomplete.css');
?>
<script type="text/javascript">
    var enterButton = false;

    function IsNumeric(expression)
    {
            return (String(expression).search(/^\d+$/) != -1);
    }

    function blockResultConsole(formData, jqForm, options) {
        jQuery.blockUI(
            {
              message: ''
            }
        );
        jQuery('#ajax_indicator').show();
        return true;
    }

    function iniciarTooltip(){
        jQuery.tools.tooltip.conf.events.input = 'focus,blur';
        jQuery.tools.tooltip.conf.events.tooltip = '';
        jQuery.tools.tooltip.conf.events.widget = 'focus, blur';
        jQuery("#InstitSimpleSearchForm :input[title]").tooltip({ effect: 'slide', offset:[22,0]});

    }

    function unblockResultConsole(responseText, statusText, xhr, $form)  {
        jQuery.unblockUI();
        jQuery('#ajax_indicator').hide();

        jQuery("#consoleResult").css({backgroundColor:"#FFFFE0"}).animate(
                   {width:'610px'},
                    200,
                    'linear',
                    function(){
                        jQuery("#consoleResult").delay(100).animate(
                            {width:'610px'},
                            200,
                            function(){
                                jQuery("#consoleResult").css({background:"#FFF"});
                        });
        });
        
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

<h1><?= __('Buscar Institución')?></h1>

<div>
    <?= $form->create('Instit',array('action' => 'simpleSearch','name'=>'InstitSearchForm'));?>

    <div style="margin-top:30px">
        <span><?php echo $form->input('cue', array('style'=>'float:left;width:90%;border: 1px solid rgb(156, 184, 250); background: transparent none repeat scroll 0pt 50%; -moz-background-clip: border; -moz-background-origin: padding; -moz-background-inline-policy: continuous; font-size: 22px; height: 29px; color: rgb(117, 117, 117);','label'=> 'CUE ó Nombre de la Institución', 'title'=> 'Ingrese CUE ó Nombre de la institución en forma completa ó parcial. Ej: 600118, 5000216 ó Manuel Belgrano.','div'=>false));?></span>
        <span class="ajax_update" id="ajax_indicator" style="display:none;"><?php echo $html->image('ajax-loader.gif')?></span>
    </div>
    <?php echo $html->link('Busqueda Avanzada...','advanced_search_form',array('class'=>'link_right'));?>
    <br/>
    <br/>
    <br/>
    
    
    <div id='consoleResult' >
        
    </div>
    
    <p>
	<? echo $html->image('/css/images/puntoverde.gif',array('title'=>'Ingresados a la Base de Datos')); ?>
	- Institución ingresada al RFIETP<br />
	<? echo $html->image('/css/images/puntorojo.gif',array('title'=>'NO Ingresados a la Base de Datos')); ?>
	- Institución NO ingresada al RFIETP
    </p>
    <?= $form->end()?>
</div>
