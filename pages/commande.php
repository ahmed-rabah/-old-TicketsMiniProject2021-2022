<?php 
session_start();
$_SESSION['page'] ='commandes' ; 
if(!isset($_SESSION['admin'])){
    if(!isset($_SESSION['admin'])){
        echo "<h1>you're not connected in admin space</h1>";
        echo "<h3>try to connect right again .</h3>";
        header('REFRESH:3;URL=../pages/login.php');}
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
    .hide {
      visibility : hidden; 
    }
    .floating{
        margin:0 ; 
    }
  }
    </style>
    <title>Les ventes</title>
</head>
<body>
   <?php include("./menuAdmin.php") ?>
    <div class=" floating">
    <div  style="position: fixed;top: 8px;right:15px; border-radius:14px ; display : flex  ; align-items : center ; judtify-content : center;"><h5 style=" padding-top:4px;margin-right:5px;"><?php echo $_SESSION['admin']; ?></h5><a href="../functions/logout.php" class="btn btn-dark ">se deconnecter</a></div>
       <div class="container">
            <div class="card mt-5 ">
                <div class="card-header bg-white p-3">
                    <h1>Les ventes  :</h1>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <th>id commande</th>
                            <th colspan="2">nomClient</th>
                            <th>CIN</th>
                            <th>mailAdresse</th>
                            <th>idmatch</th>
                        <th>type de place</th>
                        <th>prix</th>
                        </thead>
                        <tbody>
                            <?php require_once("./db.php");
                            $result = $pdo->query("select * from commande");
                            if($result->num_rows >0):
                                while($row= $result->fetch_assoc()):
                            ?>
                            <tr>
                                <td><?php echo $row['idCommande']; ?></td>
                                <td colspan="2"><?php echo $row['prenomClient'].' '.$row['nomClient']; ?></td>
                                <td><?php echo $row['CIN']; ?></td>
                                <td><?php  echo $row['mailAdresse'];  ?></td>
                                <td><?php echo $row['idMatch']; ?></td>
                                <td><?php echo $row['typePlace']; ?></td>
                                <td><?php echo $row['prixTotal']; ?></td>
                                <?php
                                endwhile;
                            endif;
                                $result->close();
                                $pdo->close();
                                ?>
                            </tr>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } ?> 
</body>
</html>