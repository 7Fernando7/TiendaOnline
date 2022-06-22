<?php
  /*Activa el almacenamiento en búfer de la salida*/
  ob_start();
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
    <title>Login</title>
  </head>
  <body>
    <!--Incluyo el heder haciendo un include de un archivo externo-->
    <?php include ($_SERVER['DOCUMENT_ROOT']."/dashboard/TiendaOnline/php/controlador/header.php"); ?>
    <!--Formulario de login en la aplicación -->
    <h2>Haga login con tu correo y contraseña.</h2>
    <div class="formularioBody">
      <div class="contenedorGeneralInformacionesLogin">
      <form method="POST" action="../controlador/loginUsuario.php">
        <input class="controls"  type="email" name="t1" required value="" placeholder="Email"/>
        <br />
        <input class="controls" type="password" name="t2" required value="" placeholder="Contraseña"/>
        <br />
        <input class="botons" name="submit" type="submit" value="Entrar" />
      </form>
      <div>
        <a href="../controlador/registrarUsuarios.php">Registrarse</a>
        <br />
        <a href="../../index.php">Volver al inicio</a>
        <br />
        <a href="../vista/forgotPassword.php">¿has olvidado la contraseña?</a>
      </div>
      </div>
    </div>
    <!--Incluyo el Footer con informaciones pertinentes a la empresa haciendo un include de un archivo externo-->
    <?php include ($_SERVER['DOCUMENT_ROOT']."/dashboard/TiendaOnline/php/vista/footer.php"); ?>
    <script>
      /** Función que se ejecuta una vez cargada la página */
      window.onload=function() {
          repetir();
      }
    </script>
    <!-- Links de hojas externas de JS -->
    <script src="../../js/portada.js"></script>
  </body>
</html>
