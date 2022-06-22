<?php
//require_once llamar a la estructura de modelo y /o vista en el orden en que queremos ejecutar
    //Llamo primero al modeloMetodoProductos.php
    require_once("../modelo/modeloMetodoProductos.php");
    //Hago una lógica que si esta logueado y NO es administrador no podrá hacer está función te redirecciona para el index.php
    if($logueado && !$administrador) {
        header("location:/dashboard/TiendaOnline/index.php");
    }//Caso contratio creo un nuevo objeto de tipo modeloProductos();
    $services = new modeloProductos();
    //Hago una lógica caso encuentre $_POST['registrarProductos']
    if(isset($_POST['registrarProductos'])) {
        //Ejecuto a la función registrarProductos();
        $pd = $services->registrarProductos();
    }
    //Redirecciono a la vista registrarProductos.php
    require_once("../vista/registrarProductos.php");
    
?>