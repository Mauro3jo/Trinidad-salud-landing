<?php
$_current = basename($_SERVER['SCRIPT_NAME']);
function _nav_link(string $href, string $icon, string $label, string $current): string {
    $active = ($current === $href) ? ' active-link' : '';
    return "<a class=\"nav-link{$active} px-2 py-1\" href=\"{$href}\"><i class=\"bi {$icon} me-1\"></i>{$label}</a>";
}
?>
<nav class="navbar navbar-expand-lg portal-navbar fixed-top">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center gap-2" href="home.php">
      <img src="../backend/img/logo.png" alt="Logo" width="36" height="36" style="object-fit:contain;">
      <span class="fw-bold">Trinidad Salud</span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#portalNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="portalNav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 gap-1">
        <li class="nav-item"><?= _nav_link('home.php',          'bi-house-fill',      'Inicio',          $_current) ?></li>
        <li class="nav-item"><?= _nav_link('perfil.php',        'bi-person-fill',     'Mi Perfil',       $_current) ?></li>
        <li class="nav-item"><?= _nav_link('autorizaciones.php','bi-shield-check',    'Autorizaciones',  $_current) ?></li>
        <li class="nav-item"><?= _nav_link('reintegros.php',    'bi-receipt',         'Reintegros',      $_current) ?></li>
        <li class="nav-item"><?= _nav_link('plan.php',          'bi-card-list',       'Mi Plan',         $_current) ?></li>
        <li class="nav-item"><?= _nav_link('ayuda.php',         'bi-question-circle', 'Ayuda',           $_current) ?></li>
      </ul>
      <div class="d-flex align-items-center gap-2 mt-2 mt-lg-0">
        <span class="text-white-50 small d-none d-lg-block">
          <?php $u = portal_user(); $up = $u['profile'] ?? []; echo htmlspecialchars(trim(($up['Nombres'] ?? '') . ' ' . ($up['Apellido'] ?? ''))); ?>
        </span>
        <a href="logout.php" class="btn btn-sm btn-outline-light rounded-pill">
          <i class="bi bi-box-arrow-right me-1"></i>Salir
        </a>
      </div>
    </div>
  </div>
</nav>
