<?php

require_once("../pages/db.php");
if(isset($_GET['local']) and isset($_GET['adver'])  ){
$a =$_GET['local'];
$b =$_GET['adver'];
$c =$_GET['dateG'];
$d =$_GET['hourG'];
$e =$_GET['stade'];
$f =$_GET['std'];
$g =$_GET['trb'];
$h=$_GET['vip'];
$param = array($a,$b,$c,$d,$e,$f,$g,$h);
		$req = $pdo->prepare("INSERT INTO matches(equipelocal,	equipeAdversaire,dateRencontre,heureDepart,idstade,prixStandard,prixTribune,prixVip) VALUES(?,?,?,?,?,?,?,?)");
		$req->bind_param('iissiiii',$a,$b,$c,$d,$e,$f,$g,$h);
		$req->execute();
		echo "envoye avec succes...";
		$req->close();
		$pdo->close();
		header("location:../pages/matches.php");
}
		require_once("../pages/db.php");   
   
if(isset($_GET['delete'])){
    
	$e =$_GET['delete'];
	$quer=("delete from matches where id_match=$e");
  
    $result= mysqli_query($pdo,$quer);
    if($result){
	    
	header("location:../pages/matches.php");
		$pdo->close();}

}

?>