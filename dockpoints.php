<?php
include_once ("connection.php");
// Check if the form is submitted to update the item

   print_r($_POST);
 
   $sql = "UPDATE tblclubhasteam SET dock = dock+1
   WHERE ClubhasteamID = :id";
  $stmt = $conn->prepare($sql);
  $params=[
        ':id'=>$_POST['teamtodock']
  ];
  print_r($params);
  $stmt->execute($params);
  echo("<script>
        alert('Point docked');
        window.location.href='Leagueadmin.php';
    </script>");#alert followed by redirect
?>