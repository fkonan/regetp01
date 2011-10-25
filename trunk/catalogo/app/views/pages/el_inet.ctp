<script type="text/javascript">
function viewDescription(este) {
    $(este.hash).dialog({
        width: 600,
                //position: 'top',
                zIndex: 3999,
                title: este.text
    });
      
    return false;
}
</script>

<?php echo $html->css('catalogo.el_inet');?> 


<div class="grid_12">
    <h1>El Instituto Nacional de Educaci�n Tecnol�gica</h1>
    <div class="boxblanca boxdocs">
            
        <h3>Estructura</h3>
        <div class="centrado">
                        
            <div id="el_inet_graph">
                <a href="#txt_comision" id="graph_comision" onclick="return viewDescription(this)">Comisi�n Federal de Educaci�n T�cnico Profesional</a>
                <a href="#txt_consejo_federal" id="graph_consejo_federal" onclick="return  viewDescription(this)">Consejo Federal de Educaci�n</a>
                <a href="#txt_consejo_nacional" id="graph_consejo_nacional" onclick="return  viewDescription(this)">Consejo Nacional de Educaci�n Trabajo y Producci�n (CONETyP)</a>
                <a href="#txt_inet" id="graph_inet" onclick="return viewDescription(this)">Instituto Nacional de Educaci�n Tecnol�gica</a>
                <a href="http://www.me.gov.ar/" target="_blank" id="graph_me">Ministerio de Educaci�n</a>
            </div>
            
            <div class="show_in_dialog" id="txt_consejo_federal">
                �mbito de concertaci�n, acuerdo y coordinaci�n de la pol�tica educativa nacional, 
                presidido por el Ministro de Educaci�n Nacional e integrado por las autoridades 
                educativas de las 23 provincias argentinas y de la Ciudad Aut�noma de Buenos Aires.
                <br/>
                <p>
                    Para obtener m�s informaci�n 
                    <a target='_blank' href='http://portal.educacion.gov.ar/consejo/2009/12/04/el-consejo/'>
                        haga click aqu�</a>
                </p>
            </div>
            
            <div class="show_in_dialog" id="txt_inet">
                El INET es el organismo del Ministerio de Educaci�n que tiene a su cargo la coordinaci�n de la aplicaci�n de las pol�ticas p�blicas de manera concertada y concurrente con las provincias y la Ciudad Aut�noma de Buenos Aires, relativas a la educaci�n t�cnico profesional en los niveles secundario t�cnico, superior t�cnico y de formaci�n profesional.<br /> Promueve la mejora continua de la calidad de la ETP, asegurando mayores niveles de inclusi�n y adecuando en forma permanente la oferta educativa a las necesidades sociales, productivas y territoriales.<br/> La Ley de Educaci�n T�cnico Profesional 26058 en su art. 45. asigna las responsabilidades y funciones del organismo. Cuenta con dos �mbitos permanentes de consulta y acuerdo: la Comisi�n Federal de ETP y el Consejo Nacional de Educaci�n Trabajo y Producci�n (CoNETyP), con quienes elabora las propuestas a ser presentadas para su aprobaci�n al Consejo Federal de Educaci�n.<br/><p>Para obtener m�s informaci�n <a target='_blank' href='http://www.inet.edu.ar/'>haga click aqu�</a></p>
            </div>
            
            <div class="show_in_dialog" id="txt_consejo_nacional">
                Este Consejo, cuya Secretar�a Permanente lleva la Direcci�n Ejecutiva del INET, tiene como funci�n asesorar al Ministro de Educaci�n en todos los aspectos que tiendan a la vinculaci�n de la educaci�n con el mundo del trabajo, de la producci�n, de la ciencia y la tecnolog�a.<BR /> En el marco de dicho Consejo se desarrollan foros sectoriales, constituidos por referentes clave de cada sector, a partir de los cuales se elaboran las propuestas espec�ficas de formaci�n y capacitaci�n.<BR />Para asegurar su representatividad, el CONETyP se conforma con representantes de los Ministerios de Educaci�n, de Trabajo y de Producci�n, de Ciencia y Tecnolog�a, del Consejo Federal de Educaci�n, de las c�maras empresarias - en particular de la peque�a y mediana empresa -, de las organizaciones de los trabajadores, incluidas las entidades gremiales docentes, las entidades profesionales de t�cnicos, y de entidades empleadoras que brindan educaci�n t�cnico profesional de gesti�n privada.
            </div>
            
            <div class="show_in_dialog" id="txt_comision">
                Esta Comisi�n creada por Ley de Educaci�n T�cnico Profesional N� 26058, art. 49 y 50 tiene como prop�sito principal garantizar los circuitos de consulta t�cnica para la formulaci�n y seguimiento de los programas federales orientados a la aplicaci�n de dicha Ley en el marco de los acuerdos del Consejo Federal de Educaci�n, como organismo de concertaci�n de la pol�tica educativa nacional.<br/>La Comisi�n Federal de Educaci�n T�cnico Profesional est� integrada por los representantes de las provincias y del Gobierno de la Ciudad Aut�noma de Buenos Aires, designados por las m�ximas autoridades jurisdiccionales respectivas y su actividad est� coordinada por la Direcci�n Ejecutiva del INET.
            </div>
          
        </div>
        <div id="descripcion"></div>
    </div>
</div>