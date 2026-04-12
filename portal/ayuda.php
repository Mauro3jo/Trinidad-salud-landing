<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/api.php';

portal_require_auth();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ayuda – Portal Trinidad Salud</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
  <link rel="stylesheet" href="css/portal.css">
  <link rel="icon" href="../backend/img/logo.png">
</head>
<body class="portal-body">
<?php include __DIR__ . '/includes/nav.php'; ?>

<main class="portal-main">
  <div class="container" style="max-width:640px;">

    <div class="portal-header mb-4">
      <h1><i class="bi bi-question-circle me-2"></i>Ayuda y Contacto</h1>
      <p>Estamos disponibles para ayudarte</p>
    </div>

    <!-- Urgencias -->
    <div class="p-card p-4 mb-4">
      <h5 class="fw-bold text-danger mb-3"><i class="bi bi-exclamation-triangle-fill me-2"></i>Emergencias</h5>
      <a href="tel:08003330425" class="contact-card">
        <div class="icon-circle" style="background:#fff0f0;">
          <i class="bi bi-telephone-fill" style="color:#dc3545;"></i>
        </div>
        <div>
          <div class="fw-bold">0800 333 0425</div>
          <div class="text-muted small">Emergencias las 24 hs.</div>
        </div>
        <i class="bi bi-chevron-right ms-auto text-muted"></i>
      </a>
    </div>

    <!-- Atención al afiliado -->
    <div class="p-card p-4 mb-4">
      <h5 class="fw-bold mb-3"><i class="bi bi-headset me-2" style="color:var(--p-primary);"></i>Atención al afiliado</h5>

      <a href="tel:08003334300" class="contact-card">
        <div class="icon-circle">
          <i class="bi bi-telephone"></i>
        </div>
        <div>
          <div class="fw-bold">0800 333 4300</div>
          <div class="text-muted small">Lunes a viernes · Horario de oficina</div>
        </div>
        <i class="bi bi-chevron-right ms-auto text-muted"></i>
      </a>

      <a href="https://api.whatsapp.com/send?phone=5493813658588" target="_blank" class="contact-card" style="color:#25d366;">
        <div class="icon-circle" style="background:#e7fef0;">
          <i class="bi bi-whatsapp" style="color:#25d366;"></i>
        </div>
        <div>
          <div class="fw-bold" style="color:#128c7e;">381-3658588</div>
          <div class="text-muted small">WhatsApp</div>
        </div>
        <i class="bi bi-chevron-right ms-auto text-muted"></i>
      </a>

      <a href="https://www.facebook.com/trinidadsaludgrupoCIO/" target="_blank" class="contact-card">
        <div class="icon-circle" style="background:#e8f0fe;">
          <i class="bi bi-facebook" style="color:#1877f2;"></i>
        </div>
        <div>
          <div class="fw-bold">Facebook</div>
          <div class="text-muted small">trinidadsaludgrupoCIO</div>
        </div>
        <i class="bi bi-chevron-right ms-auto text-muted"></i>
      </a>
    </div>

    <!-- Sedes -->
    <div class="p-card p-4">
      <h5 class="fw-bold mb-3"><i class="bi bi-geo-alt-fill me-2" style="color:var(--p-primary);"></i>Nuestras sedes</h5>
      <p class="text-muted small mb-3">San Miguel de Tucumán, Argentina</p>
      <a href="../index.php#ubicacion" class="btn btn-outline-primary rounded-3 w-100">
        <i class="bi bi-map me-1"></i>Ver ubicaciones en el mapa
      </a>
    </div>

  </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
