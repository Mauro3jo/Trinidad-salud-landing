<?php
session_start();

$success = false;
$error   = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre     = trim($_POST['nombre']        ?? '');
    $apellido   = trim($_POST['apellido']      ?? '');
    $dni        = trim($_POST['dni']           ?? '');
    $nacimiento = trim($_POST['nacimiento']    ?? '');
    $telefono   = trim($_POST['telefono']      ?? '');
    $email      = trim($_POST['email']         ?? '');
    $domicilio  = trim($_POST['domicilio']     ?? '');
    $plan       = trim($_POST['plan']          ?? '');
    $obs        = trim($_POST['observaciones'] ?? '');

    if (!$nombre || !$apellido || !$dni || !$nacimiento || !$telefono) {
        $error = 'Por favor completá todos los campos obligatorios.';
    } else {
        $success = true;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Afiliate – Trinidad Salud</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
  <link rel="stylesheet" href="backend/css/style.css">
  <link rel="icon" href="backend/img/logo.png">
</head>
<body>

<?php include 'botonera.php'; ?>

<section class="afiliarse-hero text-center">
  <div class="container">
    <h1 class="afiliarse-title">Afiliate a <span class="text-primary">Trinidad Salud</span></h1>
    <p class="afiliarse-subtitle">Completá el formulario y un asesor se comunicará con vos a la brevedad.</p>
  </div>
</section>

<section class="afiliarse-form-section">
  <div class="container">
    <div class="afiliarse-card">

      <?php if ($success): ?>
        <div class="text-center py-4">
          <i class="bi bi-check-circle-fill text-success" style="font-size:4rem;"></i>
          <h3 class="mt-3 fw-bold">¡Solicitud enviada!</h3>
          <p class="text-muted mt-2">Gracias por tu interés en Trinidad Salud.<br>
            Un asesor se comunicará con vos a la brevedad.<br>
            También podés escribirnos por
            <a href="https://api.whatsapp.com/send?phone=5493813658588" target="_blank">WhatsApp</a>.
          </p>
          <a href="index.php" class="btn btn-primary mt-3 rounded-pill px-5">
            <i class="bi bi-house me-2"></i>Volver al inicio
          </a>
        </div>

      <?php else: ?>

        <?php if ($error): ?>
          <div class="alert alert-danger rounded-3 mb-4 small"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="POST" novalidate>
          <div class="row g-3">

            <div class="col-sm-6">
              <label class="form-label fw-semibold small">Nombre <span class="text-danger">*</span></label>
              <input type="text" name="nombre" class="form-control rounded-3"
                     value="<?= htmlspecialchars($_POST['nombre'] ?? '') ?>" required>
            </div>

            <div class="col-sm-6">
              <label class="form-label fw-semibold small">Apellido <span class="text-danger">*</span></label>
              <input type="text" name="apellido" class="form-control rounded-3"
                     value="<?= htmlspecialchars($_POST['apellido'] ?? '') ?>" required>
            </div>

            <div class="col-sm-6">
              <label class="form-label fw-semibold small">DNI <span class="text-danger">*</span></label>
              <input type="text" name="dni" class="form-control rounded-3" inputmode="numeric"
                     placeholder="Sin puntos ni espacios"
                     value="<?= htmlspecialchars($_POST['dni'] ?? '') ?>" required>
            </div>

            <div class="col-sm-6">
              <label class="form-label fw-semibold small">Fecha de nacimiento <span class="text-danger">*</span></label>
              <input type="date" name="nacimiento" class="form-control rounded-3"
                     value="<?= htmlspecialchars($_POST['nacimiento'] ?? '') ?>" required>
            </div>

            <div class="col-sm-6">
              <label class="form-label fw-semibold small">Teléfono / Celular <span class="text-danger">*</span></label>
              <input type="tel" name="telefono" class="form-control rounded-3" inputmode="numeric"
                     placeholder="Ej: 381-1234567"
                     value="<?= htmlspecialchars($_POST['telefono'] ?? '') ?>" required>
            </div>

            <div class="col-sm-6">
              <label class="form-label fw-semibold small">Email <span class="text-muted">(opcional)</span></label>
              <input type="email" name="email" class="form-control rounded-3"
                     value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
            </div>

            <div class="col-12">
              <label class="form-label fw-semibold small">Domicilio <span class="text-muted">(opcional)</span></label>
              <input type="text" name="domicilio" class="form-control rounded-3"
                     placeholder="Calle, número, localidad"
                     value="<?= htmlspecialchars($_POST['domicilio'] ?? '') ?>">
            </div>

            <div class="col-sm-6">
              <label class="form-label fw-semibold small">Plan de interés</label>
              <select name="plan" class="form-select rounded-3">
                <option value=""        <?= empty($_POST['plan'])                        ? 'selected' : '' ?>>No sé todavía</option>
                <option value="basico"  <?= (($_POST['plan'] ?? '') === 'basico')        ? 'selected' : '' ?>>Trinidad Básico</option>
                <option value="integral"<?= (($_POST['plan'] ?? '') === 'integral')      ? 'selected' : '' ?>>Génesis Integral</option>
                <option value="premium" <?= (($_POST['plan'] ?? '') === 'premium')       ? 'selected' : '' ?>>Génesis Premium</option>
              </select>
            </div>

            <div class="col-12">
              <label class="form-label fw-semibold small">Observaciones <span class="text-muted">(opcional)</span></label>
              <textarea name="observaciones" class="form-control rounded-3" rows="3"
                        placeholder="Cualquier consulta o información adicional"><?= htmlspecialchars($_POST['observaciones'] ?? '') ?></textarea>
            </div>

            <div class="col-12 mt-2">
              <button type="submit" class="btn btn-primary rounded-pill px-5 py-2 fw-bold">
                <i class="bi bi-send me-2"></i>Enviar solicitud
              </button>
              <p class="text-muted small mt-2 mb-0">* Campos obligatorios</p>
            </div>

          </div>
        </form>

      <?php endif; ?>

    </div>
  </div>
</section>

<?php include 'footer.html'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
