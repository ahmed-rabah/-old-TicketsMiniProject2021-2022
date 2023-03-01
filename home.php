<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./sheet.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <script src="./js/bootstrap.min.js"></script>
    <style>
         .d-ahmed{
             display:flex ; 
             justify-content:space-around;
         }
        @media only screen and (max-width: 900px) {
    .d-ahmed {
            display:block;
    }
   
  }
    
        .x{ position : relative ; 
            background-color : aqua ; 
        }
        .x:hover{
            background-color : rgb(5, 97, 228) ; 
            animation-name :example ; 
            animation-duration : 3s ; 
        }

        @keyframes example {
  0%   {background-color:darkblue; left:0px; top:0px;}
  25%  {background-color:blue; left:40px; top:0px;}
  50%{background-color:beige; left:0px; top:0px;}
  100% {background-color:aqua; left:0px; top:0px;}
}
    </style>
    <title>accueil</title>
</head>
<body>
    
<?php    include('./functions/fonction.php');
     if(isset($_GET['buy']) && isset($_GET['type'])){
     
        require_once('./pages/db.php');
        $e=$_GET['buy'];
        $f=$_GET['type'];
    $result=$pdo->query("select capaciteTribune , capaciteVip , capaciteStandard from terrain , matches where idTerrain=idstade and id_match=$e");
    if($result->num_rows >0):
       $hid="";
        while($row= $result->fetch_assoc()):
		switch($f){
            case "Standard" : if($row['capaciteStandard']<=counting($e,$f)){
                    echo "vous ne pouvez pas vendre une ticket Standard , tous les tickets standard sont vendu" ;
                    $hid="visibility:hidden;";
                  //  header('REFRESH:2;URL=../home.php?buy='.$e);
            }                                
            break;
            case "Tribune" :  if($row['capaciteTribune']<=counting($e,$f)){
                echo "vous ne pouvez pas vendre une ticket tribune , tous les tickets tribune sont vendu" ;
                $hid="visibility:hidden;";
               // header('REFRESH:2;URL=../home.php?buy='.$e);
        } 
            break;
            case "Vip" :  if($row['capaciteVip']<=counting($e,$f)){
                echo "vous ne pouvez pas vendre une ticket Vip , tous les tickets vip sont vendu" ;
                $hid="visibility:hidden;";
        }      // header('REFRESH:2;URL=../home.php?buy='.$e);
            break;
        }
        endwhile ;
        endif ;
        $result->close();
       

        ?><div class="container w-50 mt-5" style=" position: absolute;   top:0; bottom: 0; left: 0; right: 0;margin: auto; <?php echo $hid ?>">
        <form action="./functions/addcommande.php" method="post">
            <div class="form-group">
                <label for="prenom" class="h4">prenom</label>
                <input type="text" name="prenom" id="prenom" class="form-control" placeholder="adil" required>
            </div>
            <div class="form-group">
                <label for="nom" class="h4">nom</label>
                <input type="text" name="nom" id="nom" class="form-control" placeholder="Ghazi" required>
            </div>
            <div class="form-group">
                <label for="CNI" class="h4">CNI</label>
                <input type="text" name="CNI" id="CNI" class="form-control" placeholder="AE268502" required>
            </div>
            <div class="form-group">
                <label for="mail" class="h4">adresse email</label>
                <input type="email" name="mail" id="mail" class="form-control" placeholder="ahmed_adil@gmail.com" required>
            </div>
            <div class="form-group">
                <label for="match" class="h4">numero de match</label>
                <input type="number" name="match" id="match" class="form-control" value="<?php echo $_GET['buy']; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="typee" class="h4">type de place</label>
                <input type="text" name="typee" id="typee" class="form-control" value="<?php echo $_GET['type']; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="prix" class="h4">prix</label>
                <input type="number" name="prix" id="prix" class="form-control" <?php 
                require_once('./pages/db.php');
                $req =$pdo->query("select prixStandard , prixTribune , prixVip from matches where id_match=".$_GET['buy']."");
                while($row = $req->fetch_assoc()){
                switch($_GET['type']){
                    case "Standard" : 
                        echo "value=\"".$row['prixStandard']."\"";
                    break;
                    case "Tribune" : 
                        echo "value=\"".$row['prixTribune']."\"";
                    break;
                    case "Vip" :
                         echo "value=\"".$row['prixVip']."\"";
                    break;
                    default :
                     echo "value=\"100\"";
                }} $req->close();
                    $pdo->close();
                ?> readonly>
            </div>
            <input type="submit" value="acheter" class="form-control bg-primary mt-3" style="font-size:23px;">
        </form>
        </div>
        <?php
     }
    elseif(isset($_GET['buy']) && !isset($_GET['type'])) {

         require_once('./pages/db.php') ;
        $req= $pdo->query("select prixStandard , prixTribune , prixVip ,capaciteStandard , capaciteTribune , capaciteVip from matches , terrain where  id_match=".$_GET['buy']." and idStade=idTerrain");
        while($row = $req->fetch_assoc()){
        ?> 
        <div class="container" style="margin:250px 100px;">
        <h1 class="text-center" style="padding-right:5%">choose the ticket's type</h1>
                   <div class="row" style="display: flex ;justify-content: center ;  align-items: center; ">
            <div class="col-xl-4 mb-2"><button class="btn btn-dark" style="border-radius:20px; width:300px;height:100px;font-size:20px;"><a class="text-white text-decoration-none"  href="./home.php?buy=<?php echo $_GET['buy'];?>&type=Standard">place Standard : <?php echo $row['prixStandard'];?> DH</a></button><h6 class="text-center" style="width: 300px;">place restant : <?php echo $row['capaciteStandard']-counting($_GET['buy'],"Standard"); ?> restant(s)</h6></div>
            <div class="col-xl-4 mb-2"><button class="btn btn-dark" style="border-radius:20px;width:300px;height:100px;font-size:20px;"><a class="text-white text-decoration-none"  href="./home.php?buy=<?php echo $_GET['buy'];?>&type=Tribune">place Tribune : <?php echo $row['prixTribune'];?> DH</a></button><h6 class="text-center" style="width: 300px;">place restant : <?php echo $row['capaciteTribune']-counting($_GET['buy'],"Tribune"); ?> restant(s)</h6></div>
            <div class="col-xl-4 mb-2"><button class="btn btn-dark" style="border-radius:20px;width:300px;height:100px;font-size:20px;"><a class="text-white text-decoration-none"  href="./home.php?buy=<?php echo $_GET['buy'];?>&type=Vip">place vip : <?php echo $row['prixVip'];?> DH</a></button><h6 class="text-center" style="width: 300px;">place restant : <?php echo $row['capaciteVip']-counting($_GET['buy'],"Vip"); ?> restant(s)</h6></div>
            </div>
        </div>
        <?php } $req->close(); 
                $pdo->close(); ?>
        <?php
    }else{
include('./menu.php'); ?>
<div style="display:flex;justify-content:end;align-items:end;margin:8px 8px 0 0;">
    <button type="button" class="btn btn-primary m-0" data-bs-toggle="collapse" data-bs-target="#demo">rechercher</button></div>
<div class="container" style="margin-top:5px ;">

    <?php  require_once('./pages/db.php') ;
    ?>
     <div class="card m-2 collapse show" id="demo" style="border-radius:8px;">
    <div class="card-header bg-primary"><strong>recherche des matches</strong></div>
    <div class="card-body"> <form action="./home.php" method="get" class="d-ahmed">
        <div>
        <label for="ladate" style="width:120px;">date :</label>
        <input type="date" name="ladate" id="" onchange="this.form.submit()"<?php $da=isset($_GET['ladate'])?$_GET['ladate']:"";
        if($da!=""){ echo "value=\"$da\"";} ?>></div>
        <div>
        <label for="lequipe">nom de l'équipe :</label>
        <?php $quer=$pdo->query("select * from equipe");
            if($quer->num_rows >0){ $eq=isset($_GET['lequipe'])?$_GET['lequipe']:"0";
                ?>  <select name="lequipe" id="" onchange="this.form.submit()">
                    
                  <?php
                  if($eq==0){
                    ?>
                    <option value="0" selected>no option is selected</option> <?php } 
                while($row = $quer->fetch_assoc()){  ?>
                    <option value="<?php echo $row['idEquipe']; ?>"<?php if($eq==$row['idEquipe']){echo "selected";} ?>><?php echo $row['nomEquipe']; ?></option>
                
                
           <?php } ?> </select> <?php }  $quer->close();?>
        
           </div>
           <div>
        <button type="submit" class="btn btn-primary">rechercher</button></div><div>
        <a class="btn btn-secondary" href="./home.php"> réinitialiser</a></div>
    </form></div> 
   
  </div>    
    <?php
    $da=isset($_GET['ladate'])?$_GET['ladate']:"";
    $eq=isset($_GET['lequipe'])?$_GET['lequipe']:"0";
    if($da!="" and $eq==0 ){
        $req=  $pdo->query("select * from matches where dateRencontre =\"".$_GET['ladate']."\"  order  by dateRencontre");
      
      
    }elseif($da!="" and $eq!=0){
        $req=  $pdo->query("select * from matches where dateRencontre =\"".$_GET['ladate']."\" and ( equipelocal=\"".$_GET['lequipe']."\" or equipeAdversaire=\"".$_GET['lequipe']."\")  order  by dateRencontre");
    }elseif($da=="" and $eq!=0 ){
        $req=  $pdo->query("select * from matches where dateRencontre > sysdate() and (equipelocal=\"".$_GET['lequipe']."\" or equipeAdversaire=\"".$_GET['lequipe']."\") order  by dateRencontre");
        
    }
    else{
    $req=  $pdo->query("select * from matches where dateRencontre > sysdate() order  by dateRencontre");}
    if($req->num_rows >0){
        while($row = $req->fetch_assoc()){
    ?>
    <div class="row  p-3 m-5 x" style="border-radius:60px 8px;box-shadow: 20px 14px 15px rgb(4, 165, 255), -9px 3px 14px blue;">
        <div class="col-3"><?php  
        $date = date_create($row['dateRencontre']);
       ?><h6  style=" display: flex ;justify-content: center ;  align-items: center; "><?php echo date_format($date,"d-M-Y"); ?></h6><?php echo "<h6  style=\" display: flex ;justify-content: center ;  align-items: center; \">".$row['heureDepart']."</h6>"; 
       $quer=$pdo->query("select nomTerrain from terrain where idTerrain =".$row['idstade']."");
            while($rows = $quer->fetch_assoc()) {
                echo "<h6  style=\" display: flex ;justify-content: center ;  align-items: center; \">".$rows['nomTerrain']."</h6>";
            }
            $quer->close();
       ?></div><div class="col-6" style=" display: flex ;justify-content: center ;  align-items: center; "><?php
      
          $quer=$pdo->query("select abrev from equipe where idEquipe =".$row['equipelocal']."");
            while($rows = $quer->fetch_assoc()) {
                echo "<h4 style=\"float:left\">".$rows['abrev']."</h4>";
            }
             $quer->close();
             echo "<h4 style=\"float:left;padding:0 25px;\">VS</h4>";
            $quer=$pdo->query("select abrev from equipe where idEquipe =".$row['equipeAdversaire']."");
            while($rows = $quer->fetch_assoc()) {
                echo "<h4>".$rows['abrev']."</h4>";
            }
            $quer->close();
         ?></div>
        <div class="col-3" style=" display: flex ;justify-content: center ;  align-items: center; "><button class="btn btn-dark" style="border-radius:20px;"><a class="text-white text-decoration-none"  href="./home.php?buy=<?php echo $row['id_match']; ?>">acheter une ticket</a></button></div>    
    </div>
<?php }} else { 
    echo "<h2>aucun information trouvé</h2>"; 
    header("REFRESH:1;URL=./home.php");
} $req->close();
        $pdo->close(); 
        
        ?>
</div><?php } ?>
</body>
</html>