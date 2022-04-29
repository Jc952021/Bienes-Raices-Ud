<?php

session_start();
$_SESSION["login"] = []; //como es un arreglo vacio entonces se elimina todo de adentro
header("Location:/prueba/index.php");
?>