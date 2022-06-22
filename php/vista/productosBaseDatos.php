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
    <title>Productos base de datos</title>
    </head>
<body>
  <!--Hago un contenedor para todo el proyecto-->
  <div class="container">
  <?php include ($_SERVER['DOCUMENT_ROOT']."/dashboard/TiendaOnlineTFG/php/controlador/header.php"); ?>
    <h3>Productos</h3>
        <?php
            foreach ($datos as $dato) {
                $idProductoDB = $dato->id_producto;
        ?>
        <div class="informaciones">
            <p>Producto: <?php echo $dato->nombre; ?></p>
            <p>Título: <?php echo $dato->titulo; ?></p>
            <p>Precio: <?php echo $dato->precio; ?></p>
            <p>Imagen del producto: <img src="../../img/<?php echo $dato->imagen_producto; ?>"/></p>
            <p>Cantidad: <?php echo $dato->cantidad; ?></p>
            <p>Categoria: <?php echo $dato->categorias_id; ?></p>
            <p><button><a href="../controlador/editarProductosBD.php?idProductoDB=<?=$idProductoDB?>">Editar</a></button></p>
            <p><button><a href="../controlador/borrarProductosBD.php?idProductoDB=<?=$idProductoDB?>">Borrar</a></button></p>
        </div>
    <?php
        }
    ?>
</div>
<!--Footer con informaciones pertinentes a la empresa-->
<?php include ($_SERVER['DOCUMENT_ROOT']."/dashboard/TiendaOnlineTFG/php/vista/footer.php"); ?>

<!--Enlace de los archivos JS-->
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