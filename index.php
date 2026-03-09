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

  <!-- ====================================== -->
  <!-- ===============CAROUSEL=============== -->
  <!-- ====================================== -->
  <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="false">
    <!-- INDICADORES INFERIORES DE CAROUSEL -->
    <!--  <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3" aria-label="Slide 4"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="4" aria-label="Slide 5"></button>
    </div> -->
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="backend/img/carousel1.jpg" class="d-block w-100" alt="slide1" />
        <div class="carousel-caption d-none d-md-block">
          <!-- <div class="caja-carousel">
              <h2 class="carousel-title">Odontología General</h2>
              <p>
                Some representative placeholder content for the first slide.
              </p>
            </div> -->
        </div>
      </div>
      <div class="carousel-item">
        <img src="backend/img/carousel2.jpg" class="d-block w-100" alt="slide2" />
        <div class="carousel-caption d-none d-md-block">
          <!-- <div class="caja-carousel">
              <h2 class="carousel-title">Second slide label</h2>
              <p>
                Some representative placeholder content for the second slide.
              </p>
            </div> -->
        </div>
      </div>
      <div class="carousel-item">
        <img src="backend/img/carousel3.jpg" class="d-block w-100" alt="slide3" />
        <div class="carousel-caption d-none d-md-block">
          <!-- <div class="caja-carousel">
              <h2 class="carousel-title">Second slide label</h2>
              <p>
                Some representative placeholder content for the second slide.
              </p>
            </div> -->
        </div>
      </div>
      <div class="carousel-item">
        <img src="backend/img/carousel4.jpg" class="d-block w-100" alt="slide4" />
        <div class="carousel-caption d-none d-md-block">
          <!-- <div class="caja-carousel">
            <h2 class="carousel-title">Cirugía Oral, Implante Dental</h2>
            <p>
              Some representative placeholder content for the third slide.
            </p>
          </div> -->
        </div>
      </div>
      <div class="carousel-item">
        <img src="backend/img/carousel5.png" class="d-block w-100" alt="slide5" />
        <div class="carousel-caption d-none d-md-block">
          <!-- <div class="caja-carousel">
            <h2 class="carousel-title">Cirugía Oral, Implante Dental</h2>
            <p>
              Some representative placeholder content for the third slide.
            </p>
          </div> -->
        </div>
      </div>
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
  <!-- ====================================== -->
  <!-- =============== INTRO =============== -->
  <!-- ====================================== -->
  <section class="w-50 mx-auto text-center pt-5" id="intro">
    <h1 class="p-3 fs-2 border-top border-3">
      Un centro único para todas tus necesidades de
      <span class="text-primary">Salud </span>
    </h1>
    <p class="p-3 fs-4">
      <span class="text-primary fw-bold">Trinidad Salud</span> Cuida tu salud integral,
      porque de ella depende tu calidad de vida.
    </p>

    <!-- EMERGENCIAS -->
    <!-- ====== BOTON MODAL EMERGANCIAS ======  -->
    <!-- <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#emergenciasModal">
      EMERGENCIAS
    </button> -->
    <br>




  </section>
  <!-- ====================================== -->
  <!-- =============== SERVICIOS =============== -->
  <!-- ====================================== -->
  <a class="myanchor2" id="servicios"></a>
  <section class="container-fluid">
    <div class="row w-75 mx-auto servicio-fila">
      <hr />

      <!-- ============= EQUIPO MEDICO ================ -->
      <div class="col-lg-6 col-md-6 col-sm-12 d-flex justify-content-start align-items-center my-2 icono-wrap">
        <div class="img-serv">
          <img src="backend/img/01.jpg" alt="Profesionales" width="150" />
        </div>
        <div>
          <h3 class="fs-5 mt-4 px-4 pb-1 text-primary fw-bold text-center">
            Equipo Médico
          </h3>
          <p class="px-4  text-center">Contamos con los mejores profesionales en cada especialidad.</p>
        </div>

        <!-- ====== BOTON MODAL EQUIPO MEDICO ======  -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#serviciosModal">
          Ver
        </button>

        <!-- ====== VENTANA MODAL EQUIPO MEDICO ====== -->
        <div class="modal fade" id="serviciosModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header text-primary fw-bold text-center">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Algunos de nuestros servicios</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <img src="backend/img/equipom/01.jpg" alt="Servicios">
                <img src="backend/img/equipom/02.jpg" alt="Servicios">
                <img src="backend/img/equipom/03.jpg" alt="Servicios">
                <img src="backend/img/equipom/04.jpg" alt="Servicios">
                <img src="backend/img/serv-01.jpg" alt="Servicios">
                <img src="backend/img/serv-03.jpg" alt="Servicios">
                <img src="backend/img/serv-04.jpg" alt="Servicios">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
              </div>
            </div>
          </div>
        </div>

      </div>

      <!-- ============= ESTUDIO POR IMÁGENES ================ -->
      <div class="col-lg-6 col-md-6 col-sm-12 d-flex justify-content-start align-items-center my-2 icono-wrap">
        <div class="img-serv">
          <img src="backend/img/02.jpg" alt="Estudio por Imágenes" />
        </div>
        <div>
          <h3 class="fs-5 mt-4 px-4 pb-1 text-primary fw-bold text-center">
            Estudio por Imágenes
          </h3>
          <p class="px-4 text-center">Contamos con los mejores equipos de última generación.</p>

        </div>
        <!-- ====== BOTON MODAL IMAGENES Y LABORATORIOS ======  -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#laboratoriosModal">
          Ver
        </button>

        <!-- ====== VENTANA MODAL IMAGENES Y LABORATORIOS ====== -->
        <div class="modal fade" id="laboratoriosModal" tabindex="-1" aria-labelledby="laboratorioModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header text-primary fw-bold text-center">
                <h1 class="modal-title fs-5" id="laboratorioModalLabel">Algunos de nuestros servicios</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <img src="backend/img/laboratorio/01.png" alt="Servicios">
                <img src="backend/img/laboratorio/02.png" alt="Servicios">
                <img src="backend/img/laboratorio/03.png" alt="Servicios">
                <img src="backend/img/laboratorio/04.png" alt="Servicios">
                <img src="backend/img/laboratorio/05.png" alt="Servicios">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
              </div>
            </div>
          </div>

        </div>

      </div>

      <!-- ============= ODONTOLOGÍA ================ -->
      <div class="col-lg-6 col-md-6 col-sm-12 d-flex justify-content-start align-items-center my-2 icono-wrap">
        <div class="img-serv">
          <img src="backend/img/03.jpg" alt="Odontología" width="170" />
        </div>
        <div>
          <h3 class="fs-5 mt-4 px-4 pb-1 text-primary fw-bold  text-center">Odontología Integral</h3>
          <p class="px-4  text-center">Estética Dental, Odontología General, Cirugías, Implantes, etc.</p>
        </div>

        <!-- ====== BOTON MODAL EQUIPO ODONTOLOGÍA ======  -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#odontologiaModal">
          Ver
        </button>

        <!-- ====== VENTANA MODAL ODONTOLOGÍA ====== -->
        <div class="modal fade" id="odontologiaModal" tabindex="-1" aria-labelledby="odontologiaModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header text-primary fw-bold text-center">
                <h1 class="modal-title fs-5" id="odontologiaModalLabel">Algunos de nuestros servicios</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <img src="backend/img/odont/01.jpg" alt="Servicios">
                <img src="backend/img/odont/02.jpg" alt="Servicios">


              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
              </div>
            </div>
          </div>
        </div>


      </div>

      <!-- ============= OFTALMOLOGÍA ================ -->
      <div class="col-lg-6 col-md-6 col-sm-12 d-flex align-items-center my-2 icono-wrap">
        <div class="img-serv">
          <img src="backend/img/04.jpg" alt="Oftalmología" width="170" />
        </div>
        <div>
          <h3 class="fs-5 mt-4 px-4 pb-1 text-primary text-center fw-bold">Oftalmología y Óptica</h3>
          <p class="px-4 text-center">Diagnostico y tratamiento de enfermedades oculares. Prescripción de anteojos y lentes de contacto.</p>
        </div>
        <!-- ====== BOTON MODAL OFTALMOLOGIA ======  -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#oftalmologiasModal">
          Ver
        </button>

        <!-- ====== VENTANA MODAL OFTALMOLOGIA ====== -->
        <div class="modal fade" id="oftalmologiasModal" tabindex="-1" aria-labelledby="oftalmologiaModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header text-primary fw-bold text-center">
                <h1 class="modal-title fs-5" id="oftalmologiaModalLabel">Algunos de nuestros servicios</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <img src="backend/img/oftalmologia/01.png" alt="Servicios">
                <img src="backend/img/oftalmologia/02.png" alt="Servicios">
                <iframe width="100%" height="669" src="https://www.youtube.com/embed/X9UnP6ez91k" title="Óptica" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
              </div>
            </div>
          </div>

        </div>
      </div>

      <!-- ============= FARMACIAS ================ -->
      <div class="col-lg-6 col-md-6 col-sm-12 d-flex align-items-center my-2 icono-wrap">
        <div class="img-serv">
          <img src="backend/img/farmacias/farmacia.jpg" alt="Farmacias" width="170" />
        </div>
        <div>
          <h3 class="fs-5 mt-4 px-4 pb-1 text-primary text-center fw-bold">Farmacias</h3>
          <p class="px-4 text-center">Contamos con farmacias especializadas, donde podrás encontrar una amplia variedad de medicamentos y productos.</p>
        </div>
        <!-- ====== BOTON MODAL FARMACIAS ======  -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#farmaciasModal">
          Ver
        </button>

        <!-- ====== VENTANA MODAL FARMACIAS  ====== -->
        <div class="modal fade" id="farmaciasModal" tabindex="-1" aria-labelledby="farmaciasModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header text-primary fw-bold text-center">
                <h1 class="modal-title fs-5" id="farmaciasModalLabel">Farmacias Prestadoras</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <img src="backend/img/farmacias/01.png" alt="Servicios">
                <img src="backend/img/farmacias/02.png" alt="Servicios">
                <img src="backend/img/farmacias/03.png" alt="Servicios">


              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
              </div>
            </div>
          </div>

        </div>
      </div>


      <hr />
    </div>
  </section>
  <!-- ====================================== -->
  <!-- =============== PLANES =============== -->
  <!-- ====================================== -->
  <a class="myanchor2" id="planes"></a>
  <section class="container-fluid">
    <div class="row w-75 mx-auto servicio-fila">
      <hr />
      <!-- Card 1 -->
      <div class="col-lg-6 col-md-6 col-sm-12 d-flex justify-content-center align-items-center my-2 icono-wrap">
        <div class="card" style="width: 18rem;">
          <img src="backend/img/planes/pgb-logo.png" class="card-img-top" alt="Plan Génesis Básico">
          <div class="card-body">
            <h5 class="card-title text-primary">Plan Génesis Integral</h5>
            <p class="card-text">Consultas médicas y prácticas de rutina a valores pactados.</p>
            <!-- Button trigger modal -->
            <div class="d-grid gap-2 d-md-flex justify-content-md-center">
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#plangenesisbasico">
                Detalles
              </button>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="plangenesisbasico" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5 text-primary" id="exampleModalLabel">Plan Génesis Integral</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <img src="backend/img/planes/pgi/pgi-01.jpg" alt="Plan Génesis Integral">
                    <img src="backend/img/planes/pgi/pgi-02.jpg" alt="Plan Génesis Integral">
                    <img src="backend/img/planes/pgi/pgi-03.jpg" alt="Plan Génesis Integral">
                    <img src="backend/img/planes/pgi/pgi-04.jpg" alt="Plan Génesis Integral">
                  </div>
                  <!-- <div class="modal-body" style="text-align:left;">
                    <ul>
                      <li>Consultas médicas a valores pactados dentro de nuestra cartilla.</li>
                      <li>Prácticas de rutina.</li>
                      <li>Exámenes complementarios y de diagnóstico.</li>
                      <li>Descuentos en farmacias adherias</li>
                      <li>Descuentos en ópticas adherias</li>
                      <li>Emergencias a domicilios las 24 Hs.</li>
                      <li>Sepelio. Traslado y carroza.</li>
                      <li>Beneficios en odontología general 40%.</li>
                      <li>Consulta Odontológica sin cargo.</li>
                      <li>Odontopediatría.</li>
                    </ul>
                  </div> -->
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Card 2 -->
      <div class="col-lg-6 col-md-6 col-sm-12 d-flex justify-content-center align-items-center my-2 icono-wrap">
        <div class="card" style="width: 18rem;">
          <img src="backend/img/planes/pgi-logo.png" class="card-img-top" alt="Plan Génesis Integral">
          <div class="card-body">
            <h5 class="card-title text-primary">Plan Génesis Premium</h5>
            <p class="card-text">Beneficios éxtras en consultas médicas y prácticas de rutina.</p>
            <!-- Button trigger modal -->
            <div class="d-grid gap-2 d-md-flex justify-content-md-center">
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#plangenesisintegral">
                Detalles
              </button>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="plangenesisintegral" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5 text-primary" id="exampleModalLabel">Plan Génesis Premium</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <img src="backend/img/planes/pgi/pgp-01.jpg" alt="Plan Génesis Integral">
                    <img src="backend/img/planes/pgi/pgp-02.jpg" alt="Plan Génesis Integral">
                    <img src="backend/img/planes/pgi/pgp-03.jpg" alt="Plan Génesis Integral">
                  </div>
                  <!-- <div class="modal-body" style="text-align:left;">
                    <ul>
                      <li>Consultas médicas a valores pactados dentro de nuestra cartilla.</li>
                      <li>Prácticas de rutina.</li>
                      <li>Exámenes complementarios y de diagnóstico.</li>
                      <li>Descuentos en farmacias adherias.</li>
                      <li>Descuentos en ópticas adherias.</li>
                      <li>Emergencias a domicilios las 24 Hs.</li>
                      <li>Sepelio. Traslado y carroza.</li>
                      <li>Beneficios en odontología general 50%.</li>
                      <li>Consulta odontológica sin cargo.</li>
                      <li>Odontopediatría.</li>
                    </ul>
                  </div> -->
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <hr />
    </div>
  </section>
  <!-- ====================================== -->
  <!-- =============== ACERCA DE NOSOTROS =============== -->
  <!-- ====================================== -->
  <section>
    <div class="w-75 m-auto text-center" id="equipo">
      <h2 class="mb-4 fs-2">
        Un equipo con
        <span class="text-primary">Resultados Grandes</span>
      </h2>
      <!-- <p class="fs-4">Breve texto acerca de mi manera de trabajar.</p> -->
    </div>
    <div class="mt-5 text-center">
      <img src="backend/img/equipo.jpg" alt="equipo" class="foto-equipo" />
    </div>
    <br>

    <!-- =========== UBICACIONES DE LAS DISTINTAS SEDES =========== -->
    <a class="myanchor" id="ubicacion"></a>
    <div id="local" class="border-top border-3">
      <!-- <h2 class="text-primary mb-4" id="typewriter"></h2> -->
      <div class="mapa d-flex justify-content-evenly align-items-start">


        <!-- SEDE CENTRO -->
        <div class="card" style="width: 18rem;">
          <a href=" https://api.whatsapp.com/send?phone=5493815440046" target="_blank">
            <img src="backend/img/sedes/barrioSur.png" class="card-img-top" alt="BarrioSur">
          </a>
          <div class="card-body">
            <h5 class="card-title">Horarios:</h5>
            <div>
              <p class="text-center fw-bold">Lunes a Viernes</br><span class="text-primary">9:00Hs. a 13:00Hs.</br>17:00Hs. a 21:00Hs.</span></p>
              <p class="text-center fw-bold">Sábado y Domingo</br><span class="text-danger">Cerrado</span></p>
            </div>
            <div>
            </div>

            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#sedeCentro">¿Cómo llegar?</a>
          </div>

          <!-- Modal -->
          <div class="modal fade" id="sedeCentro" tabindex="-1" aria-labelledby="sedeCentroLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5 text-primary" id="sedeCentroLabel">Sede Centro</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                  <div>

                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3559.9753288736656!2d-65.20877432447031!3d-26.84073699020054!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94225c0905c42499%3A0x44612257af4987ff!2sSim%C3%B3n%20Bol%C3%ADvar%20446%2C%20T4000ARJ%20San%20Miguel%20de%20Tucum%C3%A1n%2C%20Tucum%C3%A1n!5e0!3m2!1ses!2sar!4v1738429822117!5m2!1ses!2sar" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                  </div>
                  <div style="width: 100%; max-width: 376px; margin: 0 auto;">
                    <iframe width="100%" height="669" src="https://www.youtube.com/embed/Ox1_CwOTtHA" title="Trinidad Salud - SedeCentro" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                  </div>


                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <!--  <button type="button" class="btn btn-primary">Save changes</button> -->
                </div>
              </div>
            </div>
          </div>



        </div>

        <!-- SEDE ALDERETES -->
        <div class="card" style="width: 18rem;">
          <a href=" https://api.whatsapp.com/send?phone=5493813658588" target="_blank">
            <img src="backend/img/sedes/sedeAlderetes.png" class="card-img-top" alt="...">
          </a>
          <div class="card-body">
            <h5 class="card-title">Horarios:</h5>
            <div>
              <p class="text-center fw-bold">Lunes a Viernes</br><span class="text-primary">9:00Hs. a 13:00Hs.</br>17:00Hs. a 21:00Hs.</span></p>
              <p class="text-center fw-bold">Sábado y Domingo</br><span class="text-danger">Cerrado</span></p>
            </div>
            <div>
            </div>

            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#sedeAlderetes">¿Cómo llegar?</a>
          </div>

          <!-- Button trigger modal -->
          <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#sedeAlderetes">
            Launch demo modal
          </button> -->

          <!-- Modal -->
          <div class="modal fade" id="sedeAlderetes" tabindex="-1" aria-labelledby="sedeAlderetesLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5 text-primary" id="sedeAlderetesLabel">Sede Alderetes</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                  <div><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3560.7854864906903!2d-65.1448631845791!3d-26.814958183169697!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94225f20afa02cf5%3A0xe503a7532db566ed!2sAv.%20Rivadavia%20915%2C%20San%20Miguel%20de%20Tucum%C3%A1n%2C%20Tucum%C3%A1n!5e0!3m2!1ses!2sar!4v1679138614755!5m2!1ses!2sar" width="100%" height="417" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></div>
                  <div style="width: 100%; max-width: 376px; margin: 0 auto;">
                    <iframe
                      width="100%"
                      height="669"
                      src="https://www.youtube.com/embed/z0HrqdrpCVw"
                      title="Trinidad Salud - Sede Alderetes"
                      frameborder="0"
                      allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                      referrerpolicy="strict-origin-when-cross-origin"
                      allowfullscreen>
                    </iframe>
                  </div>


                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <!--  <button type="button" class="btn btn-primary">Save changes</button> -->
                </div>
              </div>
            </div>
          </div>



        </div>

        <!-- SEDE TRANCAS -->
        <div class="card" style="width: 18rem;">
          <a href=" https://api.whatsapp.com/send?phone=5493813575670" target="_blank">
            <img src="backend/img/sedes/sedeTrancas.png" class="card-img-top" alt="...">
          </a>
          <div class="card-body">
            <!-- <h5 class="card-title">Horarios:</h5> -->
            <div>
              <p class="text-center fw-bold">Antes de ir a nuestras oficinas, <a href=" https://api.whatsapp.com/send?phone=5493813575670" style="text-decoration:none" target="_blank">comunicate al número de celular indicado.</a></p>
            </div>
            <div>
            </div>

            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#sedeTrancas">¿Cómo llegar?</a>
          </div>

          <!-- Button trigger modal -->
          <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#sedeAlderetes">
            Launch demo modal
          </button> -->

          <!-- Modal -->
          <div class="modal fade" id="sedeTrancas" tabindex="-1" aria-labelledby="sedeTrancasLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5 text-primary" id="sedeTrancasLabel">Sede Trancas</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">

                  <div style="width: 100%; max-width: 376px; margin: 0 auto;">

                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2128.061194788243!2d-65.28396130764212!3d-26.230552237330336!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94188ffce06f79e1%3A0x55475d350f2adc4a!2sAv.%20Irigoyen%20594%2C%20T4124%20Trancas%2C%20Tucum%C3%A1n!5e0!3m2!1ses!2sar!4v1738426387313!5m2!1ses!2sar" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

                    <!--   <iframe
                      width="100%"
                      height="669"
                      src="https://www.youtube.com/embed/z0HrqdrpCVw"
                      title="Trinidad Salud - Sede Alderetes"
                      frameborder="0"
                      allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                      referrerpolicy="strict-origin-when-cross-origin"
                      allowfullscreen>
                    </iframe> -->

                  </div>


                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <!--  <button type="button" class="btn btn-primary">Save changes</button> -->
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