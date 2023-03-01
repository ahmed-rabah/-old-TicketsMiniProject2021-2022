<?php

require_once("../pages/db.php");

if(isset($_POST['id'])){
$id=$_POST['id'];
$n =$_POST['nom'];
$v =$_POST['ville'];
$ab =$_POST['abrev'];


$param = array($n, $v, $ab,$id);
		$req =$pdo->prepare("UPDATE equipe SET  `nomEquipe` = ?, `ville` = ?, `abrev` = ? WHERE `equipe`.`idEquipe` =? ");
		$req->bind_param('sssi',$n, $v, $ab,$id);
		$req->execute();
		$req->close();
		
	
		header("location:../pages/equipe.php");
		$pdo->close();
		
}
