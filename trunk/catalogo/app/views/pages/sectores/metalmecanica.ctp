<?php 
$this->pageTitle= 'Metalmecánica';
?>

<?php echo $this->element('menu_docs')?>


<div class="grid_9">
    <div class="boxblanca boxdocs">
		<?php  
        $vops = array(
            'foroName' => 'Metalmecánica',
            'participantes' => array(
                'Ministerio de la Producción.',
                'CAME',
                'UOM',
                'UDA',
                'ASIMRA',
                'FNPT',
                'AMET' ,
                'ADIMRA',
            ),
            'docInfoSectorial' => '/files/pdfs/info_sectorial/madera y mueble.pdf',
            'fliaProfesional' => array('nombre'=>'Metalmecánica',
                                       'link'=>'/pages/flias/metalmecanica')
        );
        echo $this->element('foro', $vops);
		?>
    </div>
</div>
