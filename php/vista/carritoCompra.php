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
    <title>Carrito de compra</title>
    </head>
  <body>
    <!--Hago un contenedor para todo el proyecto-->
    <div class="container">
      <!--Incluyo el heder haciendo un include de un archivo externo-->
      <?php include ($_SERVER['DOCUMENT_ROOT']."/dashboard/TiendaOnline/php/controlador/header.php"); ?>
      <!--Hago un apartado para los productos seleccionados-->
      <div class="generalContenedorInformaciones">
        <div class="informacionesCarrito">
        <div id="productoCesta" class="informaciones">
          <?php
            foreach ($productos as $producto) {
              $precioTotal = $producto['precio'] * $_SESSION['cesta'][$producto['id_producto']];
          ?>
          <div class="informacionCarritoProducto">
            <img src="../../img/<?php echo $producto['imagen_producto']; ?>"/>
            <div class="informacionproducto">
              <h4><?php echo $producto['nombre']; ?></h4>
            </div>
            <div class="botonesCarrito" >
              <table class="tablasInformaciones">
                  <tr>
                      <td>Precio</td>
                      <td>Subtotal</td>
                  </tr>
                  <tr>
                      <td><?php echo $producto['precio']; ?> €</td>
                      <td><?php echo number_format($precioTotal, 2) ?> €</td>
                  </tr>
              </table>
              <div class="contenedorbotones">
                  <div class="botones">
                    <!--Hago un contenedores para los botones de incrementar y decrementar del carrito-->
                    <button class="incr" id="incr2" onclick="incrementar(<?php echo $producto['id_producto'];?>, <?php echo $producto['cantidad'];?>)">
                    <i class="fa-solid fa-plus"></i>
                    </button>
                    <p class="contar" id="contar<?php echo $producto['id_producto'] ?>"><?php echo $_SESSION['cesta'][$producto['id_producto']] ?></p>
                    <button class="decr" id="decr2" onclick="decrementar(<?php echo $producto['id_producto']?>)">
                      <i class="fa-solid fa-minus"></i>
                    </button>
                  </div>
                </div>
              </div>
                    <form method="POST" action="">
                      <!--Aqui hago un input type hidden para almacenar la información del id_producto que será utilizado su valor -->
                      <input id="cantidadProducto<?php echo $producto['id_producto'] ?>" type="hidden" name="cantidad">
                      <input type="hidden" name="id_producto" value="<?=$producto['id_producto']?>" />
                      <input type="submit" value="Aplicar">
                    </form>
              </div>
              <?php
                }
              ?>
          </div>
          <div class="informacionResumen" > <h2>Resumen</h2>
                <p> Gastos de envío: <?php echo $precioEnvio ?> € </p>
                <p>Envío gratis para compras superiores a 75 €</p>
                <h2>Total incluyendo impuestos: <?php echo number_format($precioTotalProductos, 2) ?> € </h2>
                <form>
                  <!--Aquí hago un ternario para verificar se ya existe usuario logueado o no, si hay deja registrar una dirección, sino envia para la pagina de login-->
                  <button
                    style="margin: 5px; width: 200px; background-color: #e9b3eb"
                    type="submit"
                    <?php if(empty($productos)) { ?> 
                    disabled
                    <?php } ?>
                    onclick="javascript:form.action=<?php echo $logueado ? '\'registrarDirecciones.php\'' : '\'loginUsuario.php\'' ?>">
                  Realizar Pedido
                  </button>
                </form>
          </div>
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
      <script src="../../js/myJquery.js"></script>
      <script src="../../js/ohsnap.min.js"></script>
  </body>
</html>