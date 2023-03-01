<div class="bg-dark menuad hide">
      <nav class="navbar w-25 bg-dark navbar-dark">
        <div class="container-fluid ">
          <ul class="navbar-nav p-3">
          <li class="nav-item pb-3">
              <a class="nav-link anchor  <?php if(isset($_SESSION['page']) and $_SESSION['page']=="dashboard") {echo 'active';}  ?>" href="./Dashboard.php">Dashboard</a>
            </li>
            <li class="nav-item pb-3">
              <a class="nav-link anchor <?php if(isset($_SESSION['page']) and $_SESSION['page']=="matches") {echo 'active';}  ?> " href="./matches.php">Matches</a>
            </li>
            <li class="nav-item pb-3">
              <a class="nav-link  anchor <?php if(isset($_SESSION['page']) and $_SESSION['page']=="terrain") {echo 'active';}  ?> " href="./stade.php">Terrains</a>
            </li>
            <li class="nav-item pb-3">
              <a class="nav-link anchor <?php if(isset($_SESSION['page']) and $_SESSION['page']=="equipe") {echo 'active';}  ?>" href="./equipe.php">Equipes</a>
            </li>
            <li class="nav-item pb-3">
              <a class="nav-link anchor <?php if(isset($_SESSION['page']) and $_SESSION['page']=="commandes") {echo 'active';}  ?> " href="./commande.php">commandes</a>
            </li>
          </ul>
        </div>
      </nav>
</div>      