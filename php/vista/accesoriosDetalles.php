<?php
include ("../config/sesiones.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../../css/estilos.css" />
    <title>Accesorios</title>
    <script
      src="https://kit.fontawesome.com/85815134f5.js" crossorigin="anonymous"></script>
  </head>
  <body>
    <!--Incluyo el heder haciendo un include de un archivo externo-->
    <?php include ($_SERVER['DOCUMENT_ROOT']."/dashboard/TiendaOnline/php/controlador/header.php"); ?>
    <!--Apartado con el producto que enseñara con detalles-->
      <div class="sectionDetalles">
          <div class="productoDetalles" >
            <!--Aqui hago un enlance interno que llevara a las informaciones del producto por separado -->
            <div>
              <a href="accesoriosDetalles.php?producto=<?php echo $datosProductos['id_producto']; ?>"><img src="../../img/<?php echo $datosProductos['imagen_producto']; ?>"/></a>
            </div>
            <!--Pinto los productos sacados de la base de datos-->
            <div class="productoDetallesInfo" >
            <h2><?php echo $datosProductos['nombre']; ?></h2>
            <p><?php echo $datosProductos['titulo'] ?></p>
            <p><?php echo $datosProductos['descripcion'] ?></p>
              <p><?php echo $datosProductos['precio']; ?>€</p>
            <div class="contenedorbotones">
              <div class="botones">
                <!--El boton de incrementar tiene una condicion que si el producto llega al limite del stock deja de incrementar -->
                <button class="incr" id="incr2" onclick="incrementar(<?php echo $datosProductos['id_producto']; ?>,<?php echo $datosProductos['cantidad'];?>)">
                <i class="fa-solid fa-plus"></i>
                </button>
                <p class="contar" id="contar<?php echo $datosProductos['id_producto']; ?>">0</p>
                <button class="decr" id="decr2" onclick="decrementar(<?php echo $datosProductos['id_producto']; ?>)">
                  <i class="fa-solid fa-minus"></i>
                </button>
              </div>
            </div>
              <form method="POST" action="">
                <!--Aqui hago un input type hidden para almacenar la información del id_producto que será utilizado su valor -->
                <input id="cantidadProducto<?php echo $datosProductos['id_producto']; ?>" type="hidden" name="cantidad">
                <input type="hidden" name="id_producto" value="<?=$datosProductos['id_producto']?>" />
                <input type="submit" value="Añadir a la cesta">
              </form>
            </div>
    </div>
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
            <!--Hago un contenedores para los botones de incrementar y decrementar-->
            <div class="contenedorbotones">
              <div class="botones">
                <!--El boton de incrementar tiene una condicion que si el producto llega al limite del stock deja de incrementar -->
                <button class="incr" id="incr2" onclick="incrementar(<?php echo $dato->id_producto; ?>, <?php echo ($ExisteProductoEnCesta ? $dato->cantidad - $_SESSION['cesta'][$dato->id_producto] : $dato->cantidad);?>)">
                  <i class="fa-solid fa-plus"></i>
                </button>
                  <p class="contar" id="contar<?php echo $dato->id_producto; ?>">0</p>
                <button class="decr" id="decr2" onclick="decrementar(<?php echo $dato->id_producto; ?>)">
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
              <!--Aqui hago un input type hidden para almacenar la información del id_producto que será utilizado su valor -->
              <input id="cantidadProducto<?php echo $dato->id_producto; ?>" type="hidden" name="cantidad">
              <input type="hidden" name="id_producto" value="<?=$dato->id_producto?>" />
              <input type="submit" value="Añadir a la cesta">
            </form>
          </div>
            <?php
              }
            ?>
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