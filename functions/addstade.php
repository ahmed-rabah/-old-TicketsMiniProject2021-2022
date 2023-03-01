<?php

require_once("../pages/db.php");
if(isset($_POST['nom'])){
$n =$_POST['nom'];
$ad =$_POST['adr'];
$standard =$_POST['std'];
$tribune =$_POST['trb'];
$vip =$_POST['vip'];
$param = array($n, $ad, $standard,$tribune,$vip);
		$req = $pdo->prepare("INSERT INTO terrain(nomTerrain,adresse,capaciteStandard,capaciteTribune,capaciteVIP) VALUES(?,?,?,?,?)");
		$req->bind_param('ssiii',$n, $ad, $standard,$tribune,$vip);
		$req->execute();
		echo "envoye avec succes...";
		$req->close();
		$pdo->close();
		header("location:../pages/stade.php");
}
require_once("../pages/db.php");   
   
if(isset($_GET['delete'])){
    
	$d =$_GET['delete'];
	$quer=("delete from terrain where idTerrain=$d");
  
    $result= mysqli_query($pdo,$quer);
    if($result){
	    
	header("location:../pages/stade.php");
		$pdo->close();}

}


?>