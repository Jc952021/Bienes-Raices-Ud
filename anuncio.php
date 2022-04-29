<?php  
require "./includes/funciones.php";
traerInclude("header");
//traer la id con el get y validarlo
$id = $_GET["id"];
$id = filter_var($id,FILTER_VALIDATE_INT);

if(!$id){
header("Location: /prueba/admin");
}

//conectar la db
require "includes/config/database.php";
$db = conectarDb();
$sql = "SELECT * FROM propiedades WHERE id = $id;";
$consulta = $db->query($sql);
//de la consulta,si puso un id valido este tiene una propiedad para ver si existe
if($consulta->num_rows === 0){
  header("Location: /prueba/admin");
}
$propiedad = $consulta->fetch_assoc();
?>
<div class="anuncio-casa contenedor contenido-centrado">
  <h2><?php echo $propiedad["titulo"]; ?></h2>
  <picture>
    <img src="/prueba/imagenes/<?php echo $propiedad["imagen"]; ?>" alt="">
  </picture>
  <p class="precio">$<?php echo $propiedad["precio"]; ?></p>
  <ul class="anuncio__iconos">
    <li class="anuncio__icono">
      <img src="./build/img/icono_wc.svg" alt="">
      <p><?php echo $propiedad["wc"]; ?></p>
    </li>
    <li class="anuncio__icono">
      <img src="./build/img/icono_estacionamiento.svg " alt="">
      <p><?php echo $propiedad["estacionamiento"]; ?></p>
    </li>
    <li class="anuncio__icono">
      <img src="./build/img/icono_dormitorio.svg" alt="">
      <p><?php echo $propiedad["habitaciones"]; ?></p>
    </li>
  </ul>
  <p><?php echo $propiedad["descripcion"]; ?></p>
</div>


<?php
traerInclude("footer");
//desconectar de la db
$db->close();
?>