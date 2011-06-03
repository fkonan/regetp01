<h1>Contáctenos</h1>
<div class="grid_6">
     <div class='boxblanca formu_6'>
          <br />
          <?php
          echo $form->create('Correo', array('action' => 'contacto'));
          echo $form->input('from', array('label'=>'Nombre'));
          echo $form->input('mail', array('label'=>'E-Mail'));
          echo $form->input('telefono', array('label'=>'Teléfono'));
          echo $form->input('descripcion', array('label'=>false, 'rows' => 5, 'cols' => 50));
          echo $form->end('Enviar');
          ?>    
    </div>
</div>
<div class="grid_6 boxgris" style="height: 220px">
     
    <h2 style="margin: 10px 20px;">Formulario de Contacto</h2>
    <p style="margin: 10px 20px;">   
        Mediante este formulario usted se pondrá en contacto con la Unidad de Información del INET.
        <br />
        <br />
        Otras vías:<br />
                  <?php echo $html->image('emailButton.png');?> xxxx@inet.edu.ar<br />
                  <?php echo $html->image('phone16x16.png');?> (011) 4129-2000 Interno 4032/4033<br />
                  <?php echo $html->image('office-building.png');?> Saavedra 789 CABA, Buenos Aires, Argentina. Oficina 311. <br />
    </p>
</div>

