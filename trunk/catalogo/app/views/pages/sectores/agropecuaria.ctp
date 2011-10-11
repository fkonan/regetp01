<?php 
$this->pageTitle= 'Agropecuaria';
?>

<?php echo $this->element('menu_docs')?>


<div class="grid_9">
    <div class="boxblanca boxdocs">
		<?php  
        $vops = array(
            'foroName' => 'Agropecuario',
            'fliaProfesional' => array('nombre'=>'Agropecuario',
                           'link'=>'/pages/flias/agropecuaria')
        );
        echo $this->element('foro', $vops);
		?>
		<h3>Subsectores</h3>
		<ul>
			<li>Apí­cola</li>
			<li>Avícola</li>
			<li>Florí­cola</li>
			<li>Forestal</li>
			<li>Frutí­cola - Olivicultura</li>
			<li>Hortí­cola</li>
			<li>Producción Lechera</li>
			<li>Vitivinicultura</li>
		</ul>
    </div>
</div>
