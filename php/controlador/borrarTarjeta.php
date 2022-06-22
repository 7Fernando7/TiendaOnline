<?php
//require_once llamar a la estructura de modelo y /o vista en el orden en que queremos ejecutar
//Llamo primero al modeloMetodoPedidos.php
require_once(__DIR__."/../modelo/modeloMetodoPedidos.php");
//creo un nuevo objeto de tipo modelopedidos();
    $borrado = new modelopedidos();
    //Hago una llamada a la vista borrarTarjeta.php
    require_once(__DIR__."/../vista/borrarTarjeta.php");
    //Hago una lógica que si encuentra $_POST['borrarTarjeta'], borro la tarjeta
    if(isset($_POST['borrarTarjeta'])) {
        ///Ejecuta la función
        $borrado->tarjetaBorrada();
    }
?>