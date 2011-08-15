<?php 
$this->pageTitle= 'Informática';
?>

<?php echo $this->element('menu_docs')?>


<div class="grid_9">
    <div class="boxblanca boxdocs">
		<?php  
        $vops = array(
            'foroName' => 'Informática',
            'participantes' => array(
                'COORDIEP',
                'CPCI',
                'CESSI',
                'UDA',
                'Polo IT Buenos Aires',
                'SADIO',
                'USUARIA',
                'Córdoba Technology, Cluster de Tecnología de la Información',
                'Ministerio de la Producción',
                'COPITEC',
                'CICOMRA',
                'CEIL',
                'FNPT' ,
            ),
            'docInfoSectorial' => '',
            'fliaProfesional' => array('nombre'=>'Informática',
                                       'link'=>'/pages/doc_residual/flias/informatica')
        );
        echo $this->element('foro', $vops);
		?>
    </div>
</div>
