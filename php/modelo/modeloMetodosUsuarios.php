<?php
require_once ("../config/conexion.php");
require_once(__DIR__."/validaciones.php");
include('../config/sesiones.php');
class modeloUsuarios {
    //Cre un conector que me permitirá llamar automáticamente a esta función cuando cree un objeto de una clase.
    public function __construct() {
        $this->productoDevuelto = array();
        $this->dbh = conectarse_parampdo("formulariotienda");
    }
    //Hago una función para registrar usuario en la base de datos
    function registrarUsuario($isAdmin){
            $validaciones = new validaciones();
            $conect=conectarse_parampdo("formulariotienda");
            $nombre=trim($_POST['nombre1']);
            $apellidos=trim($_POST['apellidos1']);
            $telefono=trim($_POST['telefono']);
            $documento=trim($_POST['documento']);
            $email=trim($_POST['correo']);
            $password=trim($_POST['contrasena']);
            $admin = $isAdmin ? 1 : 0;
            $conect->beginTransaction();
            //Verifico si nombre y apellidos no están en blanco, sino envío un mensaje de error
            if (empty($nombre) || (empty($apellidos))){
                echo '<script>';
                echo "ohSnap('Los campos nombre y apellidos no pueden estar vacios', {color: 'red'});";
                echo '</script>'; 
            //Verifico si el teléfono tiene el formato adecuado, sino envío un mensaje de error
            } else if(!$validaciones->validarTelefono($telefono)) {
                echo '<script>';
                echo "ohSnap('El telefono debe de tener 9 números', {color: 'red'});";
                echo '</script>';
            //Verifico si el documento tiene el formato adecuado, sino envío un mensaje de error
            } else if(!$validaciones->validarDocumento($documento)) {
                echo '<script>';
                echo "ohSnap('El documento introducido no es correcto, o ya está registrado, favor verificar.', {color: 'red'});";
                echo '</script>';
            //Verifico si existe e-mail y si cumple con el formato adecuado, sino envío un mensaje de error
            } else if(!$validaciones->existeEmail($email)) { 
                echo '<script>';
                echo "ohSnap('El email no tiene el formato esperado o ya está registrado, favor verificar.', {color: 'red'});";
                echo '</script>';
            //Verifico si la contraseña tiene el formato adecuado, sino envío un mensaje de error
            } else if(!$validaciones->validarPassword($password)) {
                echo '<script>';
                echo "ohSnap('La contraseña debe tener entre 6 y 12 caracteres al menos una letra mayúscula, no tener espacios en blanco y al menos un caracter especial', {color: 'red'});";
                echo '</script>';
            } else {
                //Caso cumpla todos los requisitos hago el registro
                $consulta= $conect->prepare("INSERT INTO usuarios (nombre,apellidos,telefono,documento,email,password,admin) VALUE (:nombre1,:apellidos1,:telefono,:documento,:email,:contrasena,:admin);");
                $consulta->bindParam(':nombre1', $nombre);
                $consulta->bindParam(':apellidos1', $apellidos);
                $consulta->bindParam(':telefono', $telefono);
                $consulta->bindParam(':documento', $documento);
                $consulta->bindParam(':email', $email);
                $consulta->bindParam(':contrasena', $password);
                $consulta->bindParam(':admin', $admin);
                $conect->commit();
            if($consulta->execute()) {
                $enviarEmail = new enviarEmail();
                $enviarEmail->enviarAltaRegistro($nombre,$email);
                header("location:../controlador/loginUsuario.php");
            } else {
            echo "No se ha podido guardar los datos";
            }
        }
    }

    //Aqui hago una función para mostrar los datos de usuario
    public function buscar_Usuario(){
        $id=$_SESSION['id'];
        $stmt=$this->dbh-> prepare('SELECT * FROM usuarios where id_usuarios=:id');
        $stmt->bindParam(':id',$id);
        $stmt->execute();
        $row= $stmt->fetch(PDO::FETCH_ASSOC);
            if (empty($row)){
                echo "No existe ningun usuario.";
                exit;
            }else{
                return $row;
                $this->dbh=null;
        }
    }

