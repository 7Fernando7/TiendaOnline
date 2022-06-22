<?php
//require_once llamar a la estructura de modelo y /o vista en el orden en que queremos ejecutar
//Llamo primero al modeloMetodoPedidos.php
require_once(__DIR__."/../modelo/modeloMetodoPedidos.php");
    //Creo un nuevo objeto de tipo modeloPedidos();
    $pedido = new modeloPedidos();
    //Hago una lógica que se cumple los requisitos
    if(isset($_SESSION['usuario']) && isset($_GET['id_direccion']) && isset($_SESSION['cesta']) && !empty($_SESSION['cesta'])){
        //Llamo la función 
        $pedido->buscarTarjetas();
        //Redirecciono a la vista tarjetas.php
        header("location:tarjetas.php");

    }
?>