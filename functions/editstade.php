<?php

require_once("../pages/db.php");

if(isset($_POST['id'])){
$id=$_POST['id'];
$n =$_POST['nom'];
$adr =$_POST['adr'];
$std =$_POST['std'];
$trb =$_POST['trb'];
$vip =$_POST['vip'];


$param = array($n,$adr,$std,$trb,$vip,$id);
		$req =$pdo->prepare("UPDATE terrain SET  `nomTerrain` = ?, `adresse` = ?, `capaciteStandard` = ? , `capaciteTribune` = ? ,`capaciteVIP` = ?   WHERE `terrain`.`idTerrain` =? ");
		$req->bind_param('ssiiii',$n,$adr,$std,$trb,$vip,$id);
		$req->execute();
		$req->close();
		
	
		header("location:../pages/stade.php");
		$pdo->close();
		
}
