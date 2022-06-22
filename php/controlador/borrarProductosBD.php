<?php
//require_once llamar a la estructura de modelo y /o vista en el orden en que queremos ejecutar
//Llamo primero al modeloMetodoProductos.php
require_once(__DIR__."/../modelo/modeloMetodoProductos.php");
//Hago una lógica que si esta logueado y NO es administrador no podrá hacer está función te redirecciona para el index.php
if($logueado && !$administrador) {
  header("location:/dashboard/TiendaOnline/index.php");
  }//Caso contratio te redirecciona a la vista borrarProductosBD.php
    $borrado = new modeloProductos();
    require_once(__DIR__."/../vista/borrarProductosBD.php");
    //Hago una lógica que si encuentra $_POST['borrar'], borro el producto selecionado
    if(isset($_POST['borrar'])) {
      //Ejecuta la función
        $borrado->productoDeletado();
    }
    ?>