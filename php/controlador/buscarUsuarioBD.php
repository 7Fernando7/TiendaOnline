<?php
//require_once llamar a la estructura de modelo y /o vista en el orden en que queremos ejecutar
//Llamo primero al modeloMetodosUsuarios.php
require_once(__DIR__."/../modelo/modeloMetodosUsuarios.php");
//Hago una lógica que si esta logueado y NO es administrador no podrá hacer está función te redirecciona para el index.php
if($logueado && !$administrador) {
  header("location:/dashboard/TiendaOnline/index.php");
  }//Caso contratio creo un nuevo objeto de tipo modeloUsuarios();
    $usuario = new modeloUsuarios();
    //Llamo a la función
    $datos = $usuario->buscar_All_Usuarios();
    //Redirecciono a la vista cuentasBDAdmin.php
    require_once(__DIR__."/../vista/cuentasBDAdmin.php");

?>