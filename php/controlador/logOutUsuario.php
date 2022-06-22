<?php
//require_once llamar a la estructura de modelo y /o vista en el orden en que queremos ejecutar
//Llamo primero al modeloMetodosUsuarios.php
require_once(__DIR__."/../modelo/modeloMetodosUsuarios.php");
//Creo un nuevo objeto del tipo modeloUsuarios();
$usuario = new modeloUsuarios();
//Llamo a la función
$datos = $usuario->logout();
//Redirecciono a la vista index.php
require_once(__DIR__."/../index.php");

?>