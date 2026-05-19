<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reintegros y Autorizaciones – Trinidad Salud</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
  <link rel="stylesheet" href="backend/css/style.css">
  <link rel="icon" href="backend/img/logo.png">
  <style>
    .servicios-hero {
      background: linear-gradient(135deg, #2F7CE5 0%, #184F9D 100%);
      color: #fff;
      padding: 90px 0 70px;
      text-align: center;
    }
    .servicios-hero h1 { font-weight: 800; }
    .servicios-hero p { opacity: 0.92; font-size: 1.05rem; }

    .servicios-section { padding: 60px 0; }
    .servicios-section.alt { background: #f4f7fb; }

    .step-card {
      background: #fff;
      border-radius: 18px;
      padding: 26px 22px;
      height: 100%;
      box-shadow: 0 6px 18px rgba(40, 70, 120, .07);
      transition: transform .25s ease, box-shadow .25s ease;
    }
    .step-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 10px 28px rgba(40, 70, 120, .12);
    }
    .step-num {
      width: 38px; height: 38px; border-radius: 50%;
      background: #2F7CE5; color: #fff;
      display: inline-flex; align-items: center; justify-content: center;
      font-weight: 800; font-size: 1.05rem; margin-bottom: 14px;
    }
    .step-card h5 { font-weight: 700; color: #2a3850; }
    .step-card p { color: #5e6f88; font-size: 0.94rem; line-height: 1.55; margin-bottom: 0; }

    .badge-status {
      display: inline-block;
      padding: 4px 11px; border-radius: 999px;
      font-size: 0.78rem; font-weight: 600;
      margin-right: 4px; margin-bottom: 4px;
    }
    .badge-pendiente { background: #FFF3D9; color: #8b6e1f; }
    .badge-revision  { background: #E0EEFF; color: #1f5fa1; }
    .badge-aprobado  { background: #E7F8EF; color: #1B6E45; }
    .badge-pagado    { background: #D5EAFE; color: #1c4f87; }
    .badge-rechazado { background: #FDE8E8; color: #a33d3d; }

    .cta-box {
      background: #fff;
      border-radius: 22px;
      padding: 36px 30px;
      text-align: center;
      box-shadow: 0 10px 30px rgba(40, 70, 120, .08);
    }
  </style>
</head>
<body>

<?php include 'botonera.php'; ?>

<section class="servicios-hero">
  <div class="container">
    <h1 class="display-5 mb-3">Reintegros y Autorizaciones</h1>
    <p class="lead mx-auto" style="max-width: 740px;">
      Gestioná tus reintegros y autorizaciones desde la app móvil o el portal web,
      sin papeleos ni esperas. Te explicamos cómo funciona el flujo completo.
    </p>
  </div>
</section>

<!-- ============== REINTEGROS ============== -->
<section class="servicios-section">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="fw-bold text-primary mb-2"><i class="bi bi-receipt me-2"></i>Reintegros</h2>
      <p class="text-muted mx-auto" style="max-width: 700px;">
        Si abonaste un servicio médico de tu bolsillo, podés solicitar el reintegro según
        las coberturas de tu plan. El monto aprobado se acredita directamente en tu cuenta bancaria.
      </p>
    </div>

    <div class="row g-4">
      <div class="col-md-6 col-lg-3">
        <div class="step-card">
          <div class="step-num">1</div>
          <h5>Pedí factura</h5>
          <p>Solicitá la factura A o B <strong>a nombre de Trinidad Salud</strong> al prestador y guardá el comprobante de pago.</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="step-card">
          <div class="step-num">2</div>
          <h5>Cargala en la app</h5>
          <p>Abrí la sección <strong>Reintegros</strong>, indicá tipo, prestador, monto y subí el PDF de la factura.</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="step-card">
          <div class="step-num">3</div>
          <h5>Revisamos</h5>
          <p>Nuestro equipo verifica la cobertura de tu plan y te avisa si necesitamos algo más o si fue aprobado.</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="step-card">
          <div class="step-num">4</div>
          <h5>Cobrás</h5>
          <p>Transferimos el monto aprobado a tu CBU registrado y marcamos el trámite como <strong>pagado</strong>.</p>
        </div>
      </div>
    </div>

    <div class="mt-5 p-4 bg-light rounded-4">
      <h6 class="fw-bold mb-3">Estados que vas a ver en la app</h6>
      <span class="badge-status badge-pendiente">Pendiente</span>
      <span class="badge-status badge-revision">En revisión</span>
      <span class="badge-status badge-aprobado">Aprobado</span>
      <span class="badge-status badge-pagado">Pagado</span>
      <span class="badge-status badge-rechazado">Rechazado</span>
      <p class="small text-muted mb-0 mt-2">
        Si la solicitud necesita más documentación, vas a ver el estado <strong>Requiere documentación</strong> con
        la nota del admin sobre qué te está faltando.
      </p>
    </div>
  </div>
</section>

<!-- ============== AUTORIZACIONES ============== -->
<section class="servicios-section alt">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="fw-bold text-primary mb-2"><i class="bi bi-clipboard-check me-2"></i>Autorizaciones</h2>
      <p class="text-muted mx-auto" style="max-width: 700px;">
        Algunas prácticas y estudios requieren autorización previa. Solicitala desde la app
        adjuntando la orden médica y te emitimos un código que llevás al prestador.
      </p>
    </div>

    <div class="row g-4">
      <div class="col-md-6 col-lg-3">
        <div class="step-card">
          <div class="step-num">1</div>
          <h5>Orden médica</h5>
          <p>El médico te indica la práctica o estudio. Pedile la <strong>orden médica</strong> con todos los detalles.</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="step-card">
          <div class="step-num">2</div>
          <h5>Solicitá en la app</h5>
          <p>Abrí <strong>Autorizaciones</strong>, elegí el tipo (consulta, práctica, medicamento...) y subí la orden.</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="step-card">
          <div class="step-num">3</div>
          <h5>Te aprobamos</h5>
          <p>Verificamos cobertura y emitimos un <strong>código único de autorización</strong> con fecha de vencimiento.</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="step-card">
          <div class="step-num">4</div>
          <h5>Llevalo al prestador</h5>
          <p>Mostrale el código desde tu app. Es válido hasta la fecha de vencimiento que figura en la solicitud.</p>
        </div>
      </div>
    </div>

    <div class="mt-5 p-4 bg-white rounded-4 shadow-sm">
      <h6 class="fw-bold mb-3">Tipos de autorización</h6>
      <div class="row small text-muted">
        <div class="col-md-6">
          <ul class="list-unstyled">
            <li class="mb-1"><i class="bi bi-check2 text-success me-1"></i> Consultas médicas con especialistas</li>
            <li class="mb-1"><i class="bi bi-check2 text-success me-1"></i> Prácticas de rutina (laboratorio, ecografías)</li>
            <li class="mb-1"><i class="bi bi-check2 text-success me-1"></i> Prácticas especializadas (RMN, TAC, endoscopías)</li>
            <li class="mb-1"><i class="bi bi-check2 text-success me-1"></i> Medicamentos crónicos y especiales</li>
          </ul>
        </div>
        <div class="col-md-6">
          <ul class="list-unstyled">
            <li class="mb-1"><i class="bi bi-check2 text-success me-1"></i> Kinesiología, psicología, fonoaudiología</li>
            <li class="mb-1"><i class="bi bi-check2 text-success me-1"></i> Odontología</li>
            <li class="mb-1"><i class="bi bi-check2 text-success me-1"></i> Cirugías programadas e internaciones</li>
            <li class="mb-1"><i class="bi bi-check2 text-success me-1"></i> Otros tratamientos</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ============== CTA ============== -->
<section class="servicios-section">
  <div class="container">
    <div class="cta-box">
      <h3 class="fw-bold mb-2">¿Todavía no sos parte de Trinidad Salud?</h3>
      <p class="text-muted mb-4">
        Afiliate hoy y empezá a aprovechar todos nuestros servicios desde la app.
      </p>
      <!-- Link original al formulario: <a href="afiliarse.php" class="btn btn-primary btn-lg rounded-pill px-5">
        <i class="bi bi-person-plus me-2"></i>Afiliarme ahora
      </a> -->
      <a href="https://api.whatsapp.com/send?phone=5493813658588&text=Hola,%20quiero%20afiliarme%20a%20Trinidad%20Salud" target="_blank" class="btn btn-primary btn-lg rounded-pill px-5">
        <i class="bi bi-person-plus me-2"></i>Afiliarme ahora
      </a>
      <a href="portal/login.php" class="btn btn-outline-primary btn-lg rounded-pill px-5 ms-2">
        <i class="bi bi-person-fill me-2"></i>Ya soy afiliado
      </a>
    </div>
  </div>
</section>

<?php include 'footer.html'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
