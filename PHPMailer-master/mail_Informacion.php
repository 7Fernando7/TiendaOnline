<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    require 'src/Exception.php';
    require 'src/PHPMailer.php';
    require 'src/SMTP.php';
    require_once ($_SERVER['DOCUMENT_ROOT']."/dashboard/TiendaOnlineTFG/php/config/conexion.php");
  class enviarEmail {
    //Cre un conector que me permitirá llamar automáticamente a esta función cuando cree un objeto de una clase.
    public function __construct() {
        $this->productoDevuelto = array();
        $this->dbh = conectarse_parampdo("formulariotienda");
    }
    
    public function enviarDatosPedido($numeroPedido, $fechaEntrega) {
        $id_usuario = $_SESSION['usuario'];
        $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $this->dbh->prepare("SELECT * FROM usuarios WHERE id_usuarios= $id_usuario");
        $query->execute();
        $usuario = $query->fetch(PDO::FETCH_ASSOC);

        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.example.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'fernandopaivap7@gmail.com';                     //SMTP username
            $mail->Password   = 'lzgodoztmotokhro';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('fernandopaivap7@gmail.com', 'Barbara Boutique de moda');
            $mail->addAddress($usuario["email"], $usuario["nombre"]);     //Add a recipient

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = "Tu pedido ha sido realizado con exito.";
            $mail->Body    = "<b>Estamos preparando tu pedido con número $numeroPedido.</b></br>
            El pedido lo recibirás el dia $fechaEntrega.</br>
            Puedes ver el estado de tu pedido en http://localhost/dashboard/TiendaOnlineTFG/php/controlador/buscarPedidos.php</br>
            Muchas gracias!";
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            echo 'Message has been sent';
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    public function emailPedidoCancelado($numero_pedido) {
        $id_usuario = $_SESSION['usuario'];
        $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $this->dbh->prepare("SELECT * FROM usuarios WHERE id_usuarios= $id_usuario");
        $query->execute();
        $usuario = $query->fetch(PDO::FETCH_ASSOC);

        $mail = new PHPMailer();
        $mail->IsSMTP();

        $mail->SMTPDebug  = 0;  
        $mail->SMTPAuth   = TRUE;
        $mail->SMTPSecure = "tls";
        $mail->Port       = 587;
        $mail->Host       = "smtp.gmail.com";
        $mail->Username   = "fernandopaivap7@gmail.com";
        $mail->Password   = "Zilda467913";
        $mail->IsHTML(true);
        $mail->AddAddress($usuario["email"], $usuario["nombre"]);
        $mail->SetFrom("fernandopaivap7@gmail.com", "Barbara Boutique de moda");
        $mail->AddReplyTo("reply-to-email", "reply-to-name");
        $mail->AddCC("cc-recipient-email", "cc-recipient-name");
        $mail->Subject = "Tu petición ha sido atendidada con exito.";
        $content = "<b>El pedido con número $numero_pedido ha si cancelado.</b></br>
        Puedes ver el estado de tu pedido en http://localhost/dashboard/TiendaOnlineTFG/php/controlador/buscarPedidos.php</br>
        Muchas gracias!";

        $mail->MsgHTML($content); 
        if(!$mail->Send()) {
            echo "Error al enviar el email.";
            var_dump($mail);
        }
    }

    public function enviarAltaRegistro($nombre, $email) {

        $mail = new PHPMailer();
        $mail->IsSMTP();

        $mail->SMTPDebug  = 0;  
        $mail->SMTPAuth   = TRUE;
        $mail->SMTPSecure = "tls";
        $mail->Port       = 587;
        $mail->Host       = "smtp.gmail.com";
        $mail->Username   = "fernandopaivap7@gmail.com";
        $mail->Password   = "Zilda467913";
        $mail->IsHTML(true);
        $mail->AddAddress($email);
        $mail->SetFrom("fernandopaivap7@gmail.com", "Barbara Boutique de moda");
        $mail->AddReplyTo("reply-to-email", "reply-to-name");
        $mail->AddCC("cc-recipient-email", "cc-recipient-name");
        $mail->Subject = "Tu registro ha sido realizado con exito.";
        $content = "<b>Hola $nombre, bienvenido a Barbara Boutique de Moda, es un placer tenerlo como cliente.</b></br>
        Puedes acceder a tu perfil a través del enlace http://localhost/dashboard/TiendaOnlineTFG/php/controlador/loginUsuario.php</br>
        Muchas gracias!";

        $mail->MsgHTML($content); 
        if(!$mail->Send()) {
            echo "Error al enviar el email.";
            var_dump($mail);
        }
    }

    public function enviarElanceContrasena() {
        if(isset($_POST['email'])) {
    
        $conect= conectarse_parampdo("formulariotienda");
        $email=$_POST['email'];
        $conect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $conect->prepare("SELECT * FROM usuarios WHERE email = :email");
        $query->bindParam(":email", $email);
        $query->execute();
        $usuario = $query->fetch(PDO::FETCH_ASSOC);
    
        //miramos el resultado
            if (empty($usuario)){        //si esta vacio damos error
                header("location:mensajeContrasenaError.php");
                exit;
            }else{
                $mail = new PHPMailer();
                $mail->IsSMTP();
    
                $mail->SMTPDebug  = 0;  
                $mail->SMTPAuth   = TRUE;
                $mail->SMTPSecure = "tls";
                $mail->Port       = 587;
                $mail->Host       = "smtp.gmail.com";
                $mail->Username   = "fernandopaivap7@gmail.com";
                $mail->Password   = "Zilda467913";
                
                $token = rand();
                $expiracion = date('Y-m-d', strtotime("+1 day"));
                $consulta= $conect->prepare("INSERT INTO newpass (token,expiracion,usuario_id) VALUE (:token,:dataexpiracion,:id);");
                $consulta->bindParam(':token', $token);
                $consulta->bindParam(':dataexpiracion', $expiracion);
                $consulta->bindParam(':id', $usuario['id_usuarios']);
                $consulta->execute();
    
                $mail->IsHTML(true);
                $mail->AddAddress($usuario["email"], $usuario["nombre"]);
                $mail->SetFrom("fernandopaivap7@gmail.com", "Barbara Boutique de moda");
                $mail->AddReplyTo("reply-to-email", "reply-to-name");
                $mail->AddCC("cc-recipient-email", "cc-recipient-name");
                $mail->Subject = "Restablece tu contraseña!";
                $content = "<b>¿Olvidaste tu contraseña? Puede pasar no te preocupes!.</b></br>
                http://localhost/dashboard/TiendaOnlineTFG/php/controlador/updatePass.php?id=".$token;
    
                $mail->MsgHTML($content); 
                if(!$mail->Send()) {
                    echo "Error al enviar el email.";
                    var_dump($mail);
                } else {
                    header("location:mensajeContrasena.php");
                }
              }
          }
      }

}
?>