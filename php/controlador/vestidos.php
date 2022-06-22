<?php
//require_once llamar a la estructura de modelo y /o vista en el orden en que queremos ejecutar
//Llamo primero al modeloMetodoProductos.php
require_once(__DIR__."/../modelo/modeloMetodoProductos.php");
    //Creo una nuevo objeto de tipo modeloProductos();
    $productos = new modeloProductos();
    //Llamo al modelo modeloMetodoPedidos.php
    require_once(__DIR__."/../modelo/modeloMetodoPedidos.php");
    //Creo una nuevo objeto de tipo modeloPedidos();
    $cesta = new modeloPedidos();
    //Hago una lógica si se cumple con los requisitos agregarProductoCesta();
    if(isset($_POST['id_producto']) && isset($_POST['cantidad']) && $_POST['cantidad'] != ""){
        $cesta->agregarProductoCesta();
        header("location:vestidos.php");
    }//Caso contrario redirecciono a la vista productos con productos pasados por parametro obtenerProductos(3);
    $datosProductos = $productos->obtenerProductos(3);
    require_once(__DIR__."/../vista/productos.php");
?>