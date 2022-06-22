<?php
//require_once llamar a la estructura de modelo y /o vista en el orden en que queremos ejecutar
//Llamo primero al modeloMetodoProductos.php
require_once(__DIR__."/../modelo/modeloMetodoProductos.php");
//creo un nuevo objeto de tipo modeloProductos();
    $productos = new modeloProductos();
    require_once(__DIR__."/../modelo/modeloMetodoPedidos.php");
     //creo un nuevo objeto de tipo modeloPedidos();   
    $cesta = new modeloPedidos();
    //Hago una lógica que me va agregar productos en la cesta, caso cumpla con los requisitos
    if(isset($_POST['id_producto']) && isset($_POST['cantidad']) && $_POST['cantidad'] != ""){
        $cesta->agregarProductoCesta();
        header("location:accesorios.php");
    }
    //Sino cumple los requisitos llama a la funcion obtenerProductos y paso por parametro el producto que quiero que me muestre
    $datosProductos = $productos->obtenerProductos(4);
    //Redirecciono a esta vista para ver el resultado en productos.php
    require_once(__DIR__."/../vista/productos.php");
?>