<?php
if(!isset($_SESSION)){ //si sesion existe ,recordar que sesion no va a existir si no has inciado sesion,si no sig, que no has inciado
session_start();
}
var_dump($_SESSION);
//verificar si esta logeado
$auth = $_SESSION["login"] ?? false;

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="stylesheet" href="/prueba/build/css/app.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <header class="header <?php echo $inicio? "inicio":"";?>">
    <div class="contenedor contenido__header">
      <div class="barra">
        <a href="" class="barra__link">
          <img src="/prueba/build/img/logo.svg" alt="">
        </a>
<div class="barra__burguer">
  <img src="/prueba/build/img/barras.svg" alt="">
</div>
<div class="nav__derecha">
  <img src="/prueba/build/img/dark-mode.svg" alt="" class="dark-mode">

  <nav class="nav">
    <a class="nav__link" href="nosotros.php">Nosotros</a>
    <a class="nav__link" href="anuncios.php">Anuncios</a>
    <a class="nav__link" href="blog.php">Blog</a>
    <a class="nav__link" href="contacto.php">Contacto</a>
    <?php if($auth){ ?>
      <a class="nav__link" href="/prueba/cerrar.php">Cerrar Sesion</a>
    <?php } ?>
 </nav>
</div>
      </div>
      <?php echo $inicio?"<h1>Venta de Casas y Departamentos Exclusivos de Lujo</h1>":""?>
    </div>
  </header>