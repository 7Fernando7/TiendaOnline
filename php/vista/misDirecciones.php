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
        <title>Mis direcciones</title>
    </head>
    <body>
        <!--Hago un contenedor para todo el proyecto-->
        <div class="container">
            <!--Incluyo el heder haciendo un include de un archivo externo-->
            <?php include ($_SERVER['DOCUMENT_ROOT']."/dashboard/TiendaOnlineTFG/php/controlador/header.php"); ?>
            <div class="contenedorGeneralInfo">
                <h3>Mis direcciones</h3>
                <?php
                /*Hago un foreach que devulve cada dirección registrada del usuario */
                    if(isset($datos)) {
                        foreach ($datos as $dato) {
                            $idDireccion = $dato->id_direcciones;
                ?>
                <div class="informaciones">
                    <p><span>Calle:</span> <?php echo $dato->calle; ?></p>
                    <p><span>Número:</span> <?php echo $dato->numero; ?></p>
                    <p><span>Piso:</span> <?php echo $dato->piso; ?></p>
                    <p><span>Ciudad:</span> <?php echo $dato->ciudad; ?></p>
                    <p><span>Provincia:</span> <?php echo $dato->provincia; ?></p>
                    <p><span>Código postal:</span> <?php echo $dato->codigopostal; ?></p>
                    <p><button><a href="../controlador/editarDirecciones.php?idDireccion=<?=$idDireccion?>">Editar</a></button></p>
                    <p><button><a href="../controlador/borrarDirecciones.php?idDireccion=<?=$idDireccion?>">Borrar</a></button></p>
                </div>
                <?php
                            }
                    }    else {
                ?>
                <p>No tienes direcciones registradas</p>
                <?php
                        }
                ?>
                <button><a href="../controlador/registrarDirecciones.php?perfil=perfil">Registrar dirección</a></button>
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
        <script src="../../js/ohsnap.min.js"></script>
        <script src="../../js/myJquery.js"></script>
    </body>
</html>