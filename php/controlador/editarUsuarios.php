<?php
//require_once llamar a la estructura de modelo y /o vista en el orden en que queremos ejecutar
    //Llamo primero al modeloMetodosUsuarios.php
    require_once(__DIR__."/../modelo/modeloMetodosUsuarios.php");
    //Creo un nuevo objeto de tipo modeloUsuarios();
    $editado = new modeloUsuarios();
    //Llamo a la función 
    $editar = $editado->editarUsuario();
    //Redirecciono a la vista editarDatosUsuarios.php
    require_once(__DIR__."/../vista/editarDatosUsuarios.php");
    //Hago una función se encuentra $_POST['update']
    if(isset($_POST['update'])) {+
        //Ejecuto la función y actualizo los datos
        $editado->datosAtualizado();
    }

?>