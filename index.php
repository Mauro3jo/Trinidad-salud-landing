<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous" />
  <title>Trinidad Salud</title>
  <link rel="icon" href="backend/img/logo.png" />
  <link rel="apple-touch-icon" href="backend/img/logo.png" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="backend/css/style.css" />
</head>

<body>
  <!-- ==========ENCABEZADO Y BOTONERA======= -->

  <?php include("botonera.php"); ?>
<?php
require_once __DIR__ . "/backend/php/carousel-slides.php";
$carouselSlides = getHomeCarouselSlides();
?>

  <!-- ====================================== -->
  <!-- ===============CAROUSEL=============== -->
  <!-- ====================================== -->
  <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel" data-bs-touch="true" data-bs-interval="6000" data-bs-pause="hover">
  <div class="carousel-indicators">
    <?php foreach ($carouselSlides as $index => $slide): ?>
      <button
        type="button"
        data-bs-target="#carouselExampleCaptions"
        data-bs-slide-to="<?php echo $index; ?>"
        class="<?php echo $index === 0 ? "active" : ""; ?>"
        aria-current="<?php echo $index === 0 ? "true" : "false"; ?>"
        aria-label="Slide <?php echo $index + 1; ?>"></button>
    <?php endforeach; ?>
  </div>
  <div class="carousel-inner">
    <?php foreach ($carouselSlides as $index => $slide): ?>
      <div class="carousel-item <?php echo $index === 0 ? "active" : ""; ?>">
        <img src="<?php echo htmlspecialchars($slide["path"], ENT_QUOTES, "UTF-8"); ?>" class="d-block w-100 carousel-image" alt="<?php echo htmlspecialchars($slide["alt"], ENT_QUOTES, "UTF-8"); ?>" />
      </div>
    <?php endforeach; ?>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
