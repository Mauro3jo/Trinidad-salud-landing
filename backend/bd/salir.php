<?php
require 'conexion.php';
session_destroy();
$url = "../../index.php";
header("Location: $url");
