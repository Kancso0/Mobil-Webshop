<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

  <!-- Navbar brand -->
  <a class="navbar-brand " href="index.php">
  <img src="assets/ikon.png" height="50">
  </a>

  <!-- Collapse button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav"
    aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Collapsible content -->
  <div class="collapse navbar-collapse" id="navbar">

    <!-- Links -->
    <ul class="nav navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="index.php">Home     
        </a>
      </li>

        <?php 

          if(Logged_In())
            {

        ?>
            <li class="nav-item">
              <a class="nav-link" href="dashboard.php">Dashboard</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="phones.php">Phones</a>
            </li>
            
            <li class="nav-item">
              <a class="nav-link"  href="logout.php">Logout</a>
            </li>

        <?php 

            }
          else 
            {
        ?>
            <li class="nav-item">
              <a class="nav-link" href="register.php">Register</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="login.php">Login</a>
            </li>

        <?php
            }
        ?>


</nav>