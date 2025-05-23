<?php
session_start();
print_r($_POST);
include_once ("connection.php");
array_map("htmlspecialchars", $_POST);    
if ($_POST["current"]==1){
    $current=0;
}else{
    $current=1;
}

#Club has team - to store team details i.e kettering A, oundle ladies Towster doubles A
    print_r($_POST);
    print_r($_SESSION);
    $stmt = $conn->prepare("
        UPDATE TblClubhasteam
        SET current = :current
        WHERE ClubhasteamID = :chtid
    ");

    $stmt->bindParam(':current', $current, PDO::PARAM_INT);
    $stmt->bindParam(':chtid', $_POST["clubteamid"], PDO::PARAM_INT);

    $stmt->execute();
    $stmt->closeCursor();
?>