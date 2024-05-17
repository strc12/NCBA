<?php
include_once('connection.php');
	array_map("htmlspecialchars", $_POST);
	//create order if not already created
    print_r($_POST);
	$stmt = $conn->prepare("INSERT INTO TblMedia(MediaID,embedcode,dateadded,type)
    VALUES (NULL,:emb,NULL,:type)");
    $stmt->bindParam(':emb', $_POST["embedcode"]);
    $stmt->bindParam(':type', $_POST["type"]);
    
    $stmt->execute();