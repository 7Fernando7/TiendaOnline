<?php
//require_once llamar a la estructura de modelo y /o vista en el orden en que queremos ejecutar
//Llamo primero al modeloMetodoPedidos.php
require_once(__DIR__."/../modelo/modeloMetodoPedidos.php");
//Creo un nuevo objeto de tipo modeloPedidos();
    $pedidos = new modeloPedidos();
    //Llamo a la función
    $datos = $pedidos->mostrarPedidos();
    //Redirecciono para la vista misPedidos.php
    require_once(__DIR__."/../vista/misPedidos.php");
?>