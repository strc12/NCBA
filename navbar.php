<?php
if(session_status() !== PHP_SESSION_ACTIVE) {
  session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Navigation Menu</title>
  <style>
    .navbar-nav.ms-auto {
      margin-left: auto; /* Pushes the right-aligned menu items to the right */
    }
    .navbar-nav .nav-item {
      margin-left: 15px; /* Adds space between the menu items */
    }
  </style>
</head>
<body style="height:1500px">

<nav class="navbar navbar-expand-sm bg-light navbar-light fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">
      <img src="images/NCB.jpg" alt="" width="50" class="d-inline-block align-text-middle">
      NSCBA
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="tables.php">View Tables</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="result.php">View Results</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown1" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            League Info
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown1">
            <li><a class="dropdown-item" href="clubs.php">Clubs</a></li>
            <li><a class="dropdown-item" href="league.php">League</a></li>
            <li><a class="dropdown-item" href="junior.php">Juniors</a></li>
            <li><a class="dropdown-item" href="senior.php">Seniors</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="committee.php">The Committee</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="gallery.php">Photo Gallery</a>
        </li>
      </ul>
      <ul class="navbar-nav ms-auto">
        <?php
        include_once("setseason.php");
      
        if (isset ($_SESSION['adloggedin'])){
          echo('<li class="nav-item">
          <a class="nav-link text-danger fw-bold">Hi '.$_SESSION['clubid'].'</a>
          </li> <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            League Admin
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown2">
            <li><a class="dropdown-item" href="Leagueadmin.php">League Admin</a></li>
            <li><a class="dropdown-item" href="admin.php">Admin only</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php">Logout</a>
        </li>');
        } 
        else if(isset($_SESSION['clubname'])){
          echo('<li class="nav-item">
          <a class="nav-link text-danger fw-bold">Hi '.$_SESSION['clubname'].'</a>
          </li> 
          <li class="nav-item">
            <a class="nav-link" href="changepassword.php">Change Password</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown3" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Club Admin
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown3">
              <li><a class="dropdown-item" href="selectmatch.php">Enter scores</a></li>
              <li><a class="dropdown-item" href="clubadmin.php">Club Admin</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
          </li>');
        } else {
          echo('<li class="nav-item">
          <a class="nav-link" href="login.php">Login</a>
          </li>');
        }
        ?>
      </ul>
    </div>
  </div>
</nav>
</body>
</html>
