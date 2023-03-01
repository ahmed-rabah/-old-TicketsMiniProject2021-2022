<?php
session_start();
require_once('../pages/db.php');
$req="select userName , pwd from admins";

$res=mysqli_query($pdo,$req);

if($_SERVER['REQUEST_METHOD'] =='POST'){
        if(isset($_POST['user_name']) && isset($_POST['pwd'])){
        $n=$_POST['user_name'];
        $p=$_POST['pwd'];
                while($row=$res->fetch_assoc()){
                    if($n==$row['userName'] && $p==$row['pwd']){
                        $_SESSION['admin']=$n;
                        
                        header('location:../pages/dashboard.php');
                    break;
                }
        }
        if(!isset($_SESSION['admin'])){
            
            echo "<h1>you're login name or password is wrong</h1>";
            header('REFRESH:3;URL=../pages/login.php');
        }
        if(isset($_SESSION['admin'])){
            ?><link rel="stylesheet" href="../css/bootstrap.min.css">
            <script src="../js/bootstrap.min.js"></script>
            <div class="spinner-border" style="float:left;"></div><?php
            echo "<h1>you're login name or password is wrong</h1>";
            header('REFRESH:3;URL=../pages/login.php');
        }
    }
}else{
    echo "go away";
}


?>