<?php
//require_once llamar a la estructura de modelo y /o vista en el orden en que queremos ejecutar
    //Llamo primero al modeloMetodoDirecciones.php
    require_once("../modelo/modeloMetodoDirecciones.php");
    //Creo un nuevo objeto de tipo modeloDirecciones();
    $services = new modeloDirecciones();
    //Una variable booleana
    $error = false;
    //Hago una lógica que se encuentra $_POST['registrarPedido']
    if(isset($_POST['registrarPedido'])) {
        //Ejecuta esta función registrarDirecciones();
        $mensajeErrorDirecion = $services->registrarDirecciones();
    }//Caso contrario encuentre _POST['registrarDireccion']
    if(isset($_POST['registrarDireccion'])) {
        //Ejecuta esta función  registrarDirecciones();
        $mensajeErrorDirecion = $services->registrarDirecciones();
        //Hago una lógica que me enseña el mensaje de error
        if(!isset($mensajeErrorDirecion)) {
            header("location:buscarDirecciones.php");
        } else {
            $error = true;
        }
    }//Hago una lógica que se estoy logueado y tengo direcciones me enseña las direcciones
    if(!isset($_GET['perfil']) && $error === false) {
        //Ejecuto esta función
        $datos = $services->buscarDirecciones();
    }
    //Redirecciono a esta vista registrarDirecciones.php
    require_once("../vista/registrarDirecciones.php");
    //Hago una lógica si se cumple $_POST
    if(isset($_POST['elegir']) && isset($_POST['elegirDireccion'])){
        //guado la seleción dentro de una variable y redireciono a la siguiente página almazenando su ID
        $id_direccion = $_POST['elegirDireccion'];
        header("location:tarjetas.php?id_direccion=$id_direccion");
    }
    array_filter($_POST);
?>