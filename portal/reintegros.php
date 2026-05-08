<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/api.php';

portal_require_auth();

$token         = portal_token();
$error         = $success = '';
$bank_error    = $bank_success = '';

// Tipos disponibles (espejo de la app móvil)
$TIPOS = [
    'consulta'      => 'Consulta médica',
    'practica'      => 'Práctica / estudio',
    'medicamento'   => 'Medicamento',
    'odontologia'   => 'Odontología',
    'optica'        => 'Óptica',
    'kinesiologia'  => 'Kinesiología',
    'psicologia'    => 'Psicología',
    'otro'          => 'Otro',
];

// Guardar cuenta bancaria (PUT /bank-account)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_bank'])) {
    $bank_payload = [
        'bank_name' => trim($_POST['bank_name'] ?? ''),
        'cbu'       => trim($_POST['cbu']       ?? ''),
        'alias'     => trim($_POST['alias']     ?? '') ?: null,
    ];
    $bank_put = api_put('/bank-account', $bank_payload, $token);
    if (($bank_put['_http_code'] ?? 0) === 200) {
        $bank_success = 'Cuenta bancaria guardada.';
    } else {
        $bank_error = api_first_error($bank_put);
    }
}

// Crear nuevo reintegro
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['invoice'])) {
    $file = $_FILES['invoice'];

    if ($file['error'] !== UPLOAD_ERR_OK) {
        $error = 'No se pudo cargar el archivo. Intentá de nuevo.';
    } elseif ($file['size'] > 5 * 1024 * 1024) {
        $error = 'El archivo supera los 5 MB.';
    } elseif (strtolower(pathinfo($file['name'], PATHINFO_EXTENSION)) !== 'pdf') {
        $error = 'Solo se aceptan archivos PDF.';
    } else {
        $pdf_b64 = base64_encode(file_get_contents($file['tmp_name']));
        $payload = [
            'invoice_file_name'  => $file['name'],
            'invoice_pdf_base64' => $pdf_b64,
        ];

        $tipo = $_POST['tipo'] ?? '';
        if ($tipo !== '' && isset($TIPOS[$tipo])) $payload['tipo'] = $tipo;

        $fechaServicio = trim($_POST['fecha_servicio'] ?? '');
        if ($fechaServicio !== '') $payload['fecha_servicio'] = $fechaServicio;

        $prestador = trim($_POST['prestador'] ?? '');
        if ($prestador !== '') $payload['prestador'] = $prestador;

        $nroFactura = trim($_POST['nro_factura'] ?? '');
        if ($nroFactura !== '') $payload['nro_factura'] = $nroFactura;

        $monto = trim($_POST['monto_solicitado'] ?? '');
        if ($monto !== '' && is_numeric($monto)) $payload['monto_solicitado'] = (float)$monto;

        $notes = trim($_POST['notes'] ?? '');
        if ($notes !== '') $payload['notes'] = $notes;

        $res  = api_post('/reimbursements', $payload, $token);
        $code = $res['_http_code'] ?? 0;
        if ($code === 201 || $code === 200) {
            $success = 'Reintegro enviado correctamente. Revisaremos tu solicitud en breve.';
        } else {
            $error = api_first_error($res);
        }
    }
}

$res     = api_get('/reimbursements', $token);
$items   = $res['items']   ?? [];
$summary = $res['summary'] ?? [];

$bank_res = api_get('/bank-account', $token);
$bank     = $bank_res['bank_account'] ?? $bank_res ?? [];

function badge_reimb(string $status): string {
    $map = [
        'pendiente'              => ['bg-warning text-dark',     'Pendiente'],
        'en_revision'            => ['bg-info text-white',       'En revisión'],
        'requiere_documentacion' => ['bg-warning text-dark',     'Requiere doc'],
        'aprobado'               => ['bg-success text-white',    'Aprobado'],
        'pagado'                 => ['bg-primary text-white',    'Pagado'],
        'rechazado'              => ['bg-danger text-white',     'Rechazado'],
    ];
    [$cls, $label] = $map[strtolower($status)] ?? ['bg-secondary text-white', ucfirst($status)];
    return "<span class=\"status-badge badge {$cls}\">{$label}</span>";
}

function fmt_date_reimb(?string $d): string {
    if (!$d) return '––';
    $datePart = explode(' ', $d)[0];
    $parts = explode('-', $datePart);
    return count($parts) === 3 ? "{$parts[2]}/{$parts[1]}/{$parts[0]}" : $d;
}

