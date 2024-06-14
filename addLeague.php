<?php
#header("Location:Leagueadmin.php");
print_r($_POST);

include_once("connection.php");
$stmt = $conn->prepare("INSERT INTO TblLeague(LeagueID,Name,Details)
    VALUES (NULL,:name,:details)");
    $stmt->bindParam(':name', $_POST["LeagueName"]);
    $stmt->bindParam(':details', $_POST["Details"]);
    $stmt->execute();
?>