
<?php
include_once ("connection.php");
// Check if the form is submitted to update the item

   print_r($_POST);
   if (!isset($_POST["member"])){
    $act=0;
   }else {
    $act=1;
   
   }
   echo($act);
    $sql = "UPDATE tblplayers SET Forename = :forename, Surname = :surname, Gender = :gender, DOB = :dob, active = :act
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
    print_r($params);
    $stmt->execute($params);
    echo("<script>
        alert('Player Details Updated');
        window.location.href='editclub.php';
    </script>");#alert followed by redirect
      
      ?>