<?php
//require_once llamar a la estructura de modelo y /o vista en el orden en que queremos ejecutar
    //Llamo primero al modeloMetodoPedidos.php
    require_once("../modelo/modeloMetodoPedidos.php");
    //Creo un nuevo objeto de tipo modeloPedidos();
    $services = new modeloPedidos();
    //Hago una lógica si se encuentra $_POST['registrarTarjeta']
    if(isset($_POST['registrarTarjeta'])) {
        //Ejecuto la función registrarTarjeta();
        $mensajeErrorTarjeta = $services->registrarTarjeta();
    }//Caso contrario llamo a la función buscarTarjetas();
    $datos = $services->buscarTarjetas();
    //Redirecciono a la vista pagos.php
    require_once("../vista/pagos.php");
    //Hago una lógica si se cumple con los requisito enseña las tarjetas ya registradas
    if(isset($_POST['tarjetaElegida']) && isset($_POST['elegirTarjeta'])){
        $idTarjeta= $_POST['elegirTarjeta'];
        $idDireccion = $_GET['id_direccion'];
        header("location:tarjetaSeleccionada.php?id_tarjeta=$idTarjeta&id_direccion=$idDireccion");
    }
    array_filter($_POST);
?>