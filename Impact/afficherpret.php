<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Liste des prets</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Raleway:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">
</head>

<body>

  <!-- ======= Header ======= -->

  <header id="header" class="header d-flex align-items-center">

    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <h1>INFINE APP<span>.</span></h1>
      </a>
      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="index.html">Home</a></li>
          <li><a href="#about">About</a></li>
        </ul>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->
  <!-- End Header -->

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
      <div class="page-header d-flex align-items-center" style="background-image: url('');">
        <div class="container position-relative">
          <div class="row d-flex justify-content-center">
            <div class="col-lg-6 text-center">
              <h2>LISTE DES PRETS</h2>
              <p></p>
            </div>
          </div>
        </div>
      </div>
      <nav>
        <div class="container">
          <ol>
            <li><a href="gestionDesFonds.html">gestion des prets</a></li>
            <li>liste des prets</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Breadcrumbs -->

    <section class="sample-page">
      <div class="container" data-aos="fade-up">
      <?php
        if(!isset($_POST["afficher"])){
          echo"<form method=\"POST\">
          <div>
            <input type=\"submit\" name=\"afficher\" id=\"afficher\" value=\"LISTER PRET\"/>
            <input type=\"submit\" formaction='GestionDesPrets.php' name=\"annuler\" id=\"annuler\" value=\"ANNULER\"/>
          </div>
        </form>";
        }
        
      ?>
          
      </div>
    </section>
    <?php
      if(isset($_POST['afficher'])){

        $servername="localhost";
        $username="root";
        $password="";
        $dbname="tp_inf2212_tontine";
        //connexion au serveur local et a la base de donne
        $connect=mysqli_connect($servername,$username,$password,$dbname) or die('echec serveur'.mysqli_Error());
        //requette pour afficher tout les fond de la base de données
        $afficher="SELECT*
            FROM pret";
        $envoi=mysqli_query($connect,$afficher)or die('echec querry'.mysqli_Error());
        echo "<center>";
 echo "<table>";
                  while ($row=mysqli_fetch_array($envoi))
                  {
                    echo"<tr>".
                      "<td>".$row["IdPret"]."</td>".
                                  "<td>".$row["IdMembre"]."</td>".
                                  "<td>".$row["NomTontine"]."</td>".
                                  "<td>".$row["NomPret"]."</td>".
                                  "<td>".$row["MontantPret"]."</td>".
                                  "<td>".$row["DatePret"]."</td>".
                                  "<td>".$row["DelaisPret"]."</td>".	
                                  "<td>".$row["TxInteretPret"]."</td>".
                                  "<td>".$row["TxSanctionPret"]."</td>".
                                  "<td>".$row["StatutPret"]."</td>".
                    "</tr>";
                  }	
                echo "</table>";
                echo "</center>"; 
      }
    ?>
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">

    <div class="container">
      <div class="row gy-4">
        <div class="col-lg-5 col-md-12 footer-info">
          <a href="index.html" class="logo d-flex align-items-center">
            <span>Infine App</span>
          </a>
          <p></p>
          <div class="social-links d-flex mt-4">
            <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
          </div>
        </div>
      </div>
    </div>

  </footer><!-- End Footer -->
  <!-- End Footer -->

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>