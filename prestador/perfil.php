<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/api.php';

prestador_require_auth();

$success = $_SESSION['flash_msg']  ?? '';
$error   = $_SESSION['flash_err']  ?? '';
unset($_SESSION['flash_msg'], $_SESSION['flash_err']);

$forzarCambio = !empty($_GET['cambiar_pwd']);

// Guardar perfil
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_profile'])) {
    $payload = [
        'name'         => trim($_POST['name']         ?? ''),
        'telefono'     => trim($_POST['telefono']     ?? '') ?: null,
        'direccion'    => trim($_POST['direccion']    ?? '') ?: null,
        'localidad'    => trim($_POST['localidad']    ?? '') ?: null,
        'especialidad' => trim($_POST['especialidad'] ?? '') ?: null,
        'matricula'    => trim($_POST['matricula']    ?? '') ?: null,
    ];
    $r = papi_put('/profile', $payload, prestador_token());
    if (($r['_http_code'] ?? 0) === 200) {
        $_SESSION['flash_msg'] = 'Datos actualizados.';
        $_SESSION['prestador_user'] = $r['prestador'] ?? $_SESSION['prestador_user'];
    } else {
        $_SESSION['flash_err'] = papi_first_error($r);
    }
    header('Location: perfil.php');
    exit;
}

// Cambiar contraseña
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_password'])) {
    $payload = [
        'current_password'      => $_POST['current_password'] ?? '',
        'password'              => $_POST['password'] ?? '',
        'password_confirmation' => $_POST['password_confirmation'] ?? '',
    ];
    $r = papi_put('/password', $payload, prestador_token());
    if (($r['_http_code'] ?? 0) === 200) {
        $_SESSION['flash_msg'] = 'Contraseña actualizada.';
    } else {
        $_SESSION['flash_err'] = papi_first_error($r);
    }
    header('Location: perfil.php');
    exit;
}

$me_res    = papi_get('/me', prestador_token());
$prestador = $me_res['prestador'] ?? prestador_user();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Perfil – Prestadores Trinidad Salud</title>
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
      <h1><i class="bi bi-person me-2"></i>Mi perfil</h1>
      <p>Actualizá tus datos profesionales y contraseña.</p>
    </div>

    <?php if ($success): ?><div class="alert alert-success rounded-3"><?= htmlspecialchars($success) ?></div><?php endif; ?>
    <?php if ($error):   ?><div class="alert alert-danger  rounded-3"><?= htmlspecialchars($error)   ?></div><?php endif; ?>

    <?php if ($forzarCambio || !empty($prestador['must_change_password'])): ?>
      <div class="alert alert-warning rounded-3">
        <i class="bi bi-key me-1"></i>
        <strong>Tenés que cambiar tu contraseña</strong> antes de validar autorizaciones.
      </div>
    <?php endif; ?>

    <!-- Cambio de contraseña -->
    <div class="p-card p-4 mb-4">
      <h5 class="fw-bold mb-3"><i class="bi bi-key me-2" style="color:#2F7CE5"></i>Cambiar contraseña</h5>
      <form method="POST" novalidate>
        <input type="hidden" name="save_password" value="1">
        <?php if (empty($prestador['must_change_password'])): ?>
        <div class="mb-3">
          <label class="form-label fw-semibold small">Contraseña actual</label>
          <input type="password" name="current_password" class="form-control" required>
        </div>
        <?php endif; ?>
        <div class="mb-3">
          <label class="form-label fw-semibold small">Nueva contraseña <span class="text-danger">*</span></label>
          <input type="password" name="password" class="form-control" required minlength="6">
        </div>
        <div class="mb-3">
          <label class="form-label fw-semibold small">Confirmar nueva contraseña <span class="text-danger">*</span></label>
          <input type="password" name="password_confirmation" class="form-control" required minlength="6">
        </div>
        <button type="submit" class="btn btn-prest-primary">
          <i class="bi bi-save me-1"></i>Cambiar contraseña
        </button>
      </form>
    </div>

    <!-- Datos profesionales -->
    <div class="p-card p-4">
      <h5 class="fw-bold mb-3"><i class="bi bi-card-text me-2" style="color:#2F7CE5"></i>Datos profesionales</h5>
      <form method="POST" novalidate>
        <input type="hidden" name="save_profile" value="1">
        <div class="row g-3">
          <div class="col-sm-12">
            <label class="form-label fw-semibold small">Nombre / Razón social</label>
            <input type="text" name="name" class="form-control"
                   value="<?= htmlspecialchars($prestador['name'] ?? '') ?>" required>
          </div>
          <div class="col-sm-6">
            <label class="form-label fw-semibold small">Especialidad</label>
            <input type="text" name="especialidad" class="form-control"
                   value="<?= htmlspecialchars($prestador['especialidad'] ?? '') ?>">
          </div>
          <div class="col-sm-6">
            <label class="form-label fw-semibold small">Matrícula</label>
            <input type="text" name="matricula" class="form-control"
                   value="<?= htmlspecialchars($prestador['matricula'] ?? '') ?>">
          </div>
          <div class="col-sm-6">
            <label class="form-label fw-semibold small">Teléfono</label>
            <input type="text" name="telefono" class="form-control"
                   value="<?= htmlspecialchars($prestador['telefono'] ?? '') ?>">
          </div>
          <div class="col-sm-6">
            <label class="form-label fw-semibold small">Localidad</label>
            <input type="text" name="localidad" class="form-control"
                   value="<?= htmlspecialchars($prestador['localidad'] ?? '') ?>">
          </div>
          <div class="col-sm-12">
            <label class="form-label fw-semibold small">Dirección</label>
            <input type="text" name="direccion" class="form-control"
                   value="<?= htmlspecialchars($prestador['direccion'] ?? '') ?>">
          </div>
          <div class="col-sm-12">
            <label class="form-label fw-semibold small">Email <small class="text-muted">(no editable)</small></label>
            <input type="email" class="form-control" disabled
                   value="<?= htmlspecialchars($prestador['email'] ?? '') ?>">
          </div>
        </div>
        <button type="submit" class="btn btn-prest-primary mt-3">
          <i class="bi bi-save me-1"></i>Guardar datos
        </button>
      </form>
    </div>

  </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
