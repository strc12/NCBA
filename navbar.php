<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body style="height:1500px">

<nav class="navbar navbar-expand-sm bg-light navbar-light fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">
      <img src="images/NCB.jpg" alt="" width="50"  class="d-inline-block align-text-middle">
      NSCBA
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="clubs.php">Clubs</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="league.php">League</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="junior.php">Juniors</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="senior.php">Seniors</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="selectmatch.php">Enter scores</a>
        </li>
        <!-- <li class="nav-item">
          <a class="nav-link" href="trials.php">Trials</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="restricted.php">Tournaments</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="events.php">Events</a>
        </li> -->
        <li class="nav-item">
          <a class="nav-link" href="gallery.php">Gallery</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="committee.php">Committee</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="Leagueadmin.php">League Admin</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="Handbook.php">Handbook</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="tables.php">Tables</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="result.php">Results</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="admin.php">Admin only</a>
        </li>
        
       
       
<?php
session_start();
include_once("setseason.php");
if(isset($_SESSION['clubname'])){
echo('<li>
<a class="nav-link">Hi '.$_SESSION['clubname'].'</a>
</li> 
<li>
  <a class="nav-link" href="changepassword.php">Change Password</a>
</li>
<li class="nav-item">
  <a class="nav-link" href="clubadmin.php">Club Admin</a>
</li>
<li>
  <a class="nav-link" href="logout.php">Logout</a>
</li>');
}else{
  echo('<li>
  <a class="nav-link" href="login.php">Login</a>
  </li>');
}?>

      </ul>
      
    </div>
  </div>
</nav>



</body>
</html>


