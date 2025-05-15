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
$stmt = $conn->prepare("INSERT INTO TblClub(ClubID,Clubname, Location, Website, Instagram, Facebook, 
    Contactname, Contactnumber, Contactemail, Clubsecretaryname, Clubsecretarynumber, Clubsecretaryemail, Matchsecretaryname, Matchsecretarynumber, Matchsecretaryemail,
    Clubnight, Matchnight, Password, Junior)VALUES
     (NULL,:cn,:loc,:web,:insta,:fb,:connam,:connum,:conemail,:csnam,:csnum,:csemail,:msnam,:msnum,:msemail,:cnight,:mnight,:pw,:junsen)");
    $stmt->bindParam(':cn', $_POST["clubname"]);
    $stmt->bindParam(':loc', $_POST["location"]);
    $stmt->bindParam(':web', $_POST["website"]);
    $stmt->bindParam(':insta', $_POST["instagram"]);
    $stmt->bindParam(':fb', $_POST["facebook"]);
    $stmt->bindParam(':connam', $_POST["contactname"]);
    $stmt->bindParam(':connum', $_POST["contactnumber"]);
    $stmt->bindParam(':conemail', $_POST["contactemail"]);
    $stmt->bindParam(':csnam', $_POST["clubsecretaryname"]);
    $stmt->bindParam(':csnum', $_POST["clubsecretarynumber"]);
    $stmt->bindParam(':csemail', $_POST["clubsecretaryemail"]);
    $stmt->bindParam(':msnam', $_POST["matchsecretaryname"]);
    $stmt->bindParam(':msnum', $_POST["matchsecretarynumber"]);
    $stmt->bindParam(':msemail', $_POST["matchsecretaryemail"]);
    $stmt->bindParam(':cnight', $_POST["clubnight"]);
    $stmt->bindParam(':mnight', $_POST["matchnight"]);
    $stmt->bindParam(':pw', $hashed_password);
    $stmt->bindParam(':junsen', $junsen);
    
    $stmt->execute();
?>