<!-- STATS STRIP -->
  <div class="stats-strip">
    <div class="container">
      <div class="row g-0">
        <div class="col-6 col-md-3 stat-item">
          <span class="stat-num">3</span>
          <span class="stat-lbl">Sedes en Tucumán</span>
        </div>
        <div class="col-6 col-md-3 stat-item">
          <span class="stat-num">+10</span>
          <span class="stat-lbl">Años de trayectoria</span>
        </div>
        <div class="col-6 col-md-3 stat-item">
          <span class="stat-num">3</span>
          <span class="stat-lbl">Planes disponibles</span>
        </div>
        <div class="col-6 col-md-3 stat-item">
          <span class="stat-num">24hs</span>
          <span class="stat-lbl">Servicio de emergencias</span>
        </div>
      </div>
    </div>
  </div>

  <!-- ====================================== -->
  <!-- =============== PLANES =============== -->
  <!-- ====================================== -->
  <a class="myanchor2" id="planes"></a>

  <section class="planes-section">
    <div class="container">
      <div class="text-center mb-5">
        <h2 class="planes-title">Nuestros <span class="text-primary">Planes</span></h2>
        <p class="planes-subtitle">Tu cobertura, tu elección. Encontrá el plan que mejor se adapta a vos y tu familia.</p>
      </div>

      <div class="row g-4 justify-content-center align-items-stretch">

        <!-- ====== TRINIDAD BÁSICO ====== -->
        <div class="col-lg-4 col-md-6">
          <div class="plan-card-modern basico h-100" data-bs-toggle="modal" data-bs-target="#modalBasico" style="cursor:pointer;">
            <div class="plan-popular-badge" style="visibility:hidden;">·</div>
            <div class="plan-foto-wrap">
              <img src="backend/img/plan%20basico.jpeg" alt="Trinidad Básico">
              <div class="plan-foto-overlay basico"></div>
            </div>
            <div class="plan-card-body text-center">
              <h3 class="plan-name-sm basico-text">Trinidad Básico</h3>
              <div class="plan-price-inline">
                <span class="price-pers">$15.000<small>/mes personal</small></span>
                <span class="price-fam"><i class="bi bi-people-fill"></i> $18.000/mes familiar</span>
              </div>
              <p class="plan-tagline">Coberturas esenciales para tu salud y la de tu familia.</p>
              <span class="btn-plan-sm basico-btn">Ver beneficios <i class="bi bi-chevron-right"></i></span>
            </div>
          </div>
        </div>

        <!-- ====== GÉNESIS INTEGRAL ====== -->
        <div class="col-lg-4 col-md-6">
          <div class="plan-card-modern integral h-100" data-bs-toggle="modal" data-bs-target="#modalIntegral" style="cursor:pointer;">
            <div class="plan-popular-badge"><i class="bi bi-star-fill me-1"></i>Más popular</div>
            <div class="plan-foto-wrap">
              <img src="backend/img/plan%20integral.jpeg" alt="Génesis Integral">
              <div class="plan-foto-overlay integral"></div>
            </div>
            <div class="plan-card-body text-center">
              <h3 class="plan-name-sm integral-text">Génesis Integral</h3>
              <div class="plan-price-inline">
                <span class="price-pers">$35.000<small>/mes personal</small></span>
                <span class="price-fam"><i class="bi bi-people-fill"></i> $45.000/mes familiar</span>
              </div>
              <p class="plan-tagline">Cobertura completa con reintegros y descuentos ampliados.</p>
              <span class="btn-plan-sm integral-btn">Ver beneficios <i class="bi bi-chevron-right"></i></span>
            </div>
          </div>
        </div>

        <!-- ====== GÉNESIS PREMIUM ====== -->
        <div class="col-lg-4 col-md-6">
          <div class="plan-card-modern premium h-100" data-bs-toggle="modal" data-bs-target="#modalPremium" style="cursor:pointer;">
            <div class="plan-popular-badge" style="visibility:hidden;">·</div>
            <div class="plan-foto-wrap">
              <img src="backend/img/plan%20premiun.jpeg" alt="Génesis Premium">
              <div class="plan-foto-overlay premium"></div>
            </div>
            <div class="plan-card-body text-center">
              <h3 class="plan-name-sm premium-text">Génesis Premium</h3>
              <div class="plan-price-inline">
                <span class="price-pers">$45.000<small>/mes personal</small></span>
                <span class="price-fam"><i class="bi bi-people-fill"></i> $60.000/mes familiar</span>
              </div>
              <p class="plan-tagline">Lo mejor en cobertura, reintegros y beneficios exclusivos.</p>
              <span class="btn-plan-sm premium-btn">Ver beneficios <i class="bi bi-chevron-right"></i></span>
            </div>
          </div>
        </div>

      </div>

      <p class="planes-nota">* Precio final sujeto a modificaciones. La integración del grupo familiar está sujeta a términos y condiciones.</p>
    </div>
  </section>

  <!-- ====== MODAL TRINIDAD BÁSICO ====== -->
  <div class="modal fade" id="modalBasico" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
      <div class="modal-content plan-modal basico-modal">
        <div class="modal-header plan-modal-header basico">
          <div>
            <div class="plan-badge">Plan</div>
            <h2 class="plan-name mb-0">Trinidad Básico</h2>
          </div>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body p-4">
          <div class="plan-modal-prices mb-4">
            <div class="plan-modal-price-item"><span class="pmp-label">Personal</span><span class="pmp-val">$15.000<small>/mes</small></span></div>
            <div class="plan-modal-price-item"><span class="pmp-label"><i class="bi bi-people-fill"></i> Familiar</span><span class="pmp-val">$18.000<small>/mes</small></span></div>
          </div>
          <ul class="plan-benefits">
            <li>Desc. hasta 40% en odontología, libre elección de profesionales</li>
            <li>Desc. en ortodoncia de hasta 50% en prestadores de la red</li>
            <li>Descuentos en Farmacia Plazoleta</li>
            <li>Desc. de hasta 30% en Psicólogos prestadores de la red</li>
            <li>Emergencia domiciliaria SEM — Serv. de emergencias médicas</li>
            <li>Desc. de hasta 30% en Laboratorios Flores</li>
            <li>Desc. de hasta 30% en Centro de visión JURE</li>
            <li>Desc. de hasta 30% en MENDEZ COLLADO</li>
            <li>Desc. de hasta 30% en INSTITUTO DE CARDIOLOGIA</li>
            <li>Seguro de sepelio hasta 49 años</li>
            <li>Desc. en óptica propia — marco anual gratis</li>
            <li>¡Y mucho más!</li>
          </ul>
        </div>
        <div class="modal-footer border-0 pt-0">
          <a href="https://api.whatsapp.com/send?phone=5493813658588&text=Hola,%20quiero%20info%20sobre%20el%20plan%20Trinidad%20Básico"
             target="_blank" class="btn-plan basico w-100">
            <i class="bi bi-whatsapp me-2"></i>Consultar por este plan
          </a>
        </div>
      </div>
    </div>
  </div>

  <!-- ====== MODAL GÉNESIS INTEGRAL ====== -->
  <div class="modal fade" id="modalIntegral" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
      <div class="modal-content plan-modal">
        <div class="modal-header plan-modal-header integral">
          <div>
            <div class="plan-badge">Más popular</div>
            <h2 class="plan-name mb-0">Génesis Integral</h2>
          </div>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body p-4">
          <div class="plan-modal-prices mb-4">
            <div class="plan-modal-price-item"><span class="pmp-label">Personal</span><span class="pmp-val">$35.000<small>/mes</small></span></div>
            <div class="plan-modal-price-item"><span class="pmp-label"><i class="bi bi-people-fill"></i> Familiar</span><span class="pmp-val">$45.000<small>/mes</small></span></div>
          </div>
          <ul class="plan-benefits integral-check">
            <li>Desc. hasta 40% en odontología, libre elección de profesionales</li>
            <li>Desc. en ortodoncia de hasta 60% en prestadores de la red</li>
            <li>Desc. de 50% en ajustes de ortodoncia</li>
            <li>Desc. en Farmacia Plazoleta y reintegros en farmacias del interior</li>
            <li>Desc. de hasta 30% + reintegros en Psicólogos prestadores de la red</li>
            <li>Emergencia domiciliaria SEM — Serv. de emergencias médicas</li>
            <li>Desc. de hasta 30% en Laboratorios Flores</li>
            <li>Desc. de hasta 30% en Centro de visión JURE</li>
            <li>Desc. de hasta 30% + reintegros en MENDEZ COLLADO</li>
            <li>Desc. de hasta 30% en INSTITUTO DE CARDIOLOGIA</li>
            <li>Seguro de sepelio hasta 59 años</li>
            <li>Desc. en óptica propia — marco anual gratis</li>
            <li>¡Y mucho más!</li>
          </ul>
        </div>
        <div class="modal-footer border-0 pt-0">
          <a href="https://api.whatsapp.com/send?phone=5493813658588&text=Hola,%20quiero%20info%20sobre%20el%20plan%20Génesis%20Integral"
             target="_blank" class="btn-plan integral w-100">
            <i class="bi bi-whatsapp me-2"></i>Consultar por este plan
          </a>
        </div>
      </div>
    </div>
  </div>

  <!-- ====== MODAL GÉNESIS PREMIUM ====== -->
  <div class="modal fade" id="modalPremium" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
      <div class="modal-content plan-modal">
        <div class="modal-header plan-modal-header premium">
          <div>
            <div class="plan-badge">Premium</div>
            <h2 class="plan-name mb-0">Génesis Premium</h2>
          </div>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body p-4">
          <div class="plan-modal-prices mb-4">
            <div class="plan-modal-price-item"><span class="pmp-label">Personal</span><span class="pmp-val">$45.000<small>/mes</small></span></div>
            <div class="plan-modal-price-item"><span class="pmp-label"><i class="bi bi-people-fill"></i> Familiar</span><span class="pmp-val">$60.000<small>/mes</small></span></div>
          </div>
          <ul class="plan-benefits premium-check">
            <li>Desc. hasta 50% + reintegros en odontología, libre elección y 1ª consulta gratis en prestadores de la red</li>
            <li>Desc. en ortodoncia de hasta 80% en prestadores de la red</li>
            <li>Desc. de 50% en ajustes de ortodoncia</li>
            <li>Desc. en Farmacia Plazoleta y reintegros en farmacias del interior</li>
            <li>Desc. de hasta 30% + reintegros en Psicólogos prestadores de la red</li>
            <li>Emergencia domiciliaria SEM — Serv. de emergencias médicas</li>
            <li>Desc. de hasta 30% en Laboratorios Flores</li>
            <li>Desc. de hasta 30% + reintegros en Centro de visión JURE</li>
            <li>Desc. de hasta 30% + reintegros en MENDEZ COLLADO</li>
            <li>Desc. de hasta 30% en INSTITUTO DE CARDIOLOGIA</li>
            <li>Reintegros en consultas médicas</li>
            <li>Seguro de sepelio hasta 69 años</li>
            <li>Desc. en óptica propia — marco semestral gratis</li>
            <li>¡Y mucho más!</li>
          </ul>
        </div>
        <div class="modal-footer border-0 pt-0">
          <a href="https://api.whatsapp.com/send?phone=5493813658588&text=Hola,%20quiero%20info%20sobre%20el%20plan%20Génesis%20Premium"
             target="_blank" class="btn-plan premium w-100">
            <i class="bi bi-whatsapp me-2"></i>Consultar por este plan
          </a>
        </div>
      </div>
    </div>
  </div>
    <!-- CTA AFILIADO -->
    <section class="cta-strip">
      <div class="container-fluid px-0">
        <div class="cta-strip-inner">
          <div class="cta-half">
            <i class="bi bi-person-check-fill cta-ico"></i>
            <div class="cta-text-block">
              <strong>¿Ya sos afiliado?</strong>
              <span>Accedé a tu credencial digital, autorizaciones y reintegros.</span>
            </div>
            <a href="portal/login.php" class="btn-cta-outline">Mi Portal <i class="bi bi-arrow-right ms-1"></i></a>
          </div>
          <div class="cta-divider-v"></div>
          <div class="cta-half">
            <i class="bi bi-clipboard-heart-fill cta-ico"></i>
            <div class="cta-text-block">
              <strong>¿Querés afiliarte?</strong>
              <span>Completá el formulario y un asesor se contactará con vos.</span>
            </div>
            <a href="afiliarse.php" class="btn-cta-solid">Quiero afiliarme <i class="bi bi-arrow-right ms-1"></i></a>
          </div>
        </div>
      </div>
    </section>

    <!-- =========== UBICACIONES DE LAS DISTINTAS SEDES =========== -->
    <a class="myanchor" id="ubicacion"></a>
    <section class="sedes-section">
      <div class="container">
        <div class="text-center mb-5">
          <h2 class="section-title-dark">Nuestras <span class="text-primary">Sedes</span></h2>
          <p class="section-subtitle-dark">Encontranos en distintos puntos de Tucumán</p>
        </div>
        <div class="row g-4 justify-content-center">

          <!-- SEDE CENTRO -->
          <div class="col-lg-4 col-md-6">
            <div class="sede-card-v2">
              <div class="sede-img-wrap">
                <img src="backend/img/sedes/barrioSur.png" alt="Sede Centro">
              </div>
              <div class="sede-body-v2">
                <h5 class="sede-name-v2"><i class="bi bi-geo-alt-fill text-primary"></i> Sede Centro</h5>
                <div class="sede-info-row">
                  <i class="bi bi-signpost-2-fill"></i>
                  <span>Bolívar 450</span>
                </div>
                <div class="sede-info-row">
                  <i class="bi bi-whatsapp"></i>
                  <a href="https://api.whatsapp.com/send?phone=5493815440046" target="_blank">381-544-0046</a>
                </div>
                <div class="sede-horario">
                  <div>
                    <span class="sede-day-label">Lunes a Viernes</span>
                    <span class="sede-time-val text-primary">9:00–13:00 | 17:00–21:00</span>
                  </div>
                  <div>
                    <span class="sede-day-label">Sáb. y Dom.</span>
                    <span class="sede-time-val text-danger">Cerrado</span>
                  </div>
                </div>
                <button class="btn-sede-v2" data-bs-toggle="modal" data-bs-target="#sedeCentro">
                  <i class="bi bi-map me-2"></i>¿Cómo llegar?
                </button>
              </div>
            </div>
            <div class="modal fade" id="sedeCentro" tabindex="-1" aria-labelledby="sedeCentroLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5 text-primary" id="sedeCentroLabel">Sede Centro</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body text-center">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3559.9753288736656!2d-65.20877432447031!3d-26.84073699020054!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94225c0905c42499%3A0x44612257af4987ff!2sSim%C3%B3n%20Bol%C3%ADvar%20446%2C%20T4000ARJ%20San%20Miguel%20de%20Tucum%C3%A1n%2C%20Tucum%C3%A1n!5e0!3m2!1ses!2sar!4v1738429822117!5m2!1ses!2sar" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    <div style="width:100%;max-width:376px;margin:12px auto 0;">
                      <iframe width="100%" height="580" src="https://www.youtube.com/embed/Ox1_CwOTtHA" title="Trinidad Salud - SedeCentro" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- SEDE ALDERETES -->
          <div class="col-lg-4 col-md-6">
            <div class="sede-card-v2">
              <div class="sede-img-wrap">
                <img src="backend/img/sedes/sedeAlderetes.png" alt="Sede Alderetes">
              </div>
              <div class="sede-body-v2">
                <h5 class="sede-name-v2"><i class="bi bi-geo-alt-fill text-primary"></i> Sede Alderetes</h5>
                <div class="sede-info-row">
                  <i class="bi bi-signpost-2-fill"></i>
                  <span>Av. Rivadavia 915</span>
                </div>
                <div class="sede-info-row">
                  <i class="bi bi-whatsapp"></i>
                  <a href="https://api.whatsapp.com/send?phone=5493813658588" target="_blank">381-365-8588</a>
                </div>
                <div class="sede-info-row">
                  <i class="bi bi-telephone-fill"></i>
                  <span>381 260 2221 (fijo)</span>
                </div>
                <div class="sede-horario">
                  <div>
                    <span class="sede-day-label">Lunes a Viernes</span>
                    <span class="sede-time-val text-primary">9:00–13:00 | 17:00–21:00</span>
                  </div>
                  <div>
                    <span class="sede-day-label">Sáb. y Dom.</span>
                    <span class="sede-time-val text-danger">Cerrado</span>
                  </div>
                </div>
                <button class="btn-sede-v2" data-bs-toggle="modal" data-bs-target="#sedeAlderetes">
                  <i class="bi bi-map me-2"></i>¿Cómo llegar?
                </button>
              </div>
            </div>
            <div class="modal fade" id="sedeAlderetes" tabindex="-1" aria-labelledby="sedeAlderetesLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5 text-primary" id="sedeAlderetesLabel">Sede Alderetes</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body text-center">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3560.7854864906903!2d-65.1448631845791!3d-26.814958183169697!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94225f20afa02cf5%3A0xe503a7532db566ed!2sAv.%20Rivadavia%20915%2C%20San%20Miguel%20de%20Tucum%C3%A1n%2C%20Tucum%C3%A1n!5e0!3m2!1ses!2sar!4v1679138614755!5m2!1ses!2sar" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    <div style="width:100%;max-width:376px;margin:12px auto 0;">
                      <iframe width="100%" height="580" src="https://www.youtube.com/embed/z0HrqdrpCVw" title="Trinidad Salud - Sede Alderetes" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- SEDE TRANCAS -->
          <div class="col-lg-4 col-md-6">
            <div class="sede-card-v2">
              <div class="sede-img-wrap">
                <img src="backend/img/sedes/sedeTrancas.png" alt="Sede Trancas">
              </div>
              <div class="sede-body-v2">
                <h5 class="sede-name-v2"><i class="bi bi-geo-alt-fill text-primary"></i> Sede Trancas</h5>
                <div class="sede-info-row">
                  <i class="bi bi-signpost-2-fill"></i>
                  <span>Av. Hipólito Yrigoyen 600</span>
                </div>
                <div class="sede-info-row">
                  <i class="bi bi-building"></i>
                  <span>Galería frente a la Municipalidad</span>
                </div>
                <div class="sede-info-row">
                  <i class="bi bi-whatsapp"></i>
                  <a href="https://api.whatsapp.com/send?phone=5493813575670" target="_blank">381-357-5670</a>
                </div>
                <div class="sede-horario">
                  <div>
                    <span class="sede-day-label">Horario</span>
                    <span class="sede-time-val text-primary">Comunicarse para coordinar</span>
                  </div>
                </div>
                <button class="btn-sede-v2" data-bs-toggle="modal" data-bs-target="#sedeTrancas">
                  <i class="bi bi-map me-2"></i>¿Cómo llegar?
                </button>
              </div>
            </div>
            <div class="modal fade" id="sedeTrancas" tabindex="-1" aria-labelledby="sedeTrancasLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5 text-primary" id="sedeTrancasLabel">Sede Trancas</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body text-center">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2128.061194788243!2d-65.28396130764212!3d-26.230552237330336!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94188ffce06f79e1%3A0x55475d350f2adc4a!2sAv.%20Irigoyen%20594%2C%20T4124%20Trancas%2C%20Tucum%C3%A1n!5e0!3m2!1ses!2sar!4v1738426387313!5m2!1ses!2sar" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </section>


  <!-- =============== PIE DE LA PÁGINA =============== -->
  <?php
  include("footer.html")
  ?>
  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/typewriter-effect@latest/dist/core.js"></script>

  <!-- <script src="main.js"></script> -->

  <script>
    // Navbar shadow on scroll
    window.addEventListener('scroll', () => {
      document.querySelector('.navbar').classList.toggle('scrolled', window.scrollY > 40);
    });
  </script>
  <!-- ANIMACIÓN DE LETRAS -->
  <script>
    let app = document.getElementById("typewriter");

    let typewriter = new Typewriter(app, {
      loop: true,
      delay: 75,
    });

    typewriter
      .pauseFor(2500)
      .typeString("No dudes en hacer tu consulta. Comunicate con nosotros y te asesoramos.")
      .pauseFor(3000)
      .deleteChars(10)
      .start();
  </script>
</body>

</html>
