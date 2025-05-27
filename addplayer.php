
<?php
if(session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
  }
include_once ("connection.php");
// Check if the form is submitted to update the item

   print_r($_POST);
 
    $sql = "INSERT INTO TblPlayers(PlayerID,Gender,Forename,Surname,DOB,ClubID,active)VALUES 
    (NULL,:gender,:forename,:surname,:dob,:cid,1)";
    $stmt = $conn->prepare($sql);
    $params=[
        ':forename' => $_POST['forename'], 
        ':surname' => $_POST['surname'], 
        ':gender' => $_POST['gender'],
        ':dob' => $_POST['dob'],
        ':cid'=>$_POST['clubid']
    ];
    print_r($params);
    $stmt->execute($params);
    // Determine the redirect URL based on the session variable
    $redirect = 'clubadmin.php';  // Default redirect URL
    print_r($_SESSION);
    if (isset($_SESSION['adloggedin'])) {
        // Use the value from the session variable if it is set
         $redirect = "Leagueadmin.php";
        echo("£");
    }
    echo("<script>
        alert('Details Updated');
        window.location.href='$redirect'; 
    </script>"); #alert followed by redirect
      
      ?>