<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/api.php';

portal_require_auth();

$token   = portal_token();

// Leer mensajes flash (vienen del POST anterior tras el redirect)
$success = $_SESSION['flash_success'] ?? '';
$error   = $_SESSION['flash_error']   ?? '';
unset($_SESSION['flash_success'], $_SESSION['flash_error']);

// Tipos disponibles (espejo de la app móvil)
$TIPOS = [
    'consulta'           => 'Consulta médica',
    'practica_rutina'    => 'Práctica de rutina',
    'practica_especial'  => 'Práctica especializada',
    'medicamento'        => 'Medicamento',
    'kinesiologia'       => 'Kinesiología',
    'psicologia'         => 'Psicología',
    'odontologia'        => 'Odontología',
    'cirugia'            => 'Cirugía / internación',
    'otro'               => 'Otro',
];

// Crear nueva solicitud de autorización
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create_auth'])) {
    $payload = [
        'tipo'           => $_POST['tipo']           ?? 'consulta',
        'titulo'         => trim($_POST['titulo']    ?? ''),
        'prestador'      => trim($_POST['prestador'] ?? '') ?: null,
        'prestador_dni'  => trim($_POST['prestador_dni'] ?? '') ?: null,
        'observaciones'  => trim($_POST['observaciones'] ?? '') ?: null,
    ];

    if ($payload['titulo'] === '') {
        $error = 'Indicá qué necesitás autorizar.';
    } elseif (!isset($TIPOS[$payload['tipo']])) {
        $error = 'Tipo inválido.';
    } else {
        // Adjuntar orden médica si vino archivo
        if (!empty($_FILES['orden']['name']) && $_FILES['orden']['error'] === UPLOAD_ERR_OK) {
            $f = $_FILES['orden'];
            if ($f['size'] > 5 * 1024 * 1024) {
                $error = 'El archivo supera los 5 MB.';
            } else {
                $ext = strtolower(pathinfo($f['name'], PATHINFO_EXTENSION));
                if (!in_array($ext, ['pdf', 'jpg', 'jpeg', 'png'])) {
                    $error = 'Solo se aceptan PDF o imágenes (jpg/png).';
                } else {
                    $payload['orden_medica_base64']    = base64_encode(file_get_contents($f['tmp_name']));
                    $payload['orden_medica_file_name'] = $f['name'];
                }
            }
        }

        if ($error === '') {
            $res = api_post('/authorization-requests', $payload, $token);
            $code = $res['_http_code'] ?? 0;
            if ($code === 200 || $code === 201) {
                $_SESSION['flash_success'] = 'Solicitud enviada. Te avisaremos cuando esté revisada.';
            } else {
                $_SESSION['flash_error'] = api_first_error($res);
            }
        }
    }

    // Si alguna validación previa setteó $error, lo flasheamos
    if ($error !== '') {
        $_SESSION['flash_error'] = $error;
    }

    // POST/Redirect/GET: evita reenvío al recargar y limpia el formulario
    header('Location: autorizaciones.php');
    exit;
}

// Cargar listado del afiliado (igual que en la app móvil)
$res     = api_get('/authorization-requests', $token);
$items   = $res['items']   ?? [];
$summary = $res['summary'] ?? [];

function badge_status(string $status): string {
    $map = [
        'pendiente'   => ['bg-warning text-dark',     'Pendiente'],
        'en_revision' => ['bg-info text-white',       'En revisión'],
        'aprobada'    => ['bg-success text-white',    'Aprobada'],
        'rechazada'   => ['bg-danger text-white',     'Rechazada'],
        'vencida'     => ['bg-secondary text-white',  'Vencida'],
    ];
    [$cls, $label] = $map[strtolower($status)] ?? ['bg-secondary text-white', ucfirst($status)];
    return "<span class=\"status-badge badge {$cls}\">{$label}</span>";
}

