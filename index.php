<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>We Can See</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link href="css/styles.css" rel="stylesheet" />
    <style>
        .navbar-dark {
            background-color: #343a40 !important;
        }
        .navbar-nav .nav-link {
            color: #fff !important;
            margin-right: 15px;
        }
        .page-section {
            padding: 60px 0;
        }
        .page-section h2, .page-section h3 {
            margin-bottom: 20px;
        }
        @import url('https://fonts.googleapis.com/css2?family=Roboto&display=swap');
        .navbar-brand {
            font-family: 'Roboto', sans-serif;
            font-size: 24px;
        }
        .chat-bubble {
            position: fixed;
            bottom: 20px;
            left: 20px; /* Positionner à gauche */
            width: 50px;
            height: 50px;
            background-color: #007bff;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            cursor: pointer;
            z-index: 1000;
        }
    </style>
  </head>
  <body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand text-white" href="#page-top">SmartVision</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars ms-1"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="#services">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="connexion.php">Interface observateur</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Masthead-->
    <header class="bg-dark text-white" style="background-image: url('assets/img/lunette.jpg'); background-size: cover; height: 95vh;">
        <div class="container h-100">
            <div class="row h-100 align-items-center justify-content-end">
                <div class="col-md-6 text-md-end">
                    <h1 class="fw-bold" style="font-size: 3rem;">Technologie innovante pour l'assistance visuelle</h1>
                    <p class="lead" style="font-size: 1.25rem;">Découvrez nos produits innovants pour améliorer votre expérience visuelle.</p>
                </div>
            </div>
            <div class="row h-100">
                <div class="col-md-12 d-flex justify-content-end align-items-end fixed-bottom">
                    <a href="commande.php" class="btn btn-primary btn-lg text-uppercase" style="background-color: #0056b3; border-color: #0056b3;">
                        Passer une commande <i class="fas fa-shopping-cart ms-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Home-->
    <section class="page-section" id="services">
      <div class="container">
        <div class="text-center">
          <h2 class="section-heading text-uppercase">Comment ça fonctionne</h2>
          <h3 class="section-subheading text-muted"></h3>
        </div>
        <div class="row text-center">
          <div class="col-md-4">
            <p class="text-muted">
              Dans la conception de nos lunettes intelligentes, différents
              éléments collaborent pour offrir une expérience utilisateur fluide
              et pratique. Au cœur de notre dispositif se trouve l'ESP32-CAM,
              associé au module caméra OV2640, permettant ainsi la capture
              d'images et de vidéos. Ce module communique avec les autres
              éléments pour coordonner les fonctionnalités des lunettes. Le
              capteur à ultrasons HC-SR04 surveille les distances entre les
              lunettes et les objets environnants, facilitant ainsi la
              navigation de l'utilisateur dans son environnement. Le capteur de
              mouvements HC-SR501 détecte les gestes à proximité, transmettant
              des signaux à l'ESP32-CAM pour déclencher des actions telles que
              la prise de photos ou de vidéos. L'interrupteur offre une
              interface simple pour allumer ou éteindre les lunettes, tandis que
              le module GPS NEO-7M-C UARTX fournit des données de localisation
              pour géolocaliser les images ou vidéos capturées.
            </p>
          </div>
          <div class="col-md-4 order-md-last">
            <img src="assets/img/lunette.jpg" alt="Description de l'image" style="width: 100%; max-width: 400px; height: 100%" />
          </div>
        </div>
      </div>
    </section>

    <!-- Contact-->
    <section class="page-section" id="contact">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">Contact Us</h2>
            </div>
            <form id="contactForm" action="https://formspree.io/f/mqkrnwko" method="POST">
                <div class="row align-items-stretch mb-5">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input class="form-control" id="name" name="name" type="text" placeholder="Your Name *" data-sb-validations="required" />
                            <div class="invalid-feedback" data-sb-feedback="name:required">A name is required.</div>
                        </div>
                        <div class="form-group">
                            <input class="form-control" id="email" name="email" type="email" placeholder="Your Email *" data-sb-validations="required,email" />
                            <div class="invalid-feedback" data-sb-feedback="email:required">An email is required.</div>
                            <div class="invalid-feedback" data-sb-feedback="email:email">Email is not valid.</div>
                        </div>
                        <div class="form-group mb-md-0">
                            <input class="form-control" id="phone" name="phone" type="tel" placeholder="Your Phone *" data-sb-validations="required" />
                            <div class="invalid-feedback" data-sb-feedback="phone:required">A phone number is required.</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-group-textarea mb-md-0">
                            <textarea class="form-control" id="message" name="message" placeholder="Your Message *" data-sb-validations="required"></textarea>
                            <div class="invalid-feedback" data-sb-feedback="message:required">A message is required.</div>
                        </div>
                    </div>
                </div>
                <div class="d-none" id="submitSuccessMessage">
                    <div class="text-center text-white mb-3">
                        <div class="fw-bolder">Form submission successful!</div>
                        To activate this form, sign up at
                        <br />
                        <a href="https://startbootstrap.com/solution/contact-forms">https://startbootstrap.com/solution/contact-forms</a>
                    </div>
                </div>
                <div class="d-none" id="submitErrorMessage">
                    <div class="text-center text-danger mb-3">Error sending message!</div>
                </div>
                <div class="text-center">
                    <button class="btn btn-primary btn-xl text-uppercase" id="submitButton" type="submit">Send Message</button>
                </div>
            </form>
        </div>
    </section>

    <!-- Bulle de discussion -->
    <div class="chat-bubble" onclick="goToForum()">
        <i class="fas fa-comment"></i>
    </div>

    <!-- Footer-->
    <footer class="footer py-4 bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4 text-lg-start">Copyright &copy; Your Website 2024</div>
                <div class="col-lg-4 my-3 my-lg-0">
                    <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <a class="link-dark text-decoration-none me-3" href="#!">Privacy Policy</a>
                    <a class="link-dark text-decoration-none" href="#!">Terms of Use</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Core theme JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/scripts.js"></script>
    <script>
        function goToForum() {
            window.location.href = 'forum.php';
        }
    </script>
  </body>
</html>
