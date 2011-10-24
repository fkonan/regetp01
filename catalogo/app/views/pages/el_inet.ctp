<?php 
echo $javascript->link('animar_cuadros');
?>
<style type="text/css">
  #descripcion{
    background-color: lightgray;
    border: 2px solid gray;
    border-radius: 10px 10px 10px 10px;
    left: 600px;
    padding: 10px;
    position: absolute;
    top: 50px;
    width: 250px;
    display:none;
  }
  
  #el_inet_graph{
      background: url('../img/el_inet/fondo.png');
      width: 613px;
      height: 356px;
      position: relative;
      margin: auto;
  }
  
  #el_inet_graph A{
      position: absolute;
      background-repeat: no-repeat;
  }
  
  #graph_consejo_federal{
      top: 25px;
      left: 283px;
      width: 157px;
      height: 73px;
      background: url('../img/el_inet/consejo_federal.png');
  }
  
  #graph_consejo_nacional{
      top: 258px;
      left: 60px;
      width: 157px;
      height: 73px;
      background: url('../img/el_inet/consejo_nacional.png');
  }
  
  #graph_me{
      top: 23px;
      left: 39px;
      width: 148px;
      height: 78px;
      background: url('../img/el_inet/me.png');
  }
  
  #graph_inet{
      top: 140px;
      left: 393px;
      width: 181px;
      height: 81px;
      background: url('../img/el_inet/inet.png');
  }
  
  #graph_comision{
      top: 258px;
      left: 396px;
      width: 157px;
      height: 73px;
      background: url('../img/el_inet/comision.png');
  }
  
</style>
<div class="grid_12">
    <h1>El Instituto Nacional de Educación Tecnológica</h1>
    <div class="boxblanca boxdocs">
            
        <h3>Estructura</h3>
        <div class="centrado">
                        
            <div id="el_inet_graph">
                <a href="#" id="graph_comision">Comisión</a>
                <a href="#" id="graph_consejo_federal">Consejo Federal</a>
                <a href="#" id="graph_consejo_nacional">COnsejo Nacional</a>
                <a href="#" id="graph_inet">INET</a>
                <a href="#" id="graph_me">Ministerio</a>
            </div>
          
        </div>
        <div id="descripcion"></div>
    </div>
</div>
