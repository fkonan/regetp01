<div class="grid_12">
    <h1>Mapa del sitio</h1>

    <div class="boxblanca boxdocs"> 
        <ol>
            <li><?php echo $html->link('Inicio', array('controller' => 'pages', 'action' => 'home')); ?></li>
            <li><?php echo $html->link('El Instituto Nacional de Educación Tecnológica', array('controller' => 'pages', 'action' => 'el_inet')); ?>
                <ol>
                    <li>Propósitos</li>
                    <li>Ideas eje</li>
                    <li>Entidades relacionadas</li>
                </ol>
            </li>
            
            <li><?php echo $html->link('Las políticas para la Educación Técnico Profesional en Argentina', array('controller' => 'pages', 'action' => 'grafo_ley')); ?>
                <ol>
                    <li>Grafo de la ley</li>
                </ol>
            </li>
            
            <li><?php echo $html->link('La Educación Técnico Profesional en cifras', array('controller' => 'pages', 'action' => 'mapas_y_graficos')); ?></li>
            
            <li><?php echo $html->link('Buscadores', array('controller' => 'pages', 'action' => 'buscadores')); ?>
                <ol>
                    <li><?php echo $html->link('Guía del Estudiante',array('controller'=>'titulos', 'action'=>'guiaDelEstudiante')); ?></li>
                    <li><?php echo $html->link('Búsqueda de títulos y certificaciones',array('controller'=>'titulos', 'action'=>'search')); ?>
                        <ol>
                            <li><?php echo $html->link('Nivel Secundario Técnico',array('controller'=>'titulos', 'action'=>'search', SEC_TEC_ID)); ?></li>
                            <li><?php echo $html->link('Nivel Superior Técnico', array('controller'=>'titulos', 'action'=>'search', SUP_TEC_ID)); ?></li>
                            <li><?php echo $html->link('Formación Profesional', array('controller'=>'titulos', 'action'=>'search', FP_ID)); ?></li>
                        </ol>
                    </li>
                    <li><?php echo $html->link('Búsqueda por instituciones',array('controller'=>'instits', 'action'=>'search')); ?></li>
                </ol>
            </li>
            
            <li><?php echo $html->link('Documentación', array('controller' => 'pages', 'action' => 'doc_index')); ?></li>
            <li><?php echo $html->link('Contacto', array('controller' => 'correos', 'action' => 'contacto')); ?></li>
        </ol>
    </div>
</div>