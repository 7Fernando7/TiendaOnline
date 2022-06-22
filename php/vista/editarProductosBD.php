<?php
  /*Activa el almacenamiento en búfer de la salida*/
  ob_start();
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
    <link rel="stylesheet" href="../../css/estilosEspecificos.css">
    <title>Editar productos</title>
  </head>
  <body>
    <!--Hago un contenedor para todo el proyecto-->
    <div class="container">
      <!--Incluyo el heder haciendo un include de un archivo externo-->
      <?php include ($_SERVER['DOCUMENT_ROOT']."/dashboard/TiendaOnline/php/controlador/header.php"); ?>
      <!--Hago un apartado para los productos seleccionados-->
    <div>
      <h3>Desea editar los datos del producto?</h3>
      <div class="contenedorBD">
        <form method="POST" action="" enctype="multipart/form-data">
          <input type="text" name="nombre" value="<?php echo $editar['nombre'];?>" placeholder="Nombre"/>
          <br />
          <input type="text" name="titulo" value="<?php echo $editar["titulo"]?>" placeholder="Título"/>
          <br />
          <input type="text" name="precio" value="<?php echo $editar["precio"]?>" placeholder="Precio"/>
          <br />
          <input type="text" name="cantidad" value="<?php echo $editar["cantidad"]?>" placeholder="Cantidad"/>
          <br />
          <input type="text" name="descripcion" value="<?php echo $editar["descripcion"]?>" placeholder="Descripción"/>
          <br />
          <input type="hidden" name="imagen_producto" value="<?php echo $editar["imagen_producto"]?>" placeholder="Imagen"/>
          <input type="file" name="fileToUpload" id="fileToUpload">
          <img src="../../img/<?php echo $editar["imagen_producto"]?>" />
          <br />
          <input class="botons" name="update" type="submit" value="Guardar" />
        </form>
      </div>
    </div>
    <!--Incluyo el Footer con informaciones pertinentes a la empresa haciendo un include de un archivo externo-->
    <?php include ($_SERVER['DOCUMENT_ROOT']."/dashboard/TiendaOnline/php/vista/footer.php"); ?>
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