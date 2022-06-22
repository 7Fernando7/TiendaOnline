<?php
//require_once llamar a la estructura de modelo y /o vista en el orden en que queremos ejecutar
//Llamo primero al modeloMetodosUsuarios.php
require_once(__DIR__."/../modelo/modeloMetodosUsuarios.php");
//Creo un nuevo objeto de tipo modeloUsuarios();
    $registrarUsuario = new modeloUsuarios();
    //Redirecciono a la vista registro.php
    require_once(__DIR__."/../vista/registro.php");
    //Hago una lógica que si encuentra $_POST['registrar']
    if(isset($_POST['registrar'])){
        //Ejecuto la función
        $datos = $registrarUsuario->registrarUsuario(false);
    }
?>