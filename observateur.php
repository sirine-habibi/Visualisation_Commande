<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>We Can See</title>
  <!-- Favicon-->
  <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
  <!-- Font Awesome icons (free version)-->
  <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

  <script>
    ((g) => {
      var h,
        a,
        k,
        p = "The Google Maps JavaScript API",
        c = "google",
        l = "importLibrary",
        q = "__ib__",
        m = document,
        b = window;
      b = b[c] || (b[c] = {});
      var d = b.maps || (b.maps = {}),
        r = new Set(),
        e = new URLSearchParams(),
        u = () =>
          h ||
          (h = new Promise(async (f, n) => {
            await (a = m.createElement("script"));
            e.set("libraries", [...r] + "");
            for (k in g)
              e.set(
                k.replace(/[A-Z]/g, (t) => "_" + t[0].toLowerCase()),
                g[k]
              );
            e.set("callback", c + ".maps." + q);
            a.src = `https://maps.${c}apis.com/maps/api/js?` + e;
            d[q] = f;
            a.onerror = () => (h = n(Error(p + " could not load.")));
            a.nonce = m.querySelector("script[nonce]")?.nonce || "";
            m.head.append(a);
          }));
      d[l]
        ? console.warn(p + " only loads once. Ignoring:", g)
        : (d[l] = (f, ...n) => r.add(f) && u().then(() => d[l](f, ...n)));
    })({
      $googleObserverApiKey = getenv('GOOGLE_OBSERVER_API_KEY');
      // Utiliser googleObserverApiKey pour la logique de l'observateur
      key: $googleObserverApiKey,
      v: "weekly",
    });
  </script>

  <!-- Google fonts-->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
  <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
  <!-- Core theme CSS (includes Bootstrap)-->
  <link href="css/styles.css" rel="stylesheet" />
</head>

<body id="page-top">
  <!-- Navigation-->

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

        .page-section h2,
        .page-section h3 {
            margin-bottom: 20px;
        }
    </style>
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
  <div class="container">
  <a class="navbar-brand text-white" href="#page-top">SmartVision</a>
       
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive"
      aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      Menu
      <i class="fas fa-bars ms-1"></i>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="http://172.20.10.12">En direct</a>
        </li>
        <li class="nav-item"><a class="nav-link" href="#about">GPS</a></li>
        <li class="nav-item">
          <a class="nav-link" href="#contact">Contact</a>
        </li>
       
        <li class="nav-item">
           <a class="nav-link" href="profile.php">
               <i class="fas fa-user"></i> 
            </a>
        </li>
        <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
      </ul>
    </div>
  </div>
</nav>


  <!-- Live Stream-->
  <section class="page-section bg-light" id="portfolio"></section>
  <!-- GPS-->
  <section class="page-section" id="about">
    <div class="container">
      <h1>Realtime GPS Tracker </h1>
      <center>
        <hr style="
              height: 2px;
              border: none;
              color: #ffffff;
              background-color: #ffffff;
              width: 35%;
              margin: 0 auto 0 auto;
            " />
      </center>

      <center>
        <div id="map" style="width: 100%; height: 500px"></div>
      </center>
    </div>
  </section>

  <!-- Contact-->
  <section class="page-section bg-dark text-white" id="contact">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase mb-4">Contact Us</h2>
        </div>
        <form id="contactForm" action="https://formspree.io/f/mqkrnwko" method="POST">
            <div class="row align-items-stretch mb-5">
                <div class="col-md-6">
                    <div class="form-group">
                        <!-- Name input-->
                        <input class="form-control" id="name" name="name" type="text" placeholder="Your Name *"
                            data-sb-validations="required" style="background-color: #343a40; color: white;">
                        <div class="invalid-feedback" data-sb-feedback="name:required">A name is required.</div>
                    </div>
                    <div class="form-group">
                        <!-- Email address input-->
                        <input class="form-control" id="email" name="email" type="email"
                            placeholder="Your Email *" data-sb-validations="required,email"
                            style="background-color: #343a40; color: white;">
                        <div class="invalid-feedback" data-sb-feedback="email:required">An email is required.</div>
                        <div class="invalid-feedback" data-sb-feedback="email:email">Email is not valid.</div>
                    </div>
                    <div class="form-group mb-md-0">
                        <!-- Phone number input-->
                        <input class="form-control" id="phone" name="phone" type="tel" placeholder="Your Phone *"
                            data-sb-validations="required" style="background-color: #343a40; color: white;">
                        <div class="invalid-feedback" data-sb-feedback="phone:required">A phone number is required.
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group form-group-textarea mb-md-0">
                        <!-- Message input-->
                        <textarea class="form-control" id="message" name="message" placeholder="Your Message *"
                            data-sb-validations="required"
                            style="background-color: #343a40; color: white;"></textarea>
                        <div class="invalid-feedback" data-sb-feedback="message:required">A message is required.
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit Button-->
            <div class="text-center"><button class="btn btn-primary btn-xl text-uppercase"
                    id="submitButton" type="submit" style="background-color: #0056b3; border-color: #0056b3;">Send Message</button></div>

        </form>

    </div>
</section>





  <!-- Footer-->
  <footer class="footer py-4">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-4 text-lg-start">
          Copyright &copy; We Can See 2024
        </div>
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

  <!-- Bootstrap core JS-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Core theme JS-->
  <script src="js/scripts.js"></script>
  <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->

  <!-- * *                               SB Forms JS                               * *-->
  <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
  <!-- * * * * * * * * * * * * *        firebase con fig             * * * * * * * * * * * * * * * * * * * * * * * * * * *-->

  <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
  <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
  <script src="https://www.gstatic.com/firebasejs/7.14.6/firebase-app.js"></script>
  <script src="https://www.gstatic.com/firebasejs/7.14.6/firebase-database.js"></script>

  <script src="./js/map.js"></script>
</body>

</html>