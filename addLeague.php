<?php
if(session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
  }
  print_r($_SESSION);
  if (!isset($_SESSION['adloggedin']))
  {
      header("Location:index.php");
  }
  header("Location:admin.php");
print_r($_POST);

include_once("connection.php");
$stmt = $conn->prepare("INSERT INTO TblLeague(LeagueID,Name,Details)
    VALUES (NULL,:name,:details)");
    $stmt->bindParam(':name', $_POST["LeagueName"]);
    $stmt->bindParam(':details', $_POST["Details"]);
    $stmt->execute();
?>