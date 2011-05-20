<h1>Bienvenidos</h1>
<div class="grid_9 alpha">
    <cite class="bigquote">
        Necesitamos que todos los argentinos tengan una educación de calidad y en particular los técnicos porque sabemos que las tecnologías van cambiando día a día, así que, hay que contextualizar las escuelas técnicas y también que los chicos nuestros tengan una alta calificación que les permita complementar la formación académica con la transformación tecnológica y estar mejor preparados para el mundo laboral
    </cite>
</div>
<div class="grid_3 omega"><?php echo $html->image('/css/img/me_trans.png')?></div>


<div class="buscadores grid_12 alpha">
    <div class="grid_12 alpha omega">
    <h2 class="separador uppercase grid_4 alpha">Búsquedas por Perfiles</h2>
    </div>
    
    <div class="boxblanca box_grid_4 alpha">
        <h3>Estudiantes</h3>        
        <h2>Guía del Estudiante</h2>
        
        <?php echo $html->link('más información', 
                array('controller'=>'titulos', 'action'=>'guiaDelEstudiante'),
                array('class'=>'mas_info_gris'));?>
                
        <p>
           Utilizá este buscador si lo que estas buscando son Títulos o Certificados
        </p>

    </div>
    
    <div class="boxblanca grid_8 omega">
        <div class="box_grid_4 alpha omega" style="border-right: solid #dcddde 1px; padding-right: 10px; margin-right: 9px;">                   
            <h3>Otros</h3>
            <h2>Buscador de Instituciones</h2>
            <?php echo $html->link('más información', 
                    array('controller'=>'instits', 'action'=>'search_form'),
                    array('class'=>'mas_info_gris'));?>
            <p>
               Utilizá este buscador si lo que estas buscando son Títulos o Certificados
            </p>
        </div>
        
        
        
        <div class="box_grid_4 alpha omega">
            <h3>&nbsp;</h3>
            <h2>Buscador de Títulos</h2>
            <?php echo $html->link('más información', 
                    array('controller'=>'titulos', 'action'=>'guiaDelEstudiante'),
                    array('class'=>'mas_info_gris'));?>
            <p>
               Utilizá este buscador si lo que estas buscando son Títulos o Certificados
            </p>
        </div>
        
    </div>
</div>


<div class="buscadores">
    <div class="grid_12 alpha omega">
        <br />
        <h2 class="uppercase">Búsquedas por Oferta</h2>
    </div>
    
    <div class="box_grid_4 boxgris alpha">
            <h2 class="grid_4">Formación Profesional</h2>
            
            <?php echo $html->link('más información', 
                array('controller'=>'titulos', 'action'=>'search', FP_ID),
                array('class'=>'mas_info_azul'));?>
            
            <p>
                ¿Estas buscando que estudiar y no sabes que? Este buscador te guiará en tu busqueda
            </p>
            
            
    </div>
    
    
    <div class="box_grid_4 boxgris">
            <h2>Secundario Técnico</h2>
            
            <?php echo $html->link('más información', 
                array('controller'=>'titulos', 'action'=>'search', SEC_TEC_ID),
                array('class'=>'mas_info_azul'));?>
            <p>
               ¿Estas buscando que estudiar y no sabes que? Este buscador te guiará en tu busqueda
            </p>
            
            
    </div>
    
    <div class="box_grid_4 boxgris omega">
            <h2>Superior Técnico</h2>
            
            <?php echo $html->link('más información', 
                array('controller'=>'titulos', 'action'=>'search', SUP_TEC_ID),
                array('class'=>'mas_info_azul'));?>
            <p>
                ¿Estas buscando que estudiar y no sabes que? Este buscador te guiará en tu busqueda
            </p>
            
            
    </div>
    
</div>


<div class="clear"></div>



<div class="grid_12 alpha">
    <br />
    <h2>El Rol del Catálogo Nacional de Títulos y Certificados</h2>
    
    <p>
        En función de la mejora continua de la calidad de la educación técnico profesional créase, 
en el ámbito del Instituto Nacional de Educación Tecnológica, el Registro Federal de Instituciones de 
Educación Técnico Profesional y el Catálogo Nacional de Títulos y Certificaciones y establécese el proceso de 
la Homologación de Títulos y Certificaciones. Dichos instrumentos, en forma combinada, permitirán: 
    </p>
    
    <ul>
        <li>
            Garantizar el derecho de los estudiantes y de los egresados a la formación y al reconocimiento, en todo el 
territorio nacional, de estudios, certificaciones y títulos de calidad equivalente. 
        </li>
        
        <li>
            Definir los diferentes ámbitos institucionales y los distintos niveles de certificación y titulación de la 
educación técnico profesional. 
        </li>
        
        <li>
            Propiciar la articulación entre los distintos ámbitos y niveles de la educación técnico-profesional. 
        </li>
        
        <li>
            Orientar la definición y el desarrollo de programas federales para el fortalecimiento y mejora de las 
instituciones de educación técnico profesional. 
        </li>
    </ul>
</div>
