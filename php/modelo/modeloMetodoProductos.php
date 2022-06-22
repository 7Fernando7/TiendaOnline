<?php
require_once ($_SERVER['DOCUMENT_ROOT']."/dashboard/TiendaOnline/php/config/conexion.php");  
include($_SERVER['DOCUMENT_ROOT']."/dashboard/TiendaOnline/php/config/sesiones.php");
class modeloProductos {
    //Cre un conector que me permitirá llamar automáticamente a esta función cuando cree un objeto de una clase.
    public function __construct() {
        $this->productoDevuelto = array();
        $this->dbh = conectarse_parampdo("formulariotienda");
    }
    //Hago una función para la inserción de los productos en la Base de datos
    public function registrarProductos() {
        if(isset($_SESSION['usuario'])) {
            $idP=$_SESSION['usuario'];
            $dbh = conectarse_parampdo("formulariotienda");
            $nombre=trim($_POST['nombre']);
            $titulo=trim($_POST['titulo']);
            $precio=trim($_POST['precio']);
            $descripcion=trim($_POST['descripcion']);
            $imagen_producto=trim($_POST['imagen_producto']);
            $cantidad=trim($_POST['cantidad']);
            $categorias_id=trim($_POST['categorias_id']);

            $dbh->beginTransaction();
            $insertPedido=$this->dbh->prepare("INSERT INTO producto (nombre,titulo,precio,descripcion,imagen_producto,cantidad,categorias_id) 
            VALUE (:nombre,:titulo,:precio,:descripcion,:imagen_producto,:cantidad,:categorias_id)");
            $insertPedido->bindParam(':nombre', $nombre);
            $insertPedido->bindParam(':titulo', $titulo);
            $insertPedido->bindParam(':precio', $precio);
            $insertPedido->bindParam(':descripcion', $descripcion);
            $insertPedido->bindParam(':imagen_producto', $imagen_producto);
            $insertPedido->bindParam(':categorias_id', $categorias_id);
            $insertPedido->bindParam(':cantidad', $cantidad);
            $insertPedido->execute();
            $dbh->commit();
            header("location:../controlador/buscarProductos.php");
        }
    }

    //Hago una función para obtener un producto 
    public function obtenerProducto($productoId){
        $stmt=$this->dbh-> prepare("SELECT * FROM producto where id_producto = $productoId");
        $stmt->execute();
        $row= $stmt->fetch(PDO::FETCH_ASSOC);
        if (empty($row)){ //si esta vacio damos error
            header("location:../vista/error.php");
            exit;
        }else{
            return $row;
            $this->dbh=null;
        }
    }

    //Hago una función para obtener los productos
    public function obtenerProductos($categoria){
        $stmt=$this->dbh-> prepare("SELECT * FROM producto p INNER JOIN categorias c ON c.id_categorias=p.categorias_id where id_categorias=$categoria;");
        $stmt->execute();
        $row= $stmt->fetchAll(PDO::FETCH_OBJ);
            if (empty($row)){ //si esta vacio damos error
                echo "No hay productos!";
                exit;
            }else{
                foreach ($row as $res)
            {
                $this->productoDevuelto[]=$res;
            }
                return $this->productoDevuelto;
                $this->dbh=null;
        }
    }

    //Aqui hago una función para mostrar los productos
    public function buscarProductos(){
        $stmt=$this->dbh-> prepare('SELECT * FROM producto');
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

    //Aqui hago una función para buscar los productos de forma aleatoria
    public function buscarProductosRandom(){
        $stmt=$this->dbh-> prepare('SELECT * FROM producto order by RAND() LIMIT 20');
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

    //Aqui hago una función para buscar los productos por categoría
    public function buscarProductosCategoria(){
        if(isset($_GET['search'])){
            $search = $_GET['search'];
            $stmt=$this->dbh-> prepare("SELECT * FROM producto where nombre LIKE '%{$search}%' or titulo LIKE '%{$search}%' or descripcion LIKE '%{$search}%';");
            $stmt->execute();
            $row= $stmt->fetchAll(PDO::FETCH_OBJ);
            if (!empty($row)){
                foreach ($row as $res)
            {
                $this->productoDevuelto[]=$res;
            }
                return $this->productoDevuelto;
                $this->dbh=null;
            }else{
                header("location:../../index.php");
            }
        }
    }
    //Hago una función para editar los productos en la base de datos
    public function editarProductos() {
        if(isset($_GET['idProductoDB'])) {
            $idP = $_GET['idProductoDB'];
            $sentencia = $this->dbh->prepare("SELECT * FROM producto where id_producto=$idP;");
            $sentencia->execute();
            $productos = $sentencia->fetch(PDO::FETCH_ASSOC);

            if (empty($productos)){
                header("location:../vista/error.php");
                exit;
            }else{
                return $productos;
                
                $this->dbh=null;
            }
        } else {
            header("location:../vista/error.php");
        }
    }
    //Aquií hago una función para actualizar los productos,Caso se encuentre algun producto le proporciono la opción de actualizar la información
    public function datosAtualizado() {
        $random = rand(1, 9999);
        $target_dir = "../../img/";
        $target_file = $target_dir.basename($random.$_FILES["fileToUpload"]["name"]);
        $seleccionImagen = isset($_FILES["fileToUpload"]["name"]) && !empty($_FILES["fileToUpload"]["name"]);
        if(isset($_GET['idProductoDB'])) {
            if($seleccionImagen) {
                move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
            }
            $idP = $_GET['idProductoDB'];
            $conect= conectarse_parampdo("formulariotienda");
            $nombre=trim($_POST['nombre']);
            $titulo=trim($_POST['titulo']);
            $precio=trim($_POST['precio']);
            $descripcion=trim($_POST['descripcion']);
            $imagen_producto= $seleccionImagen ? $random.$_FILES["fileToUpload"]["name"] : trim($_POST['imagen_producto']);

            $conect->beginTransaction();
            $pdoQuery_run = $conect->prepare("UPDATE producto SET nombre=:nombre, titulo =:titulo, precio=:precio, descripcion=:descripcion, imagen_producto=:imagen_producto WHERE id_producto=$idP;");
            $pdoQuery_run->bindParam(':nombre',$nombre, PDO::PARAM_STR);
            $pdoQuery_run->bindParam(':titulo',$titulo, PDO::PARAM_STR);
            $pdoQuery_run->bindParam(':precio',$precio, PDO::PARAM_INT);
            $pdoQuery_run->bindParam(':descripcion',$descripcion, PDO::PARAM_STR);
            $pdoQuery_run->bindParam(':imagen_producto',$imagen_producto, PDO::PARAM_STR);
            $conect->commit();
            
            if($pdoQuery_run->execute()) {
                header("location:../controlador/buscarProductos.php");
        
            } else {
                header("location:../vista/error.php");
            }
        } else {
            header("location:../vista/error.php");
            }
    }
    //Aquí hago una función para borrar un producto, caso encuentre algún producto, hará el borrado
    public function productoDeletado() {
        if(isset($_GET['idProductoDB'])) {
            $idProductos = $_GET['idProductoDB'];
            $conect= conectarse_parampdo("formulariotienda");
            $conect->beginTransaction();
            $pdoQuery_run = $this->dbh->prepare("DELETE FROM producto WHERE id_producto=$idProductos;");
            $conect->commit();
            if ($pdoQuery_run->execute()) {
                //Finalizando el borrado lo redirecciono a está página
                header("location:../controlador/buscarProductos.php");

            } else {
                echo "No se ha podido borrar los datos";
            }
            $pdoQuery_run->execute();
        }
    }
}
?>