<?php
//require_once llamar a la estructura de modelo y /o vista en el orden en que queremos ejecutar
//Llamo primero al modeloMetodoProductos.php
    require_once(__DIR__."/../modelo/modeloMetodoProductos.php");
    //Creo un objeto de tipo modeloProductos();
    $productos = new modeloProductos();
    //Llamo  al modeloMetodoPedidos.php
    require_once(__DIR__."/../modelo/modeloMetodoPedidos.php");
    //Creo un objeto de tipo modeloPedidos();
    $cesta = new modeloPedidos();
    //Hago una lógica caso cumpla con los requisitos agredo producto a la cesta
    if(isset($_POST['id_producto']) && isset($_POST['cantidad']) && $_POST['cantidad'] != ""){
        $cesta->agregarProductoCesta();
        //Redirecciono a camisas.php
        header("location:camisas.php");
    }//Caso contrario apenas cargo los productos de acuerdo con el valor del parametro
    $datosProductos = $productos->obtenerProductos(1);
    //Redirecciono a la vista productos.php
    require_once(__DIR__."/../vista/productos.php");
?>