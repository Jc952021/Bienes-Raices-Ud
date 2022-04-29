<?php

//trser la db
require "./includes/config/database.php";
$db = conectarDb();

$email="correo@correo.com";
$password ="123456";

$passwordHasheado =  password_hash($password,PASSWORD_DEFAULT);

$sql = "INSERT INTO usuarios (email, password) VALUES ('$email','$passwordHasheado');";
//con solo entrar a esta pagin,se añade el usuario
$db->query($sql);


