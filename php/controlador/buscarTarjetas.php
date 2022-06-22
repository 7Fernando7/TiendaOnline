<?php
//require_once llamar a la estructura de modelo y /o vista en el orden en que queremos ejecutar
//Llamo primero al modeloMetodoPedidos.php
require_once(__DIR__."/../modelo/modeloMetodoPedidos.php");
    //Creo un nuevo objeto de tipo modeloPedidos();
    $direcciones = new modeloPedidos();
    //Llamo a la función
    $datos = $direcciones->buscarTarjetas();
    //Redirecciono para la vista misTarjetas.php
    require_once(__DIR__."/../vista/misTarjetas.php");
?>