<?php
//require_once llamar a la estructura de modelo y /o vista en el orden en que queremos ejecutar
    //Llamo primero al modeloMetodoProductos.php"
    require_once(__DIR__."/../modelo/modeloMetodoProductos.php");
    //Hago una lógica que si esta logueado y NO es administrador no podrá hacer está función te redirecciona para el index.php
    if($logueado && !$administrador) {
        header("location:/dashboard/TiendaOnline/index.php");
      }//Caso contratio creo un nuevo objeto de tipo modeloProductos();
    $editado = new modeloProductos();
    //Llamo la función
    $editar = $editado->editarProductos();
    //Redirecciono a la vista editarProductosBD.php
    require_once(__DIR__."/../vista/editarProductosBD.php");
    //Hago una lógica caso encuentre $_POST['update'])
    if(isset($_POST['update'])) {
        //Ejecuto la función y actualizo los datos
        $editado->datosAtualizado();
    }
?>