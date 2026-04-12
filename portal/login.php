<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/api.php';

// Already logged in → go home
if (!empty($_SESSION['portal_token'])) {
    header('Location: home.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dni      = trim($_POST['dni']      ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($dni === '' || $password === '') {
        $error = 'Completá todos los campos.';
    } else {
        $res = api_post('/login', ['DNI' => $dni, 'password' => $password]);

        if (($res['_http_code'] ?? 0) === 200 && !empty($res['token'])) {
            $_SESSION['portal_token'] = $res['token'];
            $_SESSION['portal_user']  = $res['user'] ?? [];

            // Initial password setup required
            if (!empty($res['must_change_password'])) {
                header('Location: password.php?setup=1');
                exit;
            }

            header('Location: home.php');
            exit;
        } else {
            $error = api_first_error($res) ?: 'DNI o contraseña incorrectos.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ingresar – Portal Trinidad Salud</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
  <link rel="stylesheet" href="css/portal.css">
  <link rel="icon" href="../backend/img/logo.png">
</head>
<body class="portal-body">
<div class="login-wrap">
  <div class="login-card">
    <div class="text-center mb-4">
      <img src="../backend/img/logo.png" alt="Logo" class="login-logo mb-3">
      <h2>Portal de Afiliados</h2>
      <p class="text-muted small">Ingresá con tu DNI y contraseña</p>
    </div>

    <?php if ($error): ?>
      <div class="alert alert-danger rounded-3 py-2 small"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST" novalidate>
      <div class="mb-3">
        <label class="form-label fw-semibold small">DNI</label>
        <div class="input-group">
          <span class="input-group-text"><i class="bi bi-person"></i></span>
          <input type="text" name="dni" class="form-control" placeholder="Ej: 30123456"
                 value="<?= htmlspecialchars($_POST['dni'] ?? '') ?>"
                 maxlength="10" inputmode="numeric" required autofocus>
        </div>
      </div>
      <div class="mb-4">
        <label class="form-label fw-semibold small">Contraseña</label>
        <div class="input-group">
          <span class="input-group-text"><i class="bi bi-lock"></i></span>
          <input type="password" name="password" id="pwd" class="form-control" placeholder="••••••••" required>
          <button type="button" class="btn btn-outline-secondary" onclick="togglePwd()">
            <i class="bi bi-eye" id="eye-icon"></i>
          </button>
        </div>
      </div>
      <button type="submit" class="btn-portal-primary btn">
        <i class="bi bi-box-arrow-in-right me-1"></i>Ingresar
      </button>
    </form>

    <p class="text-center text-muted small mt-4 mb-0">
      ¿Problemas para ingresar?
      <a href="ayuda.php" class="text-decoration-none" style="color:var(--p-primary)">Contactanos</a>
    </p>
  </div>
</div>

<script>
function togglePwd() {
  const p = document.getElementById('pwd');
  const i = document.getElementById('eye-icon');
  if (p.type === 'password') { p.type = 'text'; i.className = 'bi bi-eye-slash'; }
  else                        { p.type = 'password'; i.className = 'bi bi-eye'; }
}
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
