<?php
session_start();
require("connect.php");
$NomTontine = $_SESSION["NomTontine"];
if(!(isset($_SESSION["NomTontine"])&&isset($_SESSION["IdMembre"]))){
echo "<form action='Election.php' method='post'>";
        
        echo "<button type='submit' name = 'connexion' >Connexion</button>";
        echo "</form>";

}
echo "<form action='Election.php' method='post'>";
echo "<button type='submit' name = 'AccederElection' >Acceder election</button>";
 echo "</form>";
 
if(isset($_SESSION["fonctionMembre"])){
     if($_SESSION["fonctionMembre"]=="president"){
        echo "<form action='Election.php' method='post'>";
        
        echo "<button type='submit' name = 'CreerElection' >Creer Une election</button>";
        echo "<button type='submit' name = 'AnnulerElection' >Annuler Une election</button>";
        echo "<button type='submit' name = 'ValiderElection' >Valider Une election</button>";
        echo "<button type='submit' name = 'MettreAJour' >Mettre A jour Une election</button>";
        echo "<button type='submit' name = 'ProposerElection' >Proposer une election</button>";
        echo "</form>";
     }
}
if(isset($_POST["AccederElection"])){
    echo "<form action='Election.php' method='post'>";
         if(isset($_SESSION["IdElection"])){
        echo "<button type='submit' name = 'vote' >Plateforme de vote</button>";
        echo "<button type='submit' name = 'cand'>Plateforme de Candidature</button>";
       
         }
         else{
            echo "<label>IdElection</label><br>";
            echo "<input type='number' name = 'id' value ='5' ><br>";
            echo "<button type='submit' name = 'cand'>Acceder</button>";
         }
         echo "</form>";
}
 if(isset($_POST["Acceder"])){
      $id= $_POST["id"];

      $sql = "SELECT  * FROM Election WHERE IdElection = \"$id\" ";

      $rest = mysqli_query($connect,$sql)  or die('echec query'.mysqli_Error());
      if($rest==true){
        $_SESSION["IdElection"] = $id;
      echo "<button type='submit' name = 'vote' >Plateforme de vote</button>";
      echo "<button type='submit' name = 'cand'>Plateforme de Candidature</button>";
      }
      
 }
if(isset($_POST["CreerElection"])||isset($_POST["ProposerElection"])){
    echo "<form action='Election.php' method='post'>";
    echo "<label>Date de Debut</label><br>";
    echo "<input type='datetime-local' name = 'dateD'  ><br>";
    echo "<label>Date de Fin</label><br>";
    echo "<input type='datetime-local' name = 'dateF'  ><br>";
    echo "<label>Mandat</label><br>";
    echo "<input type='number' name = 'mandat' value ='5' ><br>";
    echo "<button type='submit' name = 'elect'>Entrer</button>";
        echo "</form>";
}
if(isset($_POST["AnnulerElection"])){
    echo "<form action='Election.php' method='post'>";
    if(!isset($_SESSION["IdElection"])){
        echo "<label>IdElection</label><br>";
        echo "<input type='number' name = 'id' value ='5' ><br>";
    }
    echo "<button type='submit' name = 'Aelect'>Annuler Election</button>";
        echo "</form>";
}
if(isset($_POST["ValiderElection"])){
    echo "<form action='Election.php' method='post'>";
    if(!isset($_SESSION["IdElection"])){
        echo "<label>IdElection</label><br>";
        echo "<input type='number' name = 'id' value ='5' ><br>";
    }
    echo "<button type='submit' name = 'Velect'>Valider Election</button>";
        echo "</form>";
}

if(isset($_POST["MettreAJour"])){
    echo "<form action='Election.php' method='post'>";
    if(!isset($_SESSION["IdElection"])){
        echo "<label>IdElection</label><br>";
        echo "<input type='number' name = 'idr' value ='5' ><br>";
    }
    echo "<label>Date Debut' </label><br>";
    echo "<input type='datetime-local' name = 'dtD'  ><br>";
    echo "<label>Date Fin' </label><br>";
    echo "<input type='datetime-local' name = 'dtF'  ><br>";
    echo "<label>Mandat</label><br>";
    echo "<input type='number' name = 'mt' value ='5' ><br>";
    echo "<label>Statut</label><br>";
    echo "<input type='text' name = 'st' value ='En cours' ><br>";
    echo "<button type='submit' name = 'Melect'>Mettre A jour</button>";
        echo "</form>";
}

