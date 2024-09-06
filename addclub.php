<?php
if(session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
  }
  if (!isset($_SESSION['adloggedin']))
  {
      header("Location:index.php");
  }

header("Location:index.php");
print_r($_POST);
if(isset($_POST["junior"]) and isset($_POST["senior"])){
    $junsen=2;
}elseif(isset($_POST["junior"])){
    $junsen=1;
}else{
    $junsen=0;
}
echo($junsen);
include_once("connection.php");
$hashed_password = password_hash($_POST["password"], PASSWORD_DEFAULT);
$stmt = $conn->prepare("INSERT INTO TblClub(ClubID,Clubname,location,Website,Contactname,Contactnumber,Clubnight,Contactemail,password,junior)
    VALUES (NULL,:cn,:loc,:web,:connam,:connum,:night,:email,:pw,:junsen)");
    $stmt->bindParam(':cn', $_POST["clubname"]);
    $stmt->bindParam(':loc', $_POST["location"]);
    $stmt->bindParam(':web', $_POST["website"]);
    $stmt->bindParam(':connam', $_POST["contactname"]);
    $stmt->bindParam(':connum', $_POST["contactnumber"]);
    $stmt->bindParam(':night', $_POST["clubnight"]);
    $stmt->bindParam(':email', $_POST["contactemail"]);
    $stmt->bindParam(':pw', $hashed_password);
    $stmt->bindParam(':junsen', $junsen);
    
    $stmt->execute();
?>