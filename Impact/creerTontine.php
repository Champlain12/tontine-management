<?php
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


if(isset($_POST['createTontine'])){
   
    $Nom=$_POST['nom'];
    $Dat=$_POST['dat'];
    $Slogan=$_POST['slogan'];
    $Regle=$_POST['regle'];
    
    $_SESSION['NomTontine'] = $Nom;
    $NomMembre = $_SESSION["NomMembre"];

    $sql="INSERT INTO tontine(NomTontine,DateCreationTontine,SloganTontine,RegleInterieurTontine)
          VALUES(\"$Nom\",\"$Dat\",\"$Slogan\",\"$Regle\")";
    $result= mysqli_query($connect,$sql) or die('echec query'.mysqli_Error());

    $sql = "SELECT * FROM tontine WHERE NomTontine = '$Nom'";
    $result = mysqli_query($connect,$sql);
    $Arr= mysqli_fetch_array($result);
    $Id = $Arr['NomTontine'];
    $Idmembre = $_SESSION['IdMembre'];
    

    $sql="INSERT INTO integrertontine (NomTontine,IdMembre,DateIntegration,NbPartTontine,fonctionMembre,Statut)
     VALUES(\"$Id\",\"$Idmembre\",\"$Dat\",1,\"president\",\"Valider\")";
    $result=mysqli_query($connect,$sql)or die('echec query'.mysqli_Error());

    $_SESSION["FonctionMembre"] = "president";
    $msg = " $NomMembre votre Tontine a ete creer avec success sur Infine App ";
   $date = date("Y-m-d H:i:s");

   $sql = "INSERT INTO messages(IdMembre,msg,dt) VALUES(\"$Idmembre\",\"$msg\",\"$date\")";
   $result = mysqli_query($connect,$sql)or die('echec query'.mysqli_Error());

   header("location:Tontine.php");
}
?>