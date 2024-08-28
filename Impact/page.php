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

 echo "Hello ".$_SESSION["NomMembre"];

 $IdM = $_SESSION["IdMembre"];
 $dt = date('Y-m-d H:i:s');
 $NomTontine = $_SESSION["NomTontine"];
 

  if(isset($_POST["valider"])){

   
    
    $sql = "SELECT * FROM integrertontine INNER JOIN membre ON integrertontine.IdMembre = membre.IdMembre WHERE NomTontine = \"$NomTontine\" AND Statut <> \"Valider\"  ";
    $result= mysqli_query($connect,$sql) or die('echec query'.mysqli_Error());
    $dt = date('Y-m-d H:i:s');
    echo "<br><br><table id ='table' cellpadding = \"2\">";
    echo "<tr>"."<th>".'IdMembre'."</th>"."<th>".'NomMembre'."</th>"."<th>".'Statut'."</th>".
    "</tr>";
    while($row = mysqli_fetch_array($result)){
        $a = $row['IdMembre'];
        $arr[$a] = $row['NomMembre'];
    echo "<tr>"."<td>".$row['IdMembre']."</td>"."<td>".$row['NomMembre']."</td>"."<td>".$row['Statut']."</td>".
    "</tr>";

    }
    echo "</table>";
    
   
    echo "<form action=\"page.php\" method=\"post\">;
    <label>Id Membre </label><br>
    <input type=\"number\" name=\"IdMba\" value=\"0\"><br>
    <button type=\"submit\" name=\"vld\">Valider</button>
    <button type=\"submit\" name=\"rjt\">Rejeter</button>
    "
   ;

        
    
  }

  if(isset($_POST["vld"])){
    
    $id = $_POST["IdMba"];
    $sql = "SELECT * FROM  membre WHERE IdMembre = \"$id\"  ";
    $result= mysqli_query($connect,$sql) or die('echec query'.mysqli_Error());
    $arr  = mysqli_fetch_array($result);
    $nom = $arr["NomMembre"];

    $sql = "UPDATE integrertontine SET Statut=\"Valider\" WHERE IdMembre = \"$id\" AND NomTontine = \"$NomTontine\" ";
    $result= mysqli_query($connect,$sql) or die('echec query'.mysqli_Error());
    
    $msg= "Votre Demande d'inscription A $NomTontine a ete valider ";
    $sql = "INSERT INTO messages(IdMembre,msg,dt) VALUES(\"$id\",\"$msg\",\"$dt\")";
    $result= mysqli_query($connect,$sql) or die('echec query'.mysqli_Error());

    $msg= "Vous avez valider la Demande d'inscription A $NomTontine de $nom  ";
    echo $msg;
    $sql = "INSERT INTO messages(IdMembre,msg,dt) VALUES(\"$IdM\",\"$msg\",\"$dt\")";
    $result= mysqli_query($connect,$sql) or die('echec query'.mysqli_Error());
  }
  if(isset($_POST["rjt"])){
    
    $id = $_POST["IdMba"];
    $sql = "SELECT * FROM  membre WHERE IdMembre = \"$id\"  ";
    $result= mysqli_query($connect,$sql) or die('echec query'.mysqli_Error());
    $arr  = mysqli_fetch_array($result);
    $nom = $arr["NomMembre"];

    $sql = "UPDATE integrertontine SET Statut=\"Annuler\" WHERE IdMembre = \"$id\" AND NomTontine = \"$NomTontine\" ";
            $result= mysqli_query($connect,$sql) or die('echec query'.mysqli_Error());
            
            $msg= "Votre Demande d'inscription A $NomTontine a ete refuser ";
            $sql = "INSERT INTO messages(IdMembre,msg,dt) VALUES(\"$id\",\"$msg\",\"$dt\")";
            $result= mysqli_query($connect,$sql) or die('echec query'.mysqli_Error());
            
            $msg= "Vous avez refuser la Demande d'inscription A $NomTontine de $nom  ";
            echo $msg;
            $sql = "INSERT INTO messages(IdMembre,msg,dt) VALUES(\"$IdM\",\"$msg\",\"$dt\")";
            $result= mysqli_query($connect,$sql) or die('echec query'.mysqli_Error());
    
  }
  if(isset($_POST["ajouter"])){
    echo "<form action=\"page.php\" method=\"post\">
    <label>Id Membre</label></br>
    <input type = \"number\" name =\"IdMe\" value=\"0\" required></br>
    <label>Poste </label></br>
    <input type = \"text\" name =\"poste\" value=\"secretaire\"></br>
    <button type=\"submit\" name=\"AjoutM\">Ajouter</button>
    </form>
    
    
    ";

  }
  if(isset($_POST["AjoutM"])){
    $id = $_POST["IdMe"];
    $poste = $_POST["poste"];
    $sql = "SELECT * FROM  membre WHERE IdMembre = \"$id\"  ";
    $result= mysqli_query($connect,$sql) or die('echec query'.mysqli_Error());
    $arr  = mysqli_fetch_array($result);
    $nom = $arr["NomMembre"];
    $sql = "SELECT * FROM integrertontine WHERE  IdMembre = \"$id\" AND NomTontine = \"$NomTontine\" ";
    $result= mysqli_query($connect,$sql) or die('echec query'.mysqli_Error());
    $arr = mysqli_fetch_array($result);
     if($arr==null){
      $sql="INSERT INTO integrertontine (NomTontine,IdMembre,DateIntegration,NbPartTontine,fonctionMembre,Statut) VALUES('$NomTontine','$id','$dt',0,'$poste',\"Valider\")";
      $result= mysqli_query($connect,$sql) or die('echec query'.mysqli_Error());

      $msg= "Vous avez ete integrer au poste de $poste  dans $NomTontine  ";
    $sql = "INSERT INTO messages(IdMembre,msg,dt) VALUES(\"$id\",\"$msg\",\"$dt\")";
    $result= mysqli_query($connect,$sql) or die('echec query'.mysqli_Error());
     
    $msg= "Vous avez  integrer $nom au poste de $poste dans $NomTontine ";
    echo $msg;
    $sql = "INSERT INTO messages(IdMembre,msg,dt) VALUES(\"$IdM\",\"$msg\",\"$dt\")";
    $result= mysqli_query($connect,$sql) or die('echec query'.mysqli_Error());
  
      
     }
     else{
    $sql = "UPDATE integrertontine SET fonctionMembre=\"$poste\" WHERE IdMembre = \"$id\" AND NomTontine = \"$NomTontine\" ";
    $result= mysqli_query($connect,$sql) or die('echec query'.mysqli_Error());
    
    $msg= "Vous avez ete nommer $poste  dans $NomTontine  ";
    $sql = "INSERT INTO messages(IdMembre,msg,dt) VALUES(\"$id\",\"$msg\",\"$dt\")";
    $result= mysqli_query($connect,$sql) or die('echec query'.mysqli_Error());

    $msg= "Vous avez nommer $nom au poste de $poste dans $NomTontine ";
    echo $msg;
    $sql = "INSERT INTO messages(IdMembre,msg,dt) VALUES(\"$IdM\",\"$msg\",\"$dt\")";
    $result= mysqli_query($connect,$sql) or die('echec query'.mysqli_Error());
     }

  }
  if(isset($_POST["supp"])){
    
    $sql = "SELECT * FROM integrertontine INNER JOIN membre ON integrertontine.IdMembre = membre.IdMembre WHERE NomTontine = \"$NomTontine\" AND Statut = \"Valider\"  ";
    $result= mysqli_query($connect,$sql) or die('echec query'.mysqli_Error());


    echo "<br><br><table id ='table' cellpadding = \"2\">";
    echo "<tr>"."<th>".'IdMembre'."</th>"."<th>".'NomMembre'."</th>"."<th>".'fonctionMembre'."</th>".
    "</tr>";
    while($row = mysqli_fetch_array($result)){
        $a = $row['IdMembre'];
  
    echo "<tr>"."<td>".$row['IdMembre']."</td>"."<td>".$row['NomMembre']."</td>"."<td>".$row['fonctionMembre']."</td>".
    "</tr>";

    }
    echo "</table><br><br>";



    echo "<form action=\"page.php\" method=\"post\">
    <label>Id Membre</label></br>
    <input type = \"number\" name =\"IdM\" value=\"0\" required></br>
    <button type=\"submit\" name=\"suppM\">supprimer</button>
    </form>
    
    ";

  }

  if(isset($_POST["suppM"])){
   
  
    $id = $_POST["IdM"];
    $sql = "SELECT * FROM  membre WHERE IdMembre = \"$id\"  ";
    $result= mysqli_query($connect,$sql) or die('echec query'.mysqli_Error());
    $arr  = mysqli_fetch_array($result);
    $nom = $arr["NomMembre"];

    $sql = "DELETE FROM integrertontine WHERE  IdMembre = \"$id\" AND NomTontine = \"$NomTontine\" ";
    $result= mysqli_query($connect,$sql) or die('echec query'.mysqli_Error());
    
    $msg= "Vous avez ete retirer de $NomTontine  ";
    $sql = "INSERT INTO messages(IdMembre,msg,dt) VALUES(\"$id\",\"$msg\",\"$dt\")";
    $result= mysqli_query($connect,$sql) or die('echec query'.mysqli_Error());

    $msg= "Vous avez retirer $nom de $NomTontine ";
    echo $msg;
    $sql = "INSERT INTO messages(IdMembre,msg,dt) VALUES(\"$IdM\",\"$msg\",\"$dt\")";
    $result= mysqli_query($connect,$sql) or die('echec query'.mysqli_Error());
  

  }

  if(isset($_POST["affichermembre"])){
    $sql = "SELECT * FROM integrertontine INNER JOIN membre ON integrertontine.IdMembre = membre.IdMembre WHERE NomTontine = \"$NomTontine\" AND Statut = \"Valider\"  ";
    $result= mysqli_query($connect,$sql) or die('echec query'.mysqli_Error());


    echo "<br><br><table id ='table' cellpadding = \"2\">";
    echo "<tr>"."<th>".'IdMembre'."</th>"."<th>".'NomMembre'."</th>"."<th>".'fonctionMembre'."</th>".
    "</tr>";
    while($row = mysqli_fetch_array($result)){
        $a = $row['IdMembre'];
  
    echo "<tr>"."<td>".$row['IdMembre']."</td>"."<td>".$row['NomMembre']."</td>"."<td>".$row['fonctionMembre']."</td>".
    "</tr>";

    }
    echo "</table>";
  }
  
  if(isset($_POST["reunion"])){
    echo "<form action=\"page.php\" method=\"post\">
    <label>Motif Reunion</label></br>
    <input type = \"text\" name =\"motif\" value=\"motif reunion\"></br>
    <label>Lieu Reunion</label></br>
    <input type = \"text\" name =\"lieu\" value=\"lieu reunion\"></br>
    <label>Date Reunion</label></br>
    <input type = \"datetime-local\" name =\"date\" ></br>
    <label>Heure Debut</label></br>
    <input type = \"time\" name =\"heureD\" ></br>
    <label>Heure Fin</label></br>
    <input type = \"time\" name =\"heureF\" ></br>
    <button type=\"submit\" name=\"creerR\">creer</button>
    </form>
    ";

  }
  
  if(isset($_POST["creerR"])){
    
    $motif = $_POST["motif"];
    $lieu = $_POST["lieu"];
    $heureD = $_POST["heureD"];
    $heureF = $_POST["heureF"];
    $date =  $_POST["date"];
    $id = $_SESSION["NomTontine"];
    $sql = "INSERT INTO Reunion(MotifReunion,LieuReunion,HeureDebutReunion,HeureFinReunion,DateReunion,NomTontine) 
            VALUES(\"$motif\",\"$lieu\",\"$heureD\",\"$heureF\",\"$date\",\"$id\")";

    $result = mysqli_query($connect,$sql) or die('echec query'.mysqli_Error());
  
    $sql = "SELECT * FROM Reunion WHERE HeureDebutReunion = \"$heureD\" AND HeureFinReunion = \"$heureF\" AND
         NomTontine = \"$NomTontine\"
       ";
    $result= mysqli_query($connect,$sql) or die('echec query'.mysqli_Error());
     $R = mysqli_fetch_array($result);
     
     $idR = $R["IdReunion"];
    
    $_SESSION["IdReunion"] = $idR;
        $msg ="Votre Reunion a ete creer avec success ";

        $sql = "INSERT INTO messages(IdMembre,msg,dt) VALUES(\"$IdM\",\"$msg\",\"$dt\")";
    $result= mysqli_query($connect,$sql) or die('echec query'.mysqli_Error());

    
    
    $sql = "SELECT * FROM integrertontine INNER JOIN membre ON integrertontine.IdMembre = membre.IdMembre WHERE NomTontine = \"$NomTontine\" AND Statut = \"Valider\"  ";
    $result= mysqli_query($connect,$sql) or die('echec query'.mysqli_Error());

    $msg= "Vous etes invitez a prendre part a la reunion qui aura lieu le $date a $lieu de $heureD a $heureF ";
    while($row = mysqli_fetch_array($result)){
        $a = $row['IdMembre'];
        
        $sql1 = "INSERT INTO messages(IdMembre,msg,dt) VALUES(\"$a\",\"$msg\",\"$dt\")";
        $result1= mysqli_query($connect,$sql1) or die('echec query'.mysqli_Error());
       
    

    }
    header("location:Group_chat.php");
  }
  if(isset($_POST["MettreAjour"])){
    echo "<form action=\"page.php\" method=\"post\">
    <label>Nom de Tontine</label></br>
    <input type = \"text\" name =\"NomTontine\" value=\"$NomTontine\"></br>
    <label>Slogan</label></br>
    <input type = \"text\" name =\"Slogan\" value=\"Votre Slogan\"></br>
    <label>Reglement Interieur</label></br>
    <input type = \"text\" name =\"Reglement\" ></br>
    
    <button type=\"submit\" name=\"MAJ\">Mettre A jour</button>
    </form>
    ";
  }
  if(isset($_POST["MAJ"])){
    $Nom = $_POST["NomTontine"];
    $Slogan = $_POST["Slogan"];
    $Reglement = $_POST["Reglement"];

    $sql = "UPDATE tontine SET SloganTontine = \"$Slogan\" AND RegleInterieurTontine = \"$Reglement\"
            WHERE NomTontine = \"$NomTontine\" ";
    
    $result= mysqli_query($connect,$sql) or die('echec query'.mysqli_Error());

    $_SESSION["NomTontine"] = $NomTontine;
    header("location:Tontine.php");
  }

  if(isset($_POST["suppTontine"])){
    $sql = "UPDATE tontine SET NomTontine = \"null\"  WHERE NomTontine = \"$NomTontine\" ";
    
    $result= mysqli_query($connect,$sql) or die('echec query'.mysqli_Error());
    $_SESSION["NomTontine"] = null;
    header("location:Member.php");
  }
  if(isset($_POST["mettreAjourMembre"])){
    echo "<form action=\"page.php\" method=\"post\">
    <label>Id Membre</label></br>
    <input type = \"number\" name =\"IdMe\" value=\"0\" required></br>
    <label>Poste </label></br>
    <input type = \"text\" name =\"poste\" value=\"secretaire\"></br>
    <button type=\"submit\" name=\"MAjoutM\">Mettre A jour</button>
    </form>
    
    
    ";
  } 
  if(isset($_POST["MAjoutM"])){
  $id = $_POST["IdMe"];
    $poste = $_POST["poste"];
    $sql = "SELECT * FROM  membre WHERE IdMembre = \"$id\"  ";
    $result= mysqli_query($connect,$sql) or die('echec query'.mysqli_Error());
    $arr  = mysqli_fetch_array($result);
    $nom = $arr["NomMembre"];
    $sql = "SELECT * FROM integrertontine WHERE  IdMembre = \"$id\" AND NomTontine = \"$NomTontine\" ";
    $result= mysqli_query($connect,$sql) or die('echec query'.mysqli_Error());
    $arr = mysqli_fetch_array($result);
     if($arr==null){
      echo "Le Membre N'existe pas";
     }
     else{
    $sql = "UPDATE integrertontine SET fonctionMembre=\"$poste\" WHERE IdMembre = \"$id\" AND NomTontine = \"$NomTontine\" ";
    $result= mysqli_query($connect,$sql) or die('echec query'.mysqli_Error());
    
    $msg= "Vous avez ete nommer $poste  dans $NomTontine  ";
    $sql = "INSERT INTO messages(IdMembre,msg,dt) VALUES(\"$id\",\"$msg\",\"$dt\")";
    $result= mysqli_query($connect,$sql) or die('echec query'.mysqli_Error());

    $msg= "Vous avez nommer $nom au poste de $poste dans $NomTontine ";
    echo $msg;
    $sql = "INSERT INTO messages(IdMembre,msg,dt) VALUES(\"$IdM\",\"$msg\",\"$dt\")";
    $result= mysqli_query($connect,$sql) or die('echec query'.mysqli_Error());
     }
    }

?>