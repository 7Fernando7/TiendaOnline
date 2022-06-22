<?php
  ob_start();
  require_once(__DIR__."../../config/conexion.php");
  include (__DIR__."../../config/sesiones.php");
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
    <title>Nueva contraseña</title>
  </head>
  <body>
    <!--Incluyo el heder haciendo un include de un archivo externo-->
    <?php include ($_SERVER['DOCUMENT_ROOT']."/dashboard/TiendaOnline/php/controlador/header.php"); ?>
    <!--Formulario para restablecer contraseña-->
    <div class="formularioBody">
      <div class="contenedorGeneralNewPass">
      <h2>Restablezca tu contraseña</h2>
      <form method="POST">
        <input class="controls"  type="password" name="contrasena1" required placeholder="Nueva contraseña"/>
        <br />
        <input class="controls"  type="password" name="contrasena2" required placeholder="Repita la contraseña"/>
        <br />
        <input class="botons" name="submit" type="submit" value="ENVIAR" />
        <?php if(isset($mensajeError)) { echo $mensajeError; }?>
      </form>
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
    <script src="../../js/myJquery.js"></script>
  </body>
</html>