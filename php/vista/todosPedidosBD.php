<?php
ob_start();
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
        <link rel="stylesheet" href="../../css/estilosEspecificos.css">
        <title>Ver todos los pedidos</title>
    </head>
    <body>
        <!--Hago un contenedor para todo el proyecto-->
        <div class="container">
            <?php include ($_SERVER['DOCUMENT_ROOT']."/dashboard/TiendaOnlineTFG/php/controlador/header.php"); ?>
            <div class="contenedorGeneralPedidosBD">
                <h3>Pedidos</h3>
                <?php
                    if(isset($datos)) {
                    foreach ($datos as $dato) {
                    $idPedidos = $dato->id_pedidos;
                ?>
                <table>
                    <tr>
                        <th colspan="3">Informaciones del pedido</th>
                        <th colspan="3">Usuario: <?php echo $dato->nombre; ?></th>
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
                        <td>Producto: <?php echo $producto['productos_nombre'] ?></td>
                        <td>Cantidad: <?php echo $producto['cantidad'] ?></td>
                    </tr>
                    <?php } ?>
                    <tr>
                        <td>Fecha pedido: <?php echo $dato->fechaPedido; ?></td>
                        <td>Fecha de entrega: <?php echo $dato->fechaEntrega; ?></td>
                    </tr>
                    <?php if(($dato->fechaEntrega > date("Y-m-d") && $dato->cancelado == 0 )){
                    ?>                       
                    <?php } ?>
                </table>
                <?php
                }
                    }    else {
                ?>
                    <p>No tiene pedidos.</p>
                <?php
                    }
                ?>
            </div>
        </div>
        <!--Footer con informaciones pertinentes a la empresa-->
        <?php include ($_SERVER['DOCUMENT_ROOT']."/dashboard/TiendaOnlineTFG/php/vista/footer.php"); ?>
        <!--Enlace de los archivos JS-->
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