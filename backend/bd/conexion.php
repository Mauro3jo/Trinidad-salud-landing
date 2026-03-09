<?php
if (!isset($_SESSION)) {
  session_start();
}

//Definimos base de datos
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'trinidadsalud';

//conectamos con base de datos

try {
  $connect = new PDO("mysql:host=" . $dbhost . "; dbname=" . $dbname, $dbuser, $dbpass);
  $connect->query("set names utf8;");

  $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $connect->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
} catch (PDOException $e) {
  echo $e->getMessage();
}
