<?php
    
function counting($idm,$ty){ $x = 0;
    $pdo = new mysqli("localhost","root","","ticket");
    
    $rech=$pdo->query("select count(idCommande) as c from commande where idMatch=$idm and typePlace='$ty'");
    if($rech !== false && $rech->num_rows >0) :
        while($row=$rech->fetch_assoc()) :
                       $x = $row['c'];
        endwhile;
          $rech->close();
   
    $pdo->close();
       endif;
       return $x ; 
  
}




?>