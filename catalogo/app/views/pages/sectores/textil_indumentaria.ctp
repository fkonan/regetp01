<?php 
$this->pageTitle= 'Textil / Indumentaria';
?>

<?php echo $this->element('menu_docs')?>


<div class="grid_9">
    <div class="boxblanca boxdocs">
		<?php  
        $vops = array(
            'foroName' => 'Construcciones',
            'participantes' => array(
                'Asociación Confeccionistas de Pergamino',
                'FAIIA',
                'Unión Cortadores de la Indumentaria',
                'AAQCT',
                'INTI',
                'AOT',
                'Fundación Pro-Tejer',
                'UIA',
            ),
            'docInfoSectorial' => '/files/pdfs/info_sectorial/sector_indumentaria.pdf',
            'fliaProfesional' => array('nombre'=>'Textil',
                                       'link'=>'/pages/doc_residual/flias/textil')
        );
        echo $this->element('foro', $vops);
		?>
    </div>
</div>
