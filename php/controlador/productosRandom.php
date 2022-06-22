<?php
//require_once llamar a la estructura de modelo y /o vista en el orden en que queremos ejecutar
//Llamo primero al modeloMetodoProductos.php
require_once(__DIR__."/../modelo/modeloMetodoProductos.php");
    //Creo un nuevo objeto de tipo modeloProductos();
    $productos = new modeloProductos();
    //Llamo a la función buscarProductosRandom();
    $productosRandom = $productos->buscarProductosRandom();
?>