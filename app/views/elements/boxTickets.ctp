<?
if ($session->check('Auth.User')){
	if(	$session->read('Auth.User.role') == 'admin' || 
		$session->read('Auth.User.role') == 'desarrollo' ||
		$session->read('Auth.User.role') == 'editor'){
	?>


<script type="text/javascript">
    /**
     * me dice si ya fue apretado el link Ver Pendientes,
     * en tal caso, no me vuelve a hacer un Request, simplemente oculto el div
     * y listo!
     */
    var apretado = false;

    
    function mostrarPendientes(){
        $('tickets').toggle();

        if (apretado == false) {
            new Ajax.Updater('tickets', '<? echo $html->url('/tickets/provincias_pendientes')?>');
            apretado = true;
        }
    }
    
    Event.observe(window, 'load', function(){
        $('linkVerPendientes').observe('click',mostrarPendientes);
    });
</script>

<div id="boxTickets">
	<h1>Pendientes de Actualización</h1>
	

<ul>
	<?php
			$prov_pend = array();
			$prov_pend = $this->requestAction('/tickets/provincias_pendientes');
			
			/************************/
			?>
			
			<!-- div class="box gradwhite blue" -->
			<div>
                            <a href="javascript:;" id="linkVerPendientes">Ver Pendientes</a>
                        </div>
			
		
			<div id="tickets" style="display: none;"></div>
			
			<?php 
			/************************/									
		?> 

</ul>

</div>	
	<?php 
	
	}
}
	?>