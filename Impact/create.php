<?php
 /*
session_destroy();*/
session_start();
$servername ="localhost";
$username="root";
$password="";
$dbname="tp_inf2212_tontine";

//create connection
$connect=mysqli_connect($servername,$username,$password,$dbname);

//check connection
if (!$connect) {
    die("connection failed : ".mysqli_connect_error());
}

 if(isset($_POST["enregistrer"])){
  $Nom=$_POST['nom'];
  $Prenom=$_POST['prenom'];
  $Pass=$_POST['pass'];
  $Adresse=$_POST['adresse'];
  $Mail=$_POST['mail'];
  $Phone=$_POST['phone'];
  $Dat=$_POST['dat'];
  $Prof=$_POST['profession'];
  $Sexe = $_POST['gender'];
  $sql="INSERT INTO membre (NomMembre,PrenomMembre,SexeMembre,motdepasse,AdresseMembre,EmailMembre,TelMembre,DateNaissMembre,ProfessionMembre) 
  VALUES(\"$Nom\",\"$Prenom\",\"$Sexe\",\"$Pass\",\"$Adresse\",\"$Mail\",\"$Phone\",\"$Dat\",\"$Prof\")";
  $result=mysqli_query($connect,$sql)or die('echec query'.mysqli_Error());
  
  $sql = "SELECT IdMembre FROM membre WHERE NomMembre = \"$Nom\"";
  $result = mysqli_query($connect,$sql)or die('echec query'.mysqli_Error());
  $Arr = mysqli_fetch_array($result);
  $Id = $Arr["IdMembre"];
  // Envoyer une notification de bienvenue
  $msg = "Bienvenue A vous $Nom  sur Infine App ";
   $date = date("Y-m-d H:i:s");
   $sql = "INSERT INTO messages(IdMembre,msg,dt) VALUES(\"$Id\",\"$msg\",\"$date\")";
   $result = mysqli_query($connect,$sql)or die('echec query'.mysqli_Error());

  $_SESSION["IdMembre"] = $Id;
  $_SESSION["NomMembre"] = $Nom;
  $_SESSION["MotDePasse"] = $Pass;

  header("location:Member.php");
 }

?>