<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>mettre a jour un fond</title>
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
              <h2>METTRE A JOUR UN FOND</h2>
              <p></p>
            </div>
          </div>
        </div>
      </div>
      <nav>
        <div class="container">
          <ol>
            <li><a href="gestionDesFonds.html">gestion des fonds</a></li>
            <li>mettre a jour un fond</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Breadcrumbs -->

    <section class="sample-page">
      <div class="container" data-aos="fade-up">
      <form method="POST">
          <div>
            <input type="number" name="idfond" id="idfond" placeholder="entrer l'dentifiant du fond"/>
            <input type="submit" name="mise" id="mise" value="rechercher"/>
          </div>
        </form>    
       
      </div>
    </section>
    <?php
      session_start();
       if(isset($_POST['mise'])){
        $id=$_POST['idfond'];
        $_SESSION['idfond']=$id;
        $servername="localhost";
        $username="root";
        $password="";
        $dbname="tp_inf2212_tontine";
       //connexion au serveur local et a la base de donne
        $connect=mysqli_connect($servername,$username,$password,$dbname) or die('echec serveur'.mysqli_Error());
        //connexion a la base de données
        $req="SELECT* FROM fond  WHERE IdFond='$id'";
        $envoi=mysqli_query($connect,$req) or die('echec mise a jour'.mysqli_error());

        while($row=mysqli_fetch_array($envoi)){
          echo"<form method=\"POST\">
          <div>
            <input type=\"text\" name=\"nom_fond\" id=\"nom_fond\" value=\"".$row['NomFond']."\" required/><br>
            <input type=\"text\" name=\"règle_fond\" id=\"règle_fond\" value=\"".$row['ReglesFond']."\" required/><br>
            <input type=\"text\" name=\"objectif_fond\" id=\"objectif_fond\" value=\"".$row['ObjectifFond']."\" required/><br>
            <input type=\"text\" name=\"statut_fond\" id=\"statut_fond\" value=\"".$row['StatutFond']."\"  required/><br>
            <input type=\"text\" name=\"nom_tontine\" id=\"nom_tontine\" value=\"".$row['NomTontine']."\"required/><br>
            <input type=\"submit\" name=\"soumettre\" id=\"soumettre\" value=\"soumettre\">
          </div>
        </form>";
        }
      }
      if(isset($_POST['soumettre'])){
        $NomFond=$_POST['nom_fond'];
        $ReglesFond=$_POST['règle_fond'];
        $ObjectifFond=$_POST['objectif_fond'];
        $StatutFond=$_POST['statut_fond'];
        $nomTontine=$_POST['nom_tontine'];
        $servername="localhost";
        $username="root";
        $password="";
        $dbname="tp_inf2212_tontine";
       //connexion au serveur local et a la base de donne
       $id=$_SESSION['idfond'];
        $connect=mysqli_connect($servername,$username,$password,$dbname) or die('echec serveur'.mysqli_Error());
        $miseajour="UPDATE fond
        SET 
            NomFond='$NomFond',
            ReglesFond='$ReglesFond',
            ObjectifFond='$ObjectifFond',
            StatutFond='$StatutFond',
            NomTontine='$nomTontine'
        WHERE IdFond='$id'";
        echo"mise a jour effectuer avec success";
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