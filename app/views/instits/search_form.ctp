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
        font-size: 9pt;
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

    <div>
        <?php echo $form->input('cue', array('label'=> 'CUE ó Nombre de la Institución', 'title'=> 'Ingrese CUE ó Nombre de la institución en forma completa ó parcial. Ej: 600118, 5000216 ó Manuel Belgrano.','div'=>false));?>
    </div>    
    <?php echo $html->link('Busqueda Avanzada...','advanced_search_form',array('class'=>'link_right'));?>
    <br/>
    <span class="ajax_update" id="ajax_indicator" style="display:none;float:right"><?php echo $html->image('ajax-loader.gif')?></span>
    <div id='consoleResult' >
        <h2>Resultados</h2>
        <div style="height:170px">
            <div style="border: medium none ; margin: 0px; padding: 15px; z-index: 1001; position: relative; width: 30%; top: 60px; left: 200.5px; text-align: center; color: rgb(255, 255, 255); background-color: rgb(0, 0, 0); cursor: wait; -moz-border-radius-topleft: 10px; -moz-border-radius-topright: 10px; -moz-border-radius-bottomright: 10px; -moz-border-radius-bottomleft: 10px; opacity: 0.5;" class="blockUI blockMsg blockElement">Sin Resultados</div>
        </div>
    </div>
    <p>
	<? echo $html->image('/css/images/puntoverde.gif',array('title'=>'Ingresados a la Base de Datos')); ?>
	- Institución ingresada al RFIETP<br />
	<? echo $html->image('/css/images/puntorojo.gif',array('title'=>'NO Ingresados a la Base de Datos')); ?>
	- Institución NO ingresada al RFIETP
    </p>
    <?= $form->end()?>
</div>
