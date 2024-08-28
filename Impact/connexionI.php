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


if(isset($_POST["connecter"])){
    $Pass=$_POST['password'];
    $Mail=$_POST['email'];

    $sql = "SELECT * FROM membre WHERE EmailMembre = \"$Mail\" AND motdepasse = \"$Pass\" ";
    $result=mysqli_query($connect,$sql)or die('echec query'.mysqli_Error());
    $Arr = mysqli_fetch_array($result);

    $_SESSION['IdMembre'] = $Arr["IdMembre"];
    $_SESSION['NomMembre'] = $Arr["NomMembre"];
    $_SESSION['MotDePasse'] = $Arr["motdepasse"];
    
    header("location:Member.php");

     
    
}

?>