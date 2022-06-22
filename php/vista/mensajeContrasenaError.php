<?php
include ("../config/sesiones.php");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>CarritoCompra</title>
        <script src="https://kit.fontawesome.com/85815134f5.js" crossorigin="anonymous"></script>
        <!--Aquí van los enlaces de las hojas de estilos y enlace externo de FontAwesome -->
        <link rel="stylesheet" href="../../css/estilos.css">
        <title>Mensaje error contraseña</title>
    </head>
    <body>
        <!--Hago un contenedor para todo el proyecto-->
        <div class="container">
            <!--Incluyo el heder haciendo un include de un archivo externo-->
            <?php include ($_SERVER['DOCUMENT_ROOT']."/dashboard/TiendaOnline/php/controlador/header.php"); ?>
            <div class="contenedorGeneralmensajeError">
                <p>Lo siento, no hay ningún usuario registrado con este correo.</p>
                <a href="../controlador/loginUsuario.php">Login</a>
                <br />
                <a href="../controlador/registrarUsuarios.php">Registrarse</a>
                <br />
                <a href="../../index.php">Volver al inicio</a>
                <br />
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
    </body>
</html>