<?php 

session_start();
$_SESSION['page'] ='dashboard' ; 
if(!isset($_SESSION['admin'])){
echo "<h1>you're not connected in admin space</h1>";
echo "<h3>try to connect right again .</h3>";
header('REFRESH:3;URL=../pages/login.php');
}else{ 
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../sheet.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/bootstrap.min.js"></script>
    <style>
        @media only screen and (max-width: 900px) {
    h1{
        visibility : hidden ;
    }
  }
    </style>
    <title>Dashborad</title>
</head>
<body>
   <?php include("./menuAdmin.php") ?>
<div class="floating">
<div  style="position: fixed;top: 8px;right:15px; border-radius:14px ; display : flex  ; align-items : center ; judtify-content : center;">
<h5 style=" padding-top:4px;margin-right:5px;"><?php echo $_SESSION['admin']; ?></h5>
<a href="../functions/logout.php" class="btn btn-dark ">se deconnecter</a></div>
    
    <h1>welcome <strong><?php  echo $_SESSION['admin']; ?></strong></h1>
<div class="container" style="display:flex ; justify-content: center ; align-items : center ; ">
<div class="container m-4" style="border : 1px solid black ; background-color : whitesmoke ; height:200px ;  width:500px;"><h3 class="text-center" style="font-family:monospace ; ">nombre de ticket(s) vendu(s)</h3>
<div>
    <?php require_once('./db.php');  $req=$pdo->query("select count(idCommande) as c from commande "); 
    if($req !== false && $req->num_rows >0) :
        while($row=$req->fetch_assoc()) :
                   echo "<h1 class=\"text-center\">".$row['c']."</h1>"   ;
        endwhile;
    endif;
          $req->close();
    ?>
</div>
</div>
<div class="container m-4" style="border : 1px solid black ; background-color : whitesmoke ; height:200px ;width:500px;"><h3 class="text-center" style="font-family:monospace ; ">nombre des équipes dans le championnat</h3>
<div>
    <?php require_once('./db.php');  $req=$pdo->query("select count(idEquipe) as c from equipe "); 
    if($req !== false && $req->num_rows >0) :
        while($row=$req->fetch_assoc()) :
                   echo "<h1 class=\"text-center\">".$row['c']."</h1>"   ;
        endwhile;
    endif;
          $req->close();
    ?>
</div>
</div>
</div>
<div class="container" style="display:flex ; justify-content: center ; align-items : center ; ">
<div class="container m-4" style="border : 1px solid black ; background-color : whitesmoke ; height:200px ;  width:500px;"><h3 class="text-center" style="font-family:monospace ; ">nombre de terrains disponible</h3>
<div>
    <?php require_once('./db.php');  $req=$pdo->query("select count(idTerrain) as c from terrain "); 
    if($req !== false && $req->num_rows >0) :
        while($row=$req->fetch_assoc()) :
                   echo "<h1 class=\"text-center\">".$row['c']."</h1>"   ;
        endwhile;
    endif;
          $req->close();
    ?>
</div>
</div>
<div class="container m-4" style="border : 1px solid black ; background-color : whitesmoke ; height:200px ;width:500px;"><h3 class="text-center" style="font-family:monospace ; ">nombre des matches planifiées</h3>
<div>
    <?php require_once('./db.php');  $req=$pdo->query("select count(id_match) as c from matches "); 
    if($req !== false && $req->num_rows >0) :
        while($row=$req->fetch_assoc()) :
                   echo "<h1 class=\"text-center\">".$row['c']."</h1>"   ;
        endwhile;
    endif;
          $req->close();
          $pdo->close();
    ?>
</div>
</div>
</div>
</div>
<?php } ?> 
</body>
</html>