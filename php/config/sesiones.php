<?php
//Aqui hago un control de sesiones
if (session_status() !== PHP_SESSION_ACTIVE) session_start(); 
//Aquí hago un controle del SESSION_ID
$logueado = isset($_SESSION['session_id'])  && session_id() == $_SESSION['session_id'];
//Aquí creo una variable par almacenar el administrador
$administrador = isset($_SESSION['admin']) && $_SESSION['admin'] == 1;
?>