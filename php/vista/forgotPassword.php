<?php
 require_once(__DIR__ ."../../config/conexion.php");
 include ("../config/sesiones.php");
 require_once($_SERVER['DOCUMENT_ROOT']."/dashboard/TiendaOnlineTFG/PHPMailer-master/mail_Informacion.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!--Aquí van los enlaces de las hojas de estilos y enlace externo de FontAwesome -->
    <link rel="stylesheet" href="../../css/estilos.css"/>
    <script src="https://kit.fontawesome.com/85815134f5.js" crossorigin="anonymous"></script>
    <title>Restablecer contraseña</title>
  </head>
  <body>
    <!--Incluyo el heder haciendo un include de un archivo externo-->
    <?php include ($_SERVER['DOCUMENT_ROOT']."/dashboard/TiendaOnlineTFG/php/controlador/header.php"); ?>
      <div class="contenedorGeneralPass">
        <div class="formularioBodyPass">
          <h2>Introduce el correo electrónico de tu cuenta para restablecer tu contraseña.</h2>
          <?php echo !empty($statusMsg)?'<p class="'.$statusMsgType.'">'.$statusMsg.'</p>':''; ?>
          <!--Formulario para retablecer la contraseña -->
          <form action="" method="post">
            <input class="controls"  type="email" name="email" placeholder="EMAIL" required="">
            <div class="send-button">
              <input type="submit" name="forgotSubmit" value="CONTINUE">
            </div>
            <?php
              $enviarEmail = new enviarEmail();
              $enviarEmail->enviarElanceContrasena();
            ?>
            
          </form>
            <a href="../controlador/loginUsuario.php">Login</a>
            <a href="../controlador/registrarUsuarios.php">Registrarse</a>
            <a href="../../index.php">Volver al inicio</a>
        </div>
      </div>
      <?php
        $sessData = !empty($_SESSION['sessData'])?$_SESSION['sessData']:'';
        if(!empty($sessData['status']['msg'])){
          $statusMsg = $sessData['status']['msg'];
          $statusMsgType = $sessData['status']['type'];
          unset($_SESSION['sessData']['status']);
        }
      ?>
      <!--Incluyo el Footer con informaciones pertinentes a la empresa haciendo un include de un archivo externo-->
      <?php include ($_SERVER['DOCUMENT_ROOT']."/dashboard/TiendaOnlineTFG/php/vista/footer.php"); ?>
      <script>
        /** Función que se ejecuta una vez cargada la página */
        window.onload=function() {
            repetir();
        }
      </script>
      <!-- Links de hojas externas de JS -->
      <script src="../../js/main.js"></script>
      <script src="../../js/portada.js"></script>
      <script src="../../js/myJquery.js"></script>
      <script src="../../js/ohsnap.min.js"></script>
  </body>
</html>
