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

if(isset($_POST["modifM"])){
 echo " <form  action =\"create.php\" method=\"post\" >
 <fieldset> 
      <table>
         <tr>
             <td>NOM:</td>
             <td><input type=\"text\" placeholder=\"Entrer votre nom\"  name=\"nom\" required/></td>
         </tr>
         <tr>
             <td>PRENOM:</td>
             <td><input type=\"text\" placeholder=\"Entrer votre prenom\" id=\"prenom\" name=\"prenom\" required/></td>
         </tr>
         <tr>
             <td>PASS_WORD:</td>
             <td><input type=\"text\" placeholder=\"Entrer votre mot de passe\" id=\"pass\" name=\"pass\" required/></td>
         </tr>
         <tr>
             <td>ADRESSE:</td>
             <td><input type=\"text\" placeholder=\"Entrer votre adresse\" id=\"adresse\" name=\"adresse\" required/></td>
         </tr>
         <tr>
             <td>E-MAIL:</td>
             <td><input type=\"email\" placeholder=\"Entrer votre mail\" id=\"mail\" name=\"mail\" required/></td>
         </tr>
         <tr>
             <td>TELEPHONE:</td>
             <td><input type=\"text\" placeholder=\"Entrer votre numero de phone\" id=\"phone\" name=\"phone\" required/></td>
         </tr>
         <tr>
             <td>DATE_NAISSANCE:</td>
             <td><input type=\"date\" placeholder=\"Entrer votre date de naissance\" id=\"dat\" name=\"dat\" border-radius=\"8px\" required/></td>
         </tr>
         <tr>
             <td>SEXE:</td>
             <td><input type=\"radio\" name=\"gender\" id=\"dat\" value=\"HOMME\"  required/>HOMME<br></td>
             <td><input type=\"radio\" name=\"gender\" id=\"dat\" value=\"FEMME\"  required/>FEMME<br></td>
         </tr>
         <tr>

             <td>PROFESSION:</td>
             <td><input type=\"text\" placeholder=\"Entrer votre profession\" id=\"profession\" name=\"profession\" required/></td>
         </tr>
         <tr>
             <td> </td>
             <td><button type=\"submit\" name=\"enregistrer\">Mettre A jour </button></td>
         </tr>
     </table>
 </fieldset>
</form>";
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
  $id = $_SESSION['IdMembre'];

  $sql = "UPDATE membre SET NomMembre = \"$Nom\" AND PrenomMembre = \"$Prenom\" AND SexeMembre = \"$Sexe\"
          AND AdresseMembre = \"$Adresse\" AND EmailMembre = \"$Mail\" AND TelMembre = \"$Phone\" 
          AND DateNaissMembre = \"$Dat\" AND ProfessionMembre = \"$Prof\" AND MotDePasse = \"$Pass\"
           WHERE IdMembre = \"$id\" ";
    
    $result = mysqli_query($connect,$sql)  or die('echec query'.mysqli_Error());;

    $_SESSION["NomMembre"] = $Nom;

    $msg = " $Nom vos infos ont ete mis a jour ";
   $date = date("Y-m-d H:i:s");

   $sql = "INSERT INTO messages(IdMembre,msg,dt) VALUES(\"$id\",\"$msg\",\"$date\")";
   $result = mysqli_query($connect,$sql)or die('echec query'.mysqli_Error());
 }

if(isset($_POST["liste"])){
    $sql = "SELECT * FROM tontine ";
    $result = mysqli_query($connect,$sql)  or die('echec query'.mysqli_Error());;
    
    echo "<br><br><table id ='table' cellpadding = \"2\">";
    echo "<tr>"."<th>".'NomTontine'."</th>"."<th>".'DateCreationTontine'."</th>"."<th>".'SloganTontine'."</th>".
    "<th>".'RegleInterieurTontine'."</th>".
    "</tr>";
    echo "<form action = 'membre.php' method='post'>";
    while($row = mysqli_fetch_array($result)){

       
    echo "<tr>"."<td>".$row['NomTontine']."</td>"."<td>".$row['DateCreationTontine']."</td>"."<td>".$row['SloganTontine']."</td>".
    "<td>".$row['RegleInterieurTontine']."</td>".
    "</tr>";

    }
    echo "</form>";
    echo "</table>";

}
if(isset($_POST["acceder"])){
    echo "<form action='MembreAccederTontine.php' method='post'>";
    echo "<label>Nom de La tontine</label>";
    echo "<input type='text' name ='nom' ></br>";
    echo "<input type='submit' name = 'AccederT' value='Acceder'>";
    echo "</form>";

}
if(isset($_POST["rechercher"])){
    echo "<form action='MembreAccederTontine.php' method='post'>";
    echo "<label>Nom de La tontine</label>";
    echo "<input type='text' name ='nom' ></br>";
    echo "<input type='submit' name = 'rechercheT' value='rechercher'>";
    echo "</form>";

}
if(isset($_POST['AccederT'])){
    $id = $_SESSION['IdMembre'];
    $nom = $_POST['nom'];
    $sql = "SELECT * FROM integrertontine INNER JOIN tontine ON integrertontine.NomTontine = \"$nom\" WHERE IdMembre = $id";
    $result = mysqli_query($connect,$sql) or die('echec query'.mysqli_Error());

    $row = mysqli_fetch_array($result);
     if(count($row)>0){
        
        $_SESSION["NomTontine"] = $nom;
        $_SESSION["FonctionMembre"] = $row["fonctionMembre"];
         
        header("location:Tontine.php");
     }
}

