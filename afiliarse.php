<?php
// afiliarse.php – solo valida localmente y luego la página la maneja con JS + fetch

$LARAVEL_API = 'https://trinidadsalud.online/api/public/registro';
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
  <style>
    .afiliarse-dni-preview {
      max-height: 140px;
      object-fit: contain;
      border-radius: 8px;
      border: 1px solid #dee2e6;
      background: #f8f9fa;
      display: none;
      margin-top: 8px;
      width: 100%;
    }
    .afiliarse-file-label {
      cursor: pointer;
      border: 2px dashed #c5d5ea;
      border-radius: 10px;
      padding: 14px 10px;
      text-align: center;
      color: #6a89b0;
      font-size: 0.88rem;
      transition: border-color .2s, background .2s;
    }
    .afiliarse-file-label:hover { border-color: #2F7CE5; background: #f0f5ff; }
    .afiliarse-file-label input[type=file] { display: none; }
  </style>
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

      {{-- Pantalla de éxito --}}
      <div id="successScreen" class="text-center py-4" style="display:none;">
        <i class="bi bi-check-circle-fill text-success" style="font-size:4rem;"></i>
        <h3 class="mt-3 fw-bold">¡Solicitud enviada!</h3>
        <p class="text-muted mt-2">
          Gracias por tu interés en Trinidad Salud.<br>
          Un asesor se comunicará con vos a la brevedad para finalizar el proceso.<br>
          También podés escribirnos por
          <a href="https://api.whatsapp.com/send?phone=5493813658588" target="_blank">WhatsApp</a>.
        </p>
        <a href="index.php" class="btn btn-primary mt-3 rounded-pill px-5">
          <i class="bi bi-house me-2"></i>Volver al inicio
        </a>
      </div>

      {{-- Mensaje de error global --}}
      <div id="errorAlert" class="alert alert-danger rounded-3 mb-4 small" style="display:none;"></div>

      {{-- Formulario --}}
      <form id="afiliarseForm" novalidate>

        <h6 class="fw-bold text-uppercase text-muted small mb-3 border-bottom pb-2">
          <i class="bi bi-person me-1"></i> Datos personales
        </h6>

        <div class="row g-3">

          <div class="col-sm-6">
            <label class="form-label fw-semibold small">Nombre <span class="text-danger">*</span></label>
            <input type="text" name="nombre" id="nombre" class="form-control rounded-3" required>
          </div>

          <div class="col-sm-6">
            <label class="form-label fw-semibold small">Apellido <span class="text-danger">*</span></label>
            <input type="text" name="apellido" id="apellido" class="form-control rounded-3" required>
          </div>

          <div class="col-sm-6">
            <label class="form-label fw-semibold small">DNI <span class="text-danger">*</span></label>
            <input type="text" name="dni" id="dni" class="form-control rounded-3" inputmode="numeric"
                   placeholder="Sin puntos ni espacios" required>
          </div>

          <div class="col-sm-6">
            <label class="form-label fw-semibold small">CUIL <span class="text-muted">(opcional)</span></label>
            <input type="text" name="cuil" id="cuil" class="form-control rounded-3"
                   placeholder="20-12345678-9">
          </div>

          <div class="col-sm-6">
            <label class="form-label fw-semibold small">Fecha de nacimiento <span class="text-danger">*</span></label>
            <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control rounded-3" required>
          </div>

          <div class="col-sm-6">
            <label class="form-label fw-semibold small">Celular <span class="text-danger">*</span></label>
            <input type="tel" name="celular" id="celular" class="form-control rounded-3" inputmode="numeric"
                   placeholder="Ej: 3811234567" required>
          </div>

          <div class="col-sm-6">
            <label class="form-label fw-semibold small">Teléfono fijo <span class="text-muted">(opcional)</span></label>
            <input type="tel" name="tel_fijo" id="tel_fijo" class="form-control rounded-3" inputmode="numeric"
                   placeholder="Ej: 3814567890">
          </div>

          <div class="col-sm-6">
            <label class="form-label fw-semibold small">Email <span class="text-muted">(opcional)</span></label>
            <input type="email" name="email" id="email" class="form-control rounded-3">
          </div>

          <div class="col-12">
            <label class="form-label fw-semibold small">Domicilio <span class="text-muted">(opcional)</span></label>
            <input type="text" name="domicilio" id="domicilio" class="form-control rounded-3"
                   placeholder="Calle y número">
          </div>

          <div class="col-sm-6">
            <label class="form-label fw-semibold small">Localidad <span class="text-muted">(opcional)</span></label>
            <input type="text" name="localidad" id="localidad" class="form-control rounded-3"
                   placeholder="Ej: San Miguel de Tucumán">
          </div>

          <div class="col-sm-6">
            <label class="form-label fw-semibold small">Plan de interés</label>
            <select name="plan_interes" id="plan_interes" class="form-select rounded-3">
              <option value="">No sé todavía</option>
              <option value="Trinidad Básico">Trinidad Básico</option>
              <option value="Génesis Integral">Génesis Integral</option>
              <option value="Génesis Premium">Génesis Premium</option>
            </select>
          </div>

          <div class="col-12">
            <label class="form-label fw-semibold small">Observaciones <span class="text-muted">(opcional)</span></label>
            <textarea name="observaciones" id="observaciones" class="form-control rounded-3" rows="3"
                      placeholder="Cualquier consulta o información adicional"></textarea>
          </div>

        </div>

        {{-- DNI images --}}
        <h6 class="fw-bold text-uppercase text-muted small mb-3 mt-4 border-bottom pb-2">
          <i class="bi bi-credit-card me-1"></i> Foto del DNI <span class="text-muted fw-normal">(opcional pero recomendado)</span>
        </h6>

        <div class="row g-3 mb-3">
          <div class="col-sm-6">
            <label class="afiliarse-file-label d-block">
              <input type="file" id="dniFrenteFile" accept="image/*">
              <i class="bi bi-camera me-1"></i> Frente del DNI
              <div class="small mt-1 text-muted">JPG, PNG – máx. 5 MB</div>
            </label>
            <img id="dniFrentePreview" class="afiliarse-dni-preview" alt="Frente DNI">
          </div>
          <div class="col-sm-6">
            <label class="afiliarse-file-label d-block">
              <input type="file" id="dniDorsoFile" accept="image/*">
              <i class="bi bi-camera me-1"></i> Dorso del DNI
              <div class="small mt-1 text-muted">JPG, PNG – máx. 5 MB</div>
            </label>
            <img id="dniDorsoPreview" class="afiliarse-dni-preview" alt="Dorso DNI">
          </div>
        </div>

        <div class="col-12 mt-3">
          <button type="submit" id="submitBtn" class="btn btn-primary rounded-pill px-5 py-2 fw-bold">
            <span id="submitBtnText"><i class="bi bi-send me-2"></i>Enviar solicitud</span>
            <span id="submitBtnSpinner" style="display:none;">
              <span class="spinner-border spinner-border-sm me-2" role="status"></span>Enviando...
            </span>
          </button>
          <p class="text-muted small mt-2 mb-0">* Campos obligatorios</p>
        </div>

      </form>

    </div>
  </div>
</section>

<?php include 'footer.html'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
(function () {
  const API_URL = '<?= $LARAVEL_API ?>';

  // Base64 helpers
  let dniFrenteB64 = null;
  let dniDorsoB64  = null;

  function fileToBase64(file) {
    return new Promise(function (resolve, reject) {
      if (!file) { resolve(null); return; }
      if (file.size > 5 * 1024 * 1024) { reject('El archivo debe ser menor a 5 MB.'); return; }
      const reader = new FileReader();
      reader.onload = function (e) {
        // Strip the data:image/...;base64, prefix — send only the raw base64
        resolve(e.target.result.split(',')[1]);
      };
      reader.onerror = reject;
      reader.readAsDataURL(file);
    });
  }

  function wirePreview(inputId, previewId, store) {
    const input   = document.getElementById(inputId);
    const preview = document.getElementById(previewId);
    input.addEventListener('change', async function () {
      const file = input.files[0];
      if (!file) return;
      try {
        const b64 = await fileToBase64(file);
        if (store === 'frente') dniFrenteB64 = b64;
        else                    dniDorsoB64  = b64;
        preview.src   = 'data:' + file.type + ';base64,' + b64;
        preview.style.display = 'block';
      } catch (e) {
        showError(e.toString());
      }
    });
  }

  wirePreview('dniFrenteFile', 'dniFrentePreview', 'frente');
  wirePreview('dniDorsoFile',  'dniDorsoPreview',  'dorso');

  function showError(msg) {
    const el = document.getElementById('errorAlert');
    el.textContent = msg;
    el.style.display = 'block';
    el.scrollIntoView({ behavior: 'smooth', block: 'center' });
  }

  function clearError() {
    const el = document.getElementById('errorAlert');
    el.style.display = 'none';
    el.textContent   = '';
  }

  function setLoading(loading) {
    document.getElementById('submitBtn').disabled         = loading;
    document.getElementById('submitBtnText').style.display   = loading ? 'none'  : 'inline';
    document.getElementById('submitBtnSpinner').style.display = loading ? 'inline' : 'none';
  }

  document.getElementById('afiliarseForm').addEventListener('submit', async function (e) {
    e.preventDefault();
    clearError();

    const nombre          = document.getElementById('nombre').value.trim();
    const apellido        = document.getElementById('apellido').value.trim();
    const dni             = document.getElementById('dni').value.trim();
    const fecha_nacimiento= document.getElementById('fecha_nacimiento').value.trim();
    const celular         = document.getElementById('celular').value.trim();

    if (!nombre || !apellido || !dni || !fecha_nacimiento || !celular) {
      showError('Por favor completá todos los campos obligatorios.');
      return;
    }

    setLoading(true);

    const payload = {
      nombre,
      apellido,
      cuil:              document.getElementById('cuil').value.trim()             || null,
      dni,
      fecha_nacimiento,
      celular,
      tel_fijo:          document.getElementById('tel_fijo').value.trim()         || null,
      email:             document.getElementById('email').value.trim()            || null,
      domicilio:         document.getElementById('domicilio').value.trim()        || null,
      localidad:         document.getElementById('localidad').value.trim()        || null,
      plan_interes:      document.getElementById('plan_interes').value            || null,
      observaciones:     document.getElementById('observaciones').value.trim()    || null,
      dni_frente_base64: dniFrenteB64,
      dni_dorso_base64:  dniDorsoB64,
    };

    try {
      const res = await fetch(API_URL, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
        body: JSON.stringify(payload),
      });

      const data = await res.json().catch(function () { return {}; });

      if (!res.ok) {
        const msgs = data.errors
          ? Object.values(data.errors).flat().join(' ')
          : (data.message || 'No se pudo enviar la solicitud. Intentá de nuevo.');
        showError(msgs);
        return;
      }

      document.getElementById('afiliarseForm').style.display = 'none';
      document.getElementById('successScreen').style.display = 'block';
      window.scrollTo({ top: 0, behavior: 'smooth' });

    } catch (err) {
      showError('Error de conexión. Verificá tu internet e intentá de nuevo.');
    } finally {
      setLoading(false);
    }
  });
})();
</script>
</body>
</html>
