<?php  
require "../../includes/funciones.php";
traerInclude("header");
//ver si esta autenticado
$auth = verAuth();
if(!$auth){
  header("Location:/prueba/index.php");
  }
//validar la url y que sea un id valido
$id = $_GET["id"]; // en la posicion id ya que le enviamos con esa variable
$id = filter_var($id,FILTER_VALIDATE_INT); //ese mismo id anterior lo validamos para que sea si o si un entero,esto lo pasa a un entero
if(!$id){ // si no, es decir si es false o no existe,entonces
header("Location: /prueba/admin"); // que me rediriga al admin
}
//traer la base de datos
require "../../includes/config/database.php";
$db = conectarDb();

//traer y hacer una consulta a la db con una id
$sqlid = "SELECT * FROM propiedades WHERE id = $id ;";
$propiedadId = $db->query($sqlid);
$propiedad = $propiedadId->fetch_assoc(); // en ves de while lo haremos asi,ya que solo traera uno solo


//arreglo errores global para que tambien el html lo use
$errores=[];
//variables globales para el html
$titulo = $propiedad["titulo"];
  $precio = $propiedad["precio"];
  $descripcion = $propiedad["descripcion"];
  $habitaciones = $propiedad["habitaciones"];
  $wc = $propiedad["wc"];
  $estacionamiento = $propiedad["estacionamiento"];
  $vendedorId = $propiedad["vendedorId"];
  $imagen = $propiedad["imagen"];

//traer de la base de datos,los vendedores
$consultavendedores = "SELECT * FROM vendedores;";
$vendedores = $db->query($consultavendedores);

//recordar que este solo se activa cuando le dimos click al boton submit
if($_SERVER["REQUEST_METHOD"] ==="POST"){
   echo "<pre>";
   var_dump($_POST);
   echo "</pre>";
   //validar un valor con filter de saneamiento y validacion
  // $valor = "hola";
  //  $result = filter_var($valor,FILTER_UNSAFE_RAW); //limpia para que sea un string
    //$result = filter_var($valor,FILTER_VALIDATE_INT); //valida si es un entero
   //var_dump($result);
  //crear variables para traer cada valor del post
  $titulo = $db->real_escape_string($_POST["titulo"]);
  $precio = $db->real_escape_string($_POST["precio"]);
  $descripcion = $db->real_escape_string($_POST['descripcion']);
  $habitaciones = $db->real_escape_string($_POST["habitaciones"]);
  $wc = $db->real_escape_string($_POST["wc"]);
  $estacionamiento = $db->real_escape_string($_POST["estacionamiento"]);
  $creado = date("Y/m/d");
  $vendedorId =$db->real_escape_string( $_POST["vendedorId"]);

//especificaciones de la imagen
$imagen = $_FILES["imagen"];
//verificar que cada input no este vacio
if(!$titulo){
  $errores[] = "El titulo es obligatorio"; //ese [] es como un push
}
if(!$precio){
  $errores[] = "El precio es obligatorio"; 
}
if(strlen($descripcion)<50){
  $errores[] = "La descripcion es obligatoria y minimo necesita 50 caracteres"; 
}
if(!$habitaciones){
  $errores[] = "El numero de habitaciones es obligatorio"; 
}
if(!$wc){
  $errores[] = "El numero de baños es obligatorio"; 
}
if(!$estacionamiento){
  $errores[] = "El numero de estacionamiento es obligatorio"; 
}
if(!$vendedorId){
  $errores[] = "Elije un vendedor"; 
}
// if(!$imagen["name"]|| $imagen["error"]){
//   $errores[] = "La imagen es obligatoria";
// }
//verificar tambien que esa imagen no supere los 100kb
$pesoMaximo = 100 * 1000;
if($imagen["size"]>$pesoMaximo){
$errores[]= "La imagen es muy pesada";
}

  if(empty($errores)){ //si errores esta vacio,es decir no tiene ningun valor en su array entonces

//crear una carpeta en la raiz del proyecto prueba y enviar el archivo que esta en el imagen["tmp_name"]- es un archivo temporal
$carpetaImagenes="../../imagenes/";
if(!is_dir($carpetaImagenes)){ //is dir verifica si existe el directorio-seria si no existe el directorio entonces que lo cree
  mkdir($carpetaImagenes);//este creara el directorio,pero este se ejcutara cada vez que se envia el form,para eso se crea un if especial
}
//crear una variable nombreImagen vacia para pobnerlo en el update de acuerdo al if
$nombreImagen="";
if($imagen["name"]){ // si vemos en el apartado de imagenes,si imagen [name] existe,es decir el usuario agrego una imagen ,entonces
 unlink($carpetaImagenes.$propiedad["imagen"]); //eliminaremos la imagen anterior que esta en el directorio
 //y crearemos la nueva imagen,añadiendo nuevo nombre que ira al update
 $nombreImagen = md5(uniqid(rand(),true)).".jpg"; 
 //y tambiien añadiendolo en el directorio
 move_uploaded_file($imagen["tmp_name"],$carpetaImagenes.$nombreImagen); // y lo concatenamos a la ruta de carpeta
}else{ // si no existe,es decir el usuario no eligio un archivo
//entonces enviaremos el nombre de la imagen que tenemos actualmente en la db
$nombreImagen = $propiedad["imagen"];
}

    //hacer la consulta con update
    $sql = "UPDATE propiedades SET titulo ='$titulo',precio ='$precio',imagen = '$nombreImagen',descripcion ='${descripcion}',habitaciones =$habitaciones,wc =$wc,estacionamiento =$estacionamiento,vendedorId =$vendedorId WHERE id = $id;";
    
    $consulta = $db->query($sql);
    if($consulta){
      echo "siuuuuuuu";
      header("Location: /prueba/admin?resultado=2"); //se puede añadir un ? y despues una var y su valor para luego leerlo con el $_get- actualizar a 2 para mandarlo al admin
    }
  } //mostrar cada error dentro de un div debajo del boton volver
    // echo "<pre>";
    // var_dump($errores);
   
  
}

//ver con vardump el post y el metodo que esta disponible
// echo "<pre>";
// var_dump($_POST);
// echo "</pre>";

// echo "<pre>";
// var_dump($_SERVER["REQUEST_METHOD"]);
// echo "</pre>";
?>

<main class="contenedor">
  <h1>Actualizar</h1>
  <a href="/prueba/admin" class="boton boton-verde">Volver</a>
 
   <?php foreach($errores as $error){ ?>
      <div class="error"><?php echo $error?></div>
   <?php } ?>
   
  <form class="formulario" method="POST" enctype="multipart/form-data">
    <fieldset>
      <legend>Información General</legend>
      <label for="titulo">Titulo:</label>
      <input type="text" id="titulo" name="titulo" placeholder="Titulo Propiedad" value="<?php echo $titulo ?>">

      <label for="precio">Precio:</label>
      <input type="number" id="precio" name="precio" placeholder="Precio Propiedad" value="<?php echo $precio ?>">

      <label for="imagen">Imagen:</label>
      <input type="file" id="imagen" accept=".jpg" name="imagen">
      <img src="/prueba/imagenes/<?php echo $imagen ?>" alt="" class="imagen-corta">

      <label for="descripcion">Descripción:</label>
      <textarea name="descripcion" id="descripcion" cols="30" rows="10"><?php echo $descripcion?></textarea>

    </fieldset>

    <fieldset>
      <legend>Información de Propiedad</legend>
      <label for="habitaciones">Habitaciones:</label>
      <input type="number" id="habitaciones" name="habitaciones" placeholder="Ejm:2" min="1" max="9" value="<?php echo $habitaciones ?>">

      <label for="baños">Baños:</label>
      <input type="number" name="wc" id="wc" placeholder="Ejm:2" min="1" max="9"value="<?php echo $wc ?>">

      <label for="estacionamiento">Estacionamiento:</label>
      <input type="number" name="estacionamiento" id="estacionamiento" placeholder="Ejm:2" min="1" max="9" value="<?php echo $estacionamiento ?>">
    </fieldset>

    <fieldset>
      <legend>Vendedor:</legend>
      <label for="">Vendedor:</label>
      <select name="vendedorId">
        <option value="">--Seleccione--</option>
        <?php  while ($vendedor = $vendedores->fetch_assoc()){ ?>
          <option <?php echo $vendedorId === $vendedor["id"]?"selected":""?> value=<?php echo $vendedor["id"]?>><?php echo $vendedor["nombre"]." ". $vendedor["apellido"]; ?></option>
        <?php } ?>
      </select>
    </fieldset>

    <button class="boton boton-verde" type="submit" value="Crear Propiedad">Enviar</button>
  </form>
</main>
<?php
traerInclude("footer")
?>