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
    <title>Editar direcciones</title>
  </head>
  <body>
    <!--Hago un contenedor para todo el proyecto-->
    <div class="container">
      <!--Incluyo el heder haciendo un include de un archivo externo-->
        <?php include ($_SERVER['DOCUMENT_ROOT']."/dashboard/TiendaOnlineTFG/php/controlador/header.php"); ?>
        <!--Hago un apartado para los productos seleccionados-->
        <div>
          <h3>Direcciones</h3>
          <div class="contenedor">
            <form method="POST">
              <input type="text" name="calle" value="<?php echo $editar['calle'];?>" placeholder="Calle"/>
              <br />
              <input type="text" name="numero" value="<?php echo $editar["numero"]?>" placeholder="Número"/>
              <br />
              <input type="text" name="piso" value="<?php echo $editar["piso"]?>" placeholder="Piso"/>
              <br />
              <input type="text" name="ciudad" value="<?php echo $editar["ciudad"]?>" placeholder="Ciudad"/>
              <br />
              <input type="text" name="provincia" value="<?php echo $editar["provincia"]?>" placeholder="Provincia"/>
              <br />
              <input type="text" name="codigopostal" value="<?php echo $editar["codigopostal"]?>" placeholder="Código Postal"/>
              <br />
              <input class="botons" name="update" type="submit" value="Guardar" />
            </form>
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