<?php 
$this->pageTitle= 'Construcciones';
?>

<?php echo $this->element('menu_docs')?>


<div class="grid_9">
    <div class="boxblanca boxdocs">
		<?php  
        $vops = array(
            'foroName' => 'Construcciones',
            'fliaProfesional' => array('nombre'=>'Construcciones',
                           'link'=>'/pages/flias/construccion')
        );
        echo $this->element('foro', $vops);
		?>
    </div>
</div>
