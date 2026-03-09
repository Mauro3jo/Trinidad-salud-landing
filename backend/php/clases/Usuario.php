<?php

class Usuario
{
  // Atributos privados
  protected $id;
  protected $id_usuario;
  protected $nombre;
  protected $apellido;
  protected $celulara;
  protected $celularb;
  protected $email;
  protected $rol;

  
  // Constructor
  public function __construct($id_usuario)
  {
    $dir2 = str_repeat("../", $_SESSION['dir2']);
    //require("../../../backend/bd/conexion.php");
    require("$dir2/backend/bd/conexion.php");
    //require_once($_SERVER['DOCUMENT_ROOT'] . '/02-sitios/trinidadsalud.com.ar/trinidadsalud.com.ar/backend/bd/conexion.php');


    $stmt = $connect->prepare("SELECT id, id_usuario, rol, nombre, apellido, celulara, celularb, email FROM usuarios WHERE id_usuario=:id_usuario LIMIT 1");

    $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);

    $stmt->execute();

    // Obtener los resultados como un array asociativo
    $dato = $stmt->fetch(PDO::FETCH_ASSOC);

    //Cerramos la conexión
    $connect = null;

    if ($dato) {
      // Asignar los valores a los atributos de la clase
      $this->id = $dato['id'];
      $this->id_usuario = $dato['id_usuario'];
      $this->nombre = $dato['nombre'];
      $this->apellido = $dato['apellido'];
      $this->celulara = $dato['celulara'];
      $this->celularb = $dato['celularb'];
      $this->email = $dato['email'];
      $this->rol = $dato['rol'];
    } else {
      // Si no se encuentra el usuario, lanzar un mensaje de error o asignar valores predeterminados
      $_SESSION['color'] = "danger";
      $_SESSION['msg'] = 'No se encontró el usuario con DNI:' . $id_usuario;
      throw new Exception("No se encontró el usuario con DNI: " . $id_usuario);
    }
  }

  // Métodos Get y Set para cada atributo
  public function getId()
  {
    return $this->id;
  }
  public function getIdUsuario()
  {
    return $this->id_usuario;
  }

  public function setIdUsuario($id_usuario)
  {
    $this->id_usuario = $id_usuario;
  }

  public function getNombre()
  {
    return $this->nombre;
  }

  public function setNombre($nombre)
  {
    $this->nombre = $nombre;
  }

  public function getApellido()
  {
    return $this->apellido;
  }

  public function setApellido($apellido)
  {
    $this->apellido = $apellido;
  }

  public function getCelularA()
  {
    return $this->celulara;
  }

  public function setCelularA($celulara)
  {
    $this->celulara = $celulara;
  }

  public function getCelularB()
  {
    return $this->celularb;
  }

  public function setCelularB($celularb)
  {
    $this->celularb = $celularb;
  }

  public function getEmail()
  {
    return $this->email;
  }

  public function setEmail($email)
  {
    $this->email = $email;
  }

  public function getRol()
  {
    return $this->rol;
  }

  public function setRol($rol)
  {
    $this->rol = $rol;
  }

  // Método para eliminar usuario
  public function eliminaUsuario($id_usuario)
  {
    //Para eliminar la imagen tenemos que hacerlo antes de eliminar el registro
    if (isset($id_usuario)) {

      $dir = "../../frontend/usuarios/fotos";
      $foto = $dir . '/' . $id_usuario . '.jpg';

      if (file_exists($foto)) {
        unlink($foto);
      }
      $_SESSION['color'] = "success";
      $_SESSION['msg'] = "Registro Eliminado";
    } else {
      $_SESSION['color'] = "danger";
      $_SESSION['msg'] = "Error al eliminar la foto del registro.";
    }

    require("../../backend/bd/conexion.php");
    //Preparamos la sentencia
    $stmt = $connect->prepare("DELETE FROM usuarios WHERE id_usuario=:id_usuario");

    //Vinculamos los parámetros
    $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_STR);

    //Ejecutamos la consulta
    $stmt->execute();

    //Cerramos la conexión
    $connect = null;
  }


  // Método para mostrar la información del usuario
  public function mostrarInformacion()
  {
    echo "ID Usuario: " . $this->id_usuario . "<br>";
    echo "Nombre: " . $this->nombre . "<br>";
    echo "Apellido: " . $this->apellido . "<br>";
    echo "Celular A: " . $this->celulara . "<br>";
    echo "Celular B: " . $this->celularb . "<br>";
    echo "Email: " . $this->email . "<br>";
    echo "Rol: " . $this->rol . "<br>";
  }
}

// Ejemplo de uso
// $usuario = new Usuario(1, "Juan", "Perez", "123456789", "987654321", "juan.perez@example.com", "Administrador");
// $usuario->mostrarInformacion();
