<?php
//require_once llamar a la estructura de modelo y /o vista en el orden en que queremos ejecutar
//Llamo primero al modeloMetodoProductos.php
require_once(__DIR__."/../modelo/modeloMetodoProductos.php");
//Hago una lógica que si esta logueado y NO es administrador no podrá hacer está función te redirecciona para el index.php
if($logueado && !$administrador) {
    header("location:/dashboard/TiendaOnline/index.php");
}   //Creo un nuevo objeto de tipo modeloProductos();
    $productos = new modeloProductos();
    //Llamo a la función
    $datos = $productos->buscarProductos();
    //Redirecciono a la vista productosBaseDatos.php
    require_once(__DIR__."/../vista/productosBaseDatos.php");

?>