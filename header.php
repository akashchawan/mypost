
<div class="collapse bg-dark" id="navbarHeader">
        <div class="container">
          <div class="row">
            <div class="col-sm-8 col-md-7 py-4">
              <h4 class="text-white">About</h4>
              <p class="text-muted">

              	In This website you can add you photos and let share with world
          	
          		</p>

            </div>
            <?php
            if(show()):
            ?>
            <div class="col-sm-4 offset-md-1 py-4">
              <h4 class="text-white"><?php echo "Hello ".$_SESSION['username']; ?>
              	
              	              <a class="btn btn-success" href="logout.php" style="float:right;color:white;">Logout</a>

              </h4>
            </div>
        	<?php endif; ?>


            <?php
            if(!show()):
            ?>
            <div class="col-sm-4 offset-md-1 py-4">
              <a class="btn btn-success" href="login.php" style="float:right;color:white;">Login</a>
            </div>
            <?php
            endif;
            ?>

          </div>
        </div>
      </div>
      <div class="navbar navbar-dark bg-dark box-shadow">
        <div class="container d-flex justify-content-between">
          <a href="#" class="navbar-brand d-flex align-items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg>
            <strong><a href="home.php" style="color:white;text-decoration: none;">𝑀𝓎 𝒫𝑜𝓈𝓉</a></strong>
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>
      </div>
