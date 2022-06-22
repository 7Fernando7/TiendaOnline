<?php
include ("../config/sesiones.php");
    ob_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!--Aquí van los enlaces de las hojas de estilos y enlace externo de FontAwesome -->
    <link rel="stylesheet" href="../../css/estilos.css"/>
    <script src="https://kit.fontawesome.com/85815134f5.js" crossorigin="anonymous"></script>
    <title>Método de pago</title>
  </head>
  <body>
    <!--Incluyo el heder haciendo un include de un archivo externo-->
    <?php include ($_SERVER['DOCUMENT_ROOT']."/dashboard/TiendaOnline/php/controlador/header.php"); ?>
    <!--Pinto los datos recibidos de la BD-->
    <?php
      if(isset($datos)){
    ?>
    <legend>Selecione una tarjeta:</legend>
    </div>
    <form method="POST" action="">
      <?php
        foreach ($datos as $dato) {
          $idTarjeta = $dato->id_tarjeta;
          $idUsuario = $dato->usuario_id;
      ?>
        <div class="elegirDireccion">
          <input type="radio" id="elegirTarjeta" name="elegirTarjeta" value="<?php echo $idTarjeta;?>" required>
          <p>Titular: <?php echo $dato->nombreTitular; ?></p>
          <br />
          <p>Número tarjeta: <?php echo $dato->numeroTarjeta; ?></p>
          <br />
          <p>Fecha de caducidad: <?php echo $dato->fechaCaducidad; ?></p>
          <br />
          <p>Codigo Seguridad: <?php echo $dato->codigoSeguridad; ?></p>
          <br />
        </div>
        <?php
          }
        ?>
        <!--Hago un controle que me muestre en bontón apenas cuando haya producto en el carrito y una dirección selecionada-->
        <input type="submit"
        <?php if(empty($_SESSION['cesta']) || empty($_GET['id_direccion']) )  { ?> 
                disabled
                <?php } ?>
        value="Finalizar pago" name="tarjetaElegida" id="submit">
        <?php
          }
        ?>
    </form>
    <!--Formulario para registrar una tarjeta-->     
    <h2>Datos de la tarjeta</h2>
        <?php if(isset($mensajeErrorTarjeta)) { echo $mensajeErrorTarjeta; }?>
    <div class="formularioBody">
      <div class="contenedorGeneralInformaciones">
      <form method="POST" action="">      
      <input class="controls"  type="text" name="nombreTitular" value="" placeholder="Ej: Alberto Ferreira Almeida"/>
        <br />
        <input class="controls"  type="text" name="numeroTarjeta" required value="" placeholder="Ej: 1111222233334444"/>
        <br />
        <input class="controls" type="text" name="fechaCaducidad" required value="" placeholder="Ej: 12/26"/>
        <br />
        <input class="controls" type="number" name="codigoSeguridad" required value="" placeholder="Ej: 123"/>
        <br />
        <input class="botons" name="registrarTarjeta" type="submit" value="Enviar" />
      </form>
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
    <!-- Links de hojas externas de JS -->
    <script src="../../js/portada.js"></script>
    <script src="../../js/ohsnap.min.js"></script>
    <script src="../../js/myJquery.js"></script>
    <script src="../../js/main.js"></script>
  </body>
</html>