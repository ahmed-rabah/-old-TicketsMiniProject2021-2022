<?php 
session_start();
$_SESSION['page'] ='matches' ; 
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
    <title>les matches</title>
</head>
<body>
   <?php include("./menuAdmin.php") ?>
    <div class=" floating">
    <div  style="position: fixed;top: 8px;right:15px; border-radius:14px ; display : flex  ; align-items : center ; judtify-content : center;"><h5 style=" padding-top:4px;margin-right:5px;"><?php echo $_SESSION['admin']; ?></h5><a href="../functions/logout.php" class="btn btn-dark ">se deconnecter</a></div>
       <div class="container">
            <div class="card mt-5 ">
                <div class="card-header bg-white p-3">
                <h1 <?php if(!isset($_GET['edit'])) {echo "hidden";} ?>>modifier un match</h1>
 
                    <h1 <?php if(isset($_GET['edit'])) {echo "hidden";} ?>>Les matches :</h1>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal" <?php if(isset($_GET['edit'])) {echo "hidden";} ?>>
    ajouter
  </button>
                </div>
                <div class="card-body">
                <?php
require_once("./db.php");
if(isset($_GET['edit'])){
    
	$d =$_GET['edit'];
	$quer=$pdo->query("select *  from matches where id_match=$d");
	
	while($row=$quer->fetch_assoc()){
?>
	
		
      <div class="container w-50">
       
		   <form action="../functions/editmatch.php" method="POST">
                <input type="number" name="id" id="id"value="<?php echo $d; ?>" hidden>    
           <div class="form-group">
                    <label for="local" class="form-text">equipe locale</label>
                    <select name="local" id="local"  class="form-control">
                        <?php 
                            $resultat= $pdo->query("select * from equipe");
                            if($resultat->num_rows >0){
                                while($rows = $resultat->fetch_assoc()){
                        ?>
                        <option value="<?php echo $rows['idEquipe']; ?>"<?php if($rows['idEquipe']==$row['equipelocal']){ echo "selected";} ?>> <?php echo $rows['nomEquipe']; ?> 
                    <?php 
                                }
                            }
                            $resultat->close();
                            
                    
                    ?></option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="adver" class="form-text">equipe adversaire</label>
                    <select name="adver" id="adver" class="form-control">
                        <?php 
                            $n= $_GET['local'];
                            $resultat= $pdo->query("select * from equipe");
                            if($resultat->num_rows >0){
                                while($rows = $resultat->fetch_assoc()){
                        ?>
                        <option value="<?php echo $rows['idEquipe']; ?>"<?php if($rows['idEquipe']== $row['equipeAdversaire']){echo "selected"; } ?>> <?php echo $rows['nomEquipe']; ?> 
                    <?php 
                                }
                            }
                            $resultat->close();
                            
                    
                    ?></option>
                    </select>
                </div>
                <div class="form-group w-50" style="float:left;">
                    <label for="dateG" class="form-text">date de rencontre</label>
                    <input type="date" name="dateG" id="dateG" class="form-control"value="<?php echo $row['dateRencontre']; ?>">
                </div>
                <div class="form-group w-50" style="float:left;">
                    <label for="hourG" class="form-text">heure de rencontre</label>
                    <input type="time" name="hourG" id="hourG" class="form-control"value="<?php echo $row['heureDepart']; ?>">
                </div>
                <div class="form-group">
                    <label for="stade" class="form-text">stade</label>
                    <select name="stade" id="stade"  class="form-control" value="<?php echo $row['idTerrain']; ?>">
                        <?php 
                            $resultat= $pdo->query("select idTerrain, nomTerrain from terrain");
                            if($resultat->num_rows >0){
                                while($rows = $resultat->fetch_assoc()){
                        ?>
                        <option value="<?php echo $rows['idTerrain']; ?>" <?php if($rows['idTerrain']== $row['idstade']){echo "selected"; } ?>  > <?php echo $rows['nomTerrain']; ?> 
                    <?php 
                                }
                            }
                            $resultat->close();
                            $pdo->close();
                    
                    ?></option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="std" class="form-text">prix de ticket standard</label>
                    <input type="number" name="std" id="std" class="form-control" placeholder="30" value="<?php echo $row['prixStandard']; ?>">
                </div>
                <div class="form-group">
                    <label for="trb" class="form-text">prix de ricket Tribune</label>
                    <input type="number" name="trb" id="trb" class="form-control"placeholder="100"value="<?php echo $row['prixTribune']; ?>">
                </div>
                <div class="form-group">
                    <label for="vip" class="form-text">prix de ticket VIP</label>
                    <input type="vip" name="vip" id="vip" class="form-control" placeholder="400"value="<?php echo $row['prixVip']; ?>">
                </div>
		  
	
			  
			
          <button type="submit" class="btn btn-primary">modifier</button>
       
      </form>

                        </div>
<?php	
	}
    
    

}
?>                  <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                                <th>id match</th>
                                <th>equipe local</th>
                                <th>equipe visiteur</th>
                                <th>date de rencontre</th>
                                <th>heure depart</th>
                                <th>id stade</th>
                                <th>prixStandard</th>
                                <th>prix Tribune</th>
                                <th>prix vip</th>
                                <th>Actions</th>
                        </thead>
                        <tbody>
                        <?php 
                            require("./db.php");
                            $result = $pdo->query("select * from matches");

                            if($result->num_rows >0){
                                while($row = $result->fetch_assoc()){
                            ?>
                            <tr>
                                <td><?php echo $row['id_match']; ?></td>
                                <td><?php echo $row['equipelocal']; ?></td>
                                <td><?php echo $row['equipeAdversaire']; ?></td>
                                <td><?php echo $row['dateRencontre']; ?></td>
                                <td><?php echo $row['heureDepart']; ?></td>
                                <td><?php echo $row['idstade']; ?></td>
                                <td><?php echo $row['prixStandard']; ?></td>
                            <td><?php echo $row['prixTribune']; ?></td>
                            <td><?php echo $row['prixVip']; ?></td>
                            <td>
                                <div class="d-flex">
                            <button class="btn btn-primary "><a class="text-white text-decoration-none"  href="./matches.php?edit=<?php echo $row['id_match']; ?>">modifier</a></button>
                               <button class="btn btn-danger"><a class="text-white text-decoration-none"  href="../functions/addmatch.php?delete=<?php echo $row['id_match']; ?>">delete</a></button>
                               </div>
                            </td>
                                <?php  
                                 }
                            } 
                                $result->close();
                            
                                
                            
                                ?>    
                            </tr>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--add modal-->
    <div class="modal" id="addModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">plannifier un match</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
       <form action="../functions/addmatch.php" method="GET">
           <!--                 <th>id match</th>
                                <th>equipe local</th>
                                <th>equipe visiteur</th>
                                <th>date de rencontre</th>
                                <th>heure depart</th>
                                <th>id stade</th>
                                <th>prixStandard</th>
                                <th>prix Tribune</th>
                                <th>prix vip</th>-->
               
               <?php include('../functions/plus.php'); ?>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
          <button type="submit" class="btn btn-primary">ajouter</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>
<?php } ?> 
</body>
</html>