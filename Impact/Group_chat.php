
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

  $NomT = $_SESSION["NomTontine"];
  $idM = $_SESSION["IdMembre"];
  
  if(isset($_SESSION["IdReunion"])){
	$idR  = $_SESSION["IdReunion"];
  $sql = "INSERT INTO participer(IdMembre,IdReunion,TypeParticipation)
          VALUES(\"$idM\",\"$idR\",\"En ligne\")";
  
  $result= mysqli_query($connect,$sql) or die('echec query'.mysqli_Error());


  }
echo "<p> Bienvenu sur la plateforme de reunion</p>";

echo "<form action=\"Group_chat.php\" method=\"post\">
     <label>IdReunion</label>
    <input type=\"number\" name = \"IdReunion\"><br>
    <button type=\"submit\" name = \"chat\">chat</button>
     </form>

";

echo "<form action=\"Group_chat.php\" method=\"post\">
     <label>Rechercher Rapport de Reunion</label>
    <input type=\"datetime-local\" name = \"heure\"><br>
    <button type=\"submit\" name = \"rechRapp\">Entrer</button>
     </form>

";

echo "<form action=\"Group_chat.php\" method=\"post\">
    <button type=\"submit\" name = \"Presence\">Liste de Presence</button>
	<button type=\"submit\" name = \"Notif\">Envoyer une notification</button>
	<button type=\"submit\" name = \"prog\">Programme de Reunion </button>
     </form>

";
if(isset($_POST["rechRapp"])){
  $tmp = $_POST["heure"];
  $idR = $_POST["IdReunion"];

  $sql = "SELECT Rapport FROM reunion
   WHERE IdReunion = \"$idR\" AND DateReunion = \"$tmp\" AND NomTontine =\"$NomT\"  ";

  $result= mysqli_query($connect,$sql) or die('echec query'.mysqli_Error());
  echo "<br><br><table id ='table' cellpadding = \"2\">";
  echo "<tr>"."<th>".'DateReunion'."</th>"."<th>".'Rapport'."</th>".
  "</tr>";
  while($row = mysqli_fetch_array($result)){
	 
  echo "<tr>"."<td>".$row['DateReunion']."</td>"."<td>".$row['Rapport']."</td>".
  "</tr>";

  }
  echo "</table>";


}
if(isset($_POST["Notif"])){
    
	$idR = $_SESSION["IdReunion"];
    $dt=date('y-m-d h:ia');
	$sql = "SELECT * FROM integrertontine INNER JOIN reunion ON integrertontine.NomTontine = reunion.NomTontine 
	WHERE integrertontine.NomTontine = \"$NomT\" AND Statut = \"Valider\" AND IdReunion = \"$idR\"  ";
    $result= mysqli_query($connect,$sql) or die('echec query'.mysqli_Error());
	$Arr = mysqli_fetch_array($result);
    $date = $Arr["DateReunion"];
	$lieu = $Arr["LieuReunion"];
	$heureD = $Arr["HeureDebutReunion"];
	$heureF = $Arr["HeureFinReunion"];

    $msg= "Vous etes invitez a prendre part a la reunion qui aura lieu le $date a $lieu de $heureD a $heureF ";
    while($row = mysqli_fetch_array($result)){
        $a = $row['IdMembre'];
        
        $sql1 = "INSERT INTO messages(IdMembre,msg,dt) VALUES(\"$a\",\"$msg\",\"$dt\")";
        $result1= mysqli_query($connect,$sql1) or die('echec query'.mysqli_Error());
       
    

    }

}

if(isset($_POST["Presence"])){
	$idR = $_SESSION["IdReunion"];
    
	$sql = "SELECT * FROM participer INNER JOIN membre ON  participer.IdMembre = membre.IdMembre 
	 WHERE IdReunion = \"$idR\" AND TypeParticipation <> \"Absent\" ";
	$result= mysqli_query($connect,$sql) or die('echec query'.mysqli_Error());

	echo "<br><br><table id ='table' cellpadding = \"2\">";
    echo "<tr>"."<th>".'IdMembre'."</th>"."<th>".'NomMembre'."</th>".
    "</tr>";
    while($row = mysqli_fetch_array($result)){
       
    echo "<tr>"."<td>".$row['IdMembre']."</td>"."<td>".$row['NomMembre']."</td>".
    "</tr>";

    }
    echo "</table>";

	
}

if(isset($_POST["prog"])){

	$idR = $_SESSION["IdReunion"];
   echo $idR;
	$sql = "SELECT * FROM reunion WHERE IdReunion = \"$idR\"   ";
   
   $result= mysqli_query($connect,$sql) or die('echec query'.mysqli_Error());

   echo "<br><br><table id ='table' cellpadding = \"2\">";
    echo "<tr>"."<th>".'MotifReunion'."</th>"."<th>".'LieuReunion'."</th>".
	"<th>".'HeureDebutReunion'."</th>"."<th>".'HeureFinReunion'."</th>".
	"<th>".'DateReunion'."</th>".
    "</tr>";
    while($row = mysqli_fetch_array($result)){
       
    echo "<tr>"."<td>".$row['MotifReunion']."</td>"."<td>".$row['LieuReunion']."</td>".
	$row['HeureDebutReunion']."</td>"."<td>".$row['HeureFinReunion']."</td>".
	"<td>".$row['DateReunion']."</td>".
    "</tr>";

    }
    echo "</table>";

}
 
if(isset($_POST["chat"])){
	$idR = $_POST["IdReunion"];
	$_SESSION["IdReunion"] = $idR;

  $sql = "INSERT INTO participer(IdMembre,IdReunion,TypeParticipation)
          VALUES(\"$idM\",\"$idR\",\"En ligne\")";
  
  $result= mysqli_query($connect,$sql) or die('echec query'.mysqli_Error());

}

 if(isset($_SESSION["fonctionMembre"])){

	if($_SESSION["fonctionMembre"]=="president" || $_SESSION["fonctionMembre"]=="secretaire")
    {
		echo "<form action=\"Group_chat.php\" method=\"post\">
		<label>Entrer votre rapport </label><br>
		<textarea name=\"rapp\"> </textarea><br>
        <button type=\"submit\" name = \"Rapport\">Rapport</button>
        </form>

";
	}
 }
  
 
  if(isset($_POST["Rapport"])){
	  $rap = mysqli_real_escape_string($connect,$_POST["rapp"]);
      $idr =$_SESSION["IdReunion"];
	  
	  
	  $sql = " UPDATE reunion SET Rapport = \"$rap\" WHERE IdReunion = \"$idr\" AND NomTontine =\"$NomT\"";
	  $result = mysqli_query($connect,$sql);
	  if($result){
		echo "<p> Rapport Ajouter avec success</p>";
	  }
  }


if (isset($_POST['submit'])){
/* Attempt MySQL server connection. Assuming
you are running MySQL server with default
setting (user 'root' with no password) */


$link = $connect;

// Escape user inputs for security
$un= $_POST['uname'];
$m = $_POST['msg'];

$ts=date('y-m-d h:ia');

$IdReunion = $_SESSION["IdReunion"];
 echo $IdReunion;
 
 echo $ts;

// Attempt insert query execution
$sql="INSERT INTO chats(NomTontine,IdReunion,UserName,msg,dt) VALUES(\"$NomT\",'$IdReunion',\"$un\",\"$m\",'$ts')";
 $result = mysqli_query($connect,$sql) or die('echec message'.mysqli_error());
// Close connection

}
?>
<html>
<head>
<link rel="stylesheet" href="chat.css">
<body onload="show_func()">
<div id="container">
	<main>
		<header>
			<img src="https://s3-us-west-2.amazonaws.com/
			s.cdpn.io/1940306/ico_star.png" alt="">
			<div>
				<h2>GROUP CHAT</h2>
			</div>
			<img src="https://s3-us-west-2.amazonaws.com/
			s.cdpn.io/1940306/ico_star.png" alt="">
		</header>

<script>
function show_func(){

var element = document.getElementById("chathist");
	element.scrollTop = element.scrollHeight;

}
</script>

<form id="myform" action="Group_chat.php" method="POST" >
<div class="inner_div" id="chathist">
<?php
$host = "localhost";
$user = "root";
$pass = "";
$db_name = "tp_inf2212_tontine";
$con = new mysqli($host, $user, $pass, $db_name);


if(isset($IdReunion)){
$query = "SELECT * FROM chats WHERE NomTontine= \"$NomT\" AND IdReunion =\"$IdReunion\" ";
$run = $con->query($query);
$i=0;

while($row = $run->fetch_array()) :
if($i==0){
$i=5;
$first=$row;
?>
<div id="triangle1" class="triangle1"></div>
<div id="message1" class="message1">
<span style="color:white;float:right;">
<?php echo $row['msg']; ?></span> <br/>
<div>
<span style="color:black;float:left;
font-size:10px;clear:both;">
	<?php echo $row['UserName']; ?>,
		<?php echo $row['dt']; ?>
</span>
</div>
</div>
<br/><br/>
<?php
}
else
{
if($row['UserName']!=$first['UserName'])
{
?>
<div id="triangle" class="triangle"></div>
<div id="message" class="message">
<span style="color:white;float:left;">
<?php echo $row['msg']; ?>
</span> <br/>
<div>
<span style="color:black;float:right;
		font-size:10px;clear:both;">
<?php echo $row['UserName']; ?>,
		<?php echo $row['dt']; ?>
</span>
</div>
</div>
<br/><br/>
<?php
}
else
{
?>
<div id="triangle1" class="triangle1"></div>
<div id="message1" class="message1">
<span style="color:white;float:right;">
<?php echo $row['msg']; ?>
</span> <br/>
<div>
<span style="color:black;float:left;
		font-size:10px;clear:both;">
<?php echo $row['UserName']; ?>,
	<?php echo $row['dt']; ?>
</span>
</div>
</div>
<br/><br/>
<?php
}
}
endwhile;
}
?>
</div>
	<footer>
		<table>
		<tr>
			<?php
			if(isset($_SESSION['NomMembre'])){
				$name = $_SESSION['NomMembre'];
			}
			else{
				$name = "Entrer votre nom ";
			}
			
		echo "<th>
			<input class=\"input1\" type=\"text\"
					id=\"uname\" name=\"uname\"
					value=\"$name\">
		</th>";
		?>
		<th>
			<textarea id="msg" name="msg"
				rows='3' cols='50'
				placeholder="Type your message">
			</textarea></th>
		<th>
			<input class="input2" type="submit"
			id="submit" name="submit" value="send">
		</th>			
		</tr>
		</table>			
	</footer>
</form>
</main>
</div>

</body>
</html>
