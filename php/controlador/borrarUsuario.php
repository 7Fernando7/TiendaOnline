<?php
//require_once llamar a la estructura de modelo y /o vista en el orden en que queremos ejecutar
//Llamo primero al modeloMetodosUsuarios.php
require_once(__DIR__."/../modelo/modeloMetodosUsuarios.php");
//creo un nuevo objeto de tipo modelopedidos();
    $borrado = new modeloUsuarios();
    //Llamo a la vista borrarUsuarios.php
    require_once(__DIR__."/../vista/borrarUsuarios.php");
    //Hago una lógica que si encuentra $_POST['borrar'], borro el usuario
    if(isset($_POST['borrar'])) {   
        ///Ejecuta la función
        $borrado->usuarioDeletado();
    }
    ?>