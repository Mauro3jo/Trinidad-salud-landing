<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/api.php';

portal_require_auth();

$token = portal_token();
$res   = api_get('/profile', $token);
// MobileProfileResponse: { summary, profile: MobileUser }
// MobileUser.profile tiene los campos editables: Nombres, Apellido, Email, Domicilio, etc.
$mobile_user = $res['profile'] ?? portal_user();
$profile     = $mobile_user['profile'] ?? [];   // campos con PascalCase
$summary     = $res['summary'] ?? [];

$error   = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $payload = [
        'Email'               => trim($_POST['email']        ?? ''),
        'Domicilio'           => trim($_POST['domicilio']    ?? ''),
        'Localidad'           => trim($_POST['localidad']    ?? ''),
        'Celular'             => trim($_POST['celular']      ?? ''),
        'TelFijo'             => trim($_POST['telfijo']      ?? ''),
        'AntecedentesMedicos' => trim($_POST['antecedentes'] ?? ''),
    ];

    $put = api_put('/profile', $payload, $token);

    if (($put['_http_code'] ?? 0) === 200) {
        $success     = 'Datos actualizados correctamente.';
        $mobile_user = $put['user'] ?? $mobile_user;
        $profile     = $mobile_user['profile'] ?? $profile;
        $_SESSION['portal_user'] = $mobile_user;
    } else {
        $error = api_first_error($put);
    }
}

$name = $summary['full_name'] ?? trim(($profile['Nombres'] ?? '') . ' ' . ($profile['Apellido'] ?? '')) ?: portal_user_name();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mis datos – Portal Trinidad Salud</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
  <link rel="stylesheet" href="css/portal.css">
  <link rel="icon" href="../backend/img/logo.png">
</head>
<body class="portal-body">
<?php include __DIR__ . '/includes/nav.php'; ?>

<main class="portal-main">
  <div class="container" style="max-width:640px;">

    <div class="portal-header mb-4">
      <h1><i class="bi bi-pencil-fill me-2"></i>Mis datos personales</h1>
      <p><?= htmlspecialchars($name) ?></p>
    </div>

    <?php if ($success): ?>
      <div class="alert alert-success rounded-3"><?= htmlspecialchars($success) ?></div>
    <?php elseif ($error): ?>
      <div class="alert alert-danger rounded-3"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <div class="p-card p-4">
      <!-- Datos no editables -->
      <div class="row g-3 mb-3">
        <div class="col-sm-6">
          <label class="form-label fw-semibold small text-muted">Nombre y Apellido</label>
          <input type="text" class="form-control bg-light" value="<?= htmlspecialchars($name) ?>" disabled>
        </div>
        <div class="col-sm-6">
          <label class="form-label fw-semibold small text-muted">DNI</label>
          <input type="text" class="form-control bg-light" value="<?= htmlspecialchars($summary['dni'] ?? ($mobile_user['dni'] ?? '––')) ?>" disabled>
        </div>
      </div>
      <hr class="my-3">

      <form method="POST" novalidate>
        <div class="row g-3">
          <div class="col-sm-6">
            <label class="form-label fw-semibold small">Email</label>
            <input type="email" name="email" class="form-control"
                   value="<?= htmlspecialchars($_POST['email'] ?? $profile['Email'] ?? '') ?>">
          </div>
          <div class="col-sm-6">
            <label class="form-label fw-semibold small">Celular</label>
            <input type="tel" name="celular" class="form-control"
                   value="<?= htmlspecialchars($_POST['celular'] ?? $profile['Celular'] ?? '') ?>">
          </div>
          <div class="col-sm-6">
            <label class="form-label fw-semibold small">Teléfono fijo</label>
            <input type="tel" name="telfijo" class="form-control"
                   value="<?= htmlspecialchars($_POST['telfijo'] ?? $profile['TelFijo'] ?? '') ?>">
          </div>
          <div class="col-sm-6">
            <label class="form-label fw-semibold small">Localidad</label>
            <input type="text" name="localidad" class="form-control"
                   value="<?= htmlspecialchars($_POST['localidad'] ?? $profile['Localidad'] ?? '') ?>">
          </div>
          <div class="col-12">
            <label class="form-label fw-semibold small">Domicilio</label>
            <input type="text" name="domicilio" class="form-control"
                   value="<?= htmlspecialchars($_POST['domicilio'] ?? $profile['Domicilio'] ?? '') ?>">
          </div>
          <div class="col-12">
            <label class="form-label fw-semibold small">Antecedentes médicos</label>
            <textarea name="antecedentes" class="form-control" rows="3"><?= htmlspecialchars($_POST['antecedentes'] ?? $profile['AntecedentesMedicos'] ?? '') ?></textarea>
          </div>
        </div>

        <div class="d-flex gap-2 mt-4">
          <button type="submit" class="btn-portal-primary btn">
            <i class="bi bi-check-lg me-1"></i>Guardar cambios
          </button>
          <a href="perfil.php" class="btn btn-outline-secondary rounded-3">Cancelar</a>
        </div>
      </form>
    </div>

  </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