function fmt_money(?string $v): string {
    if ($v === null || $v === '') return '––';
    return '$' . number_format((float)$v, 2, ',', '.');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reintegros – Portal Trinidad Salud</title>
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
      <h1><i class="bi bi-receipt me-2"></i>Reintegros</h1>
      <p>Enviá comprobantes y consultá el estado de tus solicitudes</p>
    </div>

    <!-- Datos bancarios -->
    <!-- Cuenta bancaria (GET + PUT /bank-account) -->
    <div class="p-card p-4 mb-4">
      <h5 class="fw-bold mb-3">
        <i class="bi bi-bank me-2" style="color:var(--p-primary);"></i>Cuenta bancaria para reintegros
      </h5>
      <?php if ($bank_success): ?>
        <div class="alert alert-success rounded-3 py-2 small"><?= htmlspecialchars($bank_success) ?></div>
      <?php elseif ($bank_error): ?>
        <div class="alert alert-danger rounded-3 py-2 small"><?= htmlspecialchars($bank_error) ?></div>
      <?php endif; ?>
      <form method="POST" novalidate>
        <input type="hidden" name="save_bank" value="1">
        <div class="row g-3">
          <div class="col-sm-6">
            <label class="form-label fw-semibold small">Banco</label>
            <input type="text" name="bank_name" class="form-control" placeholder="Ej: Banco Nación"
                   value="<?= htmlspecialchars($_POST['bank_name'] ?? $bank['bank_name'] ?? '') ?>">
          </div>
          <div class="col-sm-6">
            <label class="form-label fw-semibold small">CBU <span class="text-danger">*</span></label>
            <input type="text" name="cbu" class="form-control" placeholder="22 dígitos"
                   maxlength="22" inputmode="numeric"
                   value="<?= htmlspecialchars($_POST['cbu'] ?? $bank['cbu'] ?? '') ?>">
          </div>
          <div class="col-sm-6">
            <label class="form-label fw-semibold small">Alias (opcional)</label>
            <input type="text" name="alias" class="form-control" placeholder="Ej: MI.CUENTA.BANCO"
                   value="<?= htmlspecialchars($_POST['alias'] ?? $bank['alias'] ?? '') ?>">
          </div>
        </div>
        <button type="submit" class="btn btn-outline-primary rounded-3 mt-3">
          <i class="bi bi-save me-1"></i>Guardar cuenta
        </button>
      </form>
    </div>

    <!-- Stats -->
    <?php if (!empty($summary)): ?>
    <div class="row g-3 mb-4">
      <?php foreach ($summary as $lbl => $cnt): ?>
        <div class="col-6 col-sm-4">
          <div class="stat-chip">
            <div class="num"><?= (int)$cnt ?></div>
            <div class="lbl"><?= htmlspecialchars(ucfirst($lbl)) ?></div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <!-- Formulario nuevo reintegro -->
    <div class="p-card p-4 mb-4">
      <h5 class="fw-bold mb-3"><i class="bi bi-plus-circle me-2" style="color:var(--p-primary);"></i>Solicitar nuevo reintegro</h5>

      <?php if ($success): ?>
        <div class="alert alert-success rounded-3"><?= htmlspecialchars($success) ?></div>
      <?php elseif ($error): ?>
        <div class="alert alert-danger rounded-3"><?= htmlspecialchars($error) ?></div>
      <?php endif; ?>

      <form method="POST" enctype="multipart/form-data" novalidate>
        <div class="mb-3">
          <label class="form-label fw-semibold small">Comprobante (PDF, máx. 5 MB) <span class="text-danger">*</span></label>
          <div class="upload-zone" id="uploadZone" onclick="document.getElementById('invoice').click()">
            <i class="bi bi-file-earmark-pdf d-block mb-2"></i>
            <div class="fw-semibold" id="fileLabel">Clic para seleccionar PDF</div>
            <div class="text-muted small mt-1">Solo archivos .pdf</div>
          </div>
          <input type="file" name="invoice" id="invoice" accept=".pdf" class="d-none" onchange="updateLabel(this)">
        </div>

        <div class="row g-3">
          <div class="col-sm-6">
            <label class="form-label fw-semibold small">Tipo de gasto</label>
            <select name="tipo" class="form-select">
              <option value="">— elegir —</option>
              <?php foreach ($TIPOS as $value => $label): ?>
                <option value="<?= $value ?>" <?= ($_POST['tipo'] ?? '') === $value ? 'selected' : '' ?>>
                  <?= htmlspecialchars($label) ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="col-sm-6">
            <label class="form-label fw-semibold small">Fecha del servicio</label>
            <input type="date" name="fecha_servicio" class="form-control"
                   value="<?= htmlspecialchars($_POST['fecha_servicio'] ?? '') ?>">
          </div>
          <div class="col-sm-6">
            <label class="form-label fw-semibold small">Prestador</label>
            <input type="text" name="prestador" class="form-control"
                   placeholder="Médico, farmacia, óptica, etc."
                   value="<?= htmlspecialchars($_POST['prestador'] ?? '') ?>">
          </div>
          <div class="col-sm-6">
            <label class="form-label fw-semibold small">N° Factura</label>
            <input type="text" name="nro_factura" class="form-control"
                   value="<?= htmlspecialchars($_POST['nro_factura'] ?? '') ?>">
          </div>
          <div class="col-sm-6">
            <label class="form-label fw-semibold small">Monto solicitado ($)</label>
            <input type="number" name="monto_solicitado" class="form-control" step="0.01" min="0"
                   placeholder="Ej: 12500.00"
                   value="<?= htmlspecialchars($_POST['monto_solicitado'] ?? '') ?>">
          </div>
        </div>

        <div class="mb-3 mt-3">
          <label class="form-label fw-semibold small">Observaciones (opcional)</label>
          <textarea name="notes" class="form-control" rows="2" placeholder="Detalles adicionales"></textarea>
        </div>
        <button type="submit" class="btn-portal-primary btn">
          <i class="bi bi-send me-1"></i>Enviar solicitud
        </button>
      </form>
    </div>

    <!-- Historial -->
    <h5 class="fw-bold mb-3">Historial de solicitudes</h5>
    <?php if (empty($items)): ?>
      <div class="p-card p-5 text-center text-muted">
        <i class="bi bi-receipt fs-1 mb-3 d-block" style="opacity:.3;"></i>
        No tenés reintegros registrados.
      </div>
    <?php else: ?>
      <?php foreach ($items as $item): ?>
        <?php
          $status     = $item['status'] ?? 'pendiente';
          $canDownload = in_array($status, ['aprobado', 'pagado', 'rechazado']);
        ?>
        <div class="portal-list-item d-block">
          <div class="d-flex align-items-start">
            <div class="flex-grow-1">
              <div class="item-title">
                REI-<?= str_pad((int)($item['id'] ?? 0), 5, '0', STR_PAD_LEFT) ?> ·
                <?= htmlspecialchars($item['tipo_label'] ?? $item['invoice_file_name'] ?? 'Comprobante') ?>
              </div>
              <div class="item-sub">
                <i class="bi bi-calendar3 me-1"></i>Cargado: <?= fmt_date_reimb($item['created_at'] ?? null) ?>
                <?php if (!empty($item['fecha_servicio'])): ?>
                  &nbsp;·&nbsp; Servicio: <?= fmt_date_reimb($item['fecha_servicio']) ?>
                <?php endif; ?>
                <?php if (!empty($item['prestador'])): ?>
                  &nbsp;·&nbsp; <?= htmlspecialchars($item['prestador']) ?>
                <?php endif; ?>
              </div>
              <?php if (!empty($item['monto_solicitado']) || !empty($item['monto_aprobado'])): ?>
                <div class="item-sub mt-1">
                  <?php if (!empty($item['monto_solicitado'])): ?>
                    Solicitado: <?= fmt_money($item['monto_solicitado']) ?>
                  <?php endif; ?>
                  <?php if (!empty($item['monto_aprobado'])): ?>
                    &nbsp;·&nbsp; <strong style="color:#1B6E45;">Aprobado: <?= fmt_money($item['monto_aprobado']) ?></strong>
                    <?php if (!empty($item['paid_at'])): ?>
                      <span class="badge bg-primary text-white ms-1">Pagado</span>
                    <?php endif; ?>
                  <?php endif; ?>
                </div>
              <?php endif; ?>
              <?php if (!empty($item['notes'])): ?>
                <div class="item-sub mt-1"><i class="bi bi-chat-left-text me-1"></i><?= htmlspecialchars($item['notes']) ?></div>
              <?php endif; ?>
              <?php if (!empty($item['motivo_rechazo'])): ?>
                <div class="alert alert-danger small rounded-3 py-2 mt-2 mb-0">
                  <strong>Motivo del rechazo:</strong> <?= htmlspecialchars($item['motivo_rechazo']) ?>
                </div>
              <?php endif; ?>
            </div>
            <div class="flex-shrink-0 text-end">
              <?= badge_reimb($status) ?>
              <?php if ($canDownload): ?>
                <div class="mt-2">
                  <a href="pdf.php?type=reintegro&id=<?= (int)$item['id'] ?>"
                     class="btn btn-sm btn-outline-primary">
                    <i class="bi bi-download me-1"></i>PDF
                  </a>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>

  </div>
</main>

<script>
function updateLabel(input) {
  const lbl = document.getElementById('fileLabel');
  lbl.textContent = input.files[0] ? input.files[0].name : 'Clic para seleccionar PDF';
}
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
