<?php
include ("php/config/sesiones.php");
require_once($_SERVER['DOCUMENT_ROOT']."/dashboard/TiendaOnlineTFG/php/modelo/modeloMetodoPedidos.php");
    $cesta = new modeloPedidos();
    if(isset($_POST['id_producto']) && isset($_POST['cantidad']) && $_POST['cantidad'] != ""){
        $cesta->agregarProductoCesta();
        header("location:index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Barbara Boutique de Moda</title>
    <link rel="stylesheet" href="css/estilos.css" />
    <script src="https://kit.fontawesome.com/85815134f5.js" crossorigin="anonymous"></script>
  </head>
  <body>
  <!--Hago un contenedor para todo el proyecto-->
  <div class="container">
    <!--Incluyo el heder haciendo un include de un archivo externo-->
  <?php include ($_SERVER['DOCUMENT_ROOT']."/dashboard/TiendaOnlineTFG/php/controlador/header.php"); ?>
    <section>
        <!--Un apartado para la portada-->
        <div>
          <div class="portada">
            <img src="" id="imagen">
          </div>
          <!--Apartado con productos destacados -->
          <div class="seccion">
            <div class="producto_1">
              <a href="/dashboard/TiendaOnlineTFG/php/controlador/camisas.php"><img src="img/4416camisa04.jpg" /></a>
            </div>
            <div class="producto_2">
              <a href="/dashboard/TiendaOnlineTFG/php/controlador/vestidos.php"><img src="img/vestido07.jpg" /></a>
            </div>
            <div class="producto_3">
              <a href="/dashboard/TiendaOnlineTFG/php/controlador/bolsos.php"><img src="img/bolso04.jpg" /></a>
            </div>
        </div>
        <div class="informacionBarbara" >
        <h1>Barbara Boutique de Moda</h1>
        <p>Descubre las últimas tendencias y deslumbra con la nueva colección de ropa, calzado, 
          bolsos y accesorios para mujer de Barbara Boutique de Moda. La colección de mujer de 
          Barbara Boutique de Moda es ideal para quienes buscan un look diferente cuenta con una 
          amplia variedad de diseños. Desde vestidos, bolsos y tacones ideales para una noche de 
          fiesta hasta pantalones de chándal o zapatillas para una sesión nocturna de película, 
          sofá y manta, necesites lo que necesites, lo encontrarás en nuestro sitio web. Además, 
          también podrás elegir entre una gran selección de ropa de punto, abrigos y chaquetas 
          perfectos para abrigarte en cualquier estación. Viste a la última con nuestras novedades
          o aprovecha las ofertas para hacerte con esa prenda que quieres desde hace tanto tiempo. 
          No importa si tu estilo es colorido, atrevido o minimalista, Barbara Boutique de Moda tiene algo para ti.</p>
        </div>
      </section>
      <!--Apartado con productos aleatotorios -->
        <h2>Productos elegidos para ti</h2>
      <section class="productosRandom" >
          <?php include ($_SERVER['DOCUMENT_ROOT']."/dashboard/TiendaOnlineTFG/php/controlador/productosRandom.php"); 
            foreach($productosRandom as $dato) {
              $ExisteProductoEnCesta = isset($_SESSION['cesta'][$dato->id_producto]);
          ?>
          <div>
            <h4><?php echo $dato->nombre; ?></h4>
            <p><?php echo $dato->titulo; ?></p>
            <div>
              <a href="php/controlador/accesoriosDetalles.php?producto=<?php echo $dato->id_producto; ?>"><img src="img/<?php echo $dato->imagen_producto; ?>"/></a>
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
      <div>
      </div>
      <!--Incluyo el Footer con informaciones pertinentes a la empresa haciendo un include de un archivo externo-->
      <?php include ($_SERVER['DOCUMENT_ROOT']."/dashboard/TiendaOnlineTFG/php/vista/footer.php"); ?>
  </div>
  <script>
    /** Función que se ejecuta una vez cargada la página */
    window.onload=function() {
      // Cargamos una imagen aleatoria
      rotarImagenes();
      // Indicamos que cada 5 segundos cambie la imagen
      setInterval(rotarImagenes,5000);
      repetir();
    }
  </script>
  <!--Enlace de los archivos JS-->
  <script src="js/main.js"></script>
  <script src="js/portada.js"></script>
  <script src="js/myJquery.js"></script>
  <script src="js/ohsnap.min.js"></script>
  </body>
</html>
