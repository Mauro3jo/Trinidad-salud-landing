<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/api.php';

portal_require_auth();

$res     = api_get('/authorizations', portal_token());
$items   = $res['items']   ?? [];
$summary = $res['summary'] ?? [];

function badge_auth(string $status): string {
    $map = [
        'vigente' => 'badge-vigente',
        'vencida' => 'badge-vencida',
        'emitida' => 'badge-emitida',
    ];
    $cls = $map[strtolower($status)] ?? 'bg-secondary';
    return "<span class=\"status-badge badge text-white {$cls}\">" . htmlspecialchars($status) . "</span>";
}

function fmt_date(?string $d): string {
    if (!$d) return '––';
    $parts = explode('-', $d);
    return count($parts) === 3 ? "{$parts[2]}/{$parts[1]}/{$parts[0]}" : $d;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Autorizaciones – Portal Trinidad Salud</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
  <link rel="stylesheet" href="css/portal.css">
  <link rel="icon" href="../backend/img/logo.png">
</head>
<body class="portal-body">
<?php include __DIR__ . '/includes/nav.php'; ?>

<main class="portal-main">
  <div class="container" style="max-width:780px;">

    <div class="portal-header mb-4">
      <h1><i class="bi bi-shield-check me-2"></i>Autorizaciones</h1>
      <p>Historial de consultas, prácticas y recetas</p>
    </div>

    <!-- Stats -->
    <?php if (!empty($summary)): ?>
    <div class="row g-3 mb-4">
      <?php foreach ($summary as $lbl => $cnt): ?>
        <div class="col-6 col-sm-4 col-md-3">
          <div class="stat-chip">
            <div class="num"><?= (int)$cnt ?></div>
            <div class="lbl"><?= htmlspecialchars(ucfirst($lbl)) ?></div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <!-- Lista -->
    <?php if (empty($items)): ?>
      <div class="p-card p-5 text-center text-muted">
        <i class="bi bi-shield fs-1 mb-3 d-block" style="opacity:.3;"></i>
        No tenés autorizaciones registradas.
      </div>
    <?php else: ?>
      <?php foreach ($items as $item): ?>
        <div class="portal-list-item">
          <div class="flex-grow-1">
            <!-- MobileAuthorizationItem: title, request_type, source, status, status_label, issued_at, expires_at -->
            <div class="item-title"><?= htmlspecialchars($item['title'] ?? $item['request_type'] ?? 'Autorización') ?></div>
            <div class="item-sub">
              <i class="bi bi-calendar3 me-1"></i><?= fmt_date($item['issued_at'] ?? null) ?>
              <?php if (!empty($item['expires_at'])): ?>
                &nbsp;·&nbsp; Vence: <?= fmt_date($item['expires_at']) ?>
              <?php endif; ?>
              <?php if (!empty($item['source'])): ?>
                &nbsp;·&nbsp; <span class="text-capitalize"><?= htmlspecialchars($item['source']) ?></span>
              <?php endif; ?>
            </div>
          </div>
          <div class="flex-shrink-0">
            <?= badge_auth($item['status'] ?? 'emitida') ?>
          </div>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>

  </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
