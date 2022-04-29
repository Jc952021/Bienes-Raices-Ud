<?php  
require "./includes/funciones.php";
traerInclude("header")
?>

  <div class="anuncios contenedor">
    <h2>Casas y Depas en Venta</h2>
    
    <?php  
    $limite = 10;
    include "./includes/templates/anuncios.php";
    ?>
    </div>


    <?php
traerInclude("header")
?>