if(isset($_POST["elect"])){
    $md = $_POST["mandat"];
    $dtD = $_POST["dateD"];
    $dtF = $_POST["dateF"];
    
    
   

    $sql = "INSERT INTO Election(DateElection,MandasElection,StatutElection,NomTontine,DateFinElection)
    VALUES(\"$dtD\",\"$md\",\"En cours\",\"$NomTontine\",\"$dtF\")";
    $rest = mysqli_query($connect,$sql)  or die('echec query'.mysqli_Error());
    
    $sql = "SELECT * FROM Election WHERE DateElection = \"$dtD\" ";
    $rest = mysqli_query($connect,$sql)  or die('echec query'.mysqli_Error());
    $arr = mysqli_fetch_array($rest);
    $ide = $arr["IdElection"];

     $sql = "CREATE DEFINER=`root`@`localhost` EVENT 'Election' ON SCHEDULE AT '$dtF'
     ON COMPLETION PRESERVE ENABLE DO
      
     (SELECT Membre.IdMembre, Membre.NomMembre, Candidature.poste,COUNT(*) AS NbVoix
FROM Membre, Candidature, Vote
WHERE Membre.IdMembre=Candidature.IdMembre
AND Vote.IdCandidature=Candidature.IdCandidature
AND Vote.IdElection=\"$ide\"
AND Candidature.poste=\"President\"
GROUP BY Membre.NomMembre,Candidature.poste) AS RESULTAT_PR;


(SELECT Membre.IdMembre, Membre.NomMembre, Candidature.poste,COUNT(*) AS NbVoix
FROM Membre, Candidature, Vote
WHERE Membre.IdMembre=Candidature.IdMembre
AND Vote.IdCandidature=Candidature.IdCandidature
AND Vote.IdElection=\"$ide\"
AND Candidature.poste=\"Secretaire\"
GROUP BY Membre.NomMembre,Candidature.poste) AS RESULTAT_SE;


(SELECT Membre.IdMembre, Membre.NomMembre, Candidature.poste,COUNT(*) AS NbVoix
FROM Membre, Candidature, Vote
WHERE Membre.IdMembre=Candidature.IdMembre
AND Vote.IdCandidature=Candidature.IdCandidature
AND Vote.IdElection=\"$ide\"
AND Candidature.poste=\"Tresorier\"
GROUP BY Membre.NomMembre,Candidature.poste) AS RESULTAT_TR;


(SELECT Membre.IdMembre, Membre.NomMembre, Candidature.poste,COUNT(*) AS NbVoix
FROM Membre, Candidature, Vote
WHERE Membre.IdMembre=Candidature.IdMembre
AND Vote.IdCandidature=Candidature.IdCandidature
AND Vote.IdElection=\"$ide\"
AND Candidature.poste=\"Commissaire_au_compte\"
GROUP BY Membre.NomMembre,Candidature.poste) AS RESULTAT_CM;

SELECT IdMembre
FROM (RESULTAT) 
WHERE NbVoix=(SELECT MAX(NbVoix) FROM RESULTAT)


UPDATE IntegrerTontine
SET fonctionMembre=NULL 
WHERE IdMembre IN(SELECT IdMembre FROM IntegrerTontine WHERE  fonctionMembre IS NOT NULL AND NomTontine=\"$NomTontine\");


UPDATE IntegrerTontine
SET fonctionMembre=\"President\"
WHERE IdMembre = (SELECT IdMembre FROM RESULTAT_PR WHERE NbVoix=(SELECT MAX(NbVoix) FROM RESULTAT_PR));


UPDATE IntegrerTontine
SET fonctionMembre=\"Secretaire\"
WHERE IdMembre = (SELECT IdMembre FROM RESULTAT_PR WHERE NbVoix=(SELECT MAX(NbVoix) FROM RESULTAT_SE));


UPDATE IntegrerTontine
SET fonctionMembre=\"Commissaire_au_compte\"
WHERE IdMembre = (SELECT IdMembre FROM RESULTAT_PR WHERE NbVoix=(SELECT MAX(NbVoix) FROM RESULTAT_CM));

UPDATE IntegrerTontine
SET fonctionMembre=\"Tresorier\"
WHERE IdMembre = (SELECT IdMembre FROM RESULTAT_PR WHERE NbVoix=(SELECT MAX(NbVoix) FROM RESULTAT_TR)); ";
     $rest = mysqli_query($connect,$sql)  or die('echec query'.mysqli_Error());
    
}

if(isset($_POST["Aelect"])){
    if(!isset($_SESSION["IdElection"])){
        $md = $_POST["id"];
        $_SESSION["IdElection"] =$md;
    }
    else{
        $md = $_SESSION["IdElection"];
    }
   
    
    $sql = "UPDATE Election SET StatutElection = \"Annuler\" WHERE  IdElection = \"$md\" AND NomTontine = \"$NomTontine\"";
    $rest = mysqli_query($connect,$sql);
    if($rest){
        echo "<p>Election Annuler Avec success</p>";
        }
}

if(isset($_POST["Velect"])){
    if(!isset($_SESSION["IdElection"])){
        $md = $_POST["id"];
        $_SESSION["IdElection"] =$md;
    }
    else{
        $md = $_SESSION["IdElection"];
    }
   
    $_SESSION["IdElection"] =$md;
    $sql = "UPDATE Election SET StatutElection = \"Valider\" WHERE  IdElection = \"$md\" AND NomTontine = \"$NomTontine\"";
    $rest = mysqli_query($connect,$sql);
    if($rest){
        echo "<p>Election Valider Avec success</p>";
        }
}

if(isset($_POST["Melect"])){
    if(!isset($_SESSION["IdElection"])){
        $md = $_POST["idr"];
        $_SESSION["IdElection"] =$md;
    }
    else{
        $md = $_SESSION["IdElection"];
    }
    $dtD = $_POST["dtD"];
    $dtF = $_POST["dtF"];
    $mt = $_POST["mt"];
    $st = $_POST["st"];
    
    $sql = "UPDATE Election SET  MandasElection = \"$mt\" , DateElection = \"$dtD\"
     , StatutElection = \"$st\" , DateFinElection = \"$dtF\"
     WHERE  IdElection = \"$md\" AND NomTontine = \"$NomTontine\"";
    $rest = mysqli_query($connect,$sql);
    if($rest){
        echo "<p>Election Mis a jour Avec success</p>";
        }
}



 


   if(isset($_POST["cand"])){
    echo "<form action='Election.php' method='post'>";
    if(!isset($_SESSION["IdElection"])){
    echo "<label>Id Election</label>";
    echo "<input type='number' name ='idElect' ></br>";
    }
    echo "<label>Poste</label>";
    echo "<input type='text' name ='poste' ></br>";
    echo "<input type='submit' name = 'postuler' value='postuler'>";
    echo "</form>";
       
   }
   if(isset($_POST["postuler"])){
      
    $idM = $_SESSION["IdMembre"];
    
    if(isset($_SESSION["IdMembre"])){
        $idE = $_SESSION["IdElection"];
    }
    else{
        $idE = $_POST["idElect"];
    }
    $poste = $_POST["poste"];
    $dt = date('Y-m-d H:i:s');
    $sql1 = "SELECT StatutElection FROM election WHERE IdElection = \"$idE\" ";
    $rest1 = mysqli_query($connect,$sql1) ;
     if($rest1){
         $art = mysqli_fetch_array($rest1);
          
         if($art["StatutElection"]=="En cours" ){
         $sql = "INSERT INTO candidature(IdElection,IdMembre,DateCandidature,StatutCandidature,poste) 
         VALUES(\"$idE\",\"$idM\",\"$dt\",\"En cours\",\"$poste\")";
     
          $rest = mysqli_query($connect,$sql) ;
          if($rest){
         echo "<p> votre Candidature est En cours</p>";
           }
         else{
            echo "<p> vous ne pouvez pas candidatez plusieurs fois</p>"; 
         }
         }
     }
   
   }
   

 

 if(isset($_POST["vote"])){
  
   
    $NomTontine = $_SESSION["NomTontine"];
        
        echo "<p>Bienvenue dans la Plateforme</p>";
        echo "<form action='Election.php' method='post'>";
        echo "<label>Id Candidat</label>";
        echo "<input type='number' name ='idC' ></br>";
        
        
        if(!isset($_SESSION["IdElection"])){
            echo "<label>Id Election</label>";
            echo "<input type='number' name ='idE' ></br>";}
        
        echo "<input type='submit' name = 'vte' value='Voter'>";
        echo "</form>";
    }
 
 if(isset($_POST["vte"])){
    $dt = date('Y-m-d H:i:s');
   
    $idM = $_SESSION["IdMembre"];
    $idC = $_POST["idC"];
    if(isset($_SESSION["IdElection"])){
        $idE = $_SESSION["IdElection"];
    }
    else{
        $idE = $_POST["idE"];
    }
  

    $sql = "INSERT INTO vote(IdMembre,IdCandidature,IdElection,DateVote) VALUES(\"$idM\',\"$idC\",\"$idE\",\"$dt\")";
    $rest = mysqli_query($connect,$sql) ;
   
 }

 
 
 
 

 if(isset($_POST["connexion"])){
    
    echo "<form action='Election.php' method='post'>";
    echo "<label>NomTontine</label>";
    echo "<input type='text' name ='id' ></br>";
    echo "<label>IdMembre</label>";
    echo "<input type='number' name ='idM' ></br>";
    echo "<input type='submit' name = 'conn' value='Entrer'>";
    echo "</form>";
 }

 if(isset($_POST["conn"])){
    require("connect.php");
    $id= $_POST["id"];
    $n = $_POST["idM"];
    $_SESSION["IdMembre"] =$n;
    $sql ="SELECT * FROM integrertontine WHERE NomTontine=\"$id\" AND IdMembre =\"$n\"";
    $res = mysqli_query($connect,$sql);
   
    
       $arr = mysqli_fetch_array($res);
       $_SESSION["fonctionMembre"] = $arr["fonctionMembre"];
       $_SESSION["NomTontine"] = $arr["NomTontine"];
        
    

   

 }

 
?>