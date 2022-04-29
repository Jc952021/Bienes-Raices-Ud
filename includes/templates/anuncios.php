<?php 
//conectar la db ,ya que esto esta en el index y este es su hijo,entonces usar el require simulando que estas en el index principal
require "includes/config/database.php";
$db = conectarDb();
$sql = "SELECT * FROM propiedades LIMIT $limite;";
$consulta = $db->query($sql);


?>



<div class="contenedor__anuncios">
  <!-- por cada propiedad que muestre el anuncio -->
  <?php 
  while ($propiedad = $consulta->fetch_assoc()) {?>

  <div class="anuncio">
    
      <img src="/prueba/imagenes/<?php echo $propiedad["imagen"]; ?>" alt="">
    
    <div class="anuncio__contenedor">
      <h3><?php echo $propiedad["titulo"]; ?></h3>
      <p>
        <?php echo $propiedad["descripcion"]?></p>
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
      <a href="anuncio.php?id=<?php echo $propiedad["id"]?>" class="boton-amarillo-block">Ver Propiedad</a>
    </div>
  </div>
  <?php } ?>
</div>

<?php
//desconectar de la db
$db->close();
?>