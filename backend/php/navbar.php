<?php
$rol = "";
switch ($_SESSION["rol"]) {
  case 1:
    $rol = "Administrador";
    break;
  case 2:
    $rol = "Recepcionista";
    break;
  case 3:
    $rol = "Prestador";
    break;
}
?>
<nav class="navbar navbar-dark bg-dark fixed-top">
  <div class="container-fluid">
    <a href="../../frontend/escritorio/"><img src="../../backend/img/logo.png" alt="logomuela" width="50" class="logomuela" /></a>
    <a class="navbar-brand" href="#">
      <span class="fs-4 fw-bolder">Trinidad Salud</span> -
      <span class="fs-5">Bienvenido <?= $_SESSION['nombre'] ?> - <?= $rol ?></span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Dark offcanvas</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>


          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              🙋🏻‍♂️ Usuarios
            </a>
            <ul class="dropdown-menu dropdown-menu-dark">
              <?php if ($_SESSION['rol'] == 1) { ?>
                <li><a class="dropdown-item" href="../usuarios/">🙋🏻‍♂️🙋🏻‍♀️ Administrar Usuarios 🙋‍♂️🙋🏼‍♀️</a></li>
              <?php } ?>
              <li><a class="dropdown-item" href="../usuarios/">Administrar Pacientes</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
          </li>

          <!-- MÓDULO PARA GESTIONAR CONFIGURACIONES -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              📝 Administrar Ajustes
            </a>
            <ul class="dropdown-menu dropdown-menu-dark">
              <!-- <li><a class="dropdown-item" href="../clases/">🗓️ Crear Clases - Horarios 🗓️</a></li>
              <li><a class="dropdown-item" href="../administrador/buscarClase.php">🔍 Buscar Clases 🔍</a></li>
              <li><a class="dropdown-item" href="../planes/">📝Administrar Planes</a></li>
              <li><a class="dropdown-item" href="../promo/">%💵 Administrar Promociones 💵%</a></li> -->
              <li><a class="dropdown-item" href="../osociales/">✍ Administrar Obras Sociales 📝</a></li>
            </ul>
          </li>

          <!-- MÓDULO PARA GESTIONAR PASSWORD -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              🔑 Mis Datos Personales
            </a>
            <ul class="dropdown-menu dropdown-menu-dark">
              <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#passModal"> 🔒🔑Cambiar Contraseña🔑🔓</a></li>
            </ul>
          </li>

        </ul>
        <!-- <form class="d-flex mt-3" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-success" type="submit">Search</button>
        </form> -->
        <div class="text-center">
          <br>
          <button type="button" class="btn btn-danger btn-sm" onclick="cerrarSesion()">Cerrar Sesión</button>
          <script>
            function cerrarSesion() {
              window.location.href = '../../backend/bd/salir.php';
            }
          </script>
        </div>
      </div>
    </div>
  </div>
</nav>

<?php include("../../frontend/escritorio/php/passModal.php"); ?>