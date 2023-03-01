<?php 
session_start();
$_SESSION['page'] ='terrain' ; 
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
    <title>les terrains</title>
</head>
<body>
   <?php include("./menuAdmin.php") ?>
    <div class=" floating">
    <div  style="position: fixed;top: 8px;right:15px; border-radius:14px ; display : flex  ; align-items : center ; judtify-content : center;"><h5 style=" padding-top:4px;margin-right:5px;"><?php echo $_SESSION['admin']; ?></h5><a href="../functions/logout.php" class="btn btn-dark ">se deconnecter</a></div>
       <div class="container">
            <div class="card mt-5 ">
                <div class="card-header bg-white p-3">
                <h1 <?php if(!isset($_GET['edit'])) {echo "hidden";} ?>>modifier un terrain</h1>
 
                    <h1 <?php if(isset($_GET['edit'])) {echo "hidden";} ?>>Les terrains :</h1>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal" <?php if(isset($_GET['edit'])) {echo "hidden";} ?>>
    ajouter
  </button>
                </div>
                <div class="card-body">
                <?php
require_once("./db.php");
if(isset($_GET['edit'])){
    
	$d =$_GET['edit'];
	$quer=$pdo->query("select *  from terrain where idTerrain=$d");
	
	while($row=$quer->fetch_assoc()){
?>
	
		
      
       
		   <form action="../functions/editstade.php" method="POST">
                    <div class="form-group">
						<!--<label for="id" class="form-text">id de  l'équipe</label>-->
						<input type="number" name="id" id="id" class="form-control" value="<?php echo $d; ?>" hidden>
					</div>
               
                    <div class="form-group">
						<label for="nom" class="form-text text-dark">nom de terrain</label>
						<input type="text" name="nom" id="nom" class="form-control"  value="<?php echo $row['nomTerrain']; ?>" required>
					</div>
					<div class="form-group">
						<label for="adr" class="form-text text-dark">adresse</label>
						<input type="text" name="adr" id="adr" class="form-control" placeholder="rabat avenu mokawama" value="<?php echo $row['adresse']; ?>">
					</div>
					<div class="form-group">
						<label for="std" class="form-text text-dark">capacite <strong>Standard</strong></label>
						<input type="number" name="std" id="std" class="form-control"  value="<?php echo $row['capaciteStandard']; ?>" min="2500">
					</div>
                    <div class="form-group">
                        <label for="trb" class="form-text text-dark">capacite <strong>tribune</strong></label>
                        <input type="number" name="trb" id="trb" class="form-control" value="<?php echo $row['capaciteTribune']; ?>" min="800">
                    </div>
                    <div class="form-group">
                        <label for="vip" class="form-text text-dark">capacite <strong>VIP</strong></label>
                        <input type="number" name="vip" id="vip" class="form-control" value="<?php echo $row['capaciteVIP']; ?>" min="100">
                    </div>
        
	
			  
			
          <button type="submit" class="btn btn-primary">modifier</button>
       
      </form>


<?php	
	}
    
	
		$pdo->close();

}
?>                      <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                             <th>id terrain</th>
                             <th>nom du terrain</th>
                             <th>localisation</th>
                             <th>capacité standard</th>
                             <th>capacité tribune</th>
                             <th>capacité VIP</th>
                             <th>actions</th>
                        </thead>
                        <tbody>
                            <?php 
                            require('./db.php');
                            $result=$pdo->query("select * from terrain");
                            if($result->num_rows >0):
                                while($row=$result->fetch_assoc()):
                            ?>
                            <tr>
                            <td><?php echo $row['idTerrain']; ?></td>
                            <td><?php echo $row['nomTerrain']; ?></td>
                            <td><?php echo $row['adresse']; ?></td>
                            <td><?php echo $row['capaciteStandard']; ?></td>
                            <td><?php echo $row['capaciteTribune']; ?></td>
                            <td><?php echo $row['capaciteVIP']; ?></td>
                            <td><div class="d-flex">
                               <button class="btn btn-primary "><a class="text-white text-decoration-none"  href="./stade.php?edit=<?php echo $row['idTerrain']; ?>">modifier</a></button>
                               <button class="btn btn-danger"><a class="text-white text-decoration-none"  href="../functions/addstade.php?delete=<?php echo $row['idTerrain']; ?>">delete</a></button>
                               </div>
                            </td>
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

        <!--add modal-->
        <div class="modal" id="addModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">ajouter une équipe</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
       <form action="../functions/addstade.php" method="POST">
           <!--<th>id terrain</th>
                             <th>nom du terrain</th>
                             <th>localisation</th>
                             <th>capacité standard</th>
                             <th>capacité tribune</th>
                             <th>capacité VIP</th>-->
                <div class="form-group">
                    <label for="nom" class="form-text">nom du terrain</label>
                    <input type="text" name="nom" id="nom" class="form-control" placeholder="stade moulay abdellah" required>
                </div>
                <div class="form-group">
                    <label for="adr" class="form-text">adresse</label>
                    <input type="text" name="adr" id="adr" class="form-control" placeholder="rabat route national temara 11040" required>
                </div>
                <div class="form-group">
                    <label for="std" class="form-text">capacité des places standards</label>
                    <input type="number" name="std" id="std" class="form-control" value="5000" min="2500">
                </div>
                <div class="form-group">
                    <label for="trb" class="form-text">capacité des places Tribunes</label>
                    <input type="number" name="trb" id="trb" class="form-control" value="2500" min="800">
                </div>
                <div class="form-group">
                    <label for="vip" class="form-text">capacité des places VIP</label>
                    <input type="number" name="vip" id="vip" class="form-control" value="500" min="100">
                </div>
    
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