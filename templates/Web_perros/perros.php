<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <link rel="stylesheet" href="\static\webPerrosCss\style.css">
  <link rel="icon" href="images/icon.png" type="images/png">

<link rel="stylesheet" type="text/css"
href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />

<!-- bootstrap core css -->
<link rel="stylesheet" type="text/css" href="\static\webPerrosCss\bootstrap.css" />

<!-- fonts style -->
<link href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap" rel="stylesheet" />
<!-- Custom styles for this template -->
<link href="\static\webPerrosCss\style.css" rel="stylesheet" />
<!-- responsive style -->
<link href="\static\webPerrosCss\responsive.css" rel="stylesheet" />

  <title>Perros Cantabria</title>
</head>
<body>

  <header class="header_section fixed-header">
    <div class="container-fluid">
      <nav class="navbar navbar-expand-lg custom_nav-container">
        <a class="Title-text navbar-brand" href="index.php">
          <span>Pastores Cantabria</span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto"> <!-- Alinea a la derecha -->
            <li class="nav-item active">
              <a class="nav-link" href="index.php">Inicio <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="Nosotros.php">Nosotros</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="Ubicacion.php">Ubicación</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="perros.php">
                <span>Perros</span> <img src="images/dog-icon.png" alt="" />
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="Contacto.php">Contactar</a>
            </li>
          </ul>
        </div>
      </nav>
    </div>
  </header>


    <div>
        <h1 class="Titulo-Prin">Perros</h1>
    </div>

    <div class="container-p">

        <?php
          $conn = new mysqli('localhost','root','','perros_hijas');

          $rs = $conn->query("select * from perros;");

          while($r=$rs->fetch_assoc()){
            $f='images_perros/'.$r['id_perro'].'.png';
            if(!glob($f))
              $f='images_perros/0.png';
  
            echo '
            <div class="container-gen-perro">
                <!-- Contenedor de la información -->
                <div class="container-perro" style="flex: 1;">
                    <h1 class="Titulo-perro">'.$r['perro'].'</h1>

                        <li>Nacido '.date('d/m/Y',strtotime($r['f_nacimiento'])).'</li>
                        <li>Color '.$r['color'].'</li>
                        <li>Progenitores:'.$r['progenitores'].'</li>
                        <li>Descripción: '.$r['descripcion'].'</li>
                        <a href="Contacto.php" class="boton-contacto" >Contactar</a>
                </div>
                <!-- Contenedor de la imagen -->
                <div class="foto-perros">
                    <img src="'.$f.'" alt="Imagen de perros" style="width: 150px; height: auto; border-radius: 8px;">
                </div>
                
                
            </div>
            ';
          }
         ?>
      


    </div>


    
      <!-- info section -->
      <section class="info_section layout_padding">
        <div class="container">
          <div class="row">
            <div class="col-md-3">
              <div class="info_contact">
                <div class="info_logo">
                  <a href="index.html">
                    <span>
                      Pastores Cantabria
                    </span>
                  </a>
                </div>
                <h5>
                  Contactarnos
                </h5>
                <div>
                  <div class="img-box">
                    <img src="images/location.png" width="18px" alt="" />
                  </div>
                  <p>
                    Hijas
                  </p>
                </div>
                <div>
                  <div class="img-box">
                    <img src="images/phone.png" width="18px" alt="" />
                  </div>
                  <p>
                    +01 1234567890
                  </p>
                </div>
                <div>
                  <div class="img-box">
                    <img src="images/envelope.png" width="18px" alt="" />
                  </div>
                  <p>
                    demo@gmail.com
                  </p>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="info_info">
                <h5>
                  Más
                </h5>
                <p>
                  There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration
                  in some form, by injected humour,
                </p>
              </div>
            </div>
    
            <div class="col-md-3">
              <div class="info_links">
                <h5>
                  Links
                </h5>
                <ul>
                  <li>
                    <a href="">
                      There are many
                    </a>
                  </li>
                  <li>
                    <a href="">
                      variations of
                    </a>
                  </li>
                  <li>
                    <a href="">
                      passages of
                    </a>
                  </li>
                  <li>
                    <a href="">
                      Lorem Ipsum
                    </a>
                  </li>
                  <li>
                    <a href="">
                      available, but the
                    </a>
                  </li>
                  <li>
                    <a href="">
                      majority have
                    </a>
                  </li>
                  <li>
                    <a href="">
                      suffered
                    </a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-md-3">
              <div class="info_form ">
                <h5>
                  Correo de contacto
                </h5>
                <form action="">
                  <input type="email" placeholder="Enter your email" />
                  <button>
                    Enviar
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </section>
    
      <!-- end info_section -->
    
      <!-- footer section -->
      <section class="container-fluid footer_section">
        <p>
          &copy; 2024 All Rights Reserved By Perros Cantabria
          
        </p>
      </section>
      <!-- footer section -->
    
      <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
      <script type="text/javascript" src="js/bootstrap.js"></script>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
      </script>
      <!-- owl carousel script 
        -->
      <script type="text/javascript">
        $(".owl-carousel").owlCarousel({
          loop: true,
          margin: 0,
          navText: [],
          center: true,
          autoplay: true,
          autoplayHoverPause: true,
          responsive: {
            0: {
              items: 1
            },
            1000: {
              items: 3
            }
          }
        });
      </script>
</body>
</html>