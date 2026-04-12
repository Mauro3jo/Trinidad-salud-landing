<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/api.php';

// During initial setup token may already be in session (set at login)
if (session_status() === PHP_SESSION_NONE) session_start();

$setup = isset($_GET['setup']);

// If not setup mode, require full auth
if (!$setup) {
    portal_require_auth();
}

$error   = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new     = trim($_POST['new_password']     ?? '');
    $confirm = trim($_POST['confirm_password'] ?? '');
    $current = trim($_POST['current_password'] ?? '');

    if ($new === '' || $confirm === '') {
        $error = 'Completá todos los campos.';
    } elseif (strlen($new) < 8) {
        $error = 'La contraseña debe tener al menos 8 caracteres.';
    } elseif (!preg_match('/[a-zA-Z]/', $new) || !preg_match('/[0-9]/', $new)) {
        $error = 'La contraseña debe tener letras y números.';
    } elseif ($new !== $confirm) {
        $error = 'Las contraseñas no coinciden.';
    } else {
        $payload = [
            'password'              => $new,
            'password_confirmation' => $confirm,
        ];
        if (!$setup && $current !== '') {
            $payload['current_password'] = $current;
        }

        $res = api_put('/password', $payload, portal_token());

        if (($res['_http_code'] ?? 0) === 200) {
            if ($setup) {
                header('Location: home.php');
                exit;
            }
            $success = 'Contraseña actualizada correctamente.';
        } else {
            $error = api_first_error($res);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $setup ? 'Crear contraseña' : 'Cambiar contraseña' ?> – Portal Trinidad Salud</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
  <link rel="stylesheet" href="css/portal.css">
  <link rel="icon" href="../backend/img/logo.png">
</head>
<body class="portal-body">
<?php if (!$setup): include __DIR__ . '/includes/nav.php'; endif; ?>

<main class="portal-main <?= $setup ? 'd-flex align-items-center justify-content-center' : '' ?>"
      <?= $setup ? 'style="min-height:100vh;padding-top:0;"' : '' ?>>
  <div class="container <?= $setup ? '' : '' ?>" style="max-width:480px;">

    <?php if ($setup): ?>
      <div class="text-center mb-4 mt-3">
        <img src="../backend/img/logo.png" alt="Logo" width="52" class="mb-3">
        <h3 class="fw-bold" style="color:var(--p-dark);">Crear contraseña</h3>
        <p class="text-muted small">Es tu primer ingreso. Creá una contraseña segura para continuar.</p>
      </div>
    <?php else: ?>
      <div class="portal-header mb-4">
        <h1><i class="bi bi-shield-lock-fill me-2"></i>Cambiar contraseña</h1>
        <p>Actualizá tu clave de acceso</p>
      </div>
    <?php endif; ?>

    <?php if ($success): ?>
      <div class="alert alert-success rounded-3"><?= htmlspecialchars($success) ?></div>
    <?php elseif ($error): ?>
      <div class="alert alert-danger rounded-3"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <div class="p-card p-4">
      <form method="POST" novalidate>

        <?php if (!$setup): ?>
        <div class="mb-3">
          <label class="form-label fw-semibold small">Contraseña actual</label>
          <div class="input-group">
            <input type="password" name="current_password" id="pwd0" class="form-control" placeholder="••••••••">
            <button type="button" class="btn btn-outline-secondary" onclick="toggleField('pwd0','eye0')">
              <i class="bi bi-eye" id="eye0"></i>
            </button>
          </div>
        </div>
        <?php endif; ?>

        <div class="mb-3">
          <label class="form-label fw-semibold small">Nueva contraseña</label>
          <div class="input-group">
            <input type="password" name="new_password" id="pwd1" class="form-control" placeholder="Mín. 8 caracteres, letras y números">
            <button type="button" class="btn btn-outline-secondary" onclick="toggleField('pwd1','eye1')">
              <i class="bi bi-eye" id="eye1"></i>
            </button>
          </div>
          <div class="form-text">Mínimo 8 caracteres con letras y números.</div>
        </div>

        <div class="mb-4">
          <label class="form-label fw-semibold small">Repetir nueva contraseña</label>
          <div class="input-group">
            <input type="password" name="confirm_password" id="pwd2" class="form-control" placeholder="••••••••">
            <button type="button" class="btn btn-outline-secondary" onclick="toggleField('pwd2','eye2')">
              <i class="bi bi-eye" id="eye2"></i>
            </button>
          </div>
        </div>

        <button type="submit" class="btn-portal-primary btn">
          <i class="bi bi-check-lg me-1"></i><?= $setup ? 'Crear contraseña y continuar' : 'Actualizar contraseña' ?>
        </button>

        <?php if (!$setup): ?>
        <a href="perfil.php" class="btn btn-outline-secondary rounded-3 ms-2">Cancelar</a>
        <?php endif; ?>
      </form>
    </div>

  </div>
</main>

<script>
function toggleField(id, eyeId) {
  const f = document.getElementById(id);
  const e = document.getElementById(eyeId);
  if (f.type === 'password') { f.type = 'text'; e.className = 'bi bi-eye-slash'; }
  else                        { f.type = 'password'; e.className = 'bi bi-eye'; }
}
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
