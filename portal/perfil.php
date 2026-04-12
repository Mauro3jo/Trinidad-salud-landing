<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/api.php';

portal_require_auth();

$res     = api_get('/profile', portal_token());
// MobileProfileResponse: { summary: {full_name, plan, credential_number, dni}, profile: MobileUser }
$summary = $res['summary'] ?? [];
$user    = $res['profile']  ?? portal_user();  // MobileUser
$name    = $summary['full_name'] ?? portal_user_name();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mi Perfil – Portal Trinidad Salud</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
  <link rel="stylesheet" href="css/portal.css">
  <link rel="icon" href="../backend/img/logo.png">
</head>
<body class="portal-body">
<?php include __DIR__ . '/includes/nav.php'; ?>

<main class="portal-main">
  <div class="container" style="max-width:680px;">

    <div class="portal-header mb-4">
      <h1><i class="bi bi-person-fill me-2"></i>Mi Perfil</h1>
      <p>Información de tu cuenta</p>
    </div>

    <!-- Resumen -->
    <div class="p-card p-4 mb-4 text-center">
      <div class="mb-3">
        <span class="d-inline-flex align-items-center justify-content-center rounded-circle bg-primary text-white"
              style="width:72px;height:72px;font-size:2rem;">
          <i class="bi bi-person-fill"></i>
        </span>
      </div>
      <h4 class="fw-bold mb-1"><?= htmlspecialchars($name) ?></h4>
      <span class="badge bg-primary rounded-pill px-3 py-1 mb-1"><?= htmlspecialchars($summary['plan'] ?? ($user['plan']['Titulo'] ?? '––')) ?></span>
      <p class="text-muted small mb-0">
        N° afiliado: <strong><?= htmlspecialchars($summary['credential_number'] ?? ($user['nro_afiliado'] ?? '––')) ?></strong>
        &nbsp;|&nbsp; DNI: <strong><?= htmlspecialchars($summary['dni'] ?? ($user['dni'] ?? '––')) ?></strong>
      </p>
    </div>

    <!-- Acciones -->
    <a href="datos.php" class="profile-action">
      <div class="icon-wrap"><i class="bi bi-pencil-fill"></i></div>
      <div>
        <div class="act-title">Mis datos personales</div>
        <div class="act-sub">Editá tu información de contacto</div>
      </div>
      <i class="bi bi-chevron-right"></i>
    </a>

    <a href="plan.php" class="profile-action">
      <div class="icon-wrap"><i class="bi bi-card-list"></i></div>
      <div>
        <div class="act-title">Mi Plan</div>
        <div class="act-sub">Ver coberturas y beneficios</div>
      </div>
      <i class="bi bi-chevron-right"></i>
    </a>

    <a href="password.php" class="profile-action">
      <div class="icon-wrap"><i class="bi bi-shield-lock-fill"></i></div>
      <div>
        <div class="act-title">Cambiar contraseña</div>
        <div class="act-sub">Actualizá tu clave de acceso</div>
      </div>
      <i class="bi bi-chevron-right"></i>
    </a>

    <a href="logout.php" class="profile-action" style="color:#dc3545;" onclick="return confirm('¿Querés cerrar sesión?')">
      <div class="icon-wrap" style="background:#fff0f0;"><i class="bi bi-box-arrow-right" style="color:#dc3545;"></i></div>
      <div>
        <div class="act-title" style="color:#dc3545;">Cerrar sesión</div>
        <div class="act-sub">Salir de tu cuenta</div>
      </div>
      <i class="bi bi-chevron-right" style="color:#dc3545;"></i>
    </a>

  </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
