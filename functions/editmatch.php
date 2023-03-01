<?php

require_once("../pages/db.php");

if(isset($_POST['id'])){
    $id=$_POST['id'];
    $a =$_GET['local'];
    $b =$_GET['adver'];
    $c =$_GET['dateG'];
    $d =$_GET['hourG'];
    $e =$_GET['stade'];
    $f =$_GET['std'];
    $g =$_GET['trb'];
    $h=$_GET['vip'];
    $param = array($a,$b,$c,$d,$e,$f,$g,$h,$id);


$param = array($n, $v, $ab,$id);
		$req =$pdo->prepare("UPDATE `matches` SET `equipelocal` = ?, `equipeAdversaire` = ?, `dateRencontre` = ?, `heureDepart` = ?, `idstade` = ?, `prixStandard` = ?, `prixTribune` = ?, `prixVip` = ? WHERE `matches`.`id_match` = ?");
		$req->bind_param('iissiiiii',$a,$b,$c,$d,$e,$f,$g,$h,$id);
		$req->execute();
		$req->close();
		
	
		header("location:../pages/matches.php");
		$pdo->close();
		
}
