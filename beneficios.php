<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous" />
  <title>Trinidad Salud</title>
  <link rel="icon" href="img/logo.png" />
  <link rel="apple-touch-icon" href="img/logo.png" />
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
<!-- ====================================== -->
<!-- =============== INTRO =============== -->
  <!-- ====================================== -->
  <section class="w-50 mx-auto text-center pt-5" id="intro">
    <h1 class="p-3 fs-2 border-top border-3 text-primary">
      ¡Beneficios exclusivos para socios!

    </h1>
  </section>
  <!-- ====================================== -->
  <!-- =============== BENEFICIOS =============== -->
  <!-- ====================================== -->
  <a class="myanchor2" id="beneficios"></a>
  <section class="container-fluid">
    <div class="row w-75 mx-auto servicio-fila">
      <hr />

      <div class="col-lg-4 col-md-6 col-sm-12 d-flex justify-content-around align-items-center my-2 icono-wrap">
        <div class="img-serv">
          <img src="backend/img/beneficios/logo-ayacucho.jpg" alt="Beneficios" width="150" />
        </div>
      </div>

      <div class="col-lg-4 col-md-6 col-sm-12 d-flex justify-content-around align-items-center my-2 icono-wrap">
        <div class="img-serv">
          <a href="https://api.whatsapp.com/send?phone=5493815732192&text=¡Hola!.%20Quisiera%20consultar%20por%20los%20beneficios%20por%20ser%20afiliado%20de%20Trinidad%20Salud." target="_blank"><img src="backend/img/beneficios/logo-delissias.jpg" alt="Beneficios" /></a>
        </div>
      </div>

      <div class="col-lg-4 col-md-6 col-sm-12 d-flex justify-content-around align-items-center my-2 icono-wrap">
        <div class="img-serv">
          <a href="https://api.whatsapp.com/send?phone=5493813658588&text=¡Hola!.%20Quisiera%20consultar%20por%20los%20beneficios%20por%20ser%20afiliado%20de%20Trinidad%20Salud." target="_blank">
            <img src="backend/img/beneficios/logo-jdgym.jpg" alt="Beneficios" width="170" />
          </a>
        </div>
      </div>

      <div class="col-lg-4 col-md-6 col-sm-12 d-flex justify-content-around align-items-center my-2 icono-wrap">
        <div class="img-serv">
          <img src="backend/img/beneficios/logo-meraki.jpg" alt="Beneficios" width="170" />
        </div>
      </div>

      <div class="col-lg-4 col-md-6 col-sm-12 d-flex align-items-center my-2 icono-wrap justify-content-around">
        <div class="img-serv">
          <img src="backend/img/beneficios/logo-paskana.jpg" alt="Beneficios" width="170" />
        </div>

      </div>

      <div class="col-lg-4 col-md-6 col-sm-12 d-flex align-items-center my-2 icono-wrap justify-content-around">
        <div class="img-serv">
          <img src="backend/img/beneficios/logo-rg.jpg" alt="Beneficios" width="170" />
        </div>
      </div>

      <div class="col-lg-4 col-md-6 col-sm-12 d-flex align-items-center my-2 icono-wrap justify-content-around">
        <div class="img-serv">
          <img src="backend/img/beneficios/logo-tato.jpg" alt="Beneficios" width="170" />
        </div>
      </div>

      <div class="col-lg-4 col-md-6 col-sm-12 d-flex align-items-center my-2 icono-wrap justify-content-around">
        <div class="img-serv">
          <a href="https://www.yoheladerias.com.ar/" target="_blank"><img src="backend/img/beneficios/logo-yoh.jpg" alt="Beneficios" width="170" /></a>
        </div>
      </div>



      <hr />
    </div>
  </section>





  <!-- =============== PIE DE LA PÁGINA =============== -->
  <?php
  include("footer.html")
  ?>
  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/typewriter-effect@latest/dist/core.js"></script>
  <script src="main.js"></script>
</body>

</html>
