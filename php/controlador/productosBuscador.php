<?php
//require_once llamar a la estructura de modelo y /o vista en el orden en que queremos ejecutar
//Hago acceso a sesiones.php
include ("../config/sesiones.php");
//Llamo primero al modeloMetodoProductos.php
require_once(__DIR__."/../modelo/modeloMetodoProductos.php");
    //Creo un nuevo objeto de tipo modeloProductos();
    $productos = new modeloProductos();
    //Llamo a la función
    $datos = $productos->buscarProductosCategoria();
    //Llamo al modelo modeloMetodoPedidos.php
    require_once(__DIR__."/../modelo/modeloMetodoPedidos.php");
    //Creo un nuevo objeto de tipo modeloPedidos();
    $cesta = new modeloPedidos();
    //Hago una lógica que se cumpla los requisitos agregarProductoCesta();
    if(isset($_POST['id_producto']) && isset($_POST['cantidad']) && $_POST['cantidad'] != ""){
        $cesta->agregarProductoCesta();
        header("location:productosBuscador.php");
    }
    //Redirecciono a la vist a buscadorProductos.php
    require_once(__DIR__."/../vista/buscadorProductos.php");
?>

