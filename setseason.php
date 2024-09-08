<?php
include_once('connection.php');
if(session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
      }
	$stmt = $conn->prepare("Select Season FROM TblSeason WHERE current=1");
    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$_SESSION["Season"]=$row["Season"];
     
		}

    ?>