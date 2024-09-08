<?php
if(session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
  }
  print_r($_SESSION);
  if (!isset($_SESSION['adloggedin']))
  {
      header("Location:index.php");
  }
  header("Location:admin.php");
include_once('connection.php');
	array_map("htmlspecialchars", $_POST);
	//create order if not already created
    print_r($_POST);
	$stmt = $conn->prepare("INSERT INTO TblMedia(MediaID,embedcode,dateadded,type)
    VALUES (NULL,:emb,NULL,:type)");
    $stmt->bindParam(':emb', $_POST["embedcode"]);
    $stmt->bindParam(':type', $_POST["type"]);
    
    $stmt->execute();
    ?>