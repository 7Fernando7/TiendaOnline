<?php
//require_once llamar a la estructura de modelo y /o vista en el orden en que queremos ejecutar
//Llamo primero al modeloMetodoProductos.php
require_once(__DIR__."/../modelo/modeloMetodoProductos.php");
//creo un nuevo objeto de tipo modeloProductos();
    $productos = new modeloProductos();
    //Hago una lógica que me va mostrar los productos 
    if(isset($_GET['producto'])) {
        $datosProductos = $productos->obtenerProducto($_GET['producto']);
    } else {
        header("location:../vista/error.php");
    }
    //Llamo al modeloMetodoPedidos.php
    require_once(__DIR__."/../modelo/modeloMetodoPedidos.php");
    //creo un nuevo objeto de tipo modeloProductos();
    $cesta = new modeloPedidos();
     //Hago una lógica que me va agregar productos en la cesta
    if(isset($_POST['id_producto']) && isset($_POST['cantidad']) && $_POST['cantidad'] != ""){
        $cesta->agregarProductoCesta();
    }
    //Redirecciono a esta vista para ver el resultado en accesoriosDetalles.php
    require_once(__DIR__."/../vista/accesoriosDetalles.php");
?>