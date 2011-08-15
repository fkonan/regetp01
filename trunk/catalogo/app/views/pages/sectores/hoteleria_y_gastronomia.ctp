<?php 
$this->pageTitle= 'Hotelería y Gastronomía';
?>

<?php echo $this->element('menu_docs')?>


<div class="grid_9">
    <div class="boxblanca boxdocs">
		<?php  
        $vops = array(
            'foroName' => 'Hotelería y Gastronomía',
        );
        echo $this->element('foro', $vops);
		?>
    </div>
</div>
