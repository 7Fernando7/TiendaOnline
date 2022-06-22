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
      <!--Aquí van los enlaces de las hojas de estilos y enlace externo de FontAwesome -->
      <link rel="stylesheet" href="../../css/estilos.css">
      <link rel="stylesheet" href="../../css/estilosEspecificos.css">
      <title>Mi cuenta</title>
    </head>
  <body>
    <!--Hago un contenedor para todo el proyecto-->
    <div class="container">
      <!--Incluyo el heder haciendo un include de un archivo externo-->
      <?php include ($_SERVER['DOCUMENT_ROOT']."/dashboard/TiendaOnlineTFG/php/controlador/header.php"); ?>
      <!--Hago un apartado para los productos seleccionados-->
      <div class="contenedor" >
        <div class="contenedorGeneralInfo">
          <h3>Información de contacto</h3>
          <div class="informaciones">        
              <p><?php echo $datos['nombre']; ?> <?php echo $datos['apellidos']; ?></p>  
              <p><?php echo $datos['telefono']; ?></p>
              <p><?php echo $datos['documento']; ?></p>
              <p><?php echo $datos['email']; ?></p>
              <p><?php echo $datos['password']; ?></p>
              <p><button><a href="../controlador/editarUsuarios.php">Editar</a></button></p>
              <p><button><a href="../controlador/borrarUsuario.php">Borrar</a></button></p>
          </div>
        </div>
      </div>
      <!--Incluyo el Footer con informaciones pertinentes a la empresa haciendo un include de un archivo externo-->
      <?php include ($_SERVER['DOCUMENT_ROOT']."/dashboard/TiendaOnlineTFG/php/vista/footer.php"); ?>
    </div>
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