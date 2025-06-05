<?php
if(session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
  }
include_once ("connection.php");
// Check if the form is submitted to update the item

   #print_r($_POST);
   if (!isset($_POST["member"])){
    $act=0;
   }else {
    $act=1;
   
   }
   #echo($act);
    $sql = "UPDATE TblPlayers SET Forename = :forename, Surname = :surname, Gender = :gender, DOB = :dob, active = :act
     WHERE PlayerID = :id";
    $stmt = $conn->prepare($sql);
    $params=[
        ':forename' => $_POST['Forename'], 
        ':surname' => $_POST['Surname'], 
        ':gender' => $_POST['Gender'],
        ':dob' => $_POST['dob'],
        ':act'=>$act,
        ':id'=>$_POST['playerid']
    ];
    #print_r($params);
    $stmt->execute($params);
    // Determine the redirect URL based on the session variable
    $redirectUrl = 'clubadmin.php';  // Default redirect URL
    #print_r($_SESSION);
    if (isset($_SESSION['adloggedin'])) {
        // Use the value from the session variable if it is set
        $redirectUrl = "Leagueadmin.php";
    }
    #print_r($redirectUrl);
    echo("<script>
        alert('Player Details Updated');
        window.location.href='$redirectUrl';
    </script>");#alert followed by redirect
      
?>