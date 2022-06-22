<?php
  ob_start();
  require_once($_SERVER['DOCUMENT_ROOT']."/dashboard/TiendaOnline/PHPMailer-master/mail_Informacion.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../../css/estilos.css"/>
    <script src="https://kit.fontawesome.com/85815134f5.js" crossorigin="anonymous"></script>
    <title>Registro de usuario</title>
  </head>
  <body>
  <?php include ($_SERVER['DOCUMENT_ROOT']."/dashboard/TiendaOnline/php/controlador/header.php"); ?>
    <!--Formulario de registro en la aplicación -->
    <h2>Registro</h2>
    <div class="formularioBody">
      <form method="POST" action="">
        <input class="controls" type="text" name="nombre1" value="<?php echo isset($_POST['nombre1']) ? $_POST['nombre1'] : '';?>" placeholder="Nombre"/>
        <br/>
        <input class="controls" type="text" name="apellidos1" value="<?php echo isset($_POST['apellidos1']) ? $_POST['apellidos1'] : '';?>"  placeholder="Apellidos"/>
        <br/>
        <input class="controls" type="text" name="telefono" value="<?php echo isset($_POST['telefono']) ? $_POST['telefono'] : '';?>" placeholder="Teléfono"/>
        <br/>
        <input class="controls" type="text" name="documento" value="<?php echo isset($_POST['documento']) ? $_POST['documento'] : '';?>" placeholder="Documento"/>
        <br/>
        <input class="controls" type="email" name="correo" value="<?php echo isset($_POST['correo']) ? $_POST['correo'] : '';?>" placeholder="Email"/>
        <br/>
        <input class="controls" type="password" name="contrasena" value="" placeholder="Contraseña"/>
        <br/>
        <input class="botons" name="registrar" type="submit" value="Registrarse"/>
        <br />
        <a href="../controlador/loginUsuario.php">Login</a>
      </form>
    </div>
    <?php include ($_SERVER['DOCUMENT_ROOT']."/dashboard/TiendaOnline/php/vista/footer.php"); ?>
    <script>
      /** Función que se ejecuta una vez cargada la página */
      window.onload=function() {
          repetir();
      }
    </script>
    <script src="../../js/main.js"></script>
    <script src="../../js/portada.js"></script>
    <script src="../../js/myJquery.js"></script>
    <script src="../../js/ohsnap.min.js"></script>
  </body>
</html>
