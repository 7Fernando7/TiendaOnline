<?php
require_once ("../config/conexion.php");
require_once(__DIR__."/validaciones.php"); 
include('../config/sesiones.php');
class modeloDirecciones {
    //Cre un conector que me permitirá llamar automáticamente a esta función cuando cree un objeto de una clase.
    public function __construct() {
        $this->productoDevuelto = array();
        $this->dbh = conectarse_parampdo("formulariotienda");
    }
    //Aquí hago una función para registrar las direcciones
    public function registrarDirecciones() {
        if(isset($_SESSION['usuario'])) {
            $idP=$_SESSION['usuario'];
            $validaciones = new validaciones();
            $dbh = conectarse_parampdo("formulariotienda");
            $calle=trim($_POST['calle']);
            $numero=trim($_POST['numero']);
            $piso=trim($_POST['piso']);
            $ciudad=trim($_POST['ciudad']);
            $provincia=trim($_POST['provincia']);
            $codigopostal=trim($_POST['codigopostal']);
                //Verifico si calle, numero, piso, ciudad, provincia no están en blanco, sino envío un mensaje de error
                if (empty($calle) || (empty($numero)) || (empty($piso)) || (empty($ciudad)) || (empty($provincia))){
                    $mensajeErrorDirecion = "Los campos no pueden estar vacios";
                return $mensajeErrorDirecion;
                //Verifico si código postal tiene el formato adecuado, sino envío un mensaje de error
                } else if(!$validaciones->validarCodigoPostal($codigopostal)) {
                    $mensajeErrorDirecion = "El código postal no tiene el formato valido";
                return $mensajeErrorDirecion;
                //Caso todo cumpla el formato adecuado hago el registro
                } else {
                    $dbh->beginTransaction();
                    $insertPedido=$this->dbh->prepare("INSERT INTO direcciones (calle,numero,piso,ciudad,provincia,codigopostal,usuario_id) 
                    VALUE (:calle,:numero,:piso,:ciudad,:provincia,:codigopostal,:usuario_id)");
                    $insertPedido->bindParam(':calle', $calle);
                    $insertPedido->bindParam(':numero', $numero);
                    $insertPedido->bindParam(':piso', $piso);
                    $insertPedido->bindParam(':ciudad', $ciudad);
                    $insertPedido->bindParam(':provincia', $provincia);
                    $insertPedido->bindParam(':codigopostal', $codigopostal);
                    $insertPedido->bindParam(':usuario_id', $idP);
                    $insertPedido->execute();
                    $dbh->commit();
                if(!$dbh) {
                    array_filter($_POST);
                    echo "No se ha podido guardar los datos";
                } 
            }
        }
    }
    //Aqui hago una función para mostrar las direcciones
    public function buscarDirecciones(){
        $id=$_SESSION['id'];
        $stmt=$this->dbh-> prepare('SELECT * FROM direcciones where usuario_id=:id');
        $stmt->bindParam(':id',$id);
        $stmt->execute();
        $row= $stmt->fetchAll(PDO::FETCH_OBJ);
        if (!empty($row)){
            foreach ($row as $res)
        {
            $this->productoDevuelto[]=$res; 
        }
            return $this->productoDevuelto;
            $this->dbh=null;
        }
    }
    //Aquí hago una función para editar las direcciones del Id en sesión
    public function editarDirecciones() {
        if(isset($_GET['idDireccion'])) {
            $idUsuer = $_SESSION['usuario'];
            $idP = $_GET['idDireccion'];
            $sentencia = $this->dbh->prepare("SELECT * FROM direcciones where id_direcciones=$idP and usuario_id=$idUsuer;");
            $sentencia->execute();
            $direccion = $sentencia->fetch(PDO::FETCH_ASSOC);

            if (empty($direccion)){
                header("location:../vista/error.php");
                exit;
            }else{
                return $direccion;
                
                $this->dbh=null;
            }
        } else {
            header("location:../vista/error.php");
        }
    }
    //Aquí hago una función para actuazliar una dirección, caso se encuentre le proporciono la opción de actualizar la información
    public function datosAtualizado() {
        if(isset($_GET['idDireccion'])) {
            $idUser = $_SESSION['usuario'];
            $idP = $_GET['idDireccion'];
            $conect= conectarse_parampdo("formulariotienda");
            
            $calle=trim($_POST['calle']);
            $numero=trim($_POST['numero']);
            $piso=trim($_POST['piso']);
            $ciudad=trim($_POST['ciudad']);
            $provincia=trim($_POST['provincia']);
            $codigopostal=trim($_POST['codigopostal']);

            $conect->beginTransaction();
            $pdoQuery_run = $conect->prepare("UPDATE direcciones SET calle=:calle, numero =:numero, piso=:piso, ciudad=:ciudad, provincia=:provincia, codigopostal=:codigopostal WHERE id_direcciones=$idP and usuario_id=$idUser;");
            $pdoQuery_run->bindParam(':calle',$calle, PDO::PARAM_STR);
            $pdoQuery_run->bindParam(':numero',$numero, PDO::PARAM_INT);
            $pdoQuery_run->bindParam(':piso',$piso, PDO::PARAM_STR);
            $pdoQuery_run->bindParam(':ciudad',$ciudad, PDO::PARAM_STR);
            $pdoQuery_run->bindParam(':provincia',$provincia, PDO::PARAM_STR);
            $pdoQuery_run->bindParam(':codigopostal',$codigopostal, PDO::PARAM_STR);
            $conect->commit();
            
            if($pdoQuery_run->execute()) {
                header("location:../controlador/buscarDirecciones.php");
        
            } else {
                header("location:../vista/error.php");
            }
        } else {
            header("location:../vista/error.php");
            }
    }
    //Aquí hago una función para borrar una dirección, caso encuentre alguna hará el borrado
    public function direccionDeletada() {
        if(isset($_GET['idDireccion'])) {
            $idUser = $_SESSION['usuario'];
            $idP = $_GET['idDireccion'];
            $conect= conectarse_parampdo("formulariotienda");
            $conect->beginTransaction();
            $pdoQuery_run = $this->dbh->prepare("DELETE FROM direcciones WHERE id_direcciones=$idP and usuario_id=$idUser;");
            $conect->commit();
            if ($pdoQuery_run->execute()) {
                header("location:../controlador/buscarDirecciones.php");

            } else {
                echo "No se ha podido borrar los datos";
            }
            $pdoQuery_run->execute();
        }
    }
}
?>