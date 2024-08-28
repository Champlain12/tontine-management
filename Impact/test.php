<?php

session_start();
$_SESSION["color"] = "blue";

echo $_SESSION["color"];
?>

<?php
 echo "<p> session color </p>";
 echo $_SESSION["color"];
 $date = date("Y-m-d H:i:s");
 echo "$date";

 header("location:Member.php");
?>