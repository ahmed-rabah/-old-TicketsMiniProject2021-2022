<?php

require_once("../pages/db.php");

if(isset($_POST['nom'])){
$n =$_POST['nom'];
$v =$_POST['ville'];
$ab =$_POST['abrev'];
$param = array($n, $v, $ab);
		$req = $pdo->prepare("INSERT INTO equipe(nomEquipe,ville,abrev) VALUES(?,?,?)");
		$req->bind_param('sss',$n,$v,$ab);
		$req->execute();
		$req->close();
		header("location:../pages/equipe.php");
		$pdo->close();
		
}
require_once("../pages/db.php");   
   
if(isset($_GET['delete'])){
    
	$d =$_GET['delete'];
	$quer=("delete from equipe where idEquipe=$d");
  
    $result= mysqli_query($pdo,$quer);
    if($result){
	
    
	

    
	header("location:../pages/equipe.php");
		$pdo->close();}

}
