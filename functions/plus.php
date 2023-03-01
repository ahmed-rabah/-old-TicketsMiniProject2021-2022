<div class="form-group">
                    <label for="local" class="form-text">equipe locale</label>
                    <select name="local" id="local"  class="form-control">
                        <?php 
                            $resultat= $pdo->query("select * from equipe");
                            if($resultat->num_rows >0){
                                while($rows = $resultat->fetch_assoc()){
                        ?>
                        <option value="<?php echo $rows['idEquipe']; ?>"> <?php echo $rows['nomEquipe']; ?> 
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
                        <option value="<?php echo $rows['idEquipe']; ?>"<?php if($rows['idEquipe']==2){echo "selected"; } ?>> <?php echo $rows['nomEquipe']; ?> 
                    <?php 
                                }
                            }
                            $resultat->close();
                            
                    
                    ?></option>
                    </select>
                </div>
                <div class="form-group w-50" style="float:left;">
                    <label for="dateG" class="form-text">date de rencontre</label>
                    <input type="date" name="dateG" id="dateG" class="form-control">
                </div>
                <div class="form-group w-50" style="float:left;">
                    <label for="hourG" class="form-text">heure de rencontre</label>
                    <input type="time" name="hourG" id="hourG" class="form-control">
                </div>
                <div class="form-group">
                    <label for="stade" class="form-text">stade</label>
                    <select name="stade" id="stade"  class="form-control">
                        <?php 
                            $resultat= $pdo->query("select idTerrain, nomTerrain from terrain");
                            if($resultat->num_rows >0){
                                while($rows = $resultat->fetch_assoc()){
                        ?>
                        <option value="<?php echo $rows['idTerrain']; ?>"> <?php echo $rows['nomTerrain']; ?> 
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
                    <input type="number" name="std" id="std" class="form-control" placeholder="30">
                </div>
                <div class="form-group">
                    <label for="trb" class="form-text">prix de ricket Tribune</label>
                    <input type="number" name="trb" id="trb" class="form-control"placeholder="100">
                </div>
                <div class="form-group">
                    <label for="vip" class="form-text">prix de ticket VIP</label>
                    <input type="vip" name="vip" id="vip" class="form-control" placeholder="400">
                </div>