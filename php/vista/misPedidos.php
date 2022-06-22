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
        <title>Mis pedidos</title>
    </head>
    <body>
        <!--Hago un contenedor para todo el proyecto-->
        <div class="container">
            <!--Incluyo el heder haciendo un include de un archivo externo-->
            <?php include ($_SERVER['DOCUMENT_ROOT']."/dashboard/TiendaOnlineTFG/php/controlador/header.php"); ?>
            <div class="contenedorGeneralInfo">
                <h3>Mis pedidos</h3>
                <?php
                /*Hago un foreach que devulve cada pedido registrada del usuario */
                    if(isset($datos)) {
                    foreach ($datos as $dato) {
                    $numeroPedido = $dato->numeroPedido;
                ?>
                <table>
                    <tr>
                        <th colspan="3">Informaciones del pedido</th>
                        <th colspan="3">Número de pedido: <?php echo $dato->numeroPedido; ?></th>
                        <th class="<?php echo $dato->cancelado == 1 ? 'cancelado' :'entregado' ?>" colspan="3"><?php 
                            if($dato->cancelado == 1){
                                echo "Cancelado"; 
                            } else if ($dato->fechaEntrega > date("Y-m-d H:m:s")){
                                echo "Pendiente de entrega";
                            } else { 
                                echo "<p>Pedido entregado</p>";
                            };?></th>
                    </tr>
                    <?php 
                        foreach(json_decode($dato->pedidosProd, true) as $producto) {
                    ?>
                    <tr>
                        <td>Producto nombre: <?php echo $producto['productos_nombre'] ?></td>
                        <td>Cantidad: <?php echo $producto['cantidad'] ?></td>
                    </tr>
                    <?php } ?>
                    <tr>
                        <td>Fecha pedido: <?php echo $dato->fechaPedido; ?></td>
                        <td>Fecha de entrega: <?php echo $dato->fechaEntrega; ?></td>
                    </tr>
                    <?php if(($dato->fechaEntrega > date("Y-m-d") && $dato->cancelado == 0 )){
                    ?>
                        <tr>
                            <td><button><a href="../controlador/cancelarPedido.php?numeroPedido=<?=$numeroPedido?>">Cancelar pedido</a></button></td>
                        </tr>                        
                    <?php } ?>
                </table>
                <?php
                        }
                    }    else {
                ?>
                <p>No tienes pedidos.</p>
                <?php
                }
                ?>
            </div>
        </div>
        <!--Incluyo el Footer con informaciones pertinentes a la empresa haciendo un include de un archivo externo-->
        <?php include ($_SERVER['DOCUMENT_ROOT']."/dashboard/TiendaOnlineTFG/php/vista/footer.php"); ?>
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