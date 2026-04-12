<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/api.php';

portal_require_auth();

$res      = api_get('/current-plan', portal_token());
$plan     = $res['plan'] ?? [];
$title    = $plan['title']       ?? 'Mi Plan';
$price    = $plan['price']       ?? '';
$desc     = $plan['description'] ?? '';
$benefits = $plan['benefits']    ?? [];
$tone     = strtolower($plan['tone'] ?? '');

// Map tone to CSS class
$tone_class = match(true) {
    str_contains($tone, 'basic')    || str_contains($title, 'asico')  => 'basico',
    str_contains($tone, 'integral') || str_contains($title, 'ntegral')=> 'integral',
    str_contains($tone, 'premium')  || str_contains($title, 'remium') => 'premium',
    default                                                             => 'default',
};
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mi Plan – Portal Trinidad Salud</title>
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
      <h1><i class="bi bi-card-list me-2"></i>Mi Plan</h1>
      <p>Coberturas y beneficios incluidos</p>
    </div>

    <!-- Hero del plan -->
    <div class="plan-hero <?= $tone_class ?> mb-4">
      <div class="d-flex justify-content-between align-items-start flex-wrap gap-3">
        <div>
          <h2 class="fw-bold mb-1" style="font-size:1.5rem;"><?= htmlspecialchars($title) ?></h2>
          <?php if ($desc): ?>
            <p class="mb-0" style="opacity:.88;font-size:.9rem;"><?= htmlspecialchars($desc) ?></p>
          <?php endif; ?>
        </div>
        <?php if ($price): ?>
          <div class="text-end">
            <div style="font-size:.7rem;opacity:.7;text-transform:uppercase;letter-spacing:.05em;">Precio referencia</div>
            <div class="fw-bold" style="font-size:1.3rem;">$<?= htmlspecialchars($price) ?></div>
          </div>
        <?php endif; ?>
      </div>
    </div>

    <!-- Beneficios -->
    <?php if (!empty($benefits)): ?>
      <div class="p-card p-4">
        <h5 class="fw-bold mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i>Beneficios incluidos</h5>
        <ul class="list-unstyled mb-0 d-flex flex-column gap-2">
          <?php foreach ($benefits as $b): ?>
            <li class="d-flex align-items-start gap-2">
              <i class="bi bi-check2 text-success mt-1 flex-shrink-0"></i>
              <span><?= htmlspecialchars(is_array($b) ? ($b['description'] ?? json_encode($b)) : $b) ?></span>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php elseif (empty($plan)): ?>
      <div class="p-card p-4 text-center text-muted">
        <i class="bi bi-info-circle fs-2 mb-2 d-block"></i>
        No hay información de plan disponible.<br>
        <a href="ayuda.php" class="text-decoration-none mt-2 d-inline-block" style="color:var(--p-primary)">Contactá a Trinidad Salud</a>
      </div>
    <?php endif; ?>

  </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
