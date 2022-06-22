<?php
//require_once llamar a la estructura de modelo y /o vista en el orden en que queremos ejecutar
//Llamo primero al modeloMetodoDirecciones.php
require_once(__DIR__."/../modelo/modeloMetodoDirecciones.php");
    //creo un nuevo objeto de tipo modeloDirecciones();
    $borrado = new modeloDirecciones();
    //Llamo a la vista borrarDirecciones.php
    require_once(__DIR__."/../vista/borrarDirecciones.php");
    //Hago una lógica que si encuentra $_POST['borrar'], borro la dirección
    if(isset($_POST['borrar'])) {
        //Llamo a la función
        $borrado->direccionDeletada();
    }
?>