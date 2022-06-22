<?php
//require_once llamar a la estructura de modelo y /o vista en el orden en que queremos ejecutar
    //Hago una lógica para actualizar el carrito de compra
    $cantidadCestaTotal = 0;
    if(isset($_SESSION['cesta'])) {
        $cesta = $_SESSION['cesta'];
        foreach($cesta as $producto) {
            $cantidadCestaTotal += $producto;
        }
    }
    //Hago una lógica para el buscador
    if(isset($_POST['submit']) && isset($_POST['search'])) {
        $search = $_POST['search'];
        header("location:/dashboard/TiendaOnlineTFG/php/controlador/productosBuscador.php?search=$search");
    }
    require_once(__DIR__."/../vista/header.php");
?>