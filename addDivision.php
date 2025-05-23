<?php
if(session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
  }
  print_r($_SESSION);
  if (!isset($_SESSION['adloggedin']))
  {
      header("Location:index.php");
  }
  header("Location:Leagueadmin.php");
print_r($_POST);

include_once("connection.php");
$stmt = $conn->prepare("INSERT INTO TblDivision(DivisionID,Name,LeagueID, Divisionrank)
    VALUES (NULL,:name,:LID,:DR)");
    $stmt->bindParam(':name', $_POST["Divisionname"]);
    $stmt->bindParam(':LID', $_POST["typeofleague"]);
    $stmt->bindParam(':DR', $_POST["Rank"]);
    $stmt->execute();
?>