<?php
  //Aqui hago la conexión a la base de datos
    function conectarse_parampdo($bd){
      
    $servername = "localhost";
    $username = "root";
    $password = "root";
  
    try {
        $conect = new PDO("mysql:host=$servername;dbname=$bd", $username, $password);
      // set the PDO error mode to exception
      $conect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        $conect->rollback();
        echo "la conexion ha fallado". $e->getMessage();
        exit;
  }
     return $conect;
  
  }

?>

