<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/api.php';

if (!empty($_SESSION['prestador_token'])) {
    header('Location: home.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email    = trim($_POST['email']    ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($email === '' || $password === '') {
        $error = 'Completá email y contraseña.';
    } else {
        $res = papi_post('/login', ['email' => $email, 'password' => $password]);

        if (($res['_http_code'] ?? 0) === 200 && !empty($res['token'])) {
            $_SESSION['prestador_token'] = $res['token'];
            $_SESSION['prestador_user']  = $res['prestador'] ?? [];

            if (!empty($res['must_change_password'])) {
                header('Location: perfil.php?cambiar_pwd=1');
                exit;
            }
            header('Location: home.php');
            exit;
        } else {
            $error = papi_first_error($res) ?: 'Email o contraseña incorrectos.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ingresar – Portal Prestadores Trinidad Salud</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
  <link rel="stylesheet" href="css/portal.css">
  <link rel="icon" href="../backend/img/logo.png">
</head>
<body class="prest-body">
<div class="login-wrap">
  <div class="login-card">
    <div class="text-center mb-4">
      <img src="../backend/img/logo.png" alt="Logo" class="login-logo mb-3">
      <h2 class="fw-bold" style="color:#184F9D;">Portal de Prestadores</h2>
      <p class="text-muted small">Validá autorizaciones de los afiliados de Trinidad Salud</p>
    </div>

    <?php if ($error): ?>
      <div class="alert alert-danger rounded-3 py-2 small"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST" novalidate>
      <div class="mb-3">
        <label class="form-label fw-semibold small">Email</label>
        <div class="input-group">
          <span class="input-group-text"><i class="bi bi-envelope"></i></span>
          <input type="email" name="email" class="form-control" required autofocus
                 value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
        </div>
      </div>
      <div class="mb-4">
        <label class="form-label fw-semibold small">Contraseña</label>
        <div class="input-group">
          <span class="input-group-text"><i class="bi bi-lock"></i></span>
          <input type="password" name="password" id="pwd" class="form-control" required>
          <button type="button" class="btn btn-outline-secondary" onclick="togglePwd()">
            <i class="bi bi-eye" id="eye-icon"></i>
          </button>
        </div>
      </div>
      <button type="submit" class="btn-prest-primary btn">
        <i class="bi bi-box-arrow-in-right me-1"></i>Ingresar
      </button>
    </form>

    <p class="text-center text-muted small mt-4 mb-0">
      ¿No tenés cuenta? Pedila a Trinidad Salud al
      <a href="https://api.whatsapp.com/send?phone=5493813658588" class="text-decoration-none" style="color:#25d366">
        <i class="bi bi-whatsapp"></i> 381-3658588
      </a>
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
</body>
</html>
