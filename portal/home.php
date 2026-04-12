<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/api.php';

portal_require_auth();

$token    = portal_token();
$home_res = api_get('/home',    $token);
$me_res   = api_get('/me',      $token);

$greeting = $home_res['greeting'] ?? ('Hola, ' . portal_user_name());
// affiliate_card viene de /home con campos tipados
$card = $home_res['affiliate_card'] ?? [];
// MobileUser de /me — campos anidados: user.dni, user.nro_afiliado, user.profile, user.plan, user.coverage_expires_at
$user = $me_res;
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inicio – Portal Trinidad Salud</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
  <link rel="stylesheet" href="css/portal.css">
  <link rel="icon" href="../backend/img/logo.png">
</head>
<body class="portal-body">
<?php include __DIR__ . '/includes/nav.php'; ?>

<main class="portal-main">
  <div class="container">

    <!-- Saludo -->
    <div class="portal-header mb-4">
      <h1><i class="bi bi-house-fill me-2"></i>Inicio</h1>
      <p><?= htmlspecialchars($greeting) ?></p>
    </div>

    <div class="row g-4">

      <!-- Tarjeta afiliado -->
      <div class="col-12 col-md-5">
        <h6 class="fw-bold text-muted text-uppercase small mb-3 ls-wide">Credencial</h6>

        <div class="flip-card-wrap" id="affiliateCard" onclick="this.classList.toggle('flipped')" title="Clic para girar">
          <div class="flip-card-inner">

            <!-- FRENTE -->
            <div class="flip-card-front">
              <div class="card-front-top">
                <div>
                  <div class="card-brand">Trinidad Salud</div>
                  <div class="card-plan mt-1"><?= htmlspecialchars($card['plan'] ?? ($user['plan']['Titulo'] ?? 'Plan')) ?></div>
                </div>
                <img src="../backend/img/logo.png" alt="Logo" class="card-logo-sm">
              </div>
              <div class="card-front-bottom">
                <div>
                  <div class="card-num"><?= htmlspecialchars($card['affiliate_number'] ?? ($user['nro_afiliado'] ?? '––')) ?></div>
                  <div class="card-name" style="margin-top:4px;">
                    <?= htmlspecialchars($card['full_name'] ?? '') ?>
                  </div>
                </div>
                <div style="font-size:.7rem;opacity:.7;"><?= htmlspecialchars($card['customer_type_label'] ?? 'AFILIADO') ?></div>
              </div>
            </div>

            <!-- DORSO -->
            <div class="flip-card-back">
              <div class="card-back-row">
                <div class="card-back-label">DNI</div>
                <div class="card-back-value"><?= htmlspecialchars($card['dni'] ?? ($user['dni'] ?? '––')) ?></div>
              </div>
              <div class="card-back-row">
                <div class="card-back-label">N° Afiliado</div>
                <div class="card-back-value"><?= htmlspecialchars($card['affiliate_number'] ?? ($user['nro_afiliado'] ?? '––')) ?></div>
              </div>
              <div class="card-back-row">
                <div class="card-back-label">Vencimiento</div>
                <div class="card-back-value"><?= htmlspecialchars($user['coverage_expires_at'] ?? '––') ?></div>
              </div>
              <div class="card-back-row">
                <div class="card-back-label">Plan</div>
                <div class="card-back-value"><?= htmlspecialchars($card['plan'] ?? ($user['plan']['Titulo'] ?? '––')) ?></div>
              </div>
            </div>

          </div>
        </div>
        <p class="flip-hint mt-2"><i class="bi bi-arrow-repeat me-1"></i>Clic para ver dorso</p>
      </div>

      <!-- Acciones rápidas -->
      <div class="col-12 col-md-7">
        <h6 class="fw-bold text-muted text-uppercase small mb-3">Acciones rápidas</h6>
        <div class="row g-3">
          <div class="col-6 col-sm-3 col-md-6 col-lg-3">
            <a href="autorizaciones.php" class="quick-action">
              <i class="bi bi-shield-check"></i>
              <span>Autorizaciones</span>
            </a>
          </div>
          <div class="col-6 col-sm-3 col-md-6 col-lg-3">
            <a href="reintegros.php" class="quick-action">
              <i class="bi bi-receipt"></i>
              <span>Reintegros</span>
            </a>
          </div>
          <div class="col-6 col-sm-3 col-md-6 col-lg-3">
            <a href="plan.php" class="quick-action">
              <i class="bi bi-card-list"></i>
              <span>Mi Plan</span>
            </a>
          </div>
          <div class="col-6 col-sm-3 col-md-6 col-lg-3">
            <a href="ayuda.php" class="quick-action">
              <i class="bi bi-question-circle"></i>
              <span>Ayuda</span>
            </a>
          </div>
        </div>

        <!-- Números de emergencia -->
        <div class="p-card p-3 mt-4">
          <h6 class="fw-bold mb-3"><i class="bi bi-exclamation-triangle-fill text-danger me-2"></i>Contactos importantes</h6>
          <div class="d-flex flex-column gap-2">
            <a href="tel:08003330425" class="d-flex align-items-center gap-2 text-decoration-none text-dark">
              <span class="badge bg-danger rounded-pill px-2 py-1">Emergencias</span>
              <span class="fw-semibold">0800 333 0425</span>
            </a>
            <a href="tel:08003334300" class="d-flex align-items-center gap-2 text-decoration-none text-dark">
              <span class="badge bg-primary rounded-pill px-2 py-1">Atención al afiliado</span>
              <span class="fw-semibold">0800 333 4300</span>
            </a>
            <a href="https://api.whatsapp.com/send?phone=5493813658588" target="_blank"
               class="d-flex align-items-center gap-2 text-decoration-none" style="color:#25d366">
              <i class="bi bi-whatsapp fs-5"></i>
              <span class="fw-semibold">381-3658588 (WhatsApp)</span>
            </a>
          </div>
        </div>

      </div>
    </div>

  </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
