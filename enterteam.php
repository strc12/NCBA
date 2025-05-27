<?php
    if(session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    if (isset($_SESSION['adloggedin'])){
        $id = $_POST['id'];
        $Clubname = $_POST['clubname'];
        $redirect="Leagueadmin.php";
       # echo("bob");
    }
    elseif (isset($_SESSION["clubid"])){
        $id =$_SESSION["clubid"];
        $Clubname = $_POST['clubname'];
        $redirect="clubadmin.php";
        #echo("dave");
    }else{
        $id = $_POST['id'];
        $Clubname = $_POST['clubname'];
        $redirect="Leagueadmin.php";#from league admin page need to check when admin login set
        #echo("SFD");
    }
    
    echo($redirect);
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
     echo("<script>
        alert('Details Updated');
        window.location.href='$redirect'; 
    </script>"); #alert followed by redirect
?>