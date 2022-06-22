<?php
include ("../config/sesiones.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!--Aquí van los enlaces de las hojas de estilos y enlace externo de FontAwesome -->
    <link rel="stylesheet" href="../../css/estilos.css" />
    <script src="https://kit.fontawesome.com/85815134f5.js" crossorigin="anonymous"></script>
    <title>Productos por categoría</title>
  </head>
  <body>
    <!--Hago un contenedor para todo el proyecto-->
    <div class="container">
      <!--Encabezado con barra superior y menu-->
      <?php include ($_SERVER['DOCUMENT_ROOT']."/dashboard/TiendaOnline/php/controlador/header.php"); ?>
      <!--Apartado con todos los productos  -->
      <section>
        <div class="section1">
          <?php
            foreach ($datosProductos as $dato) {
            $ExisteProductoEnCesta = isset($_SESSION['cesta'][$dato->id_producto]);
          ?>
          <div>
          <!--Hago una lógica para enseñar AGOTADO solo en casos que la cantidad de productos sean igual a zero-->
          <?php
            if($dato->cantidad == 0) {
          ?>
          <!--Si algun producto tiene la cantidad igual a zero pintamos este mensaje -->
          <p class="agotado">AGOTADO</p>
          <?php
            }
          ?>
          <!--Si algun producto tiene la cantidad menor que 5 pintamos este mensaje -->
          <?php
            if($dato->cantidad > 0  &&  $dato->cantidad  < 5) {
          ?>
            <p class="utlimasUnidades">ULTIMAS UNIDADES</p>
          <?php
            }
          ?>
            <h4><?php echo $dato->nombre; ?></h4>
            <p><?php echo $dato->titulo; ?></p>
          <div>
          <a href="accesoriosDetalles.php?producto=<?php echo $dato->id_producto; ?>"><img src="../../img/<?php echo $dato->imagen_producto; ?>"/></a>
          </div>
          <div>
          <div>
          <p><?php echo $dato->precio; ?>€</p>
          </div>
          </div><!--Hago un contenedores para los botones de incrementar y decrementar-->
          <div class="contenedorbotones">
            <div class="botones">
              <button class="incr" id="incr2" onclick="incrementar(<?php echo $dato->id_producto;?>,<?php echo ($ExisteProductoEnCesta ? $dato->cantidad - $_SESSION['cesta'][$dato->id_producto] : $dato->cantidad);?>)">
                <i class="fa-solid fa-plus"></i>
              </button>
              <p class="contar" id="contar<?php echo $dato->id_producto; ?>">0</p>
              <button class="decr" id="decr2" onclick="decrementar(<?php echo $dato->id_producto;?>)">
                <i class="fa-solid fa-minus"></i>
              </button>
            </div>
          </div>
          <form method="POST" action="">
            <!--Hago un input tipo hidden para almacenar el id_producto que será usado en la lógica de añadir productos a la cesta-->
            <input id="cantidadProducto<?php echo $dato->id_producto; ?>" type="hidden" name="cantidad">
            <input type="hidden" name="id_producto" value="<?=$dato->id_producto?>" />
            <input type="submit" value="Añadir a la cesta">
          </form>
          </div>
          <?php
            }
          ?>
          </div>
          <!--Hago un apartado donde se va a cargar los productos de forma aleatoria-->
          <h2>Productos elegidos para ti</h2>
          <section class="productosRandom" >
            <?php include ($_SERVER['DOCUMENT_ROOT']."/dashboard/TiendaOnline/php/controlador/productosRandom.php"); 
            foreach($productosRandom as $dato) {
              $ExisteProductoEnCesta = isset($_SESSION['cesta'][$dato->id_producto]);
            ?>
            <div>
              <h4><?php echo $dato->nombre; ?></h4>
              <p><?php echo $dato->titulo; ?></p>
            <div>
              <a href="accesoriosDetalles.php?producto=<?php echo $dato->id_producto; ?>"><img src="../../img/<?php echo $dato->imagen_producto; ?>"/></a>
            </div>
              <p><?php echo $dato->precio; ?>€</p> 
              <div class="contenedorbotones">
                <div class="botones">
                  <!--El boton de incrementar tiene una condicion que si el producto llega al limite del stock deja de incrementar -->
                  <button class="incr" id="incr2" onclick="incrementar(<?php echo $dato->id_producto;?>, <?php echo ($ExisteProductoEnCesta ? $dato->cantidad - $_SESSION['cesta'][$dato->id_producto] : $dato->cantidad);?>)">
                    <i class="fa-solid fa-plus"></i>
                  </button>
                    <p class="contar" id="contar<?php echo $dato->id_producto; ?>">0</p>
                  <button class="decr" id="decr2" onclick="decrementar(<?php echo $dato->id_producto;?>)">
                    <i class="fa-solid fa-minus"></i>
                  </button>
                </div>
                <!--Si algun producto tiene la cantidad igual a zero pintamos este mensaje -->
                <?php
                    if($dato->cantidad == 0) {
                  ?>
                    <p class="agotado">AGOTADO</p>
                  <?php
                    }
                  ?>
                  <!--Si algun producto tiene la cantidad menor que 5 pintamos este mensaje -->
                  <?php
                    if($dato->cantidad > 0  &&  $dato->cantidad  < 5) {
                  ?>
                    <p class="utlimasUnidades">ULTIMAS UNIDADES</p>
                  <?php
                    }
                  ?>
              </div>
              <form method="POST" action="">
                <!--Hago un input tipo hidden para almacenar el id_producto que será usado en la lógica de añadir productos a la cesta-->
                <input id="cantidadProducto<?php echo $dato->id_producto; ?>" type="hidden" name="cantidad">
                <input type="hidden" name="id_producto" value="<?=$dato->id_producto?>" />
                <input type="submit" value="Añadir a la cesta">
              </form>
            </div>
            <?php
              }
            ?>
          </section>
        </div>
      </section>
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
    <script src="../../js/myJquery.js"></script>
    <script src="../../js/ohsnap.min.js"></script>
  </body>
</html>