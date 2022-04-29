<?php
require "./includes/funciones.php";
traerInclude("header");
//db
require "./includes/config/database.php";
$db = conectarDb();

$errores = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $email = $db->real_escape_string(filter_var($_POST["email"], FILTER_VALIDATE_EMAIL));
  //var_dump($email);
  $password = $db->real_escape_string($_POST["password"]);

  if (!$email) {
    $errores[] = "El email es obligatorio o no es válido";
  }

  if (!$password) {
    $errores[] = "Colocar un password válido";
  }
  //si errores esta vacio
  if (empty($errores)) {
    $sql = "SELECT * FROM usuarios WHERE email = '$email' "; 
//tenia que poner entre comillas ya que daba un error
//no se porque, ya que el email de por si es un string
    $consulta = $db->query($sql);
//como consulta es un objeto, se accede a su numrows,si este es 0 entonces no existe 
//lo que busco el usuario
    if ($consulta->num_rows) { //existe entonces encontro un email identico
      //hacer un fect a la consulta para traer el email y el password
      $usuario = $consulta->fetch_assoc();

      $auth = password_verify($password, $usuario["password"]);

      if ($auth) { //si existe entonces iniciamos sesion
      session_start();

      $_SESSION["usuario"] = $usuario["email"];
      $_SESSION["login"] = true;
        //despues de logear exitosamente
        header("Location:./admin/index.php");
      //var_dump($_SESSION);
      }else{//si no existe entoces, el password que puso el usuario es incorrecto
        $errores[] = "Password incorrecto";
      }
    } else { //si no existe
      $errores[] = "El usuario no existe";
    }
  }
}
?>

<div class="contenedor contenido-centrado">
  <h1>Iniciar Sesión</h1>
  <?php
  foreach ($errores as $error) { ?>
    <div class="error">
      <?php echo $error ?>
    </div>
  <?php } ?>
  <!-- por defecto si estas en un navegador avanzado ,si pones un pass email maslo te rectifica,para que no salga en form se pone novalidate -->
  <form class="formulario" method="POST">
    <fieldset>
      <legend>Email y Password</legend>
      <label for="email">E-mail</label>
      <input type="email" placeholder="Tu E-mail" id="email" name="email">

      <label for="password">Password</label>
      <input type="password" placeholder="Tu Password" id="password" name="password">
    </fieldset>

    <button class="boton boton-verde" type="submit">Iniciar Sesión</button>
  </form>

</div>








<?php
traerInclude("footer");
?>