function fmt_date(?string $d): string {
    if (!$d) return '––';
    $datePart = explode(' ', $d)[0];
    $parts = explode('-', $datePart);
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
  <style>
    .codigo-box { background: #E7F8EF; border-radius: 12px; padding: 12px 14px; margin-top: 10px; text-align: center; }
    .codigo-box .lbl { color: #1B6E45; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; }
    .codigo-box .codigo { color: #136B40; font-size: 22px; font-weight: 800; letter-spacing: 1.5px; margin-top: 4px; font-family: monospace; }
    .codigo-box .vto { color: #1B6E45; font-size: 12px; margin-top: 4px; }
    .reject-box { background: #FDE8E8; border-radius: 8px; padding: 8px 12px; color: #a33d3d; font-size: 13px; margin-top: 10px; font-style: italic; }
  </style>
</head>
<body class="portal-body">
<?php include __DIR__ . '/includes/nav.php'; ?>

<main class="portal-main">
  <div class="container" style="max-width:780px;">

    <div class="portal-header mb-4">
      <h1><i class="bi bi-shield-check me-2"></i>Autorizaciones</h1>
      <p>Solicitá autorización para tu próxima consulta, práctica o medicamento</p>
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

    <!-- Formulario nueva solicitud -->
    <div class="p-card p-4 mb-4">
      <h5 class="fw-bold mb-3">
        <i class="bi bi-plus-circle me-2" style="color:var(--p-primary);"></i>Solicitar nueva autorización
      </h5>

      <?php if ($success): ?>
        <div class="alert alert-success rounded-3"><?= htmlspecialchars($success) ?></div>
      <?php elseif ($error): ?>
        <div class="alert alert-danger rounded-3"><?= htmlspecialchars($error) ?></div>
      <?php endif; ?>

      <form method="POST" enctype="multipart/form-data" novalidate>
        <input type="hidden" name="create_auth" value="1">

        <div class="row g-3">
          <div class="col-sm-6">
            <label class="form-label fw-semibold small">Tipo de prestación <span class="text-danger">*</span></label>
            <select name="tipo" class="form-select" required>
              <?php foreach ($TIPOS as $value => $label): ?>
                <option value="<?= $value ?>" <?= ($_POST['tipo'] ?? '') === $value ? 'selected' : '' ?>>
                  <?= htmlspecialchars($label) ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="col-sm-6">
            <label class="form-label fw-semibold small">¿Qué necesitás autorizar? <span class="text-danger">*</span></label>
            <input type="text" name="titulo" class="form-control" required
                   placeholder="Ej: Resonancia rodilla derecha"
                   value="<?= htmlspecialchars($_POST['titulo'] ?? '') ?>">
          </div>
          <div class="col-sm-6">
            <label class="form-label fw-semibold small">Prestador (opcional)</label>
            <input type="text" name="prestador" class="form-control"
                   placeholder="Médico, clínica o centro"
                   value="<?= htmlspecialchars($_POST['prestador'] ?? '') ?>">
          </div>
          <div class="col-sm-6">
            <label class="form-label fw-semibold small">DNI del prestador (opcional)</label>
            <input type="text" name="prestador_dni" class="form-control"
                   placeholder="Para facturación"
                   value="<?= htmlspecialchars($_POST['prestador_dni'] ?? '') ?>">
          </div>
          <div class="col-12">
            <label class="form-label fw-semibold small">Orden médica (PDF o foto, opcional)</label>
            <div class="upload-zone" onclick="document.getElementById('orden').click()">
              <i class="bi bi-file-earmark-medical d-block mb-2"></i>
              <div class="fw-semibold" id="ordenLabel">Clic para adjuntar la orden médica</div>
              <div class="text-muted small mt-1">PDF, JPG o PNG · máx. 5 MB</div>
            </div>
            <input type="file" name="orden" id="orden" accept=".pdf,.jpg,.jpeg,.png" class="d-none"
                   onchange="document.getElementById('ordenLabel').textContent = this.files[0]?.name || 'Clic para adjuntar la orden médica';">
          </div>
          <div class="col-12">
            <label class="form-label fw-semibold small">Observaciones</label>
            <textarea name="observaciones" class="form-control" rows="2"
                      placeholder="Detalles adicionales que sirvan al admin"><?= htmlspecialchars($_POST['observaciones'] ?? '') ?></textarea>
          </div>
        </div>

        <button type="submit" class="btn-portal-primary btn mt-3">
          <i class="bi bi-send me-1"></i>Enviar solicitud
        </button>
      </form>
    </div>

    <!-- Historial -->
    <h5 class="fw-bold mb-3">Mis solicitudes</h5>
    <?php if (empty($items)): ?>
      <div class="p-card p-5 text-center text-muted">
        <i class="bi bi-shield fs-1 mb-3 d-block" style="opacity:.3;"></i>
        Todavía no enviaste solicitudes.
      </div>
    <?php else: ?>
      <?php foreach ($items as $item): ?>
        <?php
          $status   = $item['status'] ?? 'pendiente';
          $isAprob  = $status === 'aprobada';
          $codigo   = $item['codigo_autorizacion'] ?? null;
        ?>
        <div class="portal-list-item d-block">
          <div class="d-flex align-items-start">
            <div class="flex-grow-1">
              <div class="item-title"><?= htmlspecialchars($item['titulo'] ?? '—') ?></div>
              <div class="item-sub">
                <i class="bi bi-tag me-1"></i><?= htmlspecialchars($item['tipo_label'] ?? $item['tipo'] ?? '—') ?>
                &nbsp;·&nbsp;
                <i class="bi bi-calendar3 me-1"></i>Enviada: <?= fmt_date($item['created_at'] ?? null) ?>
                <?php if (!empty($item['prestador'])): ?>
                  &nbsp;·&nbsp; <?= htmlspecialchars($item['prestador']) ?>
                <?php endif; ?>
              </div>
            </div>
            <div class="flex-shrink-0">
              <?= badge_status($status) ?>
            </div>
          </div>

          <?php if ($isAprob && $codigo): ?>
            <div class="codigo-box">
              <div class="lbl">Código autorización</div>
              <div class="codigo"><?= htmlspecialchars($codigo) ?></div>
              <?php if (!empty($item['fecha_vencimiento'])): ?>
                <div class="vto">Vence: <?= fmt_date($item['fecha_vencimiento']) ?></div>
              <?php endif; ?>
              <a href="pdf.php?type=autorizacion&id=<?= (int)$item['id'] ?>"
                 class="btn btn-sm btn-portal-primary mt-2">
                <i class="bi bi-download me-1"></i>Descargar PDF
              </a>
            </div>
          <?php endif; ?>

          <?php if (!empty($item['motivo_rechazo'])): ?>
            <div class="reject-box">
              <strong>Motivo del rechazo:</strong> <?= htmlspecialchars($item['motivo_rechazo']) ?>
            </div>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>

  </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
