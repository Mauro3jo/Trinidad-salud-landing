<!-- ========= BOTONERA =========== -->
<div class="header sticky-top">
  <?php
  if (isset($_SESSION['administrador'])) {
    include('sesion_boton_cerrar.php');
  }
  ?>
  <header class="container-fluid bg-primary d-flex justify-content-center">
    <a href="https://api.whatsapp.com/send?phone=5493813658588" style="text-decoration: none">
      <p class="text-light mb-0 p-2 fs-6">
        <i class="bi bi-whatsapp"></i> Contactanos 381-3658588
      </p>
    </a>
  </header>
  <nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
      <a href="#"><img src="backend/img/logo.png" alt="logomuela" width="50" class="logomuela" /></a>
      <a class="navbar-brand" href="index.php#">
        <span class="text-primary fs-5 fw-bold">
          Trinidad Salud</span>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php#">Inicio</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php#planes">Planes</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php#ubicacion">Nuestra Ubicación</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php#planes">Beneficios</a>
          </li>
        </ul>
        <div class="d-flex gap-2 ms-2 my-2 my-lg-0">
          <a href="afiliarse.php" class="btn btn-outline-primary btn-sm rounded-pill px-3">Afiliate</a>
          <a href="portal/login.php" class="btn btn-primary btn-sm rounded-pill px-3">
            <i class="bi bi-person-fill me-1"></i>Mi Portal
          </a>
        </div>
      </div>
    </div>
  </nav>
</div>