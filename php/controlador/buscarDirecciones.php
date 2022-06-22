<?php
//require_once llamar a la estructura de modelo y /o vista en el orden en que queremos ejecutar
//Llamo primero al modeloMetodoDirecciones.php
require_once(__DIR__."/../modelo/modeloMetodoDirecciones.php");
//creo un nuevo objeto de tipo modeloDirecciones();
    $direcciones = new modeloDirecciones();
    //Llamo a la función
    $datos = $direcciones->buscarDirecciones();
    //Redirecciono a vista misDirecciones.php"
    require_once(__DIR__."/../vista/misDirecciones.php");
?>