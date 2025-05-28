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
$redirect = 'fixturedates.php';  // Default redirect URL
    
    if (isset($_SESSION['adloggedin'])) {
        // Use the value from the session variable if it is set
         $redirect = "Leagueadmin.php";
    }
echo("<script>
        alert('Fixture Dates Updated');
        window.location.href='$redirect'; 
    </script>"); #alert followed by redirect
      

?>