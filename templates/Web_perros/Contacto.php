<?php

require 'phpmailer/PHPMailer.php';
require 'phpmailer/Exception.php';
require 'phpmailer/SMTP.php';
  
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


if(isset($_POST['email'])){
  $conn = new mysqli('localhost','root','','perros_hijas');
  $conn->query("insert into mensajes_correo (correo,mensaje) values ('".$_POST['email']."','".$_POST['mensaje']."');");

  


  $mail = new PHPMailer(true);

  try {
      // Configuración del servidor
      $mail->isSMTP();                                            // Usar SMTP
      $mail->Host       = 'smtp.gmail.com';                       // Servidor SMTP
      $mail->SMTPAuth   = true;                                   // Habilitar autenticación SMTP
      $mail->Username   = 'adayfernandez57@gmail.com';                   // Tu correo
      $mail->Password   = 'gqei fzbr trsv gklw';                        // Tu contraseña (mejor usar una contraseña de aplicación si es Gmail)
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Habilitar TLS
      $mail->Port       = 587;                                    // Puerto SMTP

      // Configuración del destinatario
      $mail->setFrom('adayfernandez57@gmail.com', 'Aday');          // Remitente
      $mail->addAddress($_POST['email'], $_POST['email']);    // Destinatario
      $mail->addReplyTo('adayfernandez57@gmail.com', 'Aday'); // Responder a (opcional)

      // Contenido del correo
      $mail->isHTML(true);                                        // Habilitar HTML
      $mail->Subject = 'Solicitud de cachorro';                       // Asunto
      $mail->Body    = 'Este es el <b>mensaje</b> en HTML.';      // Cuerpo en HTML
      $mail->AltBody = 'Este es el mensaje en texto plano.';      // Cuerpo en texto plano (para clientes que no soportan HTML)

      // Enviar correo
      $mail->send();
      echo 'El mensaje se envió correctamente';
  } catch (Exception $e) {
      echo "El mensaje no se pudo enviar. Mailer Error: {$mail->ErrorInfo}";
  }
}





?>
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
  <link rel="icon" href="/static/webPerrosCss/images/icon.png" type="images/png">

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







    <div class="container-contacto">

        <div class="container-logo">
            <h2 class="texto-logo">Telefono: +34 642 532 234</h2>
            <img class="logo" src="images/telefono.png" alt="telefono logo">
        </div>
        <div class="container-logo">
            <h2 class="texto-logo">Whatsapp: +34 642 532 234</h2>
            <img class="logo" src="images/whatsap.png" alt="WhatsApp logo">
        </div>
        <form class="form-correo" method="POST">
          <div class="container-Correo">
            <h2 class="text-correo">Correo electronico</h2>
            <div class="Container-input">
              <input class="ingreso-email" name="email" type="email">
            </div>
            <h3 class="text-correo">Mensaje que desea enviar</h3>

            <textarea class="ingreso-email-text ingreso-email" name="mensaje" type="text"></textarea>

            <div class="container-boton">
                <button class="boton-enviar">Enviar</button>
            </div>
          </div>
        </form>




    </div>
































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