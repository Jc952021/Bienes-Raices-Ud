<?php

function conectarDb(){
  $db = new mysqli("localhost","root","","bienes_raices");
  if(!$db){
    exit;
  }
  return $db;
}