    //Aqui hago una función para mostrar todos los usuarios en el perfil del administrador
    public function buscar_All_Usuarios(){
        $stmt=$this->dbh-> prepare('SELECT * FROM usuarios where admin=0');
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

    //Hago una función para editar usuario, aquí hago un recorrido en la base de datos para buscar los usuarios en la Id de sessión
    public function editarUsuario() {
        if(isset($_SESSION['usuario'])) {
            $idP=$_SESSION['usuario'];
            $sentencia = $this->dbh->prepare("SELECT * FROM usuarios where id_usuarios=$idP;");
            $sentencia->execute();
            $usuario = $sentencia->fetch(PDO::FETCH_ASSOC);

            return $usuario;
            
            $this->dbh=null;
        } else {
            header("location:../vista/login.php");
        }
    }
    
    //Hago una función para actualizar datos del usuario, caso encuentre le proporciono la opción de actualizar la información
    public function datosAtualizado() {
        if(isset($_SESSION['usuario'])) {
            $conect= conectarse_parampdo("formulariotienda");
            
            $nombre=trim($_POST['nombre']);
            $apellidos=trim($_POST['apellidos']);
            $telefono=trim($_POST['telefono']);
            $email=trim($_POST['email']);
            $password=trim($_POST['contrasena']);
            $idP=$_SESSION['usuario'];
            
            $conect->beginTransaction();
            $pdoQuery_run = $conect->prepare("UPDATE usuarios SET nombre=:nombre, apellidos =:apellidos, telefono=:telefono, email=:email, password=:contrasena WHERE id_usuarios=:idP;");
            $pdoQuery_run->bindParam(':nombre',$nombre, PDO::PARAM_STR);
            $pdoQuery_run->bindParam(':apellidos',$apellidos, PDO::PARAM_STR);
            $pdoQuery_run->bindParam(':telefono',$telefono, PDO::PARAM_STR);
            $pdoQuery_run->bindParam(':email',$email, PDO::PARAM_STR);
            $pdoQuery_run->bindParam(':contrasena',$password, PDO::PARAM_STR);
            $pdoQuery_run->bindParam(':idP',$idP, PDO::PARAM_INT);
            $conect->commit();
        
            if($pdoQuery_run->execute()) {
                header("location:../controlador/buscarUsuario.php");
        
            } else {
                echo "No se ha podido guardar los datos";
            }
        } else {
            header("location:../vista/login.php");
        }
    }
    //Hago una función para borrar usuario, caso encuentre algun usuario hará el borrado
    public function usuarioDeletado() {
        if(isset($_SESSION['usuario'])) {
            $conect= conectarse_parampdo("formulariotienda");
            $idP=$_SESSION['usuario'];
            $conect->beginTransaction();
            $pdoQuery_run = $this->dbh->prepare("DELETE FROM usuarios WHERE id_usuarios=$idP;");
            $conect->commit();

        if ($pdoQuery_run->execute()) {
            header("location:../controlador/logOutUsuario.php");

        } else {
            echo "No se ha podido borrar los datos";
        }
            $pdoQuery_run->execute();
        }
    }

    //Hago una función para borrar usuario en el perfil del adminstrado, caso encuentre alguna hará el borrado
    public function UsuarioDeletadoBD() {
        if(isset($_GET['idUsuariosBD'])) {
            $idP = $_GET['idUsuariosBD'];
            $conect= conectarse_parampdo("formulariotienda");
            $conect->beginTransaction();
            $pdoQuery_run = $this->dbh->prepare("DELETE FROM usuarios WHERE id_usuarios=$idP;");
            $conect->commit();
            if ($pdoQuery_run->execute()) {
                header("location:../controlador/buscarUsuarioBD.php");

            } else {
                echo "No se ha podido borrar los datos";
            }
            $pdoQuery_run->execute();
        }
    }

    //Aquí hago una función para restablecer la contraseña
    public function editar_pass() {
        $token = $_GET['id'];
        $contrasena1=$_POST['contrasena1'];
        $contrasena2=$_POST['contrasena2'];
        
        $query = $this->dbh->prepare("SELECT id_usuario, expiracion from newpass where token=:token");
        $query->bindParam(":token", $token);
        $query->execute();
        $user = $query->fetch(PDO::FETCH_ASSOC);

        if($user['expiracion'] < date("Y-m-d H:m:s")) {
            echo "El link ha caducado!";
        } else if ($contrasena1 != $contrasena2) {//si son diferentes pinta el error
            $mensajeError = "Las contraseñas no coinciden";
            return $mensajeError;
        }else{
            $userId = $user['id_usuario'];
            $pdoQuery_run = $this->dbh->prepare("UPDATE usuarios SET password=:contrasena2 WHERE id_usuarios=:id_usuario");
            $pdoQuery_run->bindParam(":id_usuario", $userId);
            $pdoQuery_run->bindParam(":contrasena2", $contrasena2);
            if($pdoQuery_run->execute()) {
                header("location:../vista/login.php");
            } else {
                echo "No se ha podido guardar los datos";
            }
        }
    }

    public function login() {
        //Aqui hago una verificación en base de datos se ya existe el usuario, si caso positivo accedemos a su sessión
        if (isset($_REQUEST["submit"])) {
            $conect=conectarse_parampdo("formulariotienda");
            $u = $_POST['t1'];
            $p = $_POST['t2'];

            $conect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query = $conect->prepare("SELECT * FROM usuarios WHERE email = :u AND password = :p");
            $query->bindParam(":u", $u);
            $query->bindParam(":p", $p);
            $query->execute();
            $usuario = $query->fetch(PDO::FETCH_ASSOC);
        if ($usuario) {
            $_SESSION['usuario'] = $usuario["id_usuarios"];
            $_SESSION['id'] = $usuario["id_usuarios"];
            $_SESSION['nombre'] = $usuario["nombre"];
            $_SESSION['admin'] = $usuario["admin"];
            $_SESSION['session_id'] = session_id();
            header("location:../../index.php");
        }
            else {
                session_unset();
                session_destroy();
                header("location:../../index.php");
            }
        }
    }
    //Aquí hago una función para cerrar sessión
    public function logOut() {
        //Finaliza la sesión
        session_start();
        session_unset();
        session_destroy();
        $_SESSION['cesta'];
        header("location:../../index.php");
    }
}
?>