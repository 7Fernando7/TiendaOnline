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
    <link rel="stylesheet" href="../../css/estilosEspecificos.css">
    <title>Perfil administrador</title>
  </head>
  <body>
    <!--Hago un contenedor para todo el proyecto-->
    <div class="container">
      <!--Incluyo el heder haciendo un include de un archivo externo-->
      <?php include ($_SERVER['DOCUMENT_ROOT']."/dashboard/TiendaOnlineTFG/php/controlador/header.php"); ?>
      <!--Hago un apartado para los productos seleccionados-->
      <div class="contenedorGeneralInfo">
        <div class="contenedor" >
          <h3>Información de contacto</h3>
          <!--Hago un foreach que me devuelva todos los usuarios registrados-->
          <div class="contenedorCuentas">
            <?php
              if(isset($datos)) {
            foreach ($datos as $dato) {
              $idUsuariosBD = $dato->id_usuarios;
            ?>
            <div class="informacionesCuentasAdmin">  
              <p><?php echo $dato->nombre;?><?php echo $dato->apellidos; ?></p>  
              <p><?php echo $dato->telefono;?></p>
              <p><?php echo $dato->documento;?></p>
              <p><?php echo $dato->email;?></p>
              <!--Hago un buton para borrar la cuenta y paso el id del usuario como parametro-->
              <p><button><a href="../controlador/borrarUsuariosBD.php?idUsuariosBD=<?=$idUsuariosBD?>">Borrar</a></button></p>       
            </div>
            <?php
            }
              }
            ?>
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