<?php
class validaciones {
    //Cre un conector que me permitirá llamar automáticamente a esta función cuando cree un objeto de una clase.
    public function __construct() {
        $this->productoDevuelto = array();
        $this->dbh = conectarse_parampdo("formulariotienda");
    }

    //VALIDACIONES REGISTRO USUARIO
    //Hago una función para validar el e-mail y si existe en base de datos y formato adecuado
    public function existeEmail($email){
        $reg = '/^([0-9a-zA-Z]+[-._+&])*[0-9a-zA-Z]+@([-0-9a-zA-Z]+[.])+[a-zA-Z]{2,6}$/';
        if (preg_match($reg, $email)){
            $conect=conectarse_parampdo("formulariotienda");
            $stmt= $conect-> prepare('SELECT * FROM usuarios where email=:email');
            $stmt->bindParam(':email',$email);
            $stmt->execute();
            $row= $stmt->fetchAll(PDO::FETCH_OBJ);
            if (empty($row)){      
                return true;
                exit;
            } else {
                return false;
            }
        } else{
            return false;
        }
    }
    //Hago una función para validar el teléfono
    public function validarTelefono($telefono){
        if(strlen($telefono) === 9){
            return true;
        } else {
            return false;
        }
    }
    //Hago una función para validar el documento si es NIE o DNI
    public function validarDocumento($documento){
        $nifRegEx = '/^[0-9]{8}[A-Z]$/i';
        $nieRegEx = '/^[XYZ][0-9]{7}[A-Z]$/i';
        if (preg_match($nifRegEx, $documento) || preg_match($nieRegEx, $documento)){
            $conect=conectarse_parampdo("formulariotienda");
            $stmt= $conect-> prepare('SELECT * FROM usuarios where documento=:documento');
            $stmt->bindParam(':documento',$documento);
            $stmt->execute();
            $row= $stmt->fetchAll(PDO::FETCH_OBJ);
            if (empty($row)){      
                return true;
                exit;
            } else {
                return false;
            }
        } else{
            return false;
        }
    }
    //Hago una función para validar la contraseña
    public function validarPassword($password){
        $passwordRegEx = '/(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{6,12}/';
        if (preg_match($passwordRegEx, $password)){
           return true;
        } else{
            return false;
        }
    }
    //Hago una función para validar el código postal
    public function validarCodigoPostal($codigopostal){
        $codigoPostalRegEx = '/^(?:0[1-9]|[1-4]\d|5[0-2])\d{3}$/';
        if (preg_match($codigoPostalRegEx, $codigopostal)){
           return true;
        } else{
            return false;
        }
    }

    //VALIDACIONES MÉTODO DE PAGO
    
    public function existeTarjeta($numeroTarjeta){
        $regex = '/^(?:4[0-9]{12}(?:[0-9]{3})?|5[1-5][0-9]{14}|3[47][0-9]{13}|6(?:011|5[0-9][0-9])[0-9]{12})$/';
        if (preg_match($regex, $numeroTarjeta)){
            $conect=conectarse_parampdo("formulariotienda");
            $stmt= $conect-> prepare('SELECT * FROM tarjetas where numeroTarjeta=:numeroTarjeta');
            $stmt->bindParam(':numeroTarjeta',$numeroTarjeta);
            $stmt->execute();
            $row= $stmt->fetchAll(PDO::FETCH_OBJ);
            if (empty($row)){      
                return true;
                exit;
            } else {
                return false;
            }
        } else{
            return false;
        }
    }
    public function fechaCaducidad($fechaCaducidad){
        if ((strlen($_POST['fechaCaducidad']) === 5) && substr($fechaCaducidad, 2, 1) === "/"){   
                return true;
            } else {
                return false;
            }
    }

    public function codigoSeguridad($codigoSeguridad){
        if (strlen($_POST['codigoSeguridad']) === 3){      
                return true;
            } else {
                return false;
            }
    }
}
?>