if(isset($_POST['integrerT'])){
    echo "<form action='MembreAccederTontine.php' method='post'>";
    echo "<label>Nom de La tontine</label>";
    echo "<input type='text' name ='nom' ></br>";
    echo "<input type='submit' name = 'integrerTT' value='rechercher'>";
    echo "</form>";
}

if(isset($_POST['integrerTT'])){
    $nom = $_POST['nom'];
    
    $sql = "SELECT * FROM tontine INNER JOIN integrertontine ON  tontine.NomTontine =\"$nom\" WHERE fonctionMembre =\"president\"";
    $result = mysqli_query($connect,$sql) or die('echec query'.mysqli_Error());

    $Arr = mysqli_fetch_array($result);

    $Idmembre = $_SESSION["IdMembre"];
    $date = date("Y-m-d H:i:s");
    $sql1="INSERT INTO integrertontine(NomTontine,IdMembre,DateIntegration,Statut) VALUES(\"$nom\",\"$Idmembre\",\"$date\",\"En cours\")";
    $result=mysqli_query($connect,$sql1)or die('echec query'.mysqli_Error());
    $NomMembre = $_SESSION["NomMembre"];
    $msg = " $NomMembre votre demande d'integration a $nom est en cours de traitement ";
   $date = date("Y-m-d H:i:s");

   $sql2 = "INSERT INTO messages(IdMembre,msg,dt) VALUES(\"$Idmembre\",\"$msg\",\"$date\")";
   $result = mysqli_query($connect,$sql2)or die('echec query'.mysqli_Error());
   echo $msg;
   $IdPresi = $Arr["IdMembre"];

   $msg = "Vous Avez recu une demande d'integration dans la tontine $nom  par $NomMembre ";
   $sql3 = "INSERT INTO messages(IdMembre,msg,dt) VALUES(\"$IdPresi\",\"$msg\",\"$date\")";
   $result = mysqli_query($connect,$sql3)or die('echec query'.mysqli_Error());
}
if(isset($_POST['rechercheT'])){
    $nom = $_POST['nom'];

    $sql = "SELECT * FROM tontine WHERE NomTontine = '$nom'";
    $result = mysqli_query($connect,$sql) or die('echec query'.mysqli_Error());
   
    echo "<br><br><table id ='table' cellpadding = \"2\">";
    echo "<tr>"."<th>".'NomTontine'."</th>"."<th>".'DateCreationTontine'."</th>"."<th>".'SloganTontine'."</th>".
    "<th>".'RegleInterieurTontine'."</th>".
    "</tr>";
    echo "<form action = 'MembreAccederTontine.php' method='post'>";
    while($row = mysqli_fetch_array($result)){

       
        echo "<tr>"."<td>".$row['NomTontine']."</td>"."<td>".$row['DateCreationTontine']."</td>"."<td>".$row['SloganTontine']."</td>".
        "<td>".$row['RegleInterieurTontine']."</td>".
        "</tr>";

    }
    echo "</form>";
    echo "</table>";
   
   

 }

if(isset($_POST["difftont"])){
    $id = $_SESSION['IdMembre'];
    $sql = "SELECT * FROM integrertontine INNER JOIN tontine ON integrertontine.NomTontine = tontine.NomTontine WHERE IdMembre = \"$id\" AND Statut <>\"En cours\"";
    $result = mysqli_query($connect,$sql) or die('echec query'.mysqli_Error());
    echo "<br><br><table id ='table' cellpadding = \"2\">";
    echo "<tr>"."<th>".'NomTontine'."</th>"."<th>".'DateCreationTontine'."</th>"."<th>".'SloganTontine'."</th>".
    "<th>".'RegleInterieurTontine'."</th>".
    "</tr>";
    echo "<form action = 'membre.php' method='post'>";
    while($row = mysqli_fetch_array($result)){

       
        echo "<tr>"."<td>".$row['NomTontine']."</td>"."<td>".$row['DateCreationTontine']."</td>"."<td>".$row['SloganTontine']."</td>".
        "<td>".$row['RegleInterieurTontine']."</td>".
        "</tr>";
    }
    echo "</form>";
    echo "</table>";

}
if(isset($_POST["message"])){
    $idM = $_SESSION["IdMembre"];
    $sql = "SELECT * FROM messages WHERE IdMembre = \"$idM\"";
    $result = mysqli_query($connect,$sql) or die('echec query'.mysqli_Error());
    
    
        echo "<br><br><table id ='table' cellpadding = \"2\">";
        echo "<tr>"."<th>".'Messages'."</th>"."<th>".'Date'."</th>"."</tr>";
        echo "<form action = 'membre.php' method='post'>";
        while($row = mysqli_fetch_array($result)){
    
            echo "<tr>"."<td>".$row['msg']."</td>"."<td>".$row['dt']."</td>".
            "</tr>";
    
        }
        echo "</form>";
        echo "</table>";
       


}




?>