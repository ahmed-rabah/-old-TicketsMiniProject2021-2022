<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../sheet.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/bootstrap.min.js"></script>
    <title>addCommande</title>
</head>
<body>
<?php
    
if($_SERVER['REQUEST_METHOD'] =='POST' and isset($_POST['mail'])){

$a =$_POST['prenom'];
$b =$_POST['nom'];
$c =$_POST['CNI'];
$d =$_POST['mail'];
$e =$_POST['match'];
$f =$_POST['typee'];
$g =$_POST['prix'];
$param= array($a,$b,$c,$d,$e,$f,$g);
require_once('../pages/db.php');

      $sql ="INSERT INTO commande(prenomClient,nomClient,CIN,mailAdresse,idMatch,typePlace,prixTotal) VALUES(?,?,?,?,?,?,?)";
        if($query = $pdo->prepare($sql)) {
            $query->bind_param('ssssisd',$a,$b,$c,$d,$e,$f,$g);
            $query->execute();
           
        } else {echo 'ok';
            $error = $pdo->errno . ' ' . $pdo->error;
            echo $error; // 1054 Unknown column 'foo' in 'field list'
        }
      
        $query->close();
        $pdo->close();
        ?>
        <div class="bg-success text-center m-5 p-5" style=" border-radius:25px;box-shadow: 11px 11px 5px rgb(105, 216, 125);"><h3>vous avez acheté le ticket avec succés</h3></div>

        <?php
        header("REFRESH:2;URL=../home.php");
}
?>
</body>
</html>