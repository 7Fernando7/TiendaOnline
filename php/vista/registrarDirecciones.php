<?php
ob_start();
include ("../config/sesiones.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../../css/estilos.css"/>
    <script src="https://kit.fontawesome.com/85815134f5.js" crossorigin="anonymous"></script>
    <title>Registrar dirección</title>
  </head>
  <body>
    <?php include ($_SERVER['DOCUMENT_ROOT']."/dashboard/TiendaOnline/php/controlador/header.php"); ?>
    <div class="contenedorGeneralDireccion" >
      <div class="elegirDireccionInfo" >
        <?php
          if(isset($datos)){
        ?>
        <legend>Selecione una dirección:</legend>
        </div>
        <form method="POST" action="">
          <?php
            foreach ($datos as $dato) {
            $idDireccion = $dato->id_direcciones;
          ?>
            <div class="elegirDireccion">
              <input type="radio" id="elegirDireccion" name="elegirDireccion" value="<?php echo $idDireccion;?>" required>
              <p>Calle: <?php echo $dato->calle; ?></p>
              <br />
              <p>Número: <?php echo $dato->numero; ?></p>
              <br />
              <p>Piso: <?php echo $dato->piso; ?></p>
              <br />
              <p>Ciudad: <?php echo $dato->ciudad; ?></p>
              <br />
              <p>Provincia: <?php echo $dato->provincia; ?></p>
              <br />
              <p>Código postal: <?php echo $dato->codigopostal; ?></p>
              <br />
            </div>
            <?php
              }
            ?>
            <input type="submit" value="Finalizar pedido" name="elegir" id="submit">
            <?php
              }
            ?>
          </form>
          <!--Formulario de registro en la aplicación -->
          <?php if(isset($mensajeErrorDirecion)) { echo $mensajeErrorDirecion; }?>
          <h2>Registro de dirección</h2>
        <div class="formularioBody">
        <div>
        <form method="POST" action="../controlador/registrarDirecciones.php">
          <input class="controls" type="text" name="calle" value="<?php echo isset($_POST['calle']) ? $_POST['calle'] : '';?>" placeholder="Calle"/>
          <br/>
          <input class="controls" type="number" name="numero" value="<?php echo isset($_POST['numero']) ? $_POST['numero'] : '';?>"placeholder="Número"/>
          <br />
          <input class="controls" type="text" name="piso" value="<?php echo isset($_POST['piso']) ? $_POST['piso'] : '';?>" placeholder="Piso"/>
          <br />
          <input class="controls" type="text" name="ciudad" value="<?php echo isset($_POST['ciudad']) ? $_POST['ciudad'] : '';?>" placeholder="Ciudad"/>
          <br />
          <input class="controls" type="text" name="provincia" value="<?php echo isset($_POST['provincia']) ? $_POST['provincia'] : '';?>" placeholder="Provincia"/>
          <br />
          <input class="controls" type="number" name="codigopostal" value="<?php echo isset($_POST['codigopostal']) ? $_POST['codigopostal'] : '';?>" placeholder="Codigo Postal"/>
          <br />
          <input class="botons" name="<?php if(isset($_GET['perfil'])) { echo 'registrarDireccion'; 
          } else { echo 'registrarPedido'; }?>" type="submit" value="Registrar" />
        </form>
        </div>
      </div>
    </div>
    <?php include ($_SERVER['DOCUMENT_ROOT']."/dashboard/TiendaOnline/php/vista/footer.php"); ?>
    <script>
      /** Función que se ejecuta una vez cargada la página */
      window.onload=function() {
          repetir();
      }
    </script>
    <script src="../../js/main.js"></script>
    <script src="../../js/portada.js"></script>
  </body>
</html>