<?php
class FondosController extends AppController {

	var $name = 'Fondos';
	var $helpers = array('Html', 'Form');
	var $components = array('Excel');
	var $uses = array('Jurisdiccion');

	
	function jurisdiccionales(){

		$this->set('jurisdicciones',$this->Jurisdiccion->find('list'));
		
	}
	
	
	function informacion(){
	
	}

	
	function descargador_excel(){
		Configure::write('debug',1);
		$vectorMostrar[] = array("Alejandro","Pepe", "Lalsla", 12);
		$vectorMostrar[] = array("Jose","Cuchuflo", "aaa",99);
		
		$this->Excel->createConfig();
		$this->Excel->prefix = 'estadistica';
		$this->Excel->createTitle ($title = "Listado de Algo", $style = "color:black;font-size:23px;");
		
		$this->Excel->createSubTitle($title = "ALGUN SUBTITULO",
								$style= "color:black; font-size:10px;",
								$option = "newline-after");
								
		$this->Excel->createHeaders($header = "columna1, Columna2:100, Coluimna3:50, columna4",
							  $style = "color:white; font-size:12px, background:black",
							  $option = "newline-after");  						
		
				  
		$this->Excel->createList(	$arrList = $vectorMostrar, 
							$style = "color:red;font-size:10px;",
							$logical = array("Admin, style=color:green","Guest,style=color:yellow")
		);
		echo "222222222222222222";	
		
		$vectorMostrar[] = array("Maradopna","aaaa", "aaaa", 1442);
		$vectorMostrar[] = array("batistuta","bbbb", "bbbb",94449);
		$this->Excel->createList(	$arrList = $vectorMostrar, 
							$style = "color:red;font-size:10px;",
							$logical = array("Admin, style=color:green","Guest,style=color:yellow")
		);
		echo "982364789234";	
		exit();
	} 
}
?>