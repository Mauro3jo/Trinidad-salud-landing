<?php
include("../backend/bd/conexion.php");

if (isset($_POST["usuario"]) && isset($_POST["password"])) {
  $usuario = $_POST["usuario"];
  $password = MD5($_POST["password"]);

  $sql = $connect->prepare("SELECT * FROM usuarios WHERE id_usuario=:usuario AND pass=:pass");

  $sql->execute(array(':usuario' => $usuario, ':pass' => $password));

  if ($datos = $sql->fetch(PDO::FETCH_OBJ)) {
    $_SESSION['id_usuario'] = $datos->id_usuario;
    $_SESSION['dni'] = $datos->dni;
    $_SESSION['pass'] = $datos->pass;
    $_SESSION['nombre'] = $datos->nombre;
    $_SESSION['apellido'] = $datos->apellido;
    $_SESSION['celular'] = $datos->celular;
    $_SESSION['email'] = $datos->email;
    $_SESSION['rol'] = $datos->rol;


    switch ($_SESSION['rol']) {
      case 4:
        header("location:../frontend/paciente/");
        break;
      case 3:
        header("location:../frontend/escritorio/");
        break;
      case 2:
        header("location:../frontend/escritorio/");
        break;
      case 1:
        header("location:../frontend/escritorio/");
        break;
      default:
        echo '<div class="alert alert-danger">DATOS INCORRECTOS</div>';
    }
  } else {
    echo '<div class="alert alert-danger">DATOS INCORRECTOS</div>';
  }
}
$connect = null;
