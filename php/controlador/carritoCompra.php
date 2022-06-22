<?php
//require_once llamar a la estructura de modelo y /o vista en el orden en que queremos ejecutar
//Llamo primero al modeloMetodoPedidos.php
    require_once(__DIR__."/../modelo/modeloMetodoPedidos.php");
    //Creo un nuevo objeto de tipo modeloPedidos();
    $cesta = new modeloPedidos();
    //Hago una lógica, se cumple los requisitos en los $_POST llamo a la función y modifico los productos en la cesta
    if(isset($_POST['id_producto']) && isset($_POST['cantidad']) && $_POST['cantidad'] != ""){
        //Llamo la función
        $productos = $cesta->modificarProductoCesta();
    }//Caso contrario llamno la función cargarCesta();
    $productos = $cesta->cargarCesta();
    $precioTotalProductos = 0;
    $precioEnvio = 4.75;
    //Hago una lógica caso cumple con los requisitos
    if(isset($_SESSION['cesta']) && count($productos) > 0) {
        //Hago un foreach y pinto cada producto de la cesta
        foreach ($productos as $producto) {
            $precioTotalProductos += $producto['precio'] * $_SESSION['cesta'][$producto['id_producto']];
        }//Caso la suma de los productos sean inferiores a 75 sumará el valor de la taza de envío
        if($precioTotalProductos < 75) {
            $precioTotalProductos += $precioEnvio;
        }
    }
    //Redirecciono a la vista carritoCompra.php
    require_once(__DIR__."/../vista/carritoCompra.php");
?>