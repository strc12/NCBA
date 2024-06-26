
<?php
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
    echo("<script>
        alert('Player Details Updated');
        
    </script>");#alert followed by redirect
      
      ?>