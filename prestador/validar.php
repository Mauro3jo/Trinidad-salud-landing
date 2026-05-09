<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/api.php';

prestador_require_auth();

$action = $_POST['action'] ?? '';
$codigo = strtoupper(trim($_POST['codigo'] ?? ''));
$dni    = trim($_POST['dni'] ?? '');

$resultado = null;
$mensaje   = $_SESSION['flash_msg']  ?? null;
$tipo_alert= $_SESSION['flash_tipo'] ?? '';
unset($_SESSION['flash_msg'], $_SESSION['flash_tipo']);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $codigo !== '' && $dni !== '') {
    if ($action === 'confirmar_uso') {
        $r = papi_post('/autorizaciones/marcar-usada', [
            'codigo' => $codigo, 'dni' => $dni,
        ], prestador_token());
        if (($r['_http_code'] ?? 0) === 200) {
            $_SESSION['flash_msg']  = 'Autorización confirmada y marcada como utilizada.';
            $_SESSION['flash_tipo'] = 'success';
        } else {
            $_SESSION['flash_msg']  = $r['message'] ?? 'No se pudo marcar como usada.';
            $_SESSION['flash_tipo'] = 'danger';
        }
        // Re-validar para ver el estado actualizado
        header('Location: validar.php?codigo=' . urlencode($codigo) . '&dni=' . urlencode($dni));
        exit;
    } else {
        $resultado = papi_post('/autorizaciones/validar', [
            'codigo' => $codigo, 'dni' => $dni,
        ], prestador_token());
    }
}

// Soporte de GET para mostrar resultado tras redirect
if ($_SERVER['REQUEST_METHOD'] === 'GET' && !empty($_GET['codigo']) && !empty($_GET['dni'])) {
    $codigo = strtoupper(trim($_GET['codigo']));
    $dni    = trim($_GET['dni']);
    $resultado = papi_post('/autorizaciones/validar', [
        'codigo' => $codigo, 'dni' => $dni,
    ], prestador_token());
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Validar autorización – Prestadores</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
  <link rel="stylesheet" href="css/portal.css">
  <link rel="icon" href="../backend/img/logo.png">
</head>
<body class="prest-body">
<?php include __DIR__ . '/includes/nav.php'; ?>

<main class="prest-main">
  <div class="container" style="max-width: 720px;">

    <div class="prest-header mb-4">
      <h1><i class="bi bi-shield-check me-2"></i>Validar autorización</h1>
      <p>Ingresá el código que te trajo el paciente y su DNI.</p>
    </div>

    <?php if ($mensaje): ?>
      <div class="alert alert-<?= htmlspecialchars($tipo_alert ?: 'info') ?> rounded-3"><?= htmlspecialchars($mensaje) ?></div>
    <?php endif; ?>

    <div class="p-card p-4 mb-4">
      <form method="POST" novalidate>
        <input type="hidden" name="action" value="validar">
        <div class="row g-3">
          <div class="col-md-7">
            <label class="form-label fw-semibold small">Código de autorización <span class="text-danger">*</span></label>
            <input type="text" name="codigo" class="form-control form-control-lg"
                   placeholder="AUT-XXXXXXXX" required
                   value="<?= htmlspecialchars($codigo) ?>"
                   style="font-family: monospace; letter-spacing: 1px; text-transform: uppercase;">
          </div>
          <div class="col-md-5">
            <label class="form-label fw-semibold small">DNI del afiliado <span class="text-danger">*</span></label>
            <input type="text" name="dni" class="form-control form-control-lg"
                   placeholder="12345678" required maxlength="10" inputmode="numeric"
                   value="<?= htmlspecialchars($dni) ?>">
          </div>
        </div>
        <button type="submit" class="btn-prest-primary btn mt-3">
          <i class="bi bi-shield-check me-2"></i>Validar
        </button>
      </form>
    </div>

    <?php if ($resultado !== null): ?>
      <?php
        $estado = $resultado['estado'] ?? 'error';
        $datos  = $resultado['datos']  ?? null;
        $msj    = $resultado['mensaje'] ?? '';
      ?>
      <div class="p-card p-4">
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
            <div><div class="fw-bold fs-5">VENCIDA</div><div class="small"><?= htmlspecialchars($msj) ?></div></div>
          </div>
        <?php elseif ($estado === 'inexistente'): ?>
          <div class="estado-banner estado-error">
            <i class="bi bi-x-circle-fill"></i>
            <div><div class="fw-bold fs-5">No encontrada</div><div class="small">El código no existe.</div></div>
          </div>
        <?php elseif ($estado === 'dni_no_coincide'): ?>
          <div class="estado-banner estado-error">
            <i class="bi bi-x-circle-fill"></i>
            <div><div class="fw-bold fs-5">DNI incorrecto</div><div class="small">El DNI no coincide con el titular.</div></div>
          </div>
        <?php else: ?>
          <div class="estado-banner estado-rechazada">
            <i class="bi bi-x-circle-fill"></i>
            <div><div class="fw-bold fs-5"><?= htmlspecialchars(strtoupper($estado)) ?></div><div class="small"><?= htmlspecialchars($msj) ?></div></div>
          </div>
        <?php endif; ?>

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
          <?php if (!empty($datos['fecha_emision'])): ?><div class="info-row"><span class="info-label">Emitida</span><span class="info-value"><?= htmlspecialchars(date('d/m/Y', strtotime($datos['fecha_emision']))) ?></span></div><?php endif; ?>
          <?php if (!empty($datos['fecha_vencimiento'])): ?><div class="info-row"><span class="info-label">Vence</span><span class="info-value"><?= htmlspecialchars(date('d/m/Y', strtotime($datos['fecha_vencimiento']))) ?></span></div><?php endif; ?>
        <?php endif; ?>

        <?php if ($estado === 'vigente'): ?>
          <hr class="my-4">
          <h6 class="fw-bold mb-3"><i class="bi bi-pencil-square me-2"></i>Confirmar el uso</h6>
          <p class="small text-muted">Al confirmar, la autorización quedará marcada como utilizada y registrada a tu nombre.</p>
          <form method="POST" novalidate>
            <input type="hidden" name="action" value="confirmar_uso">
            <input type="hidden" name="codigo" value="<?= htmlspecialchars($codigo) ?>">
            <input type="hidden" name="dni"    value="<?= htmlspecialchars($dni) ?>">
            <button type="submit" class="btn btn-success btn-lg w-100">
              <i class="bi bi-check-lg me-2"></i>Confirmar uso
            </button>
          </form>
        <?php endif; ?>
      </div>
    <?php endif; ?>

  </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
