<?php 
$this->pageTitle= 'AeronŠutica';
?>

<?php echo $this->element('menu_docs')?>


<div class="grid_9">
    <div class="boxblanca boxdocs">
		<?php  
        $vops = array(
            'foroName' => 'AeronŠutica',
        );
        echo $this->element('foro', $vops);
		?>
    </div>
    
    
</div>