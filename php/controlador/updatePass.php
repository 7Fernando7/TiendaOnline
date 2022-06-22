<?php
//require_once llamar a la estructura de modelo y /o vista en el orden en que queremos ejecutar
    //Llamo primero al modeloMetodosUsuarios.php
    require_once(__DIR__."/../modelo/modeloMetodosUsuarios.php");
    //Creo un nuevo objeto de tipo modeloUsuarios();
    $editado = new modeloUsuarios();
    //Hago una lógica si se encuentra $_POST['submit']
    if(isset($_POST['submit'])) {
        //Ejecuto la función editar_pass();
        $mensajeError = $editado->editar_pass();
    }
    //Redirecciono a la vist a newPassword.php
    require_once(__DIR__."/../vista/newPassword.php");

?>