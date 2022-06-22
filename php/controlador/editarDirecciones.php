<?php
//require_once llamar a la estructura de modelo y /o vista en el orden en que queremos ejecutar
    //Llamo primero al modeloMetodoDirecciones.php
    require_once(__DIR__."/../modelo/modeloMetodoDirecciones.php");
    //Creo un nuevo objeto de tipo modeloDirecciones();
    $editado = new modeloDirecciones();
    //Llamo a la función
    $editar = $editado->editarDirecciones();
    //Redirecciono a la vista editarDirecciones.php
    require_once(__DIR__."/../vista/editarDirecciones.php");
    //Hago una lógica qus se encuentra $_POST['update']
    if(isset($_POST['update'])) {
        //Ejecuto la función y actualiado los datos
        $editado->datosAtualizado();
    }
?>