<?php
require_once(__DIR__."/validaciones.php");
require_once ($_SERVER['DOCUMENT_ROOT']."/dashboard/TiendaOnlineTFG/php/config/conexion.php");
require_once($_SERVER['DOCUMENT_ROOT']."/dashboard/TiendaOnlineTFG/PHPMailer-master/mail_Informacion.php");
include($_SERVER['DOCUMENT_ROOT']."/dashboard/TiendaOnlineTFG/php/config/sesiones.php");
class modeloPedidos {
    //Cre un conector que me permitirá llamar automáticamente a esta función cuando cree un objeto de una clase.
    public function __construct() {
        $this->productoDevuelto = array();
        $this->dbh = conectarse_parampdo("formulariotienda");
    }
    //Hago la inserción de los productos en la cesta del usuario
    public function agregarProductoCesta() {
        $producto_id = $_POST['id_producto'];
        $producto_cantidad = $_POST['cantidad'];
        //Comprobamos que existe la variable de sesión cesta
        if(isset($_SESSION['cesta']) && is_array($_SESSION['cesta'])) {
            if (array_key_exists($producto_id, $_SESSION['cesta'])) {
                //Si el producto ya está en la cesta, le añadimos la cantidad
                $_SESSION['cesta'][$producto_id] += $producto_cantidad;
            } else {
                //Si el producto no está en la cesta, lo añadimos
                $_SESSION['cesta'][$producto_id] = $producto_cantidad;
            }
        } else {
            //Si no hay productos en la cesta, creamos la variable de sesión y añadimos el producto
            $_SESSION['cesta'] = array($producto_id => $producto_cantidad);
        }
        array_filter($_POST);
    }
    //Hago una función para cargar la cesta
    public function cargarCesta() {
        if(isset($_SESSION['cesta']) && count($_SESSION['cesta']) > 0) {
            $cesta = $_SESSION['cesta'];
            $idsProductosCesta = implode(',', array_fill(0, count($cesta), '?'));
            $stmt = $this->dbh->prepare('SELECT * FROM producto WHERE id_producto IN (' . $idsProductosCesta . ')');
            $stmt->execute(array_keys($cesta));
            $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (empty($productos)){//si esta vacio damos error
                return array();
                exit;
            }else{
                return $productos;
            }
        } else {
            return array();
        }
    }
    //Hago una función para modificar productos de la cesta
    public function modificarProductoCesta() {
        $producto_id = $_POST['id_producto'];
        $producto_cantidad = (int)$_POST['cantidad'];
        // Comprobamos que existe la variable de sesión cesta
        if(isset($_SESSION['cesta']) && is_array($_SESSION['cesta'])) {
            if ($producto_cantidad === 0) {
                // Si la cantidad es 0, eliminamos el producto de la cesta
                unset($_SESSION['cesta'][$producto_id]);
            } else {
                // Modificamos la cantidad del producto
                $_SESSION['cesta'][$producto_id] = $producto_cantidad;
            }
        }
        array_filter($_POST);
    }
    //Hago una función para crear el pedido
    public function crearPedido() {
        $dbh = conectarse_parampdo("formulariotienda");
        $id_usuario = $_SESSION['usuario'];
        $id_direccion = $_GET['id_direccion'];
        $id_tarjeta= $_GET['id_tarjeta'];
        $fecha_entrega = date('Y-m-d', strtotime("+4 day"));
        $cesta = $_SESSION['cesta'];
        
        $numero_pedido = rand();
        $fecha_pedido = date('Y-m-d');
        $dbh->beginTransaction();
        $insertPedido=$dbh->prepare("INSERT INTO pedidos (numeroPedido,fechaPedido,fechaEntrega,usuario_id,direcciones_id,tarjeta_id) 
        VALUE (:numeroPedido,:fechaPedido,:fechaEntrega,:usuario_id,:direcciones_id,:tarjeta_id)");
        $insertPedido->bindParam(':numeroPedido', $numero_pedido);
        $insertPedido->bindParam(':fechaPedido', $fecha_pedido);
        $insertPedido->bindParam(':fechaEntrega', $fecha_entrega);
        $insertPedido->bindParam(':usuario_id', $id_usuario);
        $insertPedido->bindParam(':direcciones_id', $id_direccion);
        $insertPedido->bindParam(':tarjeta_id', $id_tarjeta);
        $insertPedido->execute();
        $id_pedido = $dbh->lastInsertId();
        $dbh->commit();
        if($dbh) {
            $resultado = "";
            // Hacemos un string con cada producto para insertar en la BBDD
            foreach(array_keys($cesta) as $key => $producto) {
                $cantidad = $cesta[$producto];
                if($key === 0) {
                    $resultado = $resultado . "(".$cantidad.",".$id_pedido.",".$producto.")";
                } else {
                    $resultado = $resultado . ",(".$cantidad.",".$id_pedido.",".$producto.")";
                }
            }
            $dbh->beginTransaction();
            $insertProductos=$dbh->prepare("INSERT INTO pedidos_productos (cantidad,pedidos_id,productos_id) 
            VALUES $resultado");
            $insertProductos->execute();
            $dbh->commit();
            if($dbh) {
                $enviarEmail = new enviarEmail();
                $enviarEmail->enviarDatosPedido($numero_pedido, $fecha_entrega);
            }
            $_SESSION['cesta'] = null;
        }
    }
    //Hago una función para mostrar los pedidos de un usuario
    public function mostrarPedidos(){
        $id_usuario = $_SESSION['usuario'];
        $mostrarPedidos=$this->dbh->prepare("SELECT *, JSON_ARRAYAGG(json_object(
            'cantidad', pp.cantidad,
            'productos_id', pp.productos_id,
            'productos_nombre', t.nombre
        )) AS pedidosProd FROM pedidos p inner join pedidos_productos pp on p.id_pedidos = pp.pedidos_id inner join producto t on pp.productos_id = t.id_producto where usuario_id =$id_usuario group by p.id_pedidos order by p.fechaPedido;");
        $mostrarPedidos->execute();
        $estadoPedido= $mostrarPedidos->fetchAll(PDO::FETCH_OBJ);
        if (!empty($estadoPedido)){
            foreach ($estadoPedido as $res)
        {
            $this->productoDevuelto[]=$res;  //si no, le decimos que meta los datosdentro de ese array
        }
            return $this->productoDevuelto;   // devolvemos ese array
            $this->dbh=null;
        } 
    }
    //Hago una función para mostrar los pedidos de un usuario en el perfil del administrador
    public function mostrarTodosPedidos(){
        $id_usuario = $_SESSION['usuario'];
        $mostrarPedidos=$this->dbh->prepare("SELECT *, JSON_ARRAYAGG(json_object(
            'cantidad', pp.cantidad,
            'productos_id', pp.productos_id,
            'productos_nombre', t.nombre,
            'nombre', u.nombre
        )) AS pedidosProd FROM pedidos p inner join pedidos_productos pp on p.id_pedidos = pp.pedidos_id inner join producto t on pp.productos_id = t.id_producto inner join usuarios u on p.usuario_id = u.id_usuarios  group by p.id_pedidos order by p.fechaPedido;");
        $mostrarPedidos->execute();
        $estadoPedido= $mostrarPedidos->fetchAll(PDO::FETCH_OBJ);
        if (!empty($estadoPedido)){
            foreach ($estadoPedido as $res)
        {
            $this->productoDevuelto[]=$res;  //si no, le decimos que meta los datosdentro de ese array
        }
            return $this->productoDevuelto;   // devolvemos ese array
            $this->dbh=null;
        } 
    }

    //Hago una función para actualizar la información del pedido
    public function pedidoCancelado() {
        if(isset($_GET['numeroPedido'])) {
            $idUser = $_SESSION['usuario'];
            $numero_pedido = $_GET['numeroPedido'];
            $conect= conectarse_parampdo("formulariotienda");
            $conect->beginTransaction();
            $pdoQuery_run = $conect->prepare("UPDATE pedidos SET cancelado=1 WHERE numeroPedido=$numero_pedido and usuario_id=$idUser;");
            $conect->commit();
            if($conect) {
                $enviarEmail = new enviarEmail();
                $enviarEmail->emailPedidoCancelado($numero_pedido);
            }
            
            if($pdoQuery_run->execute()) {
                header("location:../controlador/buscarPedidos.php");
        
            } else {
                header("location:../vista/error.php");
            }
        } else {
            header("location:../vista/error.php");
            }
    }
    //Hago una función para registrar método de pago
    public function registrarTarjeta() {
        $validaciones = new validaciones();
        if(isset($_SESSION['usuario'])) {
            $idP=$_SESSION['usuario'];
            $dbh = conectarse_parampdo("formulariotienda");
            $nombreTitular=trim($_POST['nombreTitular']);
            $numeroTarjeta=trim($_POST['numeroTarjeta']);
            $fechaCaducidad=trim($_POST['fechaCaducidad']);
            $codigoSeguridad=trim($_POST['codigoSeguridad']);

            if (empty($nombreTitular)){
                $mensajeErrorTarjeta = "El nombre del titular no puede estar vacio.";
                return $mensajeErrorTarjeta;
            }else if (!$validaciones->existeTarjeta($numeroTarjeta)){
                $mensajeErrorTarjeta = "El formato de la tarjeta no es correcto, o ya está registrado, favor verificar.";
                return $mensajeErrorTarjeta;
            } else if (!$validaciones->fechaCaducidad($fechaCaducidad)){
                echo $fechaCaducidad;
                $mensajeErrorTarjeta = "La fecha de caducidad debe ser  tener este formato 12/26.";
                return $mensajeErrorTarjeta;
            } else if (!$validaciones->codigoSeguridad($codigoSeguridad)){
                $mensajeErrorTarjeta = "El código de seguridad debe tener 3 digitos.";
                return $mensajeErrorTarjeta;
            }  else {
                $dbh->beginTransaction();
                $insertTarjeta=$this->dbh->prepare("INSERT INTO tarjetas (nombreTitular,numeroTarjeta,fechaCaducidad,codigoSeguridad,usuario_id) 
                VALUE (:nombreTitular,:numeroTarjeta,:fechaCaducidad,:codigoSeguridad,:usuario_id)");
                $insertTarjeta->bindParam(':nombreTitular', $nombreTitular);
                $insertTarjeta->bindParam(':numeroTarjeta', $numeroTarjeta);
                $insertTarjeta->bindParam(':fechaCaducidad', $fechaCaducidad);
                $insertTarjeta->bindParam(':codigoSeguridad', $codigoSeguridad);
                $insertTarjeta->bindParam(':usuario_id', $idP);
                $insertTarjeta->execute();
                $dbh->commit();
            }
            if(!$dbh) {
                array_filter($_POST);
                echo "No se ha podido guardar los datos";
            } 
        }
    }
    //Hago una función para listar todas las tarjetas registradas
    public function buscarTarjetas() {
        if(isset($_SESSION['usuario'])) {
        $idP=$_SESSION['usuario'];
        $dbh = conectarse_parampdo("formulariotienda");
        $stmt=$this->dbh-> prepare("SELECT * FROM tarjetas where usuario_id='$idP'");
        $stmt->execute();
        $row= $stmt->fetchAll(PDO::FETCH_OBJ);
        if (!empty($row)){
            foreach ($row as $res)
        {
            $this->productoDevuelto[]=$res;  //si no, le decimos que meta los datosdentro de ese array
        }
            return $this->productoDevuelto;   // devolvemos ese array
            $this->dbh=null;
        }
        }
    }

    //Hago una función para borrar las tarjetas registradas, caso encuentre alguna tarjeta hará el borrado
    public function tarjetaBorrada() {
        if(isset($_GET['idTarjeta'])) {
            $idUser = $_SESSION['usuario'];
            $idP = $_GET['idTarjeta'];
            $conect= conectarse_parampdo("formulariotienda");
            $conect->beginTransaction();
            $pdoQuery_run = $this->dbh->prepare("DELETE FROM tarjetas WHERE id_tarjeta=$idP and usuario_id=$idUser;");
            $conect->commit();
            if ($pdoQuery_run->execute()) {
                //Finalizando el borrado lo redirecciono a está página
                header("location:../controlador/buscarTarjetas.php");

            } else {
                echo "No se ha podido borrar los datos";
            }
            $pdoQuery_run->execute();
        }
    }
}
?>

