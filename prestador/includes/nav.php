<?php
if (session_status() === PHP_SESSION_NONE) session_start();
$current = basename($_SERVER['PHP_SELF']);
?>
<nav class="prest-nav navbar navbar-expand-lg" style="background:#184F9D;">
  <div class="container-fluid">
    <a class="navbar-brand text-white d-flex align-items-center gap-2" href="home.php">
      <img src="../backend/img/logo.png" alt="" style="height:32px;width:32px;border-radius:6px;">
      <span class="fw-bold">Trinidad Salud · Prestadores</span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#prestNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="prestNav">
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link <?= $current === 'home.php' ? 'active text-white fw-bold' : 'text-white' ?>" href="home.php"><i class="bi bi-house"></i> Inicio</a></li>
        <li class="nav-item"><a class="nav-link <?= $current === 'validar.php' ? 'active text-white fw-bold' : 'text-white' ?>" href="validar.php"><i class="bi bi-shield-check"></i> Validar</a></li>
        <li class="nav-item"><a class="nav-link <?= $current === 'historial.php' ? 'active text-white fw-bold' : 'text-white' ?>" href="historial.php"><i class="bi bi-clock-history"></i> Historial</a></li>
        <li class="nav-item"><a class="nav-link <?= $current === 'perfil.php' ? 'active text-white fw-bold' : 'text-white' ?>" href="perfil.php"><i class="bi bi-person"></i> Perfil</a></li>
      </ul>
      <ul class="navbar-nav">
        <li class="nav-item">
          <span class="navbar-text text-white-50 me-3 small">
            <i class="bi bi-person-badge me-1"></i><?= htmlspecialchars(prestador_name()) ?>
          </span>
        </li>
        <li class="nav-item"><a class="nav-link text-white" href="logout.php"><i class="bi bi-box-arrow-right"></i> Salir</a></li>
      </ul>
    </div>
  </div>
</nav>
