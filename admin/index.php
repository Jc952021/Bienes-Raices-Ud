<?php  
require "../includes/funciones.php";
$auth = verAuth();
//var_dump($_SESSION);
if(!$auth){
header("Location:/prueba/index.php");
}

traerInclude("header");
//ver si ha iniciado sesion, con la nueva funcion

//llamar a a la base de datos
require "../includes/config/database.php";
$db = conectarDb();

//consultar la base de datos
$sql = "SELECT * FROM propiedades;";
$consulta = $db->query($sql);

//consultar al server requestmethod para ver si existe
if($_SERVER["REQUEST_METHOD"] === "POST"){
  echo "<pre>";
  var_dump($_POST);
  echo "</pre>";

  $id = $_POST["id"]; //traer el id del post
  //validar ese id para que sea entero y no tenga un string
  $id = filter_var($id,FILTER_VALIDATE_INT);
  if($id){
    //eliminar la imagen del proyecto,haciendo una consulta select a la db depende del id
    $sqlImagen = "SELECT imagen FROM propiedades WHERE id = $id";
$consultaImagen = $db->query($sqlImagen);
$propiedad = $consultaImagen->fetch_assoc();
//ya teniendo la propiedad que es un arreglo  asociativo,acceder a su imagen para eliminarlo del proyecto
unlink("../imagenes/". $propiedad['imagen']);
    //hacer una consulta para eliminar segun el id
    $sqlEliminar = "DELETE FROM propiedades WHERE id = $id";
    $consultaEliminar = $db->query($sqlEliminar);

    if($consultaEliminar){//si es correcto la consulta que rediriga al mismo admin,con resultado 3
      header( "Location:/prueba/admin?resultado=3");
    }
  }
}

$resultado = $_GET["resultado"] ?? null; //si enviamos al comienzo al usuario aca sin el resultado saldra un error ya que no existe,para eso php agrego un ?? que sig. si no existe que agrege el valor que puse 
?>
<main class="contenedor">
  <h1>Administrador</h1>
  <!-- el de abajo esta bien si solo recibimos un valor pero recibiremos varias -->
<!-- /echo intval($resultado) === 1 ? '<div class="exito">Datos enviados correctamente</div>':null con intval transforma una variable a un entero porque el get resultado viene en un string -->
<?php 
   if(intval($resultado) ===1){?>
    <p class="exito">Datos Creados Correctamente</p>
<?php } elseif(intval($resultado)===2){ ?>
<p class="exito">Datos Actualizados Correctamente</p>
<?php } elseif(intval($resultado)===3){ ?>
<p class="exito">Datos Eliminados Correctamente</p>
<?php } ?>

  <a href="/prueba/admin/propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>
<!-- tabla -->
<table class="propiedades">
  <thead>
    <tr>
      <th>Id</th>
      <th>Título</th>
      <th>Imagen</th>
      <th>Precio</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody>
    <?php while($propiedad=$consulta->fetch_assoc()) {?>
    <tr>
      <td><?php echo $propiedad["id"]; ?></td>
      <td><?php echo $propiedad["titulo"]; ?></td>
      <td>
        <img class="imagen-tabla" src="/prueba/imagenes/<?php echo $propiedad["imagen"]; ?>" alt="">
      </td>
      <td>$<?php echo $propiedad["precio"]; ?></td>
      <td>
        <form method="POST" class="w-100">
          <input type="hidden" value="<?php echo $propiedad["id"]; ?>" name="id">
          <button type="submit" class="boton-rojo-block">Eliminar</button>
        </form>
        <a href="/prueba/admin/propiedades/actualizar.php?id=<?php echo $propiedad["id"];?>" class="boton-amarillo-block">Actualizar</a>
      </td>
    </tr>
    <?php } ?>
  </tbody>
</table>

</main>

<?php
//cerrar la conexion
$db->close();
traerInclude("footer")
?>
