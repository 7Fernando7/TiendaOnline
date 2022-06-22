<?php
include ("../config/sesiones.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://kit.fontawesome.com/85815134f5.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../css/estilos.css" />
    <title>Registrar productos</title>
  </head>
  <body>
    <div class="container">
      <?php include ($_SERVER['DOCUMENT_ROOT']."/dashboard/TiendaOnlineTFG/php/controlador/header.php"); ?>
        <!--Formulario de registro de dirección para envío -->
        <div class="formularioBody">
            <form method="POST" action="../controlador/registrarProductos.php">
              <legend>Insertar productos</legend>
              <input class="controls" type="text" name="nombre" value="" placeholder="Nombre"/>
              <br/>
              <input class="controls" type="text" name="titulo" value="" placeholder="Título"/>
              <br/>
              <input class="controls" type="number" name="precio" placeholder="Precio"/>
              <br/>
              <input class="controls" type="text" name="descripcion" value="" placeholder="Descripción"/>
              <br/>
              <input class="controls" type="number" name="cantidad" placeholder="Cantidad"/>
              <br/>
              <input class="controls" type="number" name="categorias_id" placeholder="Categoria"/>
              <br/>
              <input type="file" name="imagen_producto" accept="image/png, image/jpeg, image/jpg, image/gif"/>
              <br/>
              <input class="botons" name="registrarProductos" type="submit" value="Registrar" />
            </form>
        </div>
        <!--Footer con informaciones pertinentes a la empresa-->
        <?php include ($_SERVER['DOCUMENT_ROOT']."/dashboard/TiendaOnlineTFG/php/vista/footer.php"); ?>
    </div>
    <!--Enlace de los archivos JS-->
    <script>
    /** Función que se ejecuta una vez cargada la página */
    window.onload=function() {
        repetir();
    }
    </script>
    <!-- Links de hojas externas de JS -->
    <script src="../../js/main.js"></script>
  </body>
</html>