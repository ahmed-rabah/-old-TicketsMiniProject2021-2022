 <?php 
	try {
		$pdo = new mysqli("localhost","root","","ticket");
		
	} catch (Exception $e) {
		die('Connection failed' .$pdo->connect_error);
	}
		//echo "database connected succefuly";
		

         /*<?php
try{
$pdo = new PDO('mysql:dbname=tickets;host=localhost','root','');
}
catch (Exception $e) {
    die('Connection failed' .$pdo->connect_error);
}
   // echo "database connected succefuly";
     ?> */


