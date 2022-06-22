<?php
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
    <title>Editar usuario</title>
    </head>
  <body>
  <!--Hago un contenedor para todo el proyecto-->
  <div class="container">
    <?php include ($_SERVER['DOCUMENT_ROOT']."/dashboard/TiendaOnlineTFG/php/controlador/header.php"); ?>
      <!--Hago un apartado para los productos seleccionados-->
      <div>
        <h3>Edita tus datos personales</h3>
        <div class="contenedorGeneralInformaciones" >
          <form method="POST">
            <input class="controls"  type="text" name="nombre" value="<?php echo $editar["nombre"]?>" placeholder="Nombre"/>
            <br />
            <input class="controls"  type="text" name="apellidos" value="<?php echo $editar["apellidos"]?>" placeholder="Apellidos"/>
            <br />
            <input class="controls"  type="tel" name="telefono" value="<?php echo $editar["telefono"]?>" placeholder="Teléfono"/>
            <br />
            <input class="controls"  type="email" name="email" value="<?php echo $editar["email"]?>" placeholder="Correo"/>
            <br />
            <input class="controls"  type="text" name="contrasena" value="<?php echo $editar["password"]?>" placeholder="Contraseña"/>
            <!--Bótones con otras funcionalidades -->
            <input class="botons" name="update" type="submit" value="Guardar" />
          </form>
      </div>
    </div>
    <!--Incluyo el Footer con informaciones pertinentes a la empresa haciendo un include de un archivo externo-->
    <?php include ($_SERVER['DOCUMENT_ROOT']."/dashboard/TiendaOnlineTFG/php/vista/footer.php");?>
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
