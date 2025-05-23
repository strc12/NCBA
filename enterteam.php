<?php
    if(session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // The request is using the POST method
        
        $id=$_SESSION['clubid'];
    } elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
        if (empty($_GET)) {
            // No query parameters are provided
            
            $id=$_SESSION['clubid'];
            
          
        } else {
            // Query parameters are provided
            #echo("not");
            $id=intval($_GET['q']);
        }
        // The request is using the GET method
    }
    #print_r($_SESSION);
    echo($id);
    
include_once ("connection.php");
array_map("htmlspecialchars", $_POST);    
$bob="bob";
#Club has team - to store team details i.e kettering A, oundle ladies Towster doubles A
    print_r($_POST);
    print_r($_SESSION);
    $stmt = $conn->prepare("INSERT INTO TblClubhasteam(ClubhasteamID,ClubID,DivisionID,Name)VALUES 
    (NULL,:CID,:DID,:tname)");
    $stmt->bindParam(':CID', $_POST["Club_id"]); 
    $stmt->bindParam(':DID', $_POST["typeofleague"]); 
    $stmt->bindParam(':tname', $_POST["clubname"]); 
    $stmt->execute();
    $stmt->closeCursor();
?>