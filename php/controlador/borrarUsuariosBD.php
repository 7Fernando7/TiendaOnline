<?php
//require_once llamar a la estructura de modelo y /o vista en el orden en que queremos ejecutar
//Llamo primero al modeloMetodosUsuarios.php
require_once(__DIR__."/../modelo/modeloMetodosUsuarios.php");
//Hago una lógica que si esta logueado y NO es administrador no podrá hacer está función te redirecciona para el index.php
if($logueado && !$administrador) {
  header("location:/dashboard/TiendaOnlineTFG/index.php");
  }//Caso contratio te redirecciona a la vista borrarUsuariosBD.php
    $borrado = new modeloUsuarios();
    require_once(__DIR__."/../vista/borrarUsuariosBD.php");
    //Hago una lógica que si encuentra $_POST['borrar'], borro el usuario selecionado
    if(isset($_POST['borrar'])) {
      ///Ejecuta la función
        $borrado->UsuarioDeletadoBD();
    }
    ?>