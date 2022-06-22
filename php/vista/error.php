<?php
include ("../config/sesiones.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/85815134f5.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../css/estilos.css">
    <title>Error</title>
  </head>
  <body>
    <!--Hago un contenedor para todo el proyecto-->
    <div class="container">
      <?php include ($_SERVER['DOCUMENT_ROOT']."/dashboard/TiendaOnline/php/controlador/header.php"); ?>
      <!--Hago un apartado para los productos seleccionados-->
      <div class="error" >
        <h2>Esta página no está disponible.</h2>
        <p>Es posible que el enlace que has seguido sea incorrecto o que se haya eliminado la página. Volver a la página inicial.</p>
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
        <!--Enlace de los archivos JS-->
      <script src="../../js/main.js"></script>
      <script src="../../js/portada.js"></script>
  </body>
</html>