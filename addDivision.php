<?php
header("Location:Leagueadmin.php");
print_r($_POST);

include_once("connection.php");
$stmt = $conn->prepare("INSERT INTO TblDivision(DivisionID,Name,LeagueID)
    VALUES (NULL,:name,:LID)");
    $stmt->bindParam(':name', $_POST["Divisionname"]);
    $stmt->bindParam(':LID', $_POST["typeofleague"]);
    $stmt->execute();
?>