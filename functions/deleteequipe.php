<?php
require_once("../pages/db.php");
   
if(isset($_GET['delete'])){
    
	$d =$_GET['delete'];
	$quer=("delete from equipe where idEquipe=$d");
  
    $result= mysqli_query($pdo,$quer);
    if($result){
	

	header("location:../pages/equipe.php");
		$pdo->close();}

}
?>