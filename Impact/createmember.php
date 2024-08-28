
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>connexion</title>
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
  <!--<link href="assets/css/connInscript.css" rel="stylesheet">-->

  <!-- =======================================================
  * Template Name: Impact - v1.2.0
  * Template URL: https://bootstrapmade.com/impact-bootstrap-business-website-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header d-flex align-items-center">

    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
      <a href="index.php" class="logo d-flex align-items-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1>INFINE APP<span>.</span></h1>
      </a>
      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="#about">About</a></li>
          <li><a href="#contact">Contact</a></li>
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
              <h2>CREATE MEMBER</h2>
              <p></p>
            </div>
          </div>
        </div>
      </div>
      <nav>
        <div class="container">
          <ol>
            <li><a href="index.php">Home</a></li>
            <li>Create Member</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Breadcrumbs -->

    <section class="sample-page">
      <div class="container" data-aos="fade-up">

        <form  action ="create.php" method="post" >
        <fieldset> 
             <table>
                <tr>
                    <td>NOM:</td>
                    <td><input type="text" placeholder="Entrer votre nom"  name="nom" required/></td>
                </tr>
                <tr>
                    <td>PRENOM:</td>
                    <td><input type="text" placeholder="Entrer votre prenom" id="prenom" name="prenom" required/></td>
                </tr>
                <tr>
                    <td>PASS_WORD:</td>
                    <td><input type="text" placeholder="Entrer votre mot de passe" id="pass" name="pass" required/></td>
                </tr>
                <tr>
                    <td>ADRESSE:</td>
                    <td><input type="text" placeholder="Entrer votre adresse" id="adresse" name="adresse" required/></td>
                </tr>
                <tr>
                    <td>E-MAIL:</td>
                    <td><input type="email" placeholder="Entrer votre mail" id="mail" name="mail" required/></td>
                </tr>
                <tr>
                    <td>TELEPHONE:</td>
                    <td><input type="text" placeholder="Entrer votre numero de phone" id="phone" name="phone" required/></td>
                </tr>
                <tr>
                    <td>DATE_NAISSANCE:</td>
                    <td><input type="date" placeholder="Entrer votre date de naissance" id="dat" name="dat" border-radius="8px" required/></td>
                </tr>
                <tr>
                    <td>SEXE:</td>
                    <td><input type="radio" name="gender" id="dat" value="HOMME"  required/>HOMME<br></td>
                    <td><input type="radio" name="gender" id="dat" value="FEMME"  required/>FEMME<br></td>
                </tr>
                <tr>

                    <td>PROFESSION:</td>
                    <td><input type="text" placeholder="Entrer votre profession" id="profession" name="profession" required/></td>
                </tr>
                <tr>
                    <td> </td>
                    <td><button type="submit" name="enregistrer">CREER MEMBRE </button></td>
                    <td><button type="reset" name="supprimer">SUPPRIMER MEMBRE </button></td>
                </tr>
            </table>
        </fieldset>
    </form>

      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">

    <div class="container">
      <div class="row gy-4">
        <div class="col-lg-5 col-md-12 footer-info">
          <a href="index.php" class="logo d-flex align-items-center">
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

