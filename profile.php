<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: connexion.php");
    exit;
}

// Fetch user details from session
$username = $_SESSION["username"];
$email = $_SESSION["email"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="User Profile">
    <meta name="author" content="">
    <title>User Profile</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico">
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css">
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet">
</head>
<body id="page-top">
    <!-- Navigation -->
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
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars ms-1"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                <li class="nav-item">
                        <a class="nav-link" href="javascript:history.back()">
                            <i class="fas fa-arrow-left"></i> Retour
                        </a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                    <li class="nav-item">
                        <a class="nav-link" href="#profile">
                            <i class="fas fa-user-circle"></i> <?php echo htmlspecialchars($_SESSION["username"]); ?>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

   <!-- Profile Section -->
   <section>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center mb-4">Profile</h2>
                <div class="d-flex justify-content-center mb-4">
                    <i class="fas fa-user-circle fa-5x"></i> <!-- Icône d'utilisateur -->
                </div>
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Nom et Prénom</h5>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-user text-dark"></i></span>
                            <input type="text" class="form-control" id="username" value="<?php echo htmlspecialchars($username); ?>" readonly>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Email</h5>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-envelope text-dark"></i></span>
                            <input type="email" class="form-control" id="email" value="<?php echo htmlspecialchars($email); ?>" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



    <!-- Bootstrap core JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS -->
    <script src="js/scripts.js"></script>
</body>

</html>
