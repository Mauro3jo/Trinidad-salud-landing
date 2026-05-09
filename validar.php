<?php
session_start();

// ===== Cargar .env (mismo patrón que el resto de la landing) =====
(function () {
    $env_file = __DIR__ . '/.env';
    if (!is_readable($env_file)) return;
    foreach (file($env_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
        if (str_starts_with(trim($line), '#')) continue;
        [$key, $val] = array_map('trim', explode('=', $line, 2)) + ['', ''];
        if ($key !== '' && !array_key_exists($key, $_ENV)) {
            $_ENV[$key] = $val;
        }
    }
})();

$portalBase = $_ENV['PORTAL_API_BASE'] ?? 'https://trinidadsalud.online/api/mobile';
$apiBase    = $_ENV['LANDING_API_BASE'] ?? preg_replace('#/mobile/?$#', '', $portalBase);
$API_BASE   = rtrim($apiBase, '/');

// ===== Helper para llamar a la API =====
function api_call(string $method, string $url, array $body = []): array {
    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER     => ['Accept: application/json', 'Content-Type: application/json'],
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_TIMEOUT        => 15,
        CURLOPT_CUSTOMREQUEST  => $method,
        CURLOPT_POSTFIELDS     => json_encode($body),
    ]);
    $resp = curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $err  = curl_error($ch);
    curl_close($ch);
    if ($err) return ['_error' => $err, '_http_code' => 0];
    $decoded = json_decode($resp, true) ?? [];
    $decoded['_http_code'] = $code;
    return $decoded;
}

// ===== Procesar POST (validar / confirmar uso) =====
$action = $_POST['action'] ?? '';
$codigo = strtoupper(trim($_POST['codigo'] ?? ''));
$dni    = trim($_POST['dni'] ?? '');
$prestador = trim($_POST['prestador'] ?? '');

$resultado = null;
$mensaje   = null;
$tipo_alerta = ''; // 'success' | 'danger' | 'warning'

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $codigo !== '' && $dni !== '') {
    if ($action === 'confirmar_uso') {
        $r = api_call('POST', $API_BASE . '/public/autorizaciones/marcar-usada', [
            'codigo'    => $codigo,
            'dni'       => $dni,
            'prestador' => $prestador ?: null,
        ]);
        if (($r['_http_code'] ?? 0) === 200) {
            $tipo_alerta = 'success';
            $mensaje = 'Autorización confirmada y marcada como utilizada.';
        } else {
            $tipo_alerta = 'danger';
            $mensaje = $r['mensaje'] ?? 'No se pudo marcar como usada.';
        }
        // Re-validar para mostrar el estado actualizado
        $r = api_call('POST', $API_BASE . '/public/autorizaciones/validar', [
            'codigo' => $codigo,
            'dni'    => $dni,
        ]);
        $resultado = $r;
    } else {
        // Acción default: solo validar
        $resultado = api_call('POST', $API_BASE . '/public/autorizaciones/validar', [
            'codigo' => $codigo,
            'dni'    => $dni,
        ]);
        if (!empty($resultado['valido'])) {
            $tipo_alerta = 'success';
        } elseif (in_array($resultado['estado'] ?? '', ['usada', 'vencida'])) {
            $tipo_alerta = 'warning';
        } else {
            $tipo_alerta = 'danger';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Validar autorización – Trinidad Salud</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
  <link rel="stylesheet" href="backend/css/style.css">
  <link rel="icon" href="backend/img/logo.png">
  <style>
    .validar-hero {
      background: linear-gradient(135deg, #2F7CE5 0%, #184F9D 100%);
      color: #fff;
      padding: 70px 0 50px;
      text-align: center;
    }
    .validar-hero h1 { font-weight: 800; }
    .validar-hero p { opacity: 0.92; font-size: 1.05rem; }
    .validar-section { padding: 50px 0; }

    .validar-card {
      background: #fff;
      border-radius: 22px;
      padding: 36px 30px;
      box-shadow: 0 10px 30px rgba(40, 70, 120, .08);
    }

    .estado-banner {
      border-radius: 14px;
      padding: 18px 22px;
      margin-bottom: 22px;
      display: flex;
      align-items: center;
      gap: 14px;
    }
    .estado-banner i { font-size: 2rem; }
    .estado-vigente  { background: #e7f8ef; color: #136B40; border: 2px solid #1B6E45; }
    .estado-usada    { background: #fff3d9; color: #8b6e1f; border: 2px solid #ffaa00; }
    .estado-vencida  { background: #FDE8E8; color: #a33d3d; border: 2px solid #dc3545; }
    .estado-rechazada{ background: #FDE8E8; color: #a33d3d; border: 2px solid #dc3545; }
    .estado-error    { background: #FDE8E8; color: #a33d3d; border: 2px solid #dc3545; }

    .info-row {
      display: flex; justify-content: space-between;
      padding: 8px 0; border-bottom: 1px solid #eef1f5;
      font-size: .94rem;
    }
    .info-row:last-child { border-bottom: none; }
    .info-label { color: #6b7a91; font-weight: 600; }
    .info-value { color: #34445d; font-weight: 700; text-align: right; }

    .codigo-display {
      font-family: 'Courier New', monospace;
      font-size: 1.4rem; font-weight: 800;
      letter-spacing: 2px;
      color: #184F9D;
    }
  </style>
</head>
<body>

<?php
// botonera.php espera estar en la raíz, lo incluimos si existe
if (file_exists(__DIR__ . '/botonera.php')) {
    include __DIR__ . '/botonera.php';
}
?>

<section class="validar-hero">
  <div class="container">
    <h1 class="display-5 mb-3"><i class="bi bi-shield-check me-2"></i>Validar autorización</h1>
    <p class="lead mx-auto" style="max-width: 720px;">
      Verificá que la autorización del afiliado esté activa y no haya sido utilizada antes de la atención.
    </p>
  </div>
</section>

<section class="validar-section">
  <div class="container" style="max-width: 720px;">

    <!-- Formulario de validación -->
    <div class="validar-card mb-4">
      <h4 class="fw-bold mb-3"><i class="bi bi-search me-2" style="color:#2F7CE5"></i>Datos de la autorización</h4>

      <form method="POST" novalidate>
        <input type="hidden" name="action" value="validar">

        <div class="row g-3">
          <div class="col-md-7">
            <label class="form-label fw-semibold small">Código de autorización <span class="text-danger">*</span></label>
            <input type="text" name="codigo" class="form-control form-control-lg"
                   placeholder="AUT-XXXXXXXX" required
                   value="<?= htmlspecialchars($codigo) ?>"
                   style="font-family: 'Courier New', monospace; letter-spacing: 1px; text-transform: uppercase;">
          </div>
          <div class="col-md-5">
            <label class="form-label fw-semibold small">DNI del afiliado <span class="text-danger">*</span></label>
            <input type="text" name="dni" class="form-control form-control-lg"
                   placeholder="12345678" required maxlength="10" inputmode="numeric"
                   value="<?= htmlspecialchars($dni) ?>">
          </div>
        </div>

        <button type="submit" class="btn btn-primary btn-lg mt-3 w-100" style="background:#184F9D;border:none;">
          <i class="bi bi-shield-check me-2"></i>Validar
        </button>
      </form>
    </div>

    <!-- Resultado -->
    <?php if ($resultado !== null): ?>
      <?php
        $estado = $resultado['estado'] ?? 'error';
        $datos  = $resultado['datos']  ?? null;
        $msj    = $resultado['mensaje'] ?? '';
      ?>

      <?php if ($mensaje): ?>
        <div class="alert alert-<?= $tipo_alerta ?> rounded-3"><?= htmlspecialchars($mensaje) ?></div>
      <?php endif; ?>

      <div class="validar-card">

        <!-- Banner de estado -->
        <?php if ($estado === 'vigente'): ?>
          <div class="estado-banner estado-vigente">
            <i class="bi bi-check-circle-fill"></i>
            <div>
              <div class="fw-bold fs-5">Autorización VIGENTE</div>
              <div class="small">Podés atender al paciente.</div>
            </div>
          </div>
        <?php elseif ($estado === 'usada'): ?>
          <div class="estado-banner estado-usada">
            <i class="bi bi-exclamation-triangle-fill"></i>
            <div>
              <div class="fw-bold fs-5">Ya UTILIZADA</div>
              <div class="small">
                Usada el <?= htmlspecialchars(date('d/m/Y H:i', strtotime($resultado['usada_at'] ?? ''))) ?>
                <?php if (!empty($resultado['usada_por_prestador'])): ?>
                  por <?= htmlspecialchars($resultado['usada_por_prestador']) ?>
                <?php endif; ?>
              </div>
            </div>
          </div>
        <?php elseif ($estado === 'vencida'): ?>
          <div class="estado-banner estado-vencida">
            <i class="bi bi-x-circle-fill"></i>
            <div>
              <div class="fw-bold fs-5">VENCIDA</div>
              <div class="small"><?= htmlspecialchars($msj) ?></div>
            </div>
          </div>
        <?php elseif ($estado === 'inexistente'): ?>
          <div class="estado-banner estado-error">
            <i class="bi bi-x-circle-fill"></i>
            <div>
              <div class="fw-bold fs-5">No encontrada</div>
              <div class="small">El código no existe en el sistema.</div>
            </div>
          </div>
        <?php elseif ($estado === 'dni_no_coincide'): ?>
          <div class="estado-banner estado-error">
            <i class="bi bi-x-circle-fill"></i>
            <div>
              <div class="fw-bold fs-5">DNI incorrecto</div>
              <div class="small">El DNI no coincide con el titular del código.</div>
            </div>
          </div>
        <?php else: ?>
          <div class="estado-banner estado-rechazada">
            <i class="bi bi-x-circle-fill"></i>
            <div>
              <div class="fw-bold fs-5"><?= htmlspecialchars(strtoupper($estado)) ?></div>
              <div class="small"><?= htmlspecialchars($msj) ?></div>
            </div>
          </div>
        <?php endif; ?>

        <!-- Datos del afiliado y autorización -->
        <?php if ($datos): ?>
          <h6 class="fw-bold mt-4 mb-2"><i class="bi bi-person me-2"></i>Afiliado</h6>
          <div class="info-row"><span class="info-label">Nombre</span><span class="info-value"><?= htmlspecialchars($datos['afiliado']['nombre'] ?? '—') ?></span></div>
          <div class="info-row"><span class="info-label">DNI</span><span class="info-value"><?= htmlspecialchars($datos['afiliado']['dni'] ?? '—') ?></span></div>
          <div class="info-row"><span class="info-label">N° Afiliado</span><span class="info-value"><?= htmlspecialchars($datos['afiliado']['nro_afiliado'] ?? '—') ?></span></div>
          <div class="info-row"><span class="info-label">Plan</span><span class="info-value"><?= htmlspecialchars($datos['afiliado']['plan'] ?? '—') ?></span></div>

          <h6 class="fw-bold mt-4 mb-2"><i class="bi bi-file-medical me-2"></i>Autorización</h6>
          <div class="info-row"><span class="info-label">Código</span><span class="info-value codigo-display"><?= htmlspecialchars($datos['codigo_autorizacion'] ?? '—') ?></span></div>
          <div class="info-row"><span class="info-label">Tipo</span><span class="info-value"><?= htmlspecialchars($datos['tipo'] ?? '—') ?></span></div>
          <div class="info-row"><span class="info-label">Solicitud</span><span class="info-value"><?= htmlspecialchars($datos['titulo'] ?? '—') ?></span></div>
          <?php if (!empty($datos['prestador_solicitado'])): ?>
            <div class="info-row"><span class="info-label">Prestador previsto</span><span class="info-value"><?= htmlspecialchars($datos['prestador_solicitado']) ?></span></div>
          <?php endif; ?>
          <?php if (!empty($datos['fecha_emision'])): ?>
            <div class="info-row"><span class="info-label">Emitida</span><span class="info-value"><?= htmlspecialchars(date('d/m/Y', strtotime($datos['fecha_emision']))) ?></span></div>
          <?php endif; ?>
          <?php if (!empty($datos['fecha_vencimiento'])): ?>
            <div class="info-row"><span class="info-label">Vence</span><span class="info-value"><?= htmlspecialchars(date('d/m/Y', strtotime($datos['fecha_vencimiento']))) ?></span></div>
          <?php endif; ?>
        <?php endif; ?>

        <!-- Botón confirmar uso (solo si está vigente) -->
        <?php if ($estado === 'vigente'): ?>
          <hr class="my-4">
          <h6 class="fw-bold mb-3"><i class="bi bi-pencil-square me-2"></i>Confirmar el uso</h6>
          <p class="small text-muted">
            Al confirmar, la autorización quedará marcada como utilizada y no podrá usarse de nuevo.
          </p>
          <form method="POST" novalidate>
            <input type="hidden" name="action" value="confirmar_uso">
            <input type="hidden" name="codigo" value="<?= htmlspecialchars($codigo) ?>">
            <input type="hidden" name="dni"    value="<?= htmlspecialchars($dni) ?>">
            <div class="mb-3">
              <label class="form-label fw-semibold small">Tu nombre / consultorio (opcional)</label>
              <input type="text" name="prestador" class="form-control"
                     placeholder="Ej: Dr. Pérez — Consultorio centro"
                     maxlength="255">
            </div>
            <button type="submit" class="btn btn-success btn-lg w-100">
              <i class="bi bi-check-lg me-2"></i>Confirmar uso
            </button>
          </form>
        <?php endif; ?>

      </div>
    <?php endif; ?>

    <p class="text-center small text-muted mt-4">
      <i class="bi bi-shield-lock me-1"></i>
      Validación segura — Trinidad Salud
    </p>
  </div>
</section>

<?php
if (file_exists(__DIR__ . '/footer.html')) {
    include __DIR__ . '/footer.html';
}
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
