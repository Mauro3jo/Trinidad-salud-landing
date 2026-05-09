<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/api.php';

prestador_require_auth();

$res   = papi_get('/historial', prestador_token());
$items = $res['items'] ?? [];
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Historial – Prestadores Trinidad Salud</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
  <link rel="stylesheet" href="css/portal.css">
  <link rel="icon" href="../backend/img/logo.png">
</head>
<body class="prest-body">
<?php include __DIR__ . '/includes/nav.php'; ?>

<main class="prest-main">
  <div class="container" style="max-width: 900px;">

    <div class="prest-header mb-4">
      <h1><i class="bi bi-clock-history me-2"></i>Historial de validaciones</h1>
      <p>Últimas 100 autorizaciones que confirmaste como utilizadas.</p>
    </div>

    <?php if (empty($items)): ?>
      <div class="p-card p-5 text-center text-muted">
        <i class="bi bi-clock fs-1 mb-3 d-block" style="opacity:.3;"></i>
        Todavía no validaste autorizaciones.
      </div>
    <?php else: ?>
      <div class="table-responsive p-card">
        <table class="table table-hover align-middle mb-0">
          <thead class="table-light">
            <tr>
              <th>Código</th>
              <th>Afiliado</th>
              <th>DNI</th>
              <th>Tipo / Solicitud</th>
              <th>Fecha de uso</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($items as $it): ?>
              <tr>
                <td><span class="codigo" style="font-family:monospace;font-weight:800;color:#184F9D;"><?= htmlspecialchars($it['codigo_autorizacion'] ?? '—') ?></span></td>
                <td><?= htmlspecialchars($it['afiliado']['nombre'] ?? '—') ?></td>
                <td class="font-monospace small"><?= htmlspecialchars($it['afiliado']['dni'] ?? '—') ?></td>
                <td>
                  <div class="small fw-semibold"><?= htmlspecialchars($it['tipo'] ?? '—') ?></div>
                  <div class="small text-muted"><?= htmlspecialchars($it['titulo'] ?? '') ?></div>
                </td>
                <td class="small text-muted">
                  <?= !empty($it['usada_at']) ? date('d/m/Y H:i', strtotime($it['usada_at'])) : '—' ?>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    <?php endif; ?>

  </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
