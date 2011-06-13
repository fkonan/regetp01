<?php
class CorreosController extends AppController{
    
    // sin tablas asociadas a este controlador
    //var $uses = null;
    
    var $components = array('Email');
    
    function contacto() {
        $this->pageTitle = "Contacto";
        if (!empty($this->data)) {
            // pasa data al model para validar
            $this->Correo->set( $this->data );

            if ($this->Correo->validates()) {
                $mensaje = "Nombre: ".$this->data['Correo']['from']."\n";
                $mensaje .= "E-mail: ".$this->data['Correo']['mail']."\n";
                $mensaje .= "Teléfono: ".$this->data['Correo']['telefono']."\n\n";
                $mensaje .= $this->data['Correo']['descripcion']."\n";

                /* SMTP Options */
                $this->Email->smtpOptions = array(
                    'port'=>'25',
                    'timeout'=>'30',
                    'host' => '168.83.21.13',
                    'username'=>'desarrolloetp',
                    'password'=>'etpdesar',
                );

                $this->Email->delivery = 'smtp';
                $this->Email->from     = $this->data['Correo']['from'].' <'.$this->data['Correo']['mail'].'>';
		$this->Email->to       = NOMBRE_CONTACTO.' <'.EMAIL_CONTACTO.'>';
                $this->Email->subject  = 'Contacto desde Catálogo';
                $this->Email->template = 'simple';
                $this->set("message", $mensaje);
                           
                $this->Email->send();
                
                $this->set('smtp_errors', $this->Email->smtpError);
                $this->Session->setFlash(__("Su mensaje ha sido enviado", true));
            }
        }
    }
    
    function desactualizada(){
        if (!empty($this->data)) {
            if ($this->RequestHandler->isAjax()) {

                if (empty($this->data['Correo']['from'])) {
                        $this->data['Correo']['from'] = 'No especificado';
                }
                if (empty($this->data['Correo']['mail'])) {
                        $this->data['Correo']['mail'] = 'No especificado';
                }

                $mensaje = "Datos de la institución desactualizada:\n\n";
                $mensaje .= $this->passedArgs['cue_instit']."\n";
                $mensaje .= $this->passedArgs['nombre_completo']."\n\n";

                $mensaje .= "Nombre: ".$this->data['Correo']['from']."\n";
                $mensaje .= "E-mail: ".$this->data['Correo']['mail']."\n";
                $mensaje .= "Teléfono: ".$this->data['Correo']['telefono']."\n\n";

                $mensaje .= $this->data['Correo']['descripcion']."\n";

                /* SMTP Options */
                $this->Email->smtpOptions = array(
                    'port'=>'25',
                    'timeout'=>'30',
                    'host' => '168.83.21.13',
                    'username'=>'desarrolloetp',
                    'password'=>'etpdesar',
                );

                $this->Email->delivery = 'smtp';
                $this->Email->from     = $this->data['Correo']['from'].' <'.$this->data['Correo']['mail'].'>';
		$this->Email->to       = NOMBRE_CONTACTO.' <'.EMAIL_CONTACTO.'>';
                $this->Email->subject = 'Institución '. $this->data['Correo']['cue'] .' desactualizada';
                $this->Email->template = 'simple';
                $this->set("message", $mensaje);
                           
                $this->Email->send();
                
                $this->autoRender = false;
                //$this->Session->setFlash(__("Gracias por informarnos sobre una desactualización", true));
            }
        }
    }
}