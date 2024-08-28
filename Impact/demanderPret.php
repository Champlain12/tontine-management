
<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>demander un pret</title>
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
              <h2>FORMULAIRE DE DEMANDE DE PRET</h2>
              <p></p>
            </div>
          </div>
        </div>
      </div>
      <nav>
        <div class="container">
          <ol>
            <li><a href="GestionDesPrets.php">gestion des prets</a></li>
            <li>FORMULAIRE DE DEMANDE DE PRET</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Breadcrumbs -->

    <section class="sample-page">
      <div class="container" data-aos="fade-up">

        <form method="POST">
		<fieldset>
			<legend></legend>
			<table>
      <tr>
                        <td>Id_Membre:</td>
                        <td><input type="number" id="idmembre" name="idmembre"require/></td>
                    </tr>
                    <tr>
                        <td>NomTontine:</td>
                        <td><input type="text" id="NomTontine" name="NomTontine" require/></td>
                    </tr>
                    <tr>
                        <td>nomPret:</td>
                        <td><input type="text" placeholder="Entrer votre nomPret" id="nomPret" name="nomPret"require/></td>
                    </tr>
                    <tr>
                        <td>Montantpret:</td>
                        <td><input type="number" placeholder="Entrer votre Montantpret" id="Montantpret" name="Montantpret"require/></td>
                    </tr>
                    <tr>
                        <td>datepret:</td>
                        <td><input type="date"  id="dat" name="dat"require/></td>
                    </tr>
                    <tr>
                        <td>delais pret:</td>
                        <td><input type="date"  id="delais" name="delais"require/></td>
                    </tr>

                    <tr>
                        <td>Taux_Interet_Pret:</td>
                        <td><input type="number"  id="taux" name="taux" require/></td>
                    </tr>

                    <tr>
                        <td>Taux_sanction_Pret:</td>
                        <td><input type="number"  id="sanction" name="sanction" require/></td>
                    </tr>
                    <tr>
                    <td></td>
                    <td><button type="submit" name="enregistrer" id="enregistrer">DEMANDER PRET</button></td>
                        <td><button type="submit" formaction="reporterpret.php" name="reporter" id="reporter">REPORTER PRET</button></td>
                        <?php
                        $NomTontine = $_SESSION["NomTontine"];
                        $NomMembre = $_SESSION["NomMembre"];
                        $idM = $_SESSION["IdMembre"];
                          //requette pour demander un pret
                           
                             if(isset($_SESSION['fonctionMembre'])){
                              if($_SESSION['fonctionMembre']=='president'||$_SESSION['fonctionMembre']=='tresorier'){
                                echo'<form method="POST">
                                  <select name="statut">
                                  <option value="ACEPTEE">ACEPTEE</option>
                            
                                  <option value="REFUSEE">REFUSEE</option>
                                  </select>
                                 echo"<button type=\"submit\" name=\"valider\" id=\"recherche\">valider pret</button></td>";
                                </form>';
                              }else{
                                echo"non authoriser";
                              }
                            }
                            if(isset($_POST['valider'])){
                              $statut=$_POST['statut'];
                              $idmemb=$_POST['idmembre'];

                              $servername="localhost";
                              $username="root";
                              $password="";
                              $dbname="tp_inf2212_tontine";
                             //connexion au serveur local et a la base de donne
                              $connect=mysqli_connect($servername,$username,$password,$dbname) or die('echec serveur'.mysqli_Error());
                              //envoi de le requete d'insertion d'element dans la base de données
                              $req="UPDATE pret 
                                    SET StatutPret='$statut'
                                        WHERE IdMembre='$idmemb' AND NomTontine = '$NomTontine'";
                                    $envoi=mysqli_query($connect,$req)or die('echec querry'.mysqli_Error());
                                  
                                    $sql ="SELECT * FROM integrertontine INNER JOIN 
                                    membre ON integrertontine.IdMembre = membre.IdMembre
                                       WHERE NomTontine=\"$NomTontine\" AND IdMembre =\"$idmemb\"";
                                    $res = mysqli_query($connect,$sql);
                                   
                                    
                                       $arr = mysqli_fetch_array($res);
                                       $ar = $arr['NomMembre'];
                                    $msg = " $ar votre demande de pret a $NomTontine a ete valider ";
                                    $date = date("Y-m-d H:i:s");
                                   
                                    
                                    $sql2 = "INSERT INTO messages(IdMembre,msg,dt) VALUES(\"$idmemb\",\"$msg\",\"$date\")";
                                    $result = mysqli_query($connect,$sql2)or die('echec query'.mysqli_Error());
                                    
                                    $msg = "vous avez valide une demande de pret de   $ar dans $nom ";
                                    $sql2 = "INSERT INTO messages(IdMembre,msg,dt) VALUES(\"$idM\",\"$msg\",\"$date\")";
                                    $result = mysqli_query($connect,$sql2)or die('echec query'.mysqli_Error());
                                echo"pret effectuer avec success";
                            }


                             //requettes pour repporter un pret
                             if(isset($_SESSION['fonctionMembre'])){
                              if($_SESSION['fonctionMembre']=='president'||$_SESSION['fonctionMembre']=='tresorier'){
                        
                                  echo"<form method='POST'>
                                      <button type='submit' name=\"prolonger\" id=\"prolonger\">valider prolongation</button></td>
                                      </form>";
                              }else{
                                  echo"non authoriser";
                              }
                          }
                          if(isset($_POST['prolonger'])){
                            //vous vouler changer un delais                
                            echo"<form method='POST'>
                                <tr>
                                    <td>Id_Membre:</td>
                                    <td><input type='number' id='idmembre' name='idmembre'/></td>
                                </tr>
                                <tr>
                                    <td>delais pret:</td>
                                    <td><input type='date'  id='delais' name='delais'/></td>
                                </tr>";
                            $idmembre=$_POST['idmembre'];
                            $delais=$_POST['delais'];
                            //connection a la baése de données
                            $servername="localhost";
                            $username="root";
                            $password="";
                            $dbname="tp_inf2212_tontine";
                             //connexion au serveur local et a la base de donne
                            $connect=mysqli_connect($servername,$username,$password,$dbname) or die('echec serveur'.mysqli_Error());                                    //envoi de le requete d'insertion d'element dans la base de données
                            $req="UPDATE pret
                                SET DelaisPret='$delais'
                                WHERE IdMembre='$idmembre'";
                            $envoi=mysqli_query($connect,$req)or die('echec querry'.mysqli_Error());
                        }
                        ?>
                      </tr>
			</table>
		</fieldset>
	</form>
  <?php
    //enregistrement du pret dqns la base de données
    if(isset($_POST['enregistrer'])){
      $idmembre=$_POST['idmembre'];
      $NomTontine=$_POST['NomTontine'];
      $nomPret=$_POST['nomPret'];
      $Montantpret=$_POST['Montantpret'];
      $dat=$_POST['dat'];
      $delais=$_POST['delais'];
      $taux=$_POST['taux'];
      $sanction=$_POST['sanction'];
      $servername="localhost";
      $username="root";
      $password="";
      $dbname="tp_inf2212_tontine";
     //connexion au serveur local et a la base de donne
      $connect=mysqli_connect($servername,$username,$password,$dbname) or die('echec serveur'.mysqli_Error());
      //envoi de le requete d'insertion d'element dans la base de données
      $req="INSERT INTO pret(IdMembre,NomTontine,NomPret,MontantPret,DatePret,DelaisPret,TxInteretPret,TxSanctionPret) VALUES('$idmembre','$NomTontine','$nomPret','$Montantpret','$dat','$delais','$taux','$sanction')";
      $envoi=mysqli_query($connect,$req)or die('echec querry'.mysqli_Error());

      $sql ="SELECT * FROM integrertontine INNER JOIN 
      membre ON integrertontine.IdMembre = membre.IdMembre
         WHERE NomTontine=\"$NomTontine\" AND IdMembre =\"$idmembre\"";
      $res = mysqli_query($connect,$sql);
     
      
         $arr = mysqli_fetch_array($res);
         $ar = $arr['NomMembre'];
      $msg = "vous avez recu une demande de pret de   $ar dans $nom ";
      $sql2 = "INSERT INTO messages(IdMembre,msg,dt) VALUES(\"$idM\",\"$msg\",\"$date\")";
      $result = mysqli_query($connect,$sql2)or die('echec query'.mysqli_Error());
    }
  ?>
      </div>
    </section>

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