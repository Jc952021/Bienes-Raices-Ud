<?php
require "app.php";

function traerInclude($nombre, $inicio = false)
{
  include TEMPLATES . "/$nombre.php";
}

function verAuth(): bool
{
  session_start();

  $auth = $_SESSION["login"];
  if ($auth) {
    return true;
  }
  return false;
}
