<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/api.php';

prestador_require_auth();

$me_res    = papi_get('/me', prestador_token());
$prestador = $me_res['prestador'] ?? prestador_user();

$hist = papi_get('/historial', prestador_token());
$items = $hist['items'] ?? [];
$total = $hist['total'] ?? 0;

// Cuántas en los últimos 30 días
$ultimoMes = 0;
$hace30 = strtotime('-30 days');
foreach ($items as $it) {
    if (!empty($it['usada_at']) && strtotime($it['usada_at']) >= $hace30) $ultimoMes++;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inicio – Prestadores Trinidad Salud</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
  <link rel="stylesheet" href="css/portal.css">
  <link rel="icon" href="../backend/img/logo.png">
</head>
<body class="prest-body">
<?php include __DIR__ . '/includes/nav.php'; ?>

<main class="prest-main">
  <div class="container">

    <div class="prest-header mb-4">
      <h1>Hola, Dr/a. <?= htmlspecialchars($prestador['name'] ?? '—') ?> 👋</h1>
      <p>Validá autorizaciones desde acá o consultá el historial de las que ya usaste.</p>
    </div>

    <div class="row g-3 mb-4">
      <div class="col-12 col-md-4">
        <div class="stat-card">
          <div class="num"><?= (int) $total ?></div>
          <div class="lbl">Total de validaciones</div>
        </div>
      </div>
      <div class="col-12 col-md-4">
        <div class="stat-card">
          <div class="num"><?= (int) $ultimoMes ?></div>
          <div class="lbl">Últimos 30 días</div>
        </div>
      </div>
      <div class="col-12 col-md-4">
        <div class="stat-card">
          <div class="num" style="color:#1B6E45;">
            <i class="bi bi-shield-check"></i>
          </div>
          <div class="lbl"><?= htmlspecialchars($prestador['especialidad'] ?? 'Prestador habilitado') ?></div>
        </div>
      </div>
    </div>

    <div class="row g-4">
      <div class="col-12 col-md-7">
        <div class="p-card p-4">
          <h5 class="fw-bold mb-3"><i class="bi bi-clock-history me-2" style="color:#2F7CE5"></i>Últimas validaciones</h5>
          <?php if (empty($items)): ?>
            <p class="text-muted small mb-0">Todavía no validaste ninguna autorización.</p>
          <?php else: ?>
            <?php foreach (array_slice($items, 0, 5) as $it): ?>
              <div class="hist-item">
                <div>
                  <div class="codigo"><?= htmlspecialchars($it['codigo_autorizacion'] ?? '—') ?></div>
                  <div class="small text-muted mt-1">
                    <?= htmlspecialchars($it['afiliado']['nombre'] ?? '—') ?> · DNI <?= htmlspecialchars($it['afiliado']['dni'] ?? '—') ?>
                  </div>
                  <div class="small text-muted">
                    <?= htmlspecialchars($it['titulo'] ?? '') ?>
                  </div>
                </div>
                <div class="text-end">
                  <div class="small text-muted">
                    <?= !empty($it['usada_at']) ? date('d/m/Y H:i', strtotime($it['usada_at'])) : '—' ?>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
            <a href="historial.php" class="btn btn-sm btn-outline-primary mt-2">Ver todo el historial</a>
          <?php endif; ?>
        </div>
      </div>
      <div class="col-12 col-md-5">
        <div class="p-card p-4 text-center" style="background:linear-gradient(135deg,#2F7CE5,#184F9D);color:#fff;">
          <i class="bi bi-shield-check" style="font-size:3rem;"></i>
          <h4 class="fw-bold mt-3 mb-2">Validá una autorización</h4>
          <p class="opacity-75 mb-3">El paciente te trae el código <strong>AUT-XXXXX</strong>. Verificalo en segundos.</p>
          <a href="validar.php" class="btn btn-light fw-bold">
            <i class="bi bi-arrow-right me-1"></i>Validar ahora
          </a>
        </div>
      </div>
    </div>

  </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
