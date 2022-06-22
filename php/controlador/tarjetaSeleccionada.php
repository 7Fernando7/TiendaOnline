<?php
//require_once llamar a la estructura de modelo y /o vista en el orden en que queremos ejecutar
//Llamo primero al modeloMetodoPedidos.php
require_once(__DIR__."/../modelo/modeloMetodoPedidos.php");
//Creo un nuevo objeto de tipo modeloPedidos();
    $pedido = new modeloPedidos();
    //Hago una lógica si se cumple con los requisito crea el pedido
    if(isset($_SESSION['usuario']) && isset($_GET['id_direccion']) && isset($_GET['id_tarjeta']) && isset($_SESSION['cesta']) && !empty($_SESSION['cesta'])){
        //Llamo a la función crearPedido();
        $pedido->crearPedido();
        //Redirecciono a la vista buscarPedidos.php
        header("location:buscarPedidos.php");
    }
?>