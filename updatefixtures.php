<?php
session_start();

include_once ("connection.php");
array_map("htmlspecialchars", $_POST);
$keys=array_keys($_POST);//extracts keys as a separate array
foreach($keys as $fixt){
    $stmt = $conn->prepare("UPDATE TblMatches SET Fixturedate=:fixtdate WHERE MatchID=$fixt");
    $stmt->bindParam(':fixtdate', $_POST[$fixt]);    
    $stmt->execute();
}

header("Location:fixturedates.php");
?>