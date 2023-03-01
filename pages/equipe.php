<?php 
session_start();
$_SESSION['page'] ='equipe' ; 
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
    <title>Les équipes</title>
</head>
<body>
   <?php include("./menuAdmin.php") ?>
      <div class=" floating">
      <div  style="position: fixed;top: 8px;right:15px; border-radius:14px ; display : flex  ; align-items : center ; judtify-content : center;"><h5 style=" padding-top:4px;margin-right:5px;"><?php echo $_SESSION['admin']; ?></h5><a href="../functions/logout.php" class="btn btn-dark ">se deconnecter</a></div>
   
        <div class="container-fluid">
            <div class="card mt-5">
            <h1 <?php if(!isset($_GET['edit'])) {echo "hidden";} ?>>modifier une équipe</h1>
                <div class="card-header bg-white p-3">
                    <h1 <?php if(isset($_GET['edit'])) {echo "hidden";} ?>>Les équipes </h1>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal" <?php if(isset($_GET['edit'])) {echo "hidden";} ?>>
    ajouter
  </button>
                </div>
                <div class="card-body">
                <?php
require_once("./db.php");
if(isset($_GET['edit'])){
    
	$d =$_GET['edit'];
	$quer=$pdo->query("select *  from equipe where idEquipe=$d");
	
	while($row=$quer->fetch_assoc()){
?>
	
		
      
       
		   <form action="../functions/editequipe.php" method="POST">
                    <div class="form-group">
						<!--<label for="id" class="form-text">id de  l'équipe</label>-->
						<input type="number" name="id" id="id" class="form-control" value="<?php echo $d; ?>" hidden>
					</div>
               
                    <div class="form-group">
						<label for="nom" class="form-text">nom de l'équipe</label>
						<input type="text" name="nom" id="nom" class="form-control" placeholder="fath union sportif" value="<?php echo $row['nomEquipe']; ?>" required>
					</div>
					<div class="form-group">
						<label for="ville" class="form-text">Ville</label>
						<input type="text" name="ville" id="ville" class="form-control" placeholder="rabat" value="<?php echo $row['ville']; ?>">
					</div>
					<div class="form-group">
						<label for="abrev" class="form-text">abreviation du nom de l'équipe</label>
						<input type="text" name="abrev" id="abrev" class="form-control" placeholder="fus" max="5" value="<?php echo $row['abrev']; ?>">
					</div>
		
		  
	
			  
			
          <button type="submit" class="btn btn-primary">modifier</button>
       
      </form>


<?php	
	}
    
	
		$pdo->close();

}
?>                  <div class="table-responsive"> 
                    <table class="table table-striped ">
                        <thead>
                            
                            <th>id équipe</th>
                            <th>nom de l'équipe</th>
                            <th>ville</th>
                            <th>abreviation</th>
                            <th>actions</th>
                        </thead>
                        <tbody>

                            <?php 
                            require("./db.php");
                            
                            $result = $pdo->query("select * from equipe");

                            if($result->num_rows >0){
                                while($row = $result->fetch_assoc()){
                            ?>
                            <tr>
                                <td><?php echo $row['idEquipe']; ?></td>
                                <td><?php echo $row['nomEquipe']; ?></td>
                                <td><?php echo $row['ville']; ?></td>
                                <td><?php echo $row['abrev']; ?></td>
                               <td><div class="d-flex">
                               <button class="btn btn-primary"><a class="text-white text-decoration-none"  href="./equipe.php?edit=<?php echo $row['idEquipe']; ?>">modifier</a></button>
                               <button class="btn btn-danger"><a class="text-white text-decoration-none"  href="../functions/addequipe.php?delete=<?php echo $row['idEquipe']; ?>">delete</a></button>
                               </div>
                            </td>
                           <?php  
                                 }
                            } 
                                $result->close();
                            
                                $pdo->close();
                            
                                ?>    
                            </tr>

                        </tbody>
                    </table>
                    <div class="table-responsive"> 
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
       <form action="../functions/addequipe.php" method="POST">
                <div class="form-group">
                    <label for="nom" class="form-text">nom de l'équipe</label>
                    <input type="text" name="nom" id="nom" class="form-control" placeholder="fath union sportif" required>
                </div>
                <div class="form-group">
                    <label for="ville" class="form-text">Ville</label>
                    <input type="text" name="ville" id="ville" class="form-control" placeholder="rabat">
                </div>
                <div class="form-group">
                    <label for="abrev" class="form-text">abreviation du nom de l'équipe</label>
                    <input type="text" name="abrev" id="abrev" class="form-control" placeholder="fus" max="5">
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