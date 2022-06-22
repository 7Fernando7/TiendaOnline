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
    <!--Aquí van los enlaces de las hojas de estilos y enlace externo de FontAwesome -->
    <link rel="stylesheet" href="../../css/estilos.css">
    <link rel="stylesheet" href="../../css/estilosEspecificos.css">
    <title>Mis tarjetas</title>
    </head>
    <body>
    <!--Hago un contenedor para todo el proyecto-->
    <div class="container">
        <!--Incluyo el heder haciendo un include de un archivo externo-->
        <?php include ($_SERVER['DOCUMENT_ROOT']."/dashboard/TiendaOnline/php/controlador/header.php"); ?>
        <div class="contenedorGeneralInfo">
            <h3>Mis tarjetas</h3>
            <?php
            /*Hago un foreach que devulve cada tarjeta registrada del usuario */
                if(isset($datos)) {
                    foreach ($datos as $dato) {
                        $idTarjeta = $dato->id_tarjeta;
                        $idUsuario = $dato->usuario_id;
            ?>
            <div class="informaciones">
                <p>Titular: <?php echo $dato->nombreTitular; ?></p>
                <br />
                <p>Número de tarjeta: <?php echo $dato->numeroTarjeta; ?></p>
                <br />
                <p>Fecha de caducidad: <?php echo $dato->fechaCaducidad; ?></p>
                <br />
                <p>Código de Seguridad: <?php echo $dato->codigoSeguridad; ?></p>
                <br />
                <p><button><a href="../controlador/borrarTarjeta.php?idTarjeta=<?=$idTarjeta?>">Borrar</a></button></p>
            </div>
            <?php
                        }
                }    else {
            ?>
            <p>No tienes tarjetas registradas</p>
            <?php
                    }
            ?>
            <button><a href="../controlador/tarjetas.php?perfil=perfil">Registrar una tarjeta